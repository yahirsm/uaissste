<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Http\Response;

// Asegúrate que esta clase exista y esté correctamente instalada
use Mpdf\Mpdf;

class ReporteController extends Controller
{
    public function index()
    {
        return view('reportes.index');
    }

    public function generarInventarioPDF()
    {
        $materiales = Material::with(['partida', 'tipoInsumo'])->get();

        $html = view('reportes.inventario_pdf', compact('materiales'))->render();

        $mpdf = new \Mpdf\Mpdf([
            'margin_top'    => 40,
            'margin_bottom' => 30,
            'margin_left'   => 10,
            'margin_right'  => 10,
        ]);

        $mpdf->WriteHTML($html);

        // Fuerza la descarga con nombre definido
        return response($mpdf->Output('reporte_inventario.pdf', 'D'), 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function generarBajoStockPDF()
    {
        $materiales = Material::with(['partida', 'tipoInsumo'])
            ->where('stock_actual', '<', 3)
            ->get();

        $html = view('reportes.bajostock_pdf', compact('materiales'))->render();

        $mpdf = new Mpdf(['margin_top' => 40, 'margin_bottom' => 30, 'margin_left' => 10, 'margin_right' => 10]);
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('stock_bajo.pdf', 'D'), 200, ['Content-Type' => 'application/pdf']);
    }

    /** Reporte de caducidad en rango de fechas */
    public function generarCaducidadPDF(Request $request)
    {
        $request->validate([
            'from' => 'required|date',
            'to'   => 'required|date|after_or_equal:from',
        ]);

        $movimientos = Movimiento::with('material')
            ->whereNotNull('fecha_caducidad')
            ->whereBetween('fecha_caducidad', [$request->from, $request->to])
            ->orderBy('fecha_caducidad')
            ->get();

        $html = view('reportes.caducidad_pdf', [
            'movimientos' => $movimientos,
            'from'        => $request->from,
            'to'          => $request->to,
        ])->render();

        $mpdf = new Mpdf(['margin_top' => 40, 'margin_bottom' => 30, 'margin_left' => 10, 'margin_right' => 10]);
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('caducidad.pdf', 'D'), 200, ['Content-Type' => 'application/pdf']);
    }

    public function generarMovimientosMesPDF(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m',
        ]);

        // Parseamos el primer y último día del mes elegido
        $from = Carbon::createFromFormat('Y-m', $request->month)
                     ->startOfMonth();
        $to   = (clone $from)->endOfMonth();

        // Traemos todos los movimientos en ese rango
        $movimientos = Movimiento::with('material')
            ->whereBetween('fecha_movimiento', [$from, $to])
            ->orderBy('fecha_movimiento')
            ->get();

        $html = view('reportes.mensual_movimientos_pdf', [
            'movimientos' => $movimientos,
            'from'        => $from,
            'to'          => $to,
        ])->render();

        $mpdf = new \Mpdf\Mpdf([
            'margin_top'    => 160,
            'margin_bottom' => 100,
            'margin_left'   => 40,
            'margin_right'  => 40,
        ]);
        $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output("movimientos_{$request->month}.pdf", 'D'),
            200,
            ['Content-Type' => 'application/pdf']
        );
    }
}


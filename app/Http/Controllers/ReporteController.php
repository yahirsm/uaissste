<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mpdf\Mpdf;

class ReporteController extends Controller
{
    /**
     * Pantalla principal de reportes
     */
    public function index()
    {
        return view('reportes.index');
    }

    /**
     * Genera el PDF completo de inventario
     */
    public function generarInventarioPDF()
    {
        $materiales = Material::with(['partida', 'tipoInsumo'])->get();

        $html = view('reportes.inventario_pdf', compact('materiales'))->render();

        $mpdf = new Mpdf([
            'tempDir' => storage_path('tmp'),
        ]);

        $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output('reporte_inventario.pdf', 'D'),
            200,
            ['Content-Type' => 'application/pdf']
        );
    }

    /**
     * Genera el PDF con materiales de stock bajo (<3 unidades)
     */
    public function generarBajoStockPDF()
    {
        $materiales = Material::with(['partida', 'tipoInsumo'])
                              ->where('stock_actual', '<', 3)
                              ->get();

        $html = view('reportes.bajostock_pdf', compact('materiales'))->render();

        $mpdf = new Mpdf([
            'tempDir' => storage_path('tmp'),
        ]);

        $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output('stock_bajo.pdf', 'D'),
            200,
            ['Content-Type' => 'application/pdf']
        );
    }

    /**
     * Genera el PDF de caducidad en un rango de fechas
     */
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

        $mpdf = new Mpdf([
            'tempDir' => storage_path('tmp'),
        ]);

        $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output('caducidad.pdf', 'D'),
            200,
            ['Content-Type' => 'application/pdf']
        );
    }

    /**
     * Genera el PDF de movimientos mensuales para un mes dado
     */
    public function generarMovimientosMesPDF(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m',
        ]);

        $from = Carbon::createFromFormat('Y-m', $request->month)->startOfMonth();
        $to   = (clone $from)->endOfMonth();

        $movimientos = Movimiento::with('material')
            ->whereBetween('fecha_movimiento', [$from, $to])
            ->orderBy('fecha_movimiento')
            ->get();

        $html = view('reportes.mensual_movimientos_pdf', compact('movimientos','from','to'))->render();

        $mpdf = new Mpdf([
            'tempDir' => storage_path('tmp'),
        ]);

        $mpdf->WriteHTML($html);

        $filename = "movimientos_{$from->format('Y-m')}.pdf";

        return response(
            $mpdf->Output($filename, 'D'),
            200,
            ['Content-Type' => 'application/pdf']
        );
    }
}

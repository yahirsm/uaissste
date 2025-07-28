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
        // 1) Validamos solo 'from' en formato Y-m
        $request->validate([
            'from' => 'required|date_format:Y-m',
        ]);

        // 2) Creamos el rango: inicio y fin de mes
        $from = Carbon::createFromFormat('Y-m', $request->from)->startOfMonth();
        $to   = (clone $from)->endOfMonth();

        // 3) Query como antes, pero con el rango mensual
        $movimientos = Movimiento::with('material')
            ->whereNotNull('fecha_caducidad')
            ->whereBetween('fecha_caducidad', [$from, $to])
            ->orderBy('fecha_caducidad')
            ->get();

        // 4) Renderizamos la vista (puede seguir siendo 'reportes.caducidad_pdf')
        $html = view('reportes.caducidad_pdf', compact('movimientos', 'from', 'to'))->render();

        $mpdf = new Mpdf(['tempDir' => storage_path('tmp')]);
        $mpdf->WriteHTML($html);

        // Nombre dinámico: caducidad_2025-07.pdf
        $filename = "caducidad_{$from->format('Y-m')}.pdf";

        return response(
            $mpdf->Output($filename, 'D'),
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

        $html = view('reportes.mensual_movimientos_pdf', compact('movimientos', 'from', 'to'))->render();

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
    public function generarMovimientosSemanaPDF(Request $request)
    {
        $request->validate([
            'week' => ['required', 'regex:/^\d{4}-W\d{2}$/']
        ], [
            'week.required' => 'Por favor selecciona una semana.',
            'week.regex'    => 'El formato de semana debe ser YYYY‑Www, por ejemplo 2025‑W30.',
        ]);

        $from = Carbon::parse($request->week)->startOfWeek();
        $to   = (clone $from)->endOfWeek();

        $movimientos = Movimiento::with('material')
            ->whereBetween('fecha_movimiento', [$from, $to])
            ->orderBy('fecha_movimiento')
            ->get();

        $html = view('reportes.semanal_movimientos_pdf', compact('movimientos', 'from', 'to'))->render();

        $mpdf = new Mpdf(['tempDir' => storage_path('tmp')]);
        $mpdf->WriteHTML($html);

        $filename = "movimientos_semana_{$from->format('Y-m-d')}_a_{$to->format('Y-m-d')}.pdf";

        return response(
            $mpdf->Output($filename, 'D'),
            200,
            ['Content-Type' => 'application/pdf']
        );
    }

     public function entradasDiaForm()
    {
        return view('reportes.entradas_dia_form');
    }

    /**
     * Genera el PDF con las entradas del día seleccionado.
     */
    public function generarEntradasDiaPDF(Request $request)
    {
        // 1) Validamos el date input en formato YYYY-MM-DD
        $request->validate([
            'fecha' => 'required|date_format:Y-m-d',
        ]);

        // 2) Creamos Carbon para ese día
        $fecha = Carbon::createFromFormat('Y-m-d', $request->fecha);
        $inicio = $fecha->startOfDay();
        $fin    = $fecha->endOfDay();

        // 3) Traemos sólo movimientos tipo “entrada” en ese rango
        $entradas = Movimiento::with('material')
            ->where('tipo', 'entrada')
            ->whereBetween('fecha_movimiento', [$inicio, $fin])
            ->orderBy('fecha_movimiento')
            ->get();

        // 4) Renderizamos la vista de PDF
        $html = view('reportes.entradas_dia_pdf', compact('entradas','fecha'))->render();

        $mpdf = new Mpdf(['tempDir' => storage_path('tmp')]);
        $mpdf->WriteHTML($html);

        $filename = "entradas_{$fecha->format('Y-m-d')}.pdf";

        return response(
            $mpdf->Output($filename, 'D'),
            200,
            ['Content-Type' => 'application/pdf']
        );
    }

}

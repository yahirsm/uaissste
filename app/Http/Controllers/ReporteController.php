<?php

namespace App\Http\Controllers;

use App\Models\Material;
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
}

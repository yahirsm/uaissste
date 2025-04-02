<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index()
    {
        return view('reportes.index');
    }

    public function generarInventarioPDF()
    {
        $materiales = Material::with(['partida', 'tipoInsumo'])->get();

        $pdf = Pdf::loadView('reportes.inventario_pdf', compact('materiales'));

        return $pdf->download('reporte_inventario.pdf');
    }
}

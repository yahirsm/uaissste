<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class InventarioMovimientoController extends Controller
{
    public function index()
    {
        $movimientos = Movimiento::with('material')->latest()->paginate(15);
        $materiales  = Material::orderBy('descripcion')->get();
        return view('inventario.movimientos.index', compact('movimientos','materiales'));
    }

  public function store(Request $request)
{
    $data = $request->validate([
        'material_id'      => 'required|exists:materiales,id',
        'tipo'             => 'required|in:entrada,salida',
        'cantidad'         => 'required|numeric|min:0.01',
        'unidad'           => 'required|string',
        'fecha_movimiento' => 'required|date',
        'fecha_caducidad'  => 'nullable|date|after_or_equal:fecha_movimiento',
    ]);

    // Recupera el material para revisar stock
    $mat = Material::find($data['material_id']);

    if ($data['tipo'] === 'salida') {
        if ($mat->stock_actual <= 0) {
            return back()
                ->withErrors(['cantidad' => 'Este material no tiene existencias.'])
                ->withInput();
        }
        if ($data['cantidad'] > $mat->stock_actual) {
            return back()
                ->withErrors(['cantidad' => "La cantidad excede el stock actual ({$mat->stock_actual})."])
                ->withInput();
        }
    }

    // Si todo está bien, crea el movimiento
    $mov = Movimiento::create($data);

    // Ajusta stock
    if ($mov->tipo === 'entrada') {
        $mat->increment('stock_actual', $mov->cantidad);
    } else {
        $mat->decrement('stock_actual', $mov->cantidad);
    }

    return back()->with('success', 'Movimiento registrado correctamente.');
}

}

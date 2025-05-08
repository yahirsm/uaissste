<?php

namespace App\Http\Controllers;

use App\Models\Plaza;
use Illuminate\Http\Request;

class PlazaController extends Controller
{
    public function index()
    {
        $plazas = Plaza::orderBy('nombre')->paginate(10);
        return view('plazas.index', compact('plazas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'unique:plazas,nombre'],
        ]);

        Plaza::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('plazas.index')->with('success', '¡Plaza agregada exitosamente!');
    }

    public function update(Request $request, Plaza $plaza)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'unique:plazas,nombre,' . $plaza->id],
        ]);

        $plaza->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('plazas.index')->with('success', '¡Plaza actualizada exitosamente!');
    }

    public function destroy(Plaza $plaza)
    {
        $plaza->delete();

        return redirect()->route('plazas.index')->with('success', '¡Plaza eliminada exitosamente!');
    }
}

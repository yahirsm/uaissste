<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::orderBy('nombre')->paginate(10);
        return view('servicios.index', compact('servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'unique:servicios,nombre'],
        ]);

        Servicio::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('servicios.index')->with('success', '¡Servicio agregado exitosamente!');
    }

    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'unique:servicios,nombre,' . $servicio->id],
        ]);

        $servicio->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('servicios.index')->with('success', '¡Servicio actualizado exitosamente!');
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();

        return redirect()->route('servicios.index')->with('success', '¡Servicio eliminado exitosamente!');
    }
}

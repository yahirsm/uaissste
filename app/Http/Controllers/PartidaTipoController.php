<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use App\Models\TipoInsumo;
use Illuminate\Http\Request;

class PartidaTipoController extends Controller
{
    public function index()
    {
        $partidas = Partida::orderBy('id')->get();
        $tiposInsumo = TipoInsumo::orderBy('tipo_insumo_id')->get();

        return view('inventario.partida', compact('partidas', 'tiposInsumo'));
    }

    public function storePartida(Request $request)
    {
        $request->validate([
            'clave' => 'required|digits:5|unique:partidas,clave',
            'nombre' => 'required|regex:/^[\pL\s]+$/u|max:255'
        ], [
            'clave.digits' => 'La clave debe tener exactamente 5 dígitos.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.'
        ]);

        Partida::create([
            'clave' => $request->clave,
            'nombre' => strtoupper($request->nombre),
        ]);

        return back()->with('success', 'Partida agregada correctamente.');
    }

    public function updatePartida(Request $request, $id)
    {
        $request->validate([
            'clave' => 'required|digits:5|unique:partidas,clave,' . $id,
            'nombre' => 'required|regex:/^[\pL\s]+$/u|max:255'
        ], [
            'clave.digits' => 'La clave debe tener exactamente 5 dígitos.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.'
        ]);

        $partida = Partida::findOrFail($id);
        $partida->update([
            'clave' => $request->clave,
            'nombre' => strtoupper($request->nombre),
        ]);

        return back()->with('success', 'Partida actualizada correctamente.');
    }

    public function destroyPartida($id)
    {
        Partida::destroy($id);
        return back()->with('success', 'Partida eliminada correctamente.');
    }

    public function storeTipo(Request $request)
    {
        $nombre = strtoupper($request->nombre);
    
        $request->validate([
            'nombre' => [
                'required',
                'regex:/^[\pL\s]+$/u',
                'max:255',
                function ($attribute, $value, $fail) use ($nombre) {
                    if (TipoInsumo::whereRaw('UPPER(nombre) = ?', [$nombre])->exists()) {
                        $fail('Este tipo de insumo ya está registrado.');
                    }
                }
            ]
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.'
        ]);
    
        TipoInsumo::create([
            'nombre' => $nombre
        ]);
    
        return back()->with('success', 'Tipo de insumo agregado correctamente.');
    }
    

    public function updateTipo(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|regex:/^[\pL\s]+$/u|max:255'
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.'
        ]);

        $tipo = TipoInsumo::findOrFail($id);
        $tipo->update([
            'nombre' => strtoupper($request->nombre)
        ]);

        return back()->with('success', 'Tipo de insumo actualizado correctamente.');
    }

    public function destroyTipo($id)
    {
        TipoInsumo::destroy($id);
        return back()->with('success', 'Tipo de insumo eliminado correctamente.');
    }
}

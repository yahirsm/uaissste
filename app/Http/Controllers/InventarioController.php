<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Partida;
use App\Models\TipoInsumo;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $materiales = Material::with(['partida', 'tipoInsumo'])
            ->when($search, fn($q) => $q
                ->where('clave', 'like', "%{$search}%")
                ->orWhere('descripcion','like', "%{$search}%")
            )
            ->paginate(7);

        return view('inventario.index', compact('materiales'));
    }

    public function create()
    {
        $partidas = Partida::pluck('nombre','id');
        $tipos    = TipoInsumo::pluck('nombre','tipo_insumo_id');

        return view('inventario.create', compact('partidas','tipos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'clave'          => [
                'required',
                'string',
                'unique:materiales,clave',
                // O bien 10 dígitos numéricos ó MFCB + 6 dígitos
                'regex:/^(?:\d{10}|MFCB\d{6})$/'
            ],
            'descripcion'    => 'required|string',
            'partida_id'     => 'required|exists:partidas,id',
            'tipo_insumo_id' => 'required|exists:tipos_insumo,tipo_insumo_id',
        ], [
            'clave.regex' => 'La clave debe ser 10 dígitos o bien “MFCB” seguido de 6 dígitos.',
        ]);

        Material::create($data);

        return redirect()->route('inventario.index')
                         ->with('success','Material agregado correctamente.');
    }

    public function edit(Material $material)
    {
        $partidas = Partida::pluck('nombre','id');
        $tipos    = TipoInsumo::pluck('nombre','tipo_insumo_id');

        return view('inventario.edit', compact('material','partidas','tipos'));
    }

    public function update(Request $request, Material $material)
    {
        $data = $request->validate([
            'clave'          => [
                'required',
                'string',
                "unique:materiales,clave,{$material->id},id",
                'regex:/^(?:\d{10}|MFCB\d{6})$/'
            ],
            'descripcion'    => 'required|string',
            'partida_id'     => 'required|exists:partidas,id',
            'tipo_insumo_id' => 'required|exists:tipos_insumo,tipo_insumo_id',
        ], [
            'clave.regex' => 'La clave debe ser 10 dígitos o bien “MFCB” seguido de 6 dígitos.',
        ]);

        $material->update($data);

        return redirect()->route('inventario.index')
                         ->with('success','Material actualizado correctamente.');
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('inventario.index')
                         ->with('success','Material eliminado correctamente.');
    }
}

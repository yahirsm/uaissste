<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $materiales = Material::with(['partida', 'tipoInsumo'])
            ->when($search, function ($query, $search) {
                return $query->where('clave', 'like', "%$search%")
                             ->orWhere('descripcion', 'like', "%$search%");
            })->paginate(7);

        return view('inventario.index', compact('materiales'));
    }
}

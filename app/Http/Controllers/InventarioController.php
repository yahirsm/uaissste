<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Partida;
use App\Models\TipoInsumo;
use Illuminate\Http\Request;
use Spatie\Permission\Middleware\PermissionMiddleware; // <-- importa la clase concreta

class InventarioController extends Controller
{
  public function __construct()
    {
        // Aquí sí protegemos cada método con su permiso exacto
        $this->middleware(PermissionMiddleware::class . ':inventario.ver')->only('index');
        $this->middleware(PermissionMiddleware::class . ':inventario.crear')->only(['create','store']);
        $this->middleware(PermissionMiddleware::class . ':inventario.editar')->only(['edit','update']);
        $this->middleware(PermissionMiddleware::class . ':inventario.eliminar')->only('destroy');
    }

    public function index(Request $request)
{
    $materiales = Material::with(['partida','tipoInsumo'])
        ->when($request->search, fn($q) =>
            $q->where('clave','like',"%{$request->search}%")
              ->orWhere('descripcion','like',"%{$request->search}%")
        )
        ->when($request->has('in_stock'), fn($q) =>
            $q->where('stock_actual', '>=', 1)
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
            'clave'          => ['required','string','unique:materiales,clave','regex:/^(?:\d{10}|MFCB\d{6})$/'],
            'descripcion'    => 'required|string',
            'partida_id'     => 'required|exists:partidas,id',
            'tipo_insumo_id' => 'required|exists:tipos_insumo,tipo_insumo_id',
        ],[
            'clave.regex' => 'La clave debe ser 10 dígitos o “MFCB”+6 dígitos.',
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
            'clave'          => ['required','string',"unique:materiales,clave,{$material->id},id",'regex:/^(?:\d{10}|MFCB\d{6})$/'],
            'descripcion'    => 'required|string',
            'partida_id'     => 'required|exists:partidas,id',
            'tipo_insumo_id' => 'required|exists:tipos_insumo,tipo_insumo_id',
        ],[
            'clave.regex' => 'La clave debe ser 10 dígitos o “MFCB”+6 dígitos.',
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

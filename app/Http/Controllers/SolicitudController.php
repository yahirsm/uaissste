<?php

namespace App\Http\Controllers;  // 1) Ajusta el namespace

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Solicitud;
use App\Models\Empleado;            // 2) Importa Empleado
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index()
    {
        $materiales = Material::all()
                        ->filter(fn($m) => $m->stock_actual > 0);

        return view('distribucion.solicitud.index', compact('materiales'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'items'               => 'required|array',
            'items.*.material_id' => 'required|exists:materiales,id',
            'items.*.cantidad'    => 'required|integer|min:1',
        ]);

        // 3) Obtenemos usuario y su empleado
        $user     = $request->user();
        $empleado = $user->empleado;
        if (! $empleado) {
            return back()
                ->with('error','No encontramos tu registro de empleado.')
                ->withInput();
        }

        // 4) Sacamos de allí el servicio actual
        $servicioId = $empleado->servicio_actual_id;
        if (! $servicioId) {
            return back()
                ->with('error','Tu empleado no tiene asignado un servicio actual.')
                ->withInput();
        }

        // 5) Creamos la solicitud con el servicio correcto
        $sol = Solicitud::create([
            'user_id'     => $user->id,
            'servicio_id'=> $servicioId,
        ]);

        // 6) Validamos stock y armamos el pivot
        $attach = [];
        foreach ($data['items'] as $i) {
            $mat = Material::findOrFail($i['material_id']);
            if ($i['cantidad'] > $mat->stock_actual) {
                return back()
                    ->with('error', "La cantidad de {$mat->descripcion} excede el stock disponible.")
                    ->withInput();
            }
            $attach[$i['material_id']] = ['cantidad' => $i['cantidad']];
        }

        $sol->materiales()->attach($attach);

        return redirect()
               ->route('distribucion.pedidos.index')
               ->with('success','Solicitud enviada correctamente.');
    }

    public function show(Solicitud $solicitud)
    {
        $solicitud->load('materiales','user','servicio');

        return view('distribucion.solicitud.show', compact('solicitud'));
    }
}

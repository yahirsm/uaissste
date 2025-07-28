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
        // 1) validamos todo, permitimos 0 en cantidad
        $data = $request->validate([
            'items'                 => 'required|array',
            'items.*.material_id'   => 'required|exists:materiales,id',
            'items.*.cantidad'      => 'required|integer|min:0',
            'items.*.observaciones' => 'nullable|string',
        ]);

        // 2) solo nos importan los que tienen cantidad > 0
        $selected = array_filter($data['items'], fn($i) => $i['cantidad'] > 0);

        if (empty($selected)) {
            return back()
                ->with('error', 'Debes solicitar al menos un material con cantidad mayor a cero.')
                ->withInput();
        }

        // 3) validamos empleado y servicio como antes...
        $user     = $request->user();
        $empleado = $user->empleado;
        if (! $empleado) {
            return back()->with('error', 'No encontramos tu registro de empleado.')->withInput();
        }
        $servicioId = $empleado->servicio_actual_id;
        if (! $servicioId) {
            return back()->with('error', 'Tu empleado no tiene asignado un servicio actual.')->withInput();
        }

        // 4) creamos la solicitud
        $sol = Solicitud::create([
            'user_id'     => $user->id,
            'servicio_id' => $servicioId,
        ]);

        // 5) preparamos el attach pivot y validamos stock
        $attach = [];
        foreach ($selected as $item) {
            $mat = Material::findOrFail($item['material_id']);
            if ($item['cantidad'] > $mat->stock_actual) {
                return back()
                    ->with('error', "La cantidad de “{$mat->descripcion}” excede el stock ({$mat->stock_actual}).")
                    ->withInput();
            }
            $attach[$mat->id] = [
                'cantidad'      => $item['cantidad'],
                'observaciones' => $item['observaciones'] ?? null,
            ];
        }

        // 6) hacemos el attach
        $sol->materiales()->attach($attach);

        return redirect()
            ->route('distribucion.pedidos.index')
            ->with('success', 'Solicitud enviada correctamente.');
    }
    public function show(Solicitud $solicitud)
    {
        $solicitud->load('materiales', 'user', 'servicio');

        return view('distribucion.solicitud.show', compact('solicitud'));
    }
}

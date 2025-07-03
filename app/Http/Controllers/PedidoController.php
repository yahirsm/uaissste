<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use Mpdf\Mpdf;
use App\Models\Movimiento;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Listado de pedidos
     */
    public function index()
    {
        // Traemos los pedidos, con usuario y servicio, ordenados y paginados:
        $pedidos = Solicitud::with(['user', 'servicio'])
            ->orderBy('created_at', 'desc')
            ->paginate(10); // 10 por página (ajústalo a tu gusto)

        return view('distribucion.pedidos.index', compact('pedidos'));
    }

    /**
     * Vista de impresión en navegador
     */
    public function show(Solicitud $solicitud)
    {
        $solicitud->load('materiales', 'user', 'servicio');

        return view('distribucion.pedidos.show', compact('solicitud'));
    }

    public function pdf(Solicitud $solicitud)
    {
        $solicitud->load('materiales', 'user', 'servicio');

        $html = view('distribucion.pedidos.pdf', compact('solicitud'))->render();

        // Solo indicamos tempDir para evitar permisos
        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => storage_path('tmp'),
        ]);

        // Escribimos el HTML y forzamos descarga
        $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output("solicitud_{$solicitud->id}.pdf", 'D'),
            200,
            ['Content-Type' => 'application/pdf']
        );
    }
    public function autorizar(Solicitud $solicitud)
    {
        // Recorremos cada material de la solicitud
        foreach ($solicitud->materiales as $material) {
            Movimiento::create([
                'material_id'      => $material->id,
                'tipo'             => 'salida',
                'cantidad'         => $material->pivot->cantidad,
                // Unidad es obligatorio en tu tabla `movimientos`.
                // Cámbialo por el que uses en tu inventario.
                'unidad'           => 'UND',
                'fecha_movimiento' => now(),
                // Si tu pivot no tiene fecha de caducidad,
                // podemos dejarla nula (la columna debe admitir NULL)
                'fecha_caducidad'  => null,
            ]);
        }

        // Marcamos la solicitud como atendida (suponiendo que
        // en tu migración agregaste el campo 'atendido' booleano)
        $solicitud->update(['atendido' => true]);

        return redirect()
            ->route('distribucion.pedidos.index')
            ->with('success', 'Pedido autorizado y movimientos de salida generados.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;
use Carbon\Carbon;

class PedidoController extends Controller
{
    /**
     * Listado de pedidos
     */
    public function index()
    {
        // PHPDoc para que el IDE entienda que Auth::user() es tu App\Models\User
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user();

        // Traigo siempre los pedidos con usuario y servicio, ordenados
        $query = Solicitud::with(['user', 'servicio'])
                         ->orderBy('created_at', 'desc');

        // Si NO tiene rol Administrador ni Jefe Abasto, solo muestro los suyos
        if (! $authUser->hasAnyRole(['Administrador', 'Jefe Abasto'])) {
            $query->where('user_id', $authUser->id);
        }

        $pedidos = $query->paginate(10);

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

    /**
     * Generar PDF de un pedido
     */
    public function pdf(Solicitud $solicitud)
    {
        $solicitud->load('materiales', 'user', 'servicio');

        $html = view('distribucion.pedidos.pdf', compact('solicitud'))->render();

        $mpdf = new Mpdf(['tempDir' => storage_path('tmp')]);
        $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output("solicitud_{$solicitud->id}.pdf", 'D'),
            200,
            ['Content-Type' => 'application/pdf']
        );
    }

    /**
     * Autorizar pedido: genera movimientos y marca como atendido
     */
    public function autorizar(Solicitud $solicitud)
    {
        foreach ($solicitud->materiales as $material) {
            Movimiento::create([
                'material_id'      => $material->id,
                'tipo'             => 'salida',
                'cantidad'         => $material->pivot->cantidad,
                'unidad'           => 'UND',
                'fecha_movimiento' => now(),
                'fecha_caducidad'  => null,
            ]);
        }

        $solicitud->update(['atendido' => true]);

        return redirect()
            ->route('distribucion.pedidos.index')
            ->with('success', 'Pedido autorizado y movimientos de salida generados.');
    }
}

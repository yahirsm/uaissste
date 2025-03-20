<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PreventMultipleSessions
{
    public function handle($request, Closure $next)
    {
        // Si el usuario está autenticado
        if (Auth::check()) {
            // Si existe una sesión activa diferente a la actual
            $currentSessionId = Session::getId();
            $userSessionId = Auth::user()->current_session_id;

            if ($userSessionId && $userSessionId !== $currentSessionId) {
                // Cierra la sesión anterior si el usuario confirma
                Session::getHandler()->destroy($userSessionId);

                // Actualiza el ID de la sesión actual
                Auth::user()->update([
                    'current_session_id' => $currentSessionId,
                ]);
            } else {
                // Guarda el ID de la sesión actual
                Auth::user()->update([
                    'current_session_id' => $currentSessionId,
                ]);
            }
        }

        return $next($request);
    }
}

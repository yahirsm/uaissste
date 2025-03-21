<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SingleSession
{
    public function handle($request, Closure $next)
    {
        // ✅ Verifica que exista una sesión y que el usuario esté autenticado
        if (Auth::check()) {
            $previousSession = Auth::user()->session_id;

            if ($previousSession && $previousSession !== Session::getId()) {
                Session::getHandler()->destroy($previousSession);
                Auth::logout();
                
                // Redirige al login con un mensaje
                return redirect()->route('login')->withErrors([
                    'session' => 'Tu sesión ha sido cerrada porque otra sesión fue iniciada.'
                ]);
            }

            // ✅ Guarda la sesión actual
            Auth::user()->session_id = Session::getId();
            Auth::user()->save();
        }

        return $next($request);
    }
}

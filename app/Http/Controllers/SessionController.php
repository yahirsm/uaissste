<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function logoutPrevious()
    {
        $user = Auth::user();

        if ($user && $user->session_id) {
            // ✅ Destruye la sesión anterior
            Session::getHandler()->destroy($user->session_id);
            
            // ✅ Actualiza el ID de sesión a la actual
            $user->update(['session_id' => Session::getId()]);
        }

        return redirect()->route('dashboard');
    }
}

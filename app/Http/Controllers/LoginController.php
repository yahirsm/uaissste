<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class LoginController extends Controller
    {
        public function store(Request $request)
        {
            $credentials = $request->validate([
                'username' => ['required', 'string'],
                'password' => ['required', 'string'],
            ]);

            if (!Auth::attempt([
                'username' => $credentials['username'],
                'password' => $credentials['password'],
            ], $request->boolean('remember'))) {
                return back()->with('error', 'Usuario o contraseña incorrectos. Verifica tus datos.');
            }

            $request->session()->regenerate();

            return redirect()->intended(config('fortify.home'));
        }
    }

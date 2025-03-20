<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Auth; 

// Redirigir la página de inicio al login
Route::get('/', function () {
    return redirect()->route('login');
});

// ✅ Si el usuario ya inició sesión, redirigir al dashboard
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard'); // ✅ Ahora debería funcionar correctamente
    }
    return view('auth.login');
})->name('login');

// Grupo de rutas protegidas por autenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // ✅ Ruta para la vista de dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ✅ Redirigir automáticamente a /dashboard después de iniciar sesión
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    });

    // ✅ Ruta para la vista de inventario
    Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
    
    // ✅ Rutas para empleados (que son usuarios)
    Route::resource('usuarios', EmpleadoController::class);
});

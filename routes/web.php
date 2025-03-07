<?php

 // Importación del controlador UserController
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; // Importación del controlador UserController
use App\Http\Controllers\InventarioController; // Importación del InventarioController

// Redirigir la página de inicio al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Grupo de rutas protegidas por autenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Ruta para la vista de dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Ruta para la vista de inventario (usando el controlador)
    Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
    
    // Ruta para la vista de usuarios (modificada de la misma forma que inventario)
    Route::get('/usuarios', function () {
        return view('usuarios.usuarios'); // Ruta correcta para la vista
    })->name('usuarios.usuarios');
});

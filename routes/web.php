<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PartidaTipoController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


Route::fallback(function () {
    abort(404);
});


// Ruta raíz redirecciona a login
Route::get('/', function () {
    return redirect()->route('login');
});

// Mostrar formulario de login
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login');

// Procesar login
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Verificación de existencia
Route::get('/verificar-empleado/{numero}', function ($numero) {
    return response()->json([
        'exists' => \App\Models\Empleado::where('numero_empleado', $numero)->exists()
    ]);
});

Route::get('/verificar-usuario/{username}', function ($username) {
    return response()->json([
        'exists' => \App\Models\User::where('username', $username)->exists()
    ]);
});

// Rutas protegidas con middleware de autenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', function () {
        return redirect()->route('dashboard');
    });

    // Inventario
    Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');

    // Usuarios (empleados)
    Route::resource('usuarios', EmpleadoController::class);

    // Servicios
    Route::resource('servicios', ServicioController::class)->only(['index', 'store', 'update', 'destroy']);

    // Plazas
    Route::resource('plazas', PlazaController::class)->only(['index', 'store', 'update', 'destroy']);

    // Reportes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/inventario/pdf', [ReporteController::class, 'generarInventarioPDF'])->name('reportes.inventario.pdf');

    // Partidas y Tipos de Insumo
    Route::get('/inventario/partidas-tipos', [PartidaTipoController::class, 'index'])->name('inventario.partida');

    // Partidas
    Route::post('/partidas', [PartidaTipoController::class, 'storePartida'])->name('partidas.store');
    Route::put('/partidas/{id}', [PartidaTipoController::class, 'updatePartida'])->name('partidas.update');
    Route::delete('/partidas/{id}', [PartidaTipoController::class, 'destroyPartida'])->name('partidas.destroy');

    // Tipos de Insumo
    Route::post('/tipos-insumo', [PartidaTipoController::class, 'storeTipo'])->name('tipos.store');
    Route::put('/tipos-insumo/{id}', [PartidaTipoController::class, 'updateTipo'])->name('tipos.update');
    Route::delete('/tipos-insumo/{id}', [PartidaTipoController::class, 'destroyTipo'])->name('tipos.destroy');
});

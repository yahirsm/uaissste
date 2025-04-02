<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ReporteController;

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');

    Route::resource('usuarios', EmpleadoController::class);

    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/inventario/pdf', [ReporteController::class, 'generarInventarioPDF'])->name('reportes.inventario.pdf');
});

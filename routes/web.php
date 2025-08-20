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
use App\Http\Controllers\InventarioMovimientoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\PedidoController;

use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

Route::fallback(fn() => abort(404));

Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', function () {
     if (Auth::check()) {
          return redirect()->route('dashboard');
     }
     return view('auth.login');
})->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// AJAX de verificación
Route::get(
     '/verificar-empleado/{numero}',
     fn($numero) =>
     response()->json([
          'exists' => \App\Models\Empleado::where('numero_empleado', $numero)->exists()
     ])
);
Route::get(
     '/verificar-usuario/{username}',
     fn($username) =>
     response()->json([
          'exists' => \App\Models\User::where('username', $username)->exists()
     ])
);

Route::middleware([
     'auth:sanctum',
     config('jetstream.auth_session'),
     'verified',
])->group(function () {
     // Dashboard
     Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
     Route::get('/home', fn() => redirect()->route('dashboard'));

     // —— Usuarios (solo Administrador) ——
     Route::resource('usuarios', EmpleadoController::class)
          ->middleware(RoleMiddleware::class . ':Administrador');

     // —— Servicios (solo Administrador) ——
     Route::resource('servicios', ServicioController::class)
          ->only(['index', 'store', 'update', 'destroy'])
          ->middleware(RoleMiddleware::class . ':Administrador');

     // —— Plazas (solo Administrador) ——
     Route::resource('plazas', PlazaController::class)
          ->only(['index', 'store', 'update', 'destroy'])
          ->middleware(RoleMiddleware::class . ':Administrador');

     Route::resource('inventario', InventarioController::class)
          ->except(['show'])
          ->parameters(['inventario' => 'material'])
          ->names([
               'index'   => 'inventario.index',
               'create'  => 'inventario.create',
               'store'   => 'inventario.store',
               'edit'    => 'inventario.edit',
               'update'  => 'inventario.update',
               'destroy' => 'inventario.destroy',
          ])
          // Solo lectura aquí
          ->middleware(PermissionMiddleware::class . ':inventario.ver');

     // —— Reportes —— 
     Route::get('/reportes', [ReporteController::class, 'index'])
          ->name('reportes.index')
          ->middleware(PermissionMiddleware::class . ':reportes.ver');
     Route::get('/reportes/inventario/pdf', [ReporteController::class, 'generarInventarioPDF'])
          ->name('reportes.inventario.pdf')
          ->middleware(PermissionMiddleware::class . ':reportes.ver');

     Route::get('/reportes/inventario/stock-bajo', [ReporteController::class, 'generarBajoStockPDF'])
          ->name('reportes.stockBajo.pdf')
          ->middleware(PermissionMiddleware::class . ':reportes.ver');

     // PDF de caducidad en rango de fechas (pasa ?from=YYYY-MM-DD&to=YYYY-MM-DD)
     Route::get('/reportes/inventario/caducidad', [ReporteController::class, 'generarCaducidadPDF'])
          ->name('reportes.caducidad.pdf')
          ->middleware(PermissionMiddleware::class . ':reportes.ver');

     // PDF de movimientos de mes (pasa ?month=YYYY-MM)
     Route::get('/reportes/movimientos-mes', [ReporteController::class, 'generarMovimientosMesPDF'])
          ->name('reportes.movimientosMes.pdf')
          ->middleware(PermissionMiddleware::class . ':reportes.ver');
     // Movimientos Semanales (input week)
     Route::get('/reportes/movimientos-semana', [ReporteController::class, 'generarMovimientosSemanaPDF'])
          ->name('reportes.movimientosSemana.pdf')
          ->middleware(PermissionMiddleware::class . ':reportes.ver');


     Route::get('/reportes/entradas-dia', [ReporteController::class, 'entradasDiaForm'])
          ->name('reportes.entradasDia.form')
          ->middleware(PermissionMiddleware::class . ':reportes.ver');

     // Generar PDF de entradas del día seleccionado
     Route::get('/reportes/entradas-dia/pdf', [ReporteController::class, 'generarEntradasDiaPDF'])
          ->name('reportes.entradasDia.pdf')
          ->middleware(PermissionMiddleware::class . ':reportes.ver');

     // —— Partidas y Tipos de Insumo —— 
     Route::get('/inventario/partidas-tipos', [PartidaTipoController::class, 'index'])
          ->name('inventario.partida')
          ->middleware(PermissionMiddleware::class . ':inventario.ver');
     Route::post('/partidas', [PartidaTipoController::class, 'storePartida'])
          ->name('partidas.store')
          ->middleware(PermissionMiddleware::class . ':inventario.crear');
     Route::put('/partidas/{id}', [PartidaTipoController::class, 'updatePartida'])
          ->name('partidas.update')
          ->middleware(PermissionMiddleware::class . ':inventario.editar');
     Route::delete('/partidas/{id}', [PartidaTipoController::class, 'destroyPartida'])
          ->name('partidas.destroy')
          ->middleware(PermissionMiddleware::class . ':inventario.eliminar');

     Route::post('/tipos-insumo', [PartidaTipoController::class, 'storeTipo'])
          ->name('tipos.store')
          ->middleware(PermissionMiddleware::class . ':inventario.crear');
     Route::put('/tipos-insumo/{id}', [PartidaTipoController::class, 'updateTipo'])
          ->name('tipos.update')
          ->middleware(PermissionMiddleware::class . ':inventario.editar');
     Route::delete('/tipos-insumo/{id}', [PartidaTipoController::class, 'destroyTipo'])
          ->name('tipos.destroy')
          ->middleware(PermissionMiddleware::class . ':inventario.eliminar');

     // —— Movimientos de Inventario —— 
     Route::resource('inventario/movimientos', InventarioMovimientoController::class)
          ->only(['index', 'store'])
          ->names([
               'index' => 'inventario.movimientos.index',
               'store' => 'inventario.movimientos.store',
          ])
          ->middleware([
               PermissionMiddleware::class . ':inventario.ver',
               PermissionMiddleware::class . ':inventario.crear',
          ]);

     // —— Distribución —— 
     Route::prefix('distribucion')->name('distribucion.')->group(function () {
          // Solicitudes
          Route::get('solicitud', [SolicitudController::class, 'index'])
               ->name('solicitud.index')
               ->middleware(PermissionMiddleware::class . ':solicitudes.ver');
          Route::post('solicitud', [SolicitudController::class, 'store'])
               ->name('solicitud.store')
               ->middleware(PermissionMiddleware::class . ':solicitudes.crear');
          Route::get('solicitud/{solicitud}', [SolicitudController::class, 'show'])
               ->name('solicitud.show')
               ->middleware(PermissionMiddleware::class . ':solicitudes.ver');

          // Pedidos
          Route::get('pedidos', [PedidoController::class, 'index'])
               ->name('pedidos.index')
               ->middleware(PermissionMiddleware::class . ':pedidos.ver');
          Route::get('pedidos/{solicitud}', [PedidoController::class, 'show'])
               ->name('pedidos.show')
               ->middleware(PermissionMiddleware::class . ':pedidos.ver');
          Route::get('pedidos/{solicitud}/pdf', [PedidoController::class, 'pdf'])
               ->name('pedidos.pdf')
               ->middleware(PermissionMiddleware::class . ':pedidos.ver');
          Route::post('pedidos/{solicitud}/autorizar', [PedidoController::class, 'autorizar'])
               ->name('pedidos.autorizar')
               ->middleware(PermissionMiddleware::class . ':solicitudes.aprobar');
     });
});

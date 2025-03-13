    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\InventarioController;
    use App\Http\Controllers\EmpleadoController; // Si los empleados son usuarios, este controlador manejará todo

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
        
        // ✅ Rutas para usuarios (que son empleados)
        Route::resource('usuarios', EmpleadoController::class);
    });

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body class="font-sans antialiased">
    <?php echo $__env->make('layouts.partials.admin.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('layouts.partials.admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

      <!-- Contenido principal -->
    <div class="p-4 sm:ml-64">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 mt-14 text-center">

            <!-- Logo y saludo dinámico -->
            <img src="<?php echo e(asset('images/logo.svg')); ?>" alt="Logo ISSSTE" class="mx-auto w-40 h-40 mb-8">

            <?php
                date_default_timezone_set('America/Mexico_City');
                $hora = date('H');
                $saludo = $hora >= 6 && $hora < 12 ? 'Buenos días' : ($hora >= 12 && $hora < 18 ? 'Buenas tardes' : 'Buenas noches');
            ?>

            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                <?php echo e($saludo); ?>, <?php echo e(auth()->user()->name ?? 'Usuario'); ?>!
            </h2>

            <!-- Botones de acceso rápido -->
            <div class="mt-6 flex justify-center gap-6">
                <a href="#" class="flex flex-col items-center justify-center bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-4 px-6 rounded-lg shadow-md transition w-48 h-24">
                    <i class="fas fa-boxes text-3xl mb-2"></i>
                    <span>Inventario</span>
                </a>
                <a href="#" class="flex flex-col items-center justify-center bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-4 px-6 rounded-lg shadow-md transition w-48 h-24">
                    <i class="fas fa-receipt text-3xl mb-2"></i>
                    <span>Vales</span>
                </a>
                <a href="#" class="flex flex-col items-center justify-center bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-4 px-6 rounded-lg shadow-md transition w-48 h-24">
                    <i class="fas fa-chart-line text-3xl mb-2"></i>
                    <span>Reportes</span>
                </a>
            </div>
        </div>
    </div>

    <?php echo $__env->yieldPushContent('modals'); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>

</html>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/layouts/admin.blade.php ENDPATH**/ ?>
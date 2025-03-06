<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php echo $__env->make('layouts.partials.admin.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('layouts.partials.admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Contenedor principal con margen izquierdo ajustado -->
    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 text-center">
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
            <div class="mt-6 flex flex-wrap justify-center gap-6">
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/dashboard.blade.php ENDPATH**/ ?>
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

    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-3xl font-bold text-red-700 dark:text-white mb-4">
                <i class="fas fa-id-card"></i> Detalle del Empleado
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nombre -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Nombre:</p>
                    <p class="text-lg text-gray-900 dark:text-white"><?php echo e($empleado->nombre); ?></p>
                </div>

                <!-- Primer Apellido -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Primer Apellido:</p>
                    <p class="text-lg text-gray-900 dark:text-white"><?php echo e($empleado->primer_apellido); ?></p>
                </div>

                <!-- Segundo Apellido -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Segundo Apellido:</p>
                    <p class="text-lg text-gray-900 dark:text-white"><?php echo e($empleado->segundo_apellido); ?></p>
                </div>

                <!-- Número de Empleado -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Número de Empleado:</p>
                    <p class="text-lg text-gray-900 dark:text-white"><?php echo e($empleado->numero_empleado); ?></p>
                </div>

                <!-- RFC -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">RFC:</p>
                    <p class="text-lg text-gray-900 dark:text-white"><?php echo e($empleado->rfc); ?></p>
                </div>

                <!-- Servicio Actual -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Servicio Actual:</p>
                    <p class="text-lg text-gray-900 dark:text-white">
                        <?php echo e($empleado->servicioActual?->nombre ?? 'N/A'); ?>

                    </p>
                </div>

                <!-- Plaza -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Plaza:</p>
                    <p class="text-lg text-gray-900 dark:text-white">
                        <?php echo e($empleado->plaza?->nombre ?? 'N/A'); ?>

                    </p>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex justify-end space-x-2">
                <a href="<?php echo e(route('usuarios.index')); ?>"
                    class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition">
                    Volver
                </a>
                <a href="<?php echo e(route('usuarios.edit', $empleado->id)); ?>"
                    class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                    Editar
                </a>
            </div>
        </div>
    </div>
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/usuarios/show.blade.php ENDPATH**/ ?>
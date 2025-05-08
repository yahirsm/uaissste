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
            <!-- Usuario -->
<?php if($empleado->user): ?>
<div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Usuario -->
    <div>
        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Usuario:</p>
        <p class="text-lg text-gray-900 dark:text-white bg-blue-50 dark:bg-gray-800 px-3 py-2 rounded border border-gray-300 dark:border-gray-600">
            <?php echo e($empleado->user->username); ?>

        </p>
    </div>

    <!-- Contraseña -->
    <div>
        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Contraseña:</p>
        <div class="relative">
            <input type="password" id="passwordField"
                value="<?php echo e(strtolower(substr($empleado->nombre, 0, 1)) . strtolower(substr($empleado->primer_apellido, 0, 1)) . strtolower(substr($empleado->segundo_apellido ?? 'x', 0, 1)) . $empleado->numero_empleado . '#'); ?>"
                class="w-full p-2 pr-10 border rounded bg-blue-50 text-gray-900 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                readonly>
            <button type="button" onclick="togglePassword()"
                class="absolute right-2 top-2 text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white">
                <i id="eyeIcon" class="fas fa-eye"></i>
            </button>
        </div>
    </div>
</div>
<?php endif; ?>



            <!-- Servicios Anteriores -->
            <div class="mt-6">
                <h3 class="text-xl font-bold text-red-700 dark:text-white mb-2">
                    <i class="fas fa-history"></i> Servicios Anteriores
                </h3>
                <?php if($empleado->serviciosAnteriores->isNotEmpty()): ?>
                    <h3 class="text-xl font-bold mt-4">Historial de Servicios</h3>
                    <ul class="list-disc pl-5">
                        <?php $__currentLoopData = $empleado->serviciosAnteriores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($servicio->nombre); ?> (<?php echo e($servicio->pivot->fecha_inicio); ?> -
                                <?php echo e($servicio->pivot->fecha_fin ?? 'Actual'); ?>)</li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>

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
<script>
    function togglePassword() {
        const input = document.getElementById('passwordField');
        const icon = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/usuarios/show.blade.php ENDPATH**/ ?>
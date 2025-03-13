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
                <i class="fas fa-users"></i> Lista de Empleados
            </h2>

            <?php if(session('success')): ?>
                <div class="bg-green-500 text-white p-2 mb-4 rounded">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <!-- Tabla de empleados -->
            <div class="overflow-x-auto">
                <table class="table-fixed w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                    <thead class="bg-red-700 text-white">
                        <tr>
                            <th class="px-4 py-2 w-32">Nombre</th>
                            <th class="px-4 py-2 w-32">Primer Apellido</th>
                            <th class="px-4 py-2 w-32">Segundo Apellido</th>
                            <th class="px-4 py-2 w-32">Número de Empleado</th>
                            <th class="px-4 py-2 w-40">RFC</th>
                            <th class="px-4 py-2 w-40">Servicio Actual</th>
                            <th class="px-4 py-2 w-32">Plaza</th>
                            <th class="px-4 py-2 w-40 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-2 truncate"><?php echo e($empleado->nombre); ?></td>
                                <td class="px-4 py-2 truncate"><?php echo e($empleado->primer_apellido); ?></td>
                                <td class="px-4 py-2 truncate"><?php echo e($empleado->segundo_apellido); ?></td>
                                <td class="px-4 py-2 truncate"><?php echo e($empleado->numero_empleado); ?></td>
                                <td class="px-4 py-2 truncate"><?php echo e($empleado->rfc); ?></td>
                                <td class="px-4 py-2 truncate">
                                    <?php echo e($empleado->servicioActual?->nombre ?? 'N/A'); ?>

                                </td>
                                <td class="px-4 py-2 truncate">
                                    <?php echo e($empleado->plaza?->nombre ?? 'N/A'); ?>

                                </td>
                                <td class="px-4 py-2 flex justify-center space-x-2">
                                    <!-- Botón para ver empleado -->
                                    <a href="<?php echo e(route('usuarios.show', $empleado->id)); ?>"
                                        class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-700"
                                        aria-label="Ver empleado" title="Ver">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>

                                    <!-- Botón para editar empleado -->
                                    <a href="<?php echo e(route('usuarios.edit', $empleado->id)); ?>"
                                        class="bg-yellow-600 text-white py-1 px-3 rounded hover:bg-yellow-700"
                                        aria-label="Editar empleado" title="Editar">
                                        <i class="fas fa-pencil-alt"></i> Editar
                                    </a>

                                    <!-- Botón para eliminar empleado -->
                                    <form action="<?php echo e(route('usuarios.destroy', $empleado->id)); ?>" method="POST"
                                        onsubmit="return confirmarEliminacion('<?php echo e($empleado->nombre); ?>');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                            class="bg-red-600 text-white py-1 px-3 rounded hover:bg-red-700"
                                            aria-label="Eliminar empleado" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script para confirmación personalizada -->
    <script>
        function confirmarEliminacion(nombre) {
            return confirm(`¿Estás seguro de que deseas eliminar a ${nombre}?`);
        }
    </script>
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/usuarios/usuarios.blade.php ENDPATH**/ ?>
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
    <?php $__env->startSection('content'); ?>
        <?php echo $__env->make('layouts.partials.admin.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('layouts.partials.admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="sm:ml-64 p-4 pt-20">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-3xl font-bold text-red-700 dark:text-white mb-4">
                    <i class="fas fa-user-edit"></i> Editar Empleado
                </h2>

                <?php if($errors->any()): ?>
                    <div class="bg-red-600 text-white p-3 mb-4 rounded">
                        <ul class="list-disc list-inside">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('usuarios.update', $empleado->id)); ?>" method="POST" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Nombre
                        </label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo e(old('nombre', $empleado->nombre)); ?>"
                            required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <!-- Primer Apellido -->
                    <div>
                        <label for="primer_apellido" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Primer Apellido
                        </label>
                        <input type="text" id="primer_apellido" name="primer_apellido"
                            value="<?php echo e(old('primer_apellido', $empleado->primer_apellido)); ?>" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <!-- Segundo Apellido -->
                    <div>
                        <label for="segundo_apellido" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Segundo Apellido
                        </label>
                        <input type="text" id="segundo_apellido" name="segundo_apellido"
                            value="<?php echo e(old('segundo_apellido', $empleado->segundo_apellido)); ?>" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <!-- Número de Empleado -->
                    <div>
                        <label for="numero_empleado" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Número de Empleado
                        </label>
                        <input type="number" id="numero_empleado" name="numero_empleado"
                            value="<?php echo e(old('numero_empleado', $empleado->numero_empleado)); ?>" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <!-- RFC -->
                    <div>
                        <label for="rfc" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            RFC
                        </label>
                        <input type="text" id="rfc" name="rfc" value="<?php echo e(old('rfc', $empleado->rfc)); ?>" required
                            pattern="[A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3}"
                            title="Formato RFC inválido (Ejemplo: ABCD123456XYZ)"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <!-- Plaza -->
                    <div>
                        <label for="plaza" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Plaza
                        </label>
                        <select id="plaza" name="plaza" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <?php $__currentLoopData = $plazas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plaza): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($plaza->nombre); ?>"
                                    <?php echo e($empleado->plaza?->nombre === $plaza->nombre ? 'selected' : ''); ?>>
                                    <?php echo e($plaza->nombre); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Servicio -->
                    <div>
                        <label for="servicio_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Servicio
                        </label>
                        <select id="servicio_id" name="servicio_id" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="" disabled>Seleccione un servicio</option>
                            <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($servicio->id); ?>"
                                    <?php echo e(old('servicio_id', $empleado->servicio_id) == $servicio->id ? 'selected' : ''); ?>>
                                    <?php echo e($servicio->nombre); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end space-x-3 mt-6">
                        <a href="<?php echo e(route('usuarios.index')); ?>"
                            class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php $__env->stopSection(); ?>
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/usuarios/edit.blade.php ENDPATH**/ ?>
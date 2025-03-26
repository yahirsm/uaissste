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
            <h2 class="text-3xl font-bold text-red-700 dark:text-red-400 mb-4">
                <i class="fas fa-user-plus mr-2"></i> Agregar Nuevo Usuario
            </h2>

            <?php if($errors->any()): ?>
                <div class="bg-red-500 text-white p-2 mb-4 rounded shadow-md dark:bg-red-700">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('usuarios.store')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div>
                    <label for="primer_apellido" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Primer Apellido</label>
                    <input type="text" name="primer_apellido" id="primer_apellido" required 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div>
                    <label for="segundo_apellido" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Segundo Apellido</label>
                    <input type="text" name="segundo_apellido" id="segundo_apellido" 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div>
                    <label for="numero_empleado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Número de Empleado</label>
                    <input type="number" name="numero_empleado" id="numero_empleado" required 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div>
                    <label for="rfc" class="block text-sm font-medium text-gray-700 dark:text-gray-300">RFC</label>
                    <input type="text" name="rfc" id="rfc" required 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div>
                    <label for="plaza" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Plaza</label>
                    <select name="plaza" id="plaza" required 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="Confianza">Confianza</option>
                        <option value="Base">Base</option>
                        <option value="Eventual">Eventual</option>
                        <option value="INSABI">INSABI</option>
                    </select>
                </div>
                
                <div>
                    <label for="servicio_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Servicio Actual</label>
                    <select name="servicio_id" id="servicio_id" required 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($servicio->id); ?>"><?php echo e($servicio->nombre); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                <div class="flex justify-end space-x-2">
                    <a href="<?php echo e(route('usuarios.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-4 py-2 rounded">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded">
                        Guardar Usuario
                    </button>
                </div>
            </form>
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/usuarios/create.blade.php ENDPATH**/ ?>
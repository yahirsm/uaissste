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
                <i class="fas fa-cogs"></i> Inventario de Materiales
            </h2>

            <p class="text-gray-600 dark:text-gray-300 mb-4">
                Aquí puedes revisar los materiales en el inventario con sus datos detallados.
            </p>

            <!-- Campo de búsqueda y botón de agregar -->
            <div class="flex justify-between items-center mb-4">
                <form method="GET" action="<?php echo e(route('inventario.index')); ?>" class="flex space-x-2">
                    <input type="text" name="search" placeholder="Buscar por clave o descripción" 
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:border-red-700 focus:ring focus:ring-red-300 w-64"
                        value="<?php echo e(request('search')); ?>">
                    <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded-lg hover:bg-red-800">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </form>

                <button class="bg-red-700 text-white py-2 px-4 rounded hover:bg-red-800">
                    <i class="fas fa-plus-circle"></i> Agregar Material
                </button>
            </div>

            <!-- Tabla -->
            <table class="table-auto w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                <thead class="bg-red-700 text-white">
                    <tr>
                        <th class="px-6 py-3">Clave</th>
                        <th class="px-6 py-3">Descripción</th>
                        <th class="px-6 py-3">Tipo de Insumo</th>
                        <th class="px-6 py-3">Partida</th>
                        <th class="px-6 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php if($materiales->isEmpty()): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-red-600 font-semibold">
                                No se encontraron coincidencias.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $__currentLoopData = $materiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-6 py-3"><?php echo e($material->clave); ?></td>
                                <td class="px-6 py-3"><?php echo e($material->descripcion); ?></td>
                                <td class="px-6 py-3"><?php echo e($material->tipo_insumo); ?></td>
                                <td class="px-6 py-3">
                                    <?php if($material->partida): ?>
                                        <?php echo e($material->partida->nombre); ?>

                                    <?php else: ?>
                                        <span class="text-red-600">Sin partida</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-3 flex justify-center space-x-2">
                                    <button class="bg-yellow-600 text-white py-1 px-3 rounded hover:bg-yellow-700">
                                        <i class="fas fa-pencil-alt"></i> Modificar
                                    </button>
                                    <button class="bg-red-600 text-white py-1 px-3 rounded hover:bg-red-700">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="mt-4">
                <?php echo e($materiales->links('pagination::tailwind')); ?>

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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/inventario/index.blade.php ENDPATH**/ ?>
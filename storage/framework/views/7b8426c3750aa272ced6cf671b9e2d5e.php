<?php if($materiales->isEmpty()): ?>
    <p class="text-red-600">No se encontraron coincidencias.</p>
<?php else: ?>
    <table class="table-auto w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
        <thead class="bg-red-700 text-white">
            <tr>
                <th class="px-6 py-3">Clave</th>
                <th class="px-6 py-3">Descripción</th>
                <th class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            <?php $__currentLoopData = $materiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-6 py-3"><?php echo e($material->clave); ?></td>
                    <td class="px-6 py-3"><?php echo e($material->descripcion); ?></td>
                    <td class="px-6 py-3 flex space-x-2">
                        <button class="bg-yellow-600 text-white p-2 rounded hover:bg-yellow-700">
                            <i class="fas fa-pencil-alt"></i> Editar
                        </button>
                        <button class="bg-red-600 text-white p-2 rounded hover:bg-red-700">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="mt-4">
        <?php echo e($materiales->links('pagination::tailwind')); ?>

    </div>
<?php endif; ?>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/inventario/tabla.blade.php ENDPATH**/ ?>
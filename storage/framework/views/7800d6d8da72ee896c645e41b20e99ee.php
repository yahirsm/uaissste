
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
            
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-3xl font-bold text-red-700 dark:text-red-400">
                    <i class="fas fa-cogs mr-2"></i> Inventario de Materiales
                </h2>
                <a href="<?php echo e(route('inventario.create')); ?>"
                   class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2">
                    <i class="fas fa-plus-circle"></i>
                    <span>Agregar Material</span>
                </a>
            </div>

            
            <form method="GET" action="<?php echo e(route('inventario.index')); ?>" class="mb-4">
                <div class="flex items-center gap-2">
                    <input type="text" name="search" placeholder="Buscar clave o descripción"
                        value="<?php echo e(request('search')); ?>"
                        class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-700 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                    >
                    <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-search mr-1"></i> Buscar
                    </button>
                </div>
            </form>

            
            <?php if(session('success')): ?>
                <div class="bg-green-500 text-white p-2 mb-4 rounded shadow-md dark:bg-green-700">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="bg-red-500 text-white p-2 mb-4 rounded shadow-md dark:bg-red-700">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                    <thead class="bg-red-700 text-white text-sm uppercase tracking-wider dark:bg-red-800">
                        <tr>
                            <th class="px-4 py-3">Clave</th>
                            <th class="px-4 py-3">Descripción</th>
                            <th class="px-4 py-3">Tipo de Insumo</th>
                            <th class="px-4 py-3">Partida</th>
                            <th class="px-4 py-3">Stock</th>
                            <th class="px-4 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $materiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-300 dark:border-gray-700">
                            <td class="px-4 py-3"><?php echo e($material->clave); ?></td>
                            <td class="px-4 py-3"><?php echo e($material->descripcion); ?></td>
                            <td class="px-4 py-3"><?php echo e($material->tipoInsumo->nombre ?? 'Sin tipo'); ?></td>
                            <td class="px-4 py-3"><?php echo e($material->partida->nombre ?? 'Sin partida'); ?></td>
                            <td class="px-4 py-3"><?php echo e(number_format($material->stock_actual,2)); ?></td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    
                                    <a href="<?php echo e(route('inventario.edit', $material)); ?>"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2">
                                        <i class="fas fa-pencil-alt"></i>
                                        <span>Editar</span>
                                    </a>
                                    
                                    <form action="<?php echo e(route('inventario.destroy', $material)); ?>"
                                          method="POST"
                                          class="delete-material-form"
                                          data-nombre="<?php echo e($material->descripcion); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded flex items-center gap-2">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Eliminar</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-yellow-800 dark:text-yellow-200 bg-yellow-100 dark:bg-yellow-900">
                                No hay materiales.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="mt-4">
                <?php echo e($materiales->appends(request()->query())->links('pagination::tailwind')); ?>

            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      document.querySelectorAll('.delete-material-form').forEach(form => {
        form.addEventListener('submit', async function(e) {
          e.preventDefault();
          const nombre = this.dataset.nombre;
          const result = await Swal.fire({
            title: '¿Eliminar material?',
            html: `¿Estás seguro de que deseas eliminar <strong>${nombre}</strong>? Esta acción no se puede deshacer.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
          });
          if (result.isConfirmed) {
            this.submit();
          }
        });
      });
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/inventario/index.blade.php ENDPATH**/ ?>
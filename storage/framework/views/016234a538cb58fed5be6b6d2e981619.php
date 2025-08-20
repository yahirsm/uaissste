
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
                <h2 class="text-3xl font-bold text-red-700 dark:text-red-400 flex items-center gap-2">
                    <i class="fas fa-cogs"></i>
                    Inventario de Materiales
                </h2>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario.crear')): ?>
                    <a href="<?php echo e(route('inventario.create')); ?>"
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
                        <i class="fas fa-plus mr-1"></i> Agregar Material
                    </a>
                <?php endif; ?>
            </div>

            
            <form method="GET" action="<?php echo e(route('inventario.index')); ?>" class="mb-4">
                <?php
                    // request()->boolean() devuelve true si ?in_stock=1 o in_stock=on
                    $inStock = request()->boolean('in_stock');
                ?>
                <div class="flex flex-wrap items-center gap-2">
                    <input
                        type="text"
                        name="search"
                        placeholder="Buscar clave o descripción"
                        value="<?php echo e(request('search')); ?>"
                        class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-700 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                    />
                    <button
                        type="submit"
                        class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg transition flex items-center gap-1"
                    >
                        <i class="fas fa-search"></i> Buscar
                    </button>

                    <label
                        for="in_stock"
                        class="inline-flex items-center gap-1 px-3 py-2 border rounded-lg cursor-pointer
                            <?php echo e($inStock
                                ? 'bg-green-100 border-green-500 text-green-700'
                                : 'bg-gray-100 border-gray-300 text-gray-700'); ?>

                            transition"
                    >
                        <input
                            type="checkbox"
                            id="in_stock"
                            name="in_stock"
                            class="sr-only"
                            onchange="this.form.submit()"
                            <?php echo e($inStock ? 'checked' : ''); ?>

                        />
                        <i class="fas fa-box-check"></i>
                        <span class="text-sm">Solo existencias ≥ 1</span>
                    </label>
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
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['inventario.editar','inventario.eliminar'])): ?>
                                <th class="px-4 py-3 text-center">Acciones</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $materiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-300 dark:border-gray-700">
                                <td class="px-4 py-3"><?php echo e($material->clave); ?></td>
                                <td class="px-4 py-3"><?php echo e($material->descripcion); ?></td>
                                <td class="px-4 py-3"><?php echo e($material->tipoInsumo->nombre ?? '—'); ?></td>
                                <td class="px-4 py-3"><?php echo e($material->partida->nombre ?? '—'); ?></td>
                                <td class="px-4 py-3 flex items-center gap-1">
                                    <?php if($material->stock_actual >= 1): ?>
                                        <i class="fas fa-check-circle text-green-600"></i>
                                    <?php else: ?>
                                        <i class="fas fa-times-circle text-red-600"></i>
                                    <?php endif; ?>
                                    <?php echo e(number_format($material->stock_actual, 2)); ?>

                                </td>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['inventario.editar','inventario.eliminar'])): ?>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-center gap-2">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario.editar')): ?>
                                                <a href="<?php echo e(route('inventario.edit', $material)); ?>"
                                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded flex items-center gap-1 transition">
                                                    <i class="fas fa-pencil-alt"></i> Editar
                                                </a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario.eliminar')): ?>
                                                <form
                                                    action="<?php echo e(route('inventario.destroy', $material)); ?>"
                                                    method="POST"
                                                    class="delete-material-form"
                                                    data-nombre="<?php echo e($material->descripcion); ?>"
                                                >
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit"
                                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded flex items-center gap-1 transition">
                                                        <i class="fas fa-trash-alt"></i> Eliminar
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php
                                // Si no hay columnas de acciones, colspan = 5, si sí, colspan = 6
                                $colspan = Auth::user()->canany(['inventario.editar','inventario.eliminar']) ? 6 : 5;
                            ?>
                            <tr>
                                <td
                                    colspan="<?php echo e($colspan); ?>"
                                    class="px-4 py-4 text-center text-yellow-800 dark:text-yellow-200 bg-yellow-100 dark:bg-yellow-900"
                                >
                                    No hay materiales que coincidan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="mt-4">
                <?php echo e($materiales
                    ->withQueryString()
                    ->links('pagination::tailwind')); ?>

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
            html: `¿Estás seguro de eliminar <strong>${nombre}</strong>?`,
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/inventario/index.blade.php ENDPATH**/ ?>
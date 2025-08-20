
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
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold text-red-700 mb-4">
                <i class="fas fa-exchange-alt mr-2"></i> Movimientos de Inventario
            </h2>

            
            <?php if(session('success')): ?>
                <div class="bg-green-500 text-white p-2 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($err); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            
            <form action="<?php echo e(route('inventario.movimientos.store')); ?>" method="POST"
                class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-6">
                <?php echo csrf_field(); ?>

                
                <div class="col-span-full">
                    <label for="material_id" class="block font-medium mb-1">Material</label>
                    <select id="material_id" name="material_id" required
                        class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
                        <option value="" disabled selected>Selecciona o busca material</option>
                        <?php $__currentLoopData = $materiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($m->id); ?>" data-stock="<?php echo e($m->stock_actual); ?>">
                                <?php echo e($m->clave); ?> — <?php echo e($m->descripcion); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div>
                    <label for="tipo" class="block font-medium mb-1">Tipo</label>
                    <select name="tipo" id="tipo" required
                        class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
                        <option value="entrada">Entrada</option>
                        <option value="salida">Salida</option>
                    </select>
                </div>

                
                <div>
                    <label for="cantidad" class="block font-medium mb-1">Cantidad</label>
                    <input type="number" step="0.01" name="cantidad" id="cantidad" required
                        class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600" />
                    <p id="cantidadError" class="mt-1 text-sm text-red-600 hidden">
                        La cantidad excede el stock actual.
                    </p>
                </div>

                
                <div>
                    <label for="unidad" class="block font-medium mb-1">Unidad</label>
                    <input type="text" name="unidad" id="unidad" value="pieza" required
                        class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600" />
                </div>

                
                <div>
                    <label for="fecha_movimiento" class="block font-medium mb-1">Fecha</label>
                    <input type="date" name="fecha_movimiento" id="fecha_movimiento" required
                        class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600" />
                </div>

                
                <div>
                    <label for="fecha_caducidad" class="block font-medium mb-1">
                        Caducidad (opcional)
                    </label>
                    <input type="date" name="fecha_caducidad" id="fecha_caducidad"
                        class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600" />
                </div>

                
                <div class="flex items-end justify-end">
                    <button type="submit" id="submitBtn"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold px-4 py-2 rounded flex items-center gap-2 disabled:opacity-50">
                        <i class="fas fa-save"></i> Registrar
                    </button>
                </div>
            </form>
            
            <p class="mb-4 text-gray-700 italic">
               Movimientos de entradas y salidas de insumos registrados de la Unidad de Abasto.
            </p>

            
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-red-700 text-white">
                            <th class="p-2">#</th>
                            <th class="p-2">Material</th>
                            <th class="p-2">Tipo</th>
                            <th class="p-2">Cantidad</th>
                            <th class="p-2">Unidad</th>
                            <th class="p-2">Fecha</th>
                            <th class="p-2">Caducidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $movimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b align-top">
                                <td class="p-2"><?php echo e($mov->id); ?></td>
                                <td class="p-2 whitespace-normal break-words">
                                    <?php echo e($mov->material->clave); ?> — <?php echo e($mov->material->descripcion); ?>

                                </td>
                                <td class="p-2 capitalize"><?php echo e($mov->tipo); ?></td>
                                <td class="p-2"><?php echo e($mov->cantidad); ?></td>
                                <td class="p-2"><?php echo e($mov->unidad); ?></td>
                                <td class="p-2"><?php echo e($mov->fecha_movimiento->format('d/m/Y')); ?></td>
                                <td class="p-2"><?php echo e(optional($mov->fecha_caducidad)->format('d/m/Y') ?: 'Sin fecha de caducidad'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            
            <div class="mt-4">
                <?php echo e($movimientos->links()); ?>

            </div>
        </div>
    </div>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Choices.js para select con búsqueda
            const materialSelect = document.getElementById('material_id');
            new Choices(materialSelect, {
                searchEnabled: true,
                itemSelectText: '',
                shouldSort: false,
                placeholder: true,
                placeholderValue: 'Selecciona o busca material',
                searchPlaceholderValue: 'Escribe para buscar…',
                noResultsText: 'No se encontró ese material',
                noChoicesText: 'No hay materiales disponibles',
                position: 'bottom',
                searchResultLimit: 100,
            });

            // Elementos de validación
            const tipoInput = document.getElementById('tipo');
            const cantidadInput = document.getElementById('cantidad');
            const errorP = document.getElementById('cantidadError');
            const submitBtn = document.getElementById('submitBtn');

            function validarCantidad() {
                // stock obtenido del option seleccionado
                const opt = materialSelect.selectedOptions[0];
                const stock = parseFloat(opt?.dataset.stock || 0);
                const qty = parseFloat(cantidadInput.value) || 0;

                // para salidas, qty > stock deshabilita el botón
                if (tipoInput.value === 'salida' && qty > stock) {
                    errorP.textContent = `La cantidad excede el stock actual (${stock}).`;
                    errorP.classList.remove('hidden');
                    submitBtn.disabled = true;
                } else {
                    errorP.classList.add('hidden');
                    submitBtn.disabled = false;
                }
            }

            // dispara al cambiar material, tipo o al salir del campo cantidad
            materialSelect.addEventListener('change', validarCantidad);
            tipoInput.addEventListener('change', validarCantidad);
            cantidadInput.addEventListener('blur', validarCantidad);
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/inventario/movimientos/index.blade.php ENDPATH**/ ?>
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
                    <i class="fas fa-layer-group mr-2"></i> Partidas y Tipos de Insumo
                </h2>
            </div>

            <?php if(session('success')): ?>
                <div class="bg-green-500 text-white p-2 mb-4 rounded shadow-md dark:bg-green-700">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <!-- FORMULARIO AGREGAR PARTIDA -->
            <?php echo $__env->make('inventario.partidas-seccion', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- FORMULARIO AGREGAR TIPO INSUMO -->
            <?php echo $__env->make('inventario.tipos-seccion', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    <!-- MODALES -->
    <div id="modalEditarPartida" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Editar Partida</h2>
            <form id="formEditarPartida" method="POST" action="">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Clave</label>
                    <input type="text" name="clave" id="edit_clave" pattern="\d{5}" maxlength="5" minlength="5"
                        required class="mt-1 w-full rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nombre</label>
                    <input type="text" name="nombre" id="edit_nombre_partida" pattern="[A-Z\sÁÉÍÓÚÑ]{3,100}" required
                        style="text-transform: uppercase"
                        class="mt-1 w-full rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="cerrarModal('modalEditarPartida')" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalEditarTipo" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Editar Tipo de Insumo</h2>
            <form id="formEditarTipo" method="POST" action="">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nombre</label>
                    <input type="text" name="nombre" id="edit_nombre_tipo" pattern="[A-Z\sÁÉÍÓÚÑ]{3,100}" required
                        style="text-transform: uppercase"
                        class="mt-1 w-full rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="cerrarModal('modalEditarTipo')" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        function mostrarEditarPartida(id, clave, nombre) {
            document.getElementById('formEditarPartida').action = `/partidas/${id}`;
            document.getElementById('edit_clave').value = clave;
            document.getElementById('edit_nombre_partida').value = nombre;
            document.getElementById('modalEditarPartida').classList.remove('hidden');
        }
    
        function cerrarModalPartida() {
            document.getElementById('modalEditarPartida').classList.add('hidden');
        }
    
        function mostrarEditarTipo(id, nombre) {
            document.getElementById('formEditarTipo').action = `/tipos-insumo/${id}`;
            document.getElementById('edit_nombre_tipo').value = nombre;
            document.getElementById('modalEditarTipo').classList.remove('hidden');
        }
    
        function cerrarModalTipo() {
            document.getElementById('modalEditarTipo').classList.add('hidden');
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/inventario/partida.blade.php ENDPATH**/ ?>
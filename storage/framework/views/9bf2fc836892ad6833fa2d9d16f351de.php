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

            <!-- Encabezado y Botón Agregar Plaza -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-3xl font-bold text-red-700 dark:text-red-400">
                    <i class="fas fa-briefcase mr-2"></i> Lista de Plazas
                </h2>
                <button onclick="document.getElementById('formAgregar').classList.toggle('hidden')"
                    class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2 transition">
                    <i class="fas fa-plus"></i>
                    <span>Agregar Plaza</span>
                </button>
            </div>

            <!-- Mensaje de éxito -->
            <?php if(session('success')): ?>
                <div class="bg-green-500 text-white p-2 mb-4 rounded shadow-md dark:bg-green-700">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <!-- Formulario Agregar Plaza -->
            <div id="formAgregar" class="hidden mb-6">
                <form method="POST" action="<?php echo e(route('plazas.store')); ?>"
                    class="bg-gray-100 p-4 rounded-lg shadow-md dark:bg-gray-700">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nombre
                            de la Plaza</label>
                        <input type="text" name="nombre" id="nombre" value="<?php echo e(old('nombre')); ?>"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-700 focus:border-red-700 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                        <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 transition">
                            <i class="fas fa-save"></i>
                            <span>Guardar</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tabla de Plazas -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                    <thead class="bg-red-700 text-white text-sm uppercase tracking-wider dark:bg-red-800">
                        <tr>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $plazas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plaza): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr
                                class="hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-300 dark:border-gray-700">
                                <td class="px-4 py-3"><?php echo e($plaza->nombre); ?></td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        <!-- Editar -->
                                        <button onclick="mostrarEditar('<?php echo e($plaza->id); ?>', '<?php echo e($plaza->nombre); ?>')"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2 transition">
                                            <i class="fas fa-pencil-alt"></i>
                                            <span>Editar</span>
                                        </button>

                                        <!-- Eliminar -->
                                        <form action="<?php echo e(route('plazas.destroy', $plaza->id)); ?>" method="POST"
                                            data-nombre="<?php echo e($plaza->nombre); ?>" class="form-eliminar-plaza">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                class="bg-red-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2 transition">
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Eliminar</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" class="text-center py-4">No hay plazas registradas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-4">
                <?php echo e($plazas->links()); ?>

            </div>

        </div>
    </div>

    <!-- Modal Editar Plaza -->
    <div id="modalEditar" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Editar Plaza</h2>
            <form id="formEditar" method="POST" action="">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-4">
                    <label for="edit_nombre"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                    <input type="text" name="nombre" id="edit_nombre"
                        class="mt-1 block w-full rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="cerrarModal()"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function mostrarEditar(id, nombre) {
            document.getElementById('formEditar').action = `/plazas/${id}`;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('modalEditar').classList.remove('hidden');
        }

        function cerrarModal() {
            document.getElementById('modalEditar').classList.add('hidden');
        }

        function confirmarEliminacion(nombre) {
            return confirm(`¿Seguro que deseas eliminar la plaza "${nombre}"?`);
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
<script>

      document.addEventListener('DOMContentLoaded', () => {
        const formulariosPlaza = document.querySelectorAll('.form-eliminar-plaza');

        formulariosPlaza.forEach(form => {
            form.addEventListener('submit', async function (e) {
                e.preventDefault();
                const nombre = this.dataset.nombre;
                const confirmado = await confirmarEliminacionSweet(`la plaza "${nombre}"`);

                if (confirmado) this.submit();
            });
        });
    });
    function confirmarEliminacionSweet(nombreEntidad = 'este elemento') {
        return Swal.fire({
            title: '¿Eliminar?',
            text: `¿Estás seguro de que deseas eliminar ${nombreEntidad}? Esta acción no se puede deshacer.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(result => result.isConfirmed);
    }
</script>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/plazas/index.blade.php ENDPATH**/ ?>
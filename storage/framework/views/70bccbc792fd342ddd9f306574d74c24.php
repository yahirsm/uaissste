<!-- Tabla de Tipos de Insumo -->
<table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
    <thead class="bg-red-700 text-white text-sm uppercase tracking-wider dark:bg-red-800">
        <tr>
            <th class="px-4 py-3">Nombre</th>
            <th class="px-4 py-3 text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $tiposInsumo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-300 dark:border-gray-700">
                <td class="px-4 py-3"><?php echo e($tipo->nombre); ?></td>
                <td class="px-4 py-3 text-center">
                    <div class="flex justify-center gap-2">
                        <button onclick="mostrarEditarTipo('<?php echo e($tipo->tipo_insumo_id); ?>', '<?php echo e($tipo->nombre); ?>')"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2 transition">
                            <i class="fas fa-pencil-alt"></i>
                            <span>Editar</span>
                        </button>
                        <form action="<?php echo e(route('tipos.destroy', $tipo->tipo_insumo_id)); ?>" method="POST"
                            data-nombre="<?php echo e($tipo->nombre); ?>" class="form-eliminar-tipo-insumo">

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
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<!-- Modal Editar Tipo de Insumo -->
<div id="modalEditarTipo" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Editar Tipo de Insumo</h2>
        <form id="formEditarTipo" method="POST" action="">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-4">
                <label for="edit_nombre_tipo"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                <input type="text" name="nombre" id="edit_nombre_tipo"
                    class="mt-1 block w-full border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required pattern="[A-ZÁÉÍÓÚÑ\s]{3,100}" style="text-transform: uppercase">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="cerrarModalTipo()"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancelar</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Guardar
                    cambios</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const formulariosTipo = document.querySelectorAll('.form-eliminar-tipo-insumo');

        formulariosTipo.forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const nombre = this.dataset.nombre;
                const confirmado = await confirmarEliminacionSweet(
                    `el tipo de insumo "${nombre}"`);

                if (confirmado) this.submit();
            });
        });
    });
</script>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/inventario/tipos-tabla.blade.php ENDPATH**/ ?>
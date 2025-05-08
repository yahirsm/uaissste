<!-- Sección Tipos de Insumo -->
<div class="mb-10">
    <div class="flex justify-between items-center mb-2">
        <h3 class="text-xl font-semibold text-red-600 dark:text-red-300">Tipos de Insumo</h3>
        <button onclick="document.getElementById('formAgregarTipo').classList.toggle('hidden')"
            class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2 transition">
            <i class="fas fa-plus"></i>
            <span>Agregar Tipo</span>
        </button>
    </div>

    <div id="formAgregarTipo" class="hidden mb-6">
        <form method="POST" action="<?php echo e(route('tipos.store')); ?>"
            class="bg-gray-100 p-4 rounded-lg shadow-md dark:bg-gray-700" onsubmit="return validarFormularioTipo()">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nombre</label>
                <input type="text" name="nombre" id="nombreTipoInput" required style="text-transform: uppercase"
                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-red-700 focus:border-red-700 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                    value="<?php echo e(strtoupper(old('nombre'))); ?>"
>
                <p id="errorNombreTipo" class="text-red-500 text-sm mt-1 hidden">
                    El nombre debe contener solo letras y al menos 3 caracteres.
                </p>
                <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                <?php else: ?>
                    <p id="errorNombreTipo" class="text-red-500 text-sm mt-1 hidden">
                        El nombre debe contener solo letras y al menos 3 caracteres.
                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('formAgregarTipo').classList.add('hidden')"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                    <i class="fas fa-times-circle"></i>
                    <span>Cancelar</span>
                </button>
                <button type="submit"
                    class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 transition">
                    <i class="fas fa-save"></i>
                    <span>Guardar</span>
                </button>
            </div>
        </form>
    </div>

    <?php echo $__env->make('inventario.tipos-tabla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<script>
    function validarFormularioTipo() {
        const nombre = document.getElementById('nombreTipoInput');
        const error = document.getElementById('errorNombreTipo');

        const regex = /^[a-zA-ZÁÉÍÓÚáéíóúÑñüÜ\s]{3,}$/;

        if (!regex.test(nombre.value.trim())) {
            error.classList.remove('hidden');
            nombre.focus();
            return false;
        }

        error.classList.add('hidden');
        return true;
    }
</script>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/inventario/tipos-seccion.blade.php ENDPATH**/ ?>
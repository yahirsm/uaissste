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
            <h2 class="text-3xl font-bold text-red-700 dark:text-red-400 mb-6">
                <i class="fas fa-user-plus mr-2"></i> Agregar Nuevo Usuario
            </h2>

            <?php if($errors->any()): ?>
                <div class="bg-red-500 text-white p-2 mb-4 rounded shadow-md dark:bg-red-700">
                    <ul class="list-disc pl-5">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form id="formUsuario" action="<?php echo e(route('usuarios.store')); ?>" method="POST"
                class="grid grid-cols-1 md:grid-cols-2 gap-4 animate-fade-in">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="numero_empleado">Número de Empleado</label>
                    <input type="text" name="numero_empleado" id="numero_empleado" maxlength="6" required
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition"
                    >
                    <small id="empleadoExiste" class="text-red-600 hidden">Ya existe un empleado con este número.</small>
                </div>

                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                </div>

                <div>
                    <label for="primer_apellido">Primer Apellido</label>
                    <input type="text" name="primer_apellido" id="primer_apellido" required
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                </div>

                <div>
                    <label for="segundo_apellido">Segundo Apellido</label>
                    <input type="text" name="segundo_apellido" id="segundo_apellido"
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                </div>

                <div>
                    <label for="rfc">RFC</label>
                    <input type="text" name="rfc" id="rfc" maxlength="13" required
                        class="w-full p-2 border rounded uppercase bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                </div>

                <div>
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" id="email" required
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                </div>

                <div>
                    <label for="plaza_id">Tipo de Plaza</label>
                    <select name="plaza_id" id="plaza_id" required
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                        <?php $__currentLoopData = $plazas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plaza): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($plaza->id); ?>"><?php echo e($plaza->nombre); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label for="servicio_id">Servicio Actual</label>
                    <select name="servicio_id" id="servicio_id" required
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                        <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($servicio->id); ?>"><?php echo e($servicio->nombre); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label for="username">Usuario Generado</label>
                    <input type="text" name="username" id="username" readonly
                        class="w-full p-2 border rounded bg-gray-100 text-gray-700 font-semibold">
                </div>

                <div>
                    <label for="password">Contraseña Generada</label>
                    <input type="text" name="password" id="password" readonly
                        class="w-full p-2 border rounded bg-gray-100 text-gray-700 font-semibold">
                </div>

                <div class="col-span-2 flex justify-end gap-4">
                    <button type="button" onclick="confirmarCancelacion()"
                        class="bg-red-100 text-red-700 hover:bg-red-200 hover:text-red-800 px-6 py-2 rounded-xl font-semibold shadow-inner border border-red-300 transition duration-200">
                        <i class="fas fa-arrow-left mr-1"></i> Cancelar
                    </button>

                    <button id="guardarBtn" type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-xl font-semibold shadow-md transition">
                        Guardar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const inputNumero = document.getElementById('numero_empleado');
        const inputNombre = document.getElementById('nombre');
        const inputApellido1 = document.getElementById('primer_apellido');
        const inputApellido2 = document.getElementById('segundo_apellido');
        const inputUsuario = document.getElementById('username');
        const inputPass = document.getElementById('password');
        const rfc = document.getElementById('rfc');
        const btnGuardar = document.getElementById('guardarBtn');
        const alertaEmpleado = document.getElementById('empleadoExiste');

        inputNumero.addEventListener('blur', function () {
            const num = this.value;
            fetch(`/verificar-empleado/${num}`)
                .then(res => res.json())
                .then(data => {
                    const existe = data.exists;
                    alertaEmpleado.classList.toggle('hidden', !existe);
                    btnGuardar.disabled = existe;
                    btnGuardar.classList.toggle('opacity-50', existe);
                    btnGuardar.classList.toggle('cursor-not-allowed', existe);
                });
        });

        function generarUsuarioYPassword() {
            const nombre = inputNombre.value.trim();
            const apellido1 = inputApellido1.value.trim();
            const apellido2 = inputApellido2.value.trim();
            const numero = inputNumero.value.trim();

            if (apellido1 && numero && nombre) {
                const usuarioBase = apellido1.toLowerCase();
                fetch(`/verificar-usuario/${usuarioBase}`)
                    .then(res => res.json())
                    .then(data => {
                        let usuario = usuarioBase;
                        if (data.exists && apellido2) usuario += apellido2[0].toLowerCase();
                        inputUsuario.value = usuario;

                        const inicialNombre = nombre.split(' ')[0][0]?.toLowerCase() || '';
                        const inicialPA = apellido1[0]?.toLowerCase() || '';
                        const inicialSA = apellido2[0]?.toLowerCase() || '';
                        inputPass.value = `${inicialNombre}${inicialPA}${inicialSA}${numero}#`;
                    });
            }
        }

        [inputNombre, inputApellido1, inputApellido2, inputNumero].forEach(input => {
            input.addEventListener('blur', generarUsuarioYPassword);
        });

        [inputNombre, inputApellido1, inputApellido2].forEach(input => {
            input.addEventListener('input', () => {
                input.value = input.value.replace(/[^a-zA-Z\sñÑáéíóúÁÉÍÓÚ]/g, '');
            });
        });

        rfc.addEventListener('input', () => {
            rfc.value = rfc.value.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 13);
        });

        function confirmarCancelacion() {
            if (confirm('¿Estás seguro de que deseas cancelar el registro? Se perderán los datos no guardados.')) {
                history.back(); // o window.location.href = "<?php echo e(route('usuarios.index')); ?>";
            }
        }
    </script>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }
    </style>
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
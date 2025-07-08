<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-3xl font-bold text-red-700 dark:text-red-400 mb-6">
                <i class="fas fa-user-plus mr-2"></i> Agregar Nuevo Usuario
            </h2>

            @if ($errors->any())
                <div class="bg-red-500 text-white p-2 mb-4 rounded shadow-md dark:bg-red-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="formUsuario" action="{{ route('usuarios.store') }}" method="POST"
                class="grid grid-cols-1 md:grid-cols-2 gap-4 animate-fade-in">
                @csrf

                <div>
                    <label for="numero_empleado">Número de Empleado</label>
                    <input type="text" name="numero_empleado" id="numero_empleado" maxlength="6" required
                        placeholder="Ej. 123456"
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                    <small id="empleadoExiste" class="text-red-600 hidden">Ya existe un empleado con este
                        número.</small>
                </div>

                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required placeholder="Ej. Juan Carlos"
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                </div>

                <div>
                    <label for="primer_apellido">Primer Apellido</label>
                    <input type="text" name="primer_apellido" id="primer_apellido" required placeholder="Ej. Perez"
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                </div>

                <div>
                    <label for="segundo_apellido">Segundo Apellido</label>
                    <input type="text" name="segundo_apellido" id="segundo_apellido" placeholder="Ej. López"
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                </div>

                <div>
                    <label for="rfc">RFC</label>
                    <input type="text" name="rfc" id="rfc" maxlength="13" required
                        placeholder="Ej. ABCD901212XXX"
                        class="w-full p-2 border rounded uppercase bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                </div>

                <div>
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" id="email" required
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                </div>
                <div class="mt-4">
                    <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
                    <select id="rol" name="rol"
                        class="mt-1 block w-full rounded border-gray-300 focus:border-red-700 focus:ring focus:ring-red-200">
                        <option value="Administrador"
                            {{ old('rol', $user->roles->pluck('name')->first() ?? '') == 'Administrador' ? 'selected' : '' }}>
                            Administrador
                        </option>
                        <option value="Jefe Abasto"
                            {{ old('rol', $user->roles->pluck('name')->first() ?? '') == 'Jefe Abasto' ? 'selected' : '' }}>
                            Jefe Abasto
                        </option>
                        <option value="Solicitante"
                            {{ old('rol', $user->roles->pluck('name')->first() ?? '') == 'Solicitante' ? 'selected' : '' }}>
                            Solicitante
                        </option>
                    </select>
                </div>


                <div>
                    <label for="plaza_id">Tipo de Plaza</label>
                    <select name="plaza_id" id="plaza_id" required
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                        <option value="" disabled selected>Seleccione una plaza</option>
                        @foreach ($plazas as $plaza)
                            <option value="{{ $plaza->id }}">{{ $plaza->nombre }}</option>
                        @endforeach
                    </select>
                </div>


                <div>
                    <label for="servicio_id">Servicio Actual</label>
                    <select name="servicio_id" id="servicio_id" required
                        class="w-full p-2 border rounded bg-blue-50 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                        <option value="" disabled selected>Seleccione un servicio</option>
                        @foreach ($servicios as $servicio)
                            <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                        @endforeach
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

        inputNumero.addEventListener('blur', function() {
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
            Swal.fire({
                title: '¿Cancelar registro?',
                text: 'Se perderán los datos no guardados.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'No, continuar'
            }).then((result) => {
                if (result.isConfirmed) {
                    history.back(); // o window.location.href = "{{ route('usuarios.index') }}";
                }
            });
        }
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }
    </style>
</x-app-layout>

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/logo.svg') }}" alt="ISSSTE Logo" class="w-48 h-auto mx-auto">
        </x-slot>

        <head>
            <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
            <meta http-equiv="Cache-Control" content="post-check=0, pre-check=0" false>
            <meta http-equiv="Pragma" content="no-cache">
        </head>

        @if (session('error'))
            <div id="alert"
                class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-md relative flex justify-between items-center">
                <div>
                    <strong class="font-bold">¡Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
                <button type="button" class="text-red-700 hover:text-red-500" onclick="closeAlert()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <div id="formAlert"
            class="hidden mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-md relative flex justify-between items-center">
            <div>
                <strong class="font-bold">¡Error!</strong>
                <span id="alertMessage" class="block sm:inline"></span>
            </div>
            <button type="button" class="text-red-700 hover:text-red-500" onclick="closeFormAlert()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Usuario -->
            <div class="relative">
                <x-label for="username" value="Usuario" />
                <div class="absolute top-3 left-3 text-gray-500">
                    <i class="fas fa-user"></i>
                </div>
                <x-input id="username"
                    class="block mt-1 w-full border-gray-300 focus:border-red-700 focus:ring-red-700 pl-10"
                    type="text" name="username" value="{{ old('username') }}" placeholder="ej. ramirez" autofocus />
            </div>

          <!-- Contraseña -->
<div class="relative mt-4">
    <x-label for="password" value="Contraseña" />
    <div class="absolute top-3 left-3 text-gray-500">
        <i class="fas fa-lock"></i>
    </div>
    <x-input id="password"
        class="block mt-1 w-full border-gray-300 focus:border-red-700 focus:ring-red-700 pl-10 pr-10"
        type="password" name="password" />
    <div class="absolute inset-y-0 right-3 flex items-center cursor-pointer" onclick="togglePassword()">
        <i id="eyeIcon" class="fas fa-eye text-gray-500 transition-colors duration-200"></i>
    </div>
</div>


            <!-- Recuérdame -->
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">Recuérdame</span>
                </label>
            </div>

            <!-- Botón de envío -->
            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                    class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 transition">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Iniciar Sesión</span>
                </button>
            </div>
        </form>
    </x-authentication-card>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!username || !password) {
                let message = '';
                if (!username) message += 'El usuario es obligatorio. ';
                if (!password) message += 'La contraseña es obligatoria.';

                showFormAlert(message);
            } else {
                this.submit();
            }
        });

        document.getElementById('username').addEventListener('blur', function() {
            const value = this.value.trim();
            const pattern = /^[a-zA-Z]{3,}$/;

            if (!pattern.test(value)) {
                showFormAlert('El usuario solo puede contener letras y al menos 3 caracteres.');
            } else {
                closeFormAlert();
            }
        });

    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
            icon.classList.remove('text-gray-500');
            icon.classList.add('text-red-700');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
            icon.classList.remove('text-red-700');
            icon.classList.add('text-gray-500');
        }
    }


        function showFormAlert(message) {
            const alertBox = document.getElementById('formAlert');
            const alertMessage = document.getElementById('alertMessage');
            alertMessage.textContent = message;
            alertBox.classList.remove('hidden');
        }

        function closeAlert() {
            const alert = document.getElementById('alert');
            if (alert) {
                alert.style.transition = 'opacity 0.3s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }
        }

        function closeFormAlert() {
            const alert = document.getElementById('formAlert');
            if (alert) {
                alert.style.transition = 'opacity 0.3s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.classList.add('hidden'), 300);
            }
        }
    </script>
</x-guest-layout>

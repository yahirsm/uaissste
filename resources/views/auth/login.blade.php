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
            <div id="alert" class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-md relative flex justify-between items-center">
                <div>
                    <strong class="font-bold">¡Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
                <button type="button" class="text-red-700 hover:text-red-500" onclick="closeAlert()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <div id="formAlert" class="hidden mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-md relative flex justify-between items-center">
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

            <!-- Correo Electrónico -->
            <div class="relative">
                <x-label for="email" value="Correo Electrónico" />
                <div class="absolute top-3 left-3 text-gray-500">
                    <i class="fas fa-user"></i>
                </div>
                <x-input id="email"
                    class="block mt-1 w-full border-gray-300 focus:border-red-700 focus:ring-red-700 pl-10"
                    type="email" name="email" value="{{ old('email') }}" />
            </div>

            <!-- Contraseña -->
            <div class="relative mt-4">
                <x-label for="password" value="Contraseña" />
                <div class="absolute top-3 left-3 text-gray-500">
                    <i class="fas fa-lock"></i>
                </div>
                <x-input id="password"
                    class="block mt-1 w-full border-gray-300 focus:border-red-700 focus:ring-red-700 pl-10"
                    type="password" name="password" />
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

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!email || !password) {
                let message = '';
                if (!email) message += 'El correo electrónico es obligatorio. ';
                if (!password) message += 'La contraseña es obligatoria.';

                const alertBox = document.getElementById('formAlert');
                const alertMessage = document.getElementById('alertMessage');
                alertMessage.textContent = message;
                alertBox.classList.remove('hidden');
            } else {
                this.submit();
            }
        });

        function closeAlert() {
            const alert = document.getElementById('alert');
            if (alert) {
                alert.style.transition = 'opacity 0.3s ease';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }
        }

        function closeFormAlert() {
            const alert = document.getElementById('formAlert');
            if (alert) {
                alert.style.transition = 'opacity 0.3s ease';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.classList.add('hidden');
                }, 300);
            }
        }
    </script>
</x-guest-layout>

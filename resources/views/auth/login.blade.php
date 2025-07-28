{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-black relative overflow-hidden">

        {{-- Imagen de fondo absoluta --}}
        <div class="absolute inset-0 flex items-center justify-center">
            <img src="{{ asset('images/unidad2.png') }}" alt="Fondo" class="object-contain w-full h-full opacity-10">
        </div>

        {{-- Capa oscura semitransparente --}}
        <div class="absolute inset-0 bg-black opacity-50"></div>

        {{-- Formulario --}}
        <div
            class="relative z-10 w-full max-w-md p-8 
         bg-yellow-50 bg-opacity-50 backdrop-blur-sm
         rounded-lg 
         shadow-lg shadow-gray-800/20 
         border-2 border-yellow-600
         overflow-visible">
            {{-- Logo --}}
            <div class="text-center mb-6">
                <img src="{{ asset('images/logo.svg') }}" alt="ISSSTE Logo" class="mx-auto w-40 h-auto">
            </div>

            {{-- Error de sesión --}}
            @if (session('error'))
                <div id="alert"
                    class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-md flex justify-between items-center">
                    <div>
                        <strong class="font-bold">¡Error!</strong>
                        <span class="block">{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="closeAlert()">
                        <i class="fas fa-times text-red-700 hover:text-red-500"></i>
                    </button>
                </div>
            @endif

            {{-- Alerta JS --}}
            <div id="formAlert"
                class="hidden mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-md flex justify-between items-center">
                <div>
                    <strong class="font-bold">¡Error!</strong>
                    <span id="alertMessage" class="block"></span>
                </div>
                <button type="button" onclick="closeFormAlert()">
                    <i class="fas fa-times text-red-700 hover:text-red-500"></i>
                </button>
            </div>

            {{-- Formulario --}}
            <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- Usuario --}}
                <div class="relative">
                    <x-label for="username" value="Usuario" />
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3  text-gray-900 font-medium">
                        <i class="fas fa-user"></i>
                    </div>
                    <x-input id="username" name="username" type="text" required autofocus placeholder="ej. ramirez"
                        value="{{ old('username') }}"
                        class="block w-full pl-10 pr-3 py-2 border rounded focus:ring-red-700 focus:border-red-700" />
                </div>

                {{-- Contraseña --}}
                <div class="relative">
                    <x-label for="password" value="Contraseña" />
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-900 font-medium">
                        <i class="fas fa-lock"></i>
                    </div>
                    <x-input id="password" name="password" type="password" required placeholder="********"
                        class="block w-full pl-10 pr-10 py-2 border rounded focus:ring-red-700 focus:border-red-700" />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                        onclick="togglePassword()">
                        <i id="eyeIcon" class="fas fa-eye text-gray-500 transition-colors duration-200"></i>
                    </div>
                </div>

                {{-- Recuérdame --}}
                <div class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <label for="remember_me" class="ml-2 text-sm text-gray-900 font-medium">Recuérdame</label>
                </div>

                {{-- Botón --}}
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 
         bg-yellow-600 hover:bg-yellow-700 text-white 
         font-bold px-4 py-2 rounded-lg transition">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Iniciar Sesión</span>
                    </button>
                </div>
            </form>
        </div>

    </div>

    {{-- Scripts de validación y toggle --}}
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const user = document.getElementById('username').value.trim();
            const pass = document.getElementById('password').value.trim();
            if (!user || !pass) {
                let msg = '';
                if (!user) msg += 'El usuario es obligatorio. ';
                if (!pass) msg += 'La contraseña es obligatoria.';
                showFormAlert(msg);
            } else {
                this.submit();
            }
        });

        document.getElementById('username').addEventListener('blur', function() {
            const val = this.value.trim();
            if (!/^[a-zA-Z]{3,}$/.test(val)) {
                showFormAlert('El usuario solo puede contener letras y al menos 3 caracteres.');
            } else {
                closeFormAlert();
            }
        });

        function togglePassword() {
            const inp = document.getElementById('password');
            const ico = document.getElementById('eyeIcon');
            if (inp.type === 'password') {
                inp.type = 'text';
                ico.classList.replace('fa-eye', 'fa-eye-slash');
                ico.classList.replace('text-gray-500', 'text-red-700');
            } else {
                inp.type = 'password';
                ico.classList.replace('fa-eye-slash', 'fa-eye');
                ico.classList.replace('text-red-700', 'text-gray-500');
            }
        }

        function showFormAlert(msg) {
            const a = document.getElementById('formAlert');
            document.getElementById('alertMessage').textContent = msg;
            a.classList.remove('hidden');
        }

        function closeFormAlert() {
            document.getElementById('formAlert').classList.add('hidden');
        }

        function closeAlert() {
            document.getElementById('alert')?.remove();
        }
    </script>
</x-guest-layout>

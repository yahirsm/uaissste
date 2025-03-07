<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/logo.svg') }}" alt="ISSSTE Logo" class="w-48 h-auto mx-auto"> <!-- Logo más grande -->
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="relative">
                <x-label for="email" value="{{ __('Correo Electrónico') }}" class="text-gray-700 font-semibold" />
                <div class="absolute top-3 left-3">
                    <i class="fas fa-envelope text-gray-500"></i> <!-- Ícono de correo -->
                </div>
                <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-red-700 focus:ring-red-700 pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="relative mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" class="text-gray-700 font-semibold" />
                <div class="absolute top-3 left-3">
                    <i class="fas fa-lock text-gray-500"></i> <!-- Ícono de candado -->
                </div>
                <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-red-700 focus:ring-red-700 pl-10" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="border-gray-300 text-red-700 focus:ring-red-500" />
                    <span class="ms-2 text-sm text-gray-600">Recuérdame</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-red-700 hover:text-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <x-button class="ms-4 bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg">
                    Iniciar Sesión
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

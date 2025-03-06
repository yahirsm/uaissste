<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/logo.svg') }}" alt="ISSSTE Logo" class="w-32 h-auto mx-auto">
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Correo Electrónico') }}" class="text-gray-700 font-semibold" />
                <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-green-600 focus:ring-green-600 rounded-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" class="text-gray-700 font-semibold" />
                <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-green-600 focus:ring-green-600 rounded-lg" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="border-gray-300 text-green-600 focus:ring-green-500" />
                    <span class="ms-2 text-sm text-gray-600">Recuérdame</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-green-700 hover:text-green-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <x-button class="ms-4 bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-lg">
                    Iniciar Sesión
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo ISSSTE" class="w-32 h-auto mx-auto">
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div class="relative">
                <x-label for="name" value="Nombre" />
                <x-input id="name" class="block w-full pl-10" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <i class="fa-solid fa-user absolute left-3 top-10 text-gray-500"></i>
            </div>

            <div class="relative">
                <x-label for="email" value="Correo Electrónico" />
                <x-input id="email" class="block w-full pl-10" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <i class="fa-solid fa-envelope absolute left-3 top-10 text-gray-500"></i>
            </div>

            <div class="relative">
                <x-label for="password" value="Contraseña" />
                <x-input id="password" class="block w-full pl-10" type="password" name="password" required autocomplete="new-password" />
                <i class="fa-solid fa-lock absolute left-3 top-10 text-gray-500"></i>
            </div>

            <div class="relative">
                <x-label for="password_confirmation" value="Confirmar Contraseña" />
                <x-input id="password_confirmation" class="block w-full pl-10" type="password" name="password_confirmation" required autocomplete="new-password" />
                <i class="fa-solid fa-lock absolute left-3 top-10 text-gray-500"></i>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="flex items-center mt-4">
                    <input type="checkbox" name="terms" id="terms" required class="mr-2 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                    <label for="terms" class="text-sm text-gray-600">
                        {!! __('Acepto los :terms_of_service y la :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-yellow-600 hover:text-yellow-700">'.__('Términos de Servicio').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-yellow-600 hover:text-yellow-700">'.__('Política de Privacidad').'</a>',
                        ]) !!}
                    </label>
                </div>
            @endif

            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                    ¿Ya estás registrado?
                </a>

                <x-button class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                    Registrar
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

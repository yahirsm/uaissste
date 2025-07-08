{{-- resources/views/profile/show.blade.php --}}
<x-app-layout>
    @include('layouts.partials.admin.navigation')

    <x-slot name="header">
        <div class="flex items-center justify-between">
            {{-- Títulos Perfíl y Dashboard con separación --}}
            <div class="flex space-x-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-white">
                    {{ __('Perfil') }}
                </h2>
                <a href="{{ route('dashboard') }}"
                   class="font-semibold text-xl text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white">
                    {{ __('Dashboard') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="sm:ml-64 p-4 pt-20">
        <div class="max-w-3xl mx-auto space-y-8">

            @role('Administrador')
                {{-- El Admin puede actualizar todo --}}
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    <div class="bg-white p-6 rounded-lg shadow">
                        @livewire('profile.update-profile-information-form')
                    </div>
                @endif

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="bg-white p-6 rounded-lg shadow">
                        @livewire('profile.update-password-form')
                    </div>
                @endif

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="bg-white p-6 rounded-lg shadow">
                        @livewire('profile.two-factor-authentication-form')
                    </div>
                @endif

                <div class="bg-white p-6 rounded-lg shadow">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>

                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <div class="bg-white p-6 rounded-lg shadow">
                        @livewire('profile.delete-user-form')
                    </div>
                @endif
            @else
                {{-- Jefe Abasto y Solicitante: solo ven su info y pueden cerrar sesión --}}
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">
                        {{ __('Información de tu cuenta') }}
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500">{{ __('Nombre') }}</p>
                            <p class="mt-1 font-semibold text-gray-800 dark:text-gray-100">
                                {{ auth()->user()->name }}
                            </p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500">{{ __('Rol') }}</p>
                            <p class="mt-1 font-semibold text-gray-800 dark:text-gray-100">
                                {{ auth()->user()->getRoleNames()->first() ?? '–' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>
            @endrole

        </div>
    </div>
</x-app-layout>

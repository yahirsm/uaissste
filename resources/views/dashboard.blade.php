<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <!-- Contenedor principal con margen izquierdo ajustado -->
    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 text-center">
            <!-- Logo y saludo dinámico -->
            <img src="{{ asset('images/logo.svg') }}" alt="Logo ISSSTE" class="mx-auto w-40 h-40 mb-8">
            
            @php
                date_default_timezone_set('America/Mexico_City');
                $hora = date('H');
                $saludo = $hora >= 6 && $hora < 12 ? 'Buenos días' : ($hora >= 12 && $hora < 18 ? 'Buenas tardes' : 'Buenas noches');
            @endphp
            
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                {{ $saludo }}, {{ auth()->user()->name ?? 'Usuario' }}!
            </h2>
            
            <!-- Botones de acceso rápido -->
            <div class="mt-6 flex flex-wrap justify-center gap-6">
                <a href="{{ route('inventario.index') }}" class="flex flex-col items-center justify-center bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-4 px-6 rounded-lg shadow-md transition w-48 h-24">
                    <i class="fas fa-boxes text-3xl mb-2"></i>
                    <span>Inventario</span>
                </a>
                  <a href="{{ route('distribucion.pedidos.index') }}"
                   class="flex flex-col items-center justify-center bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-4 px-6 rounded-lg shadow-md transition w-48 h-24">
                    <i class="fas fa-receipt text-3xl mb-2"></i>
                    <span>Pedidos</span>
                </a>
                <a href="{{ route('reportes.index') }}" class="flex flex-col items-center justify-center bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-4 px-6 rounded-lg shadow-md transition w-48 h-24">
                    <i class="fas fa-chart-line text-3xl mb-2"></i>
                    <span>Reportes</span>
                </a>
            </div>
        </div>
    </div>
    
    @stack('modals')
</x-app-layout>

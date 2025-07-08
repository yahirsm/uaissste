<x-app-layout>
  @include('layouts.partials.admin.navigation')
  @include('layouts.partials.admin.sidebar')

  <div class="sm:ml-64 p-4 pt-20">
    <div class="p-6 bg-white rounded-lg shadow text-center">
      <img src="{{ asset('images/logo.svg') }}" alt="Logo ISSSTE" class="mx-auto w-40 h-40 mb-8">
      @php
        date_default_timezone_set('America/Mexico_City');
        $hora = date('H');
        $saludo = $hora < 12 ? 'Buenos días' : ($hora < 18 ? 'Buenas tardes' : 'Buenas noches');
      @endphp
      <h2 class="text-2xl font-bold mb-2">{{ $saludo }}, {{ auth()->user()->name }}!</h2>

      <div class="mt-6 flex flex-wrap justify-center gap-6">
        @can('inventario.ver')
        <a href="{{ route('inventario.index') }}"
           class="w-48 h-24 flex flex-col items-center justify-center bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg shadow-md transition">
          <i class="fas fa-boxes text-3xl mb-2"></i>
          <span>Inventario</span>
        </a>
        @endcan

        @can('pedidos.ver')
        <a href="{{ route('distribucion.pedidos.index') }}"
           class="w-48 h-24 flex flex-col items-center justify-center bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg shadow-md transition">
          <i class="fas fa-receipt text-3xl mb-2"></i>
          <span>Pedidos</span>
        </a>
        @endcan

        @can('reportes.ver')
        <a href="{{ route('reportes.index') }}"
           class="w-48 h-24 flex flex-col items-center justify-center bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg shadow-md transition">
          <i class="fas fa-chart-line text-3xl mb-2"></i>
          <span>Reportes</span>
        </a>
        @endcan
      </div>
    </div>
  </div>

  @stack('modals')
</x-app-layout>

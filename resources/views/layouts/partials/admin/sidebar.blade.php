@php
    $links = [
        [
            'name' => 'Dashboard', // Nombre del enlace
            'icon' => 'fa-solid fa-gauge-high', // Ícono de FontAwesome
            'route' => 'admin.dashboard', // Ruta asociada
            'active' => request()->routeIs('admin.dashboard'), // Verifica si la ruta actual coincide
        ],
        [
            'header' => 'Separación', // Elemento de separación (no tiene 'route')
        ],
        [
            'name' => 'Usuarios', // Nombre del enlace
            'icon' => 'fa-solid fa-users', // Ícono de FontAwesome
            'route' => 'admin.dashboard', // Ruta asociada (reutilizas 'admin.dashboard' como ejemplo)
            'active' => false, // Verifica si la ruta actual coincide
        ],
    ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            @foreach ($links as $item)
                @if (isset($item['header'])) <!-- Verifica si es un elemento de separación -->
                    <li>
                        <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">
                            {{ $item['header'] }} <!-- Muestra el texto de separación -->
                        </div>
                    </li>
                @elseif (isset($item['route'])) <!-- Verifica si el elemento tiene una ruta -->
                    <li>
                        <a href="{{ route($item['route']) }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $item['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                            <span class="w-5 h-5 inline-flex justify-center items-center">
                                <i class="{{ $item['icon'] }} text-gray-800"></i>
                            </span>
                            <span class="ms-3">{{ $item['name'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach

        </ul>
    </div>
</aside>
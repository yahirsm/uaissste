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
        [
            'name' => 'Inventario', // Nuevo elemento
            'icon' => 'fa-solid fa-boxes', // Ícono de FontAwesome
            'route' => '#', // Sin ruta específica
            'active' => false,
        ],
        [
            'name' => 'Reportes', // Nuevo elemento
            'icon' => 'fa-solid fa-chart-line', // Ícono de FontAwesome
            'route' => '#', // Sin ruta específica
            'active' => false,
        ],
        [
            'name' => 'Distribución', // Nuevo elemento con submenú
            'icon' => 'fa-solid fa-truck', // Ícono de FontAwesome
            'route' => '#', // Sin ruta específica
            'active' => false,
            'submenu' => [ // Submenú
                [
                    'name' => 'Vales', // Subelemento
                    'route' => '#', // Sin ruta específica
                    'active' => false,
                ],
                [
                    'name' => 'Pedidos', // Subelemento
                    'route' => '#', // Sin ruta específica
                    'active' => false,
                ],
            ],
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
                @elseif (isset($item['submenu'])) <!-- Verifica si es un elemento con submenú -->
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="w-5 h-5 inline-flex justify-center items-center">
                                <i class="{{ $item['icon'] }} text-gray-800"></i>
                            </span>
                            <span class="ms-3">{{ $item['name'] }}</span>
                            <svg class="w-3 h-3 ms-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <ul class="py-2 space-y-2">
                            @foreach ($item['submenu'] as $subitem)
                                <li>
                                    <a href="{{ $subitem['route'] }}"
                                        class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                        <span class="ms-3">{{ $subitem['name'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else <!-- Si es un enlace normal -->
                    <li>
                        <a href="{{ $item['route'] }}"
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
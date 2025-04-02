@php
    $links = [
        [
            'name' => 'Inicio',
            'icon' => 'fa-solid fa-house-flag',
            'route' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
        ],
        [
            'header' => 'Menú',
        ],
        [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-users',
            'route' => route('usuarios.index'),
            'active' => request()->routeIs('usuarios.index'),
        ],

        [
            'name' => 'Inventario',
            'icon' => 'fa-solid fa-boxes',
            'route' => route('inventario.index'),
            'active' => request()->routeIs('inventario.index'),
        ],
        [
            'name' => 'Reportes',
            'icon' => 'fa-solid fa-chart-line',
            'route' => route('reportes.index'),
            'active' =>  request()->routeIs('reportes.index'),
        ],
        [
            'name' => 'Distribución',
            'icon' => 'fa-solid fa-truck',
            'route' => '#',
            'active' => request()->routeIs('solicitud') || request()->routeIs('pedidos'),
            'submenu' => [
                [
                    'name' => 'Solicitud',
                    'route' => '#',
                    'active' => false,
                ],
                [
                    'name' => 'Pedidos',
                    'route' => '#',
                    'active' => false,
                ],
            ],
        ],
    ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-48 h-screen pt-20 transition-all duration-300 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            @foreach ($links as $item)
                @if (isset($item['header']))
                    <li>
                        <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">
                            {{ $item['header'] }}
                        </div>
                    </li>
                @elseif (isset($item['submenu']))
                    <li>
                        <button type="button"
                            class="flex items-center justify-between w-full p-2 rounded-lg transition duration-300 
                            {{ $item['active'] ? 'bg-[#7A0019] text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                            onclick="toggleSubmenu(this)">
                            <div class="flex items-center">
                                <span class="w-5 h-5 flex justify-center items-center">
                                    <i class="{{ $item['icon'] }} {{ $item['active'] ? 'text-white' : 'text-gray-800' }}"></i>
                                </span>
                                <span class="ms-3">{{ $item['name'] }}</span>
                            </div>
                            <svg class="w-3 h-3 transition-transform duration-200"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul class="py-2 space-y-2 {{ $item['active'] ? '' : 'hidden' }}">
                            @foreach ($item['submenu'] as $subitem)
                                <li>
                                    <a href="{{ $subitem['route'] }}"
                                        class="flex items-center p-2 pl-11 rounded-lg transition duration-300 
                                        {{ $subitem['active'] ? 'bg-[#7A0019] text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                        {{ $subitem['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{ $item['route'] }}"
                            class="flex items-center p-2 rounded-lg transition duration-300 
                            {{ $item['active'] ? 'bg-[#7A0019] text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <span class="w-5 h-5 flex justify-center items-center">
                                <i class="{{ $item['icon'] }} {{ $item['active'] ? 'text-white' : 'text-gray-800' }}"></i>
                            </span>
                            <span class="ms-3">{{ $item['name'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach

        </ul>
    </div>
</aside>

<script>
    function toggleSubmenu(button) {
        let submenu = button.nextElementSibling;
        let icon = button.querySelector('svg');

        submenu.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>



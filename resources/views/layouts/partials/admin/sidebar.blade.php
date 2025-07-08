@php
    $links = [
        ['name'=>'Inicio','icon'=>'fa-solid fa-house-flag','route'=>route('dashboard'),'active'=>request()->routeIs('dashboard')],
        ['header'=>'Menú'],
        ['name'=>'Usuarios','icon'=>'fa-solid fa-users','route'=>route('usuarios.index'),
            'active'=>request()->routeIs('usuarios.index')||request()->routeIs('servicios.index')||request()->routeIs('plazas.index'),
            'submenu'=>[
                ['name'=>'Usuarios','icon'=>'fa-solid fa-user','route'=>route('usuarios.index'),'active'=>request()->routeIs('usuarios.index')],
                ['name'=>'Servicios','icon'=>'fa-solid fa-stethoscope','route'=>route('servicios.index'),'active'=>request()->routeIs('servicios.index')],
                ['name'=>'Plazas','icon'=>'fa-solid fa-briefcase','route'=>route('plazas.index'),'active'=>request()->routeIs('plazas.index')],
            ],
        ],
        ['name'=>'Inventario','icon'=>'fa-solid fa-boxes-stacked','route'=>route('inventario.index'),
            'active'=>request()->routeIs('inventario.index')||request()->routeIs('inventario.partida')||request()->routeIs('inventario.movimientos.*'),
            'submenu'=>[
                ['name'=>'Inventario','icon'=>'fa-solid fa-warehouse','route'=>route('inventario.index'),'active'=>request()->routeIs('inventario.index')],
                ['name'=>'Partidas','icon'=>'fa-solid fa-list-ol','route'=>route('inventario.partida'),'active'=>request()->routeIs('inventario.partida')],
                ['name'=>'Movimientos','icon'=>'fa-solid fa-exchange-alt','route'=>route('inventario.movimientos.index'),'active'=>request()->routeIs('inventario.movimientos.*')],
            ],
        ],
        ['name'=>'Reportes','icon'=>'fa-solid fa-chart-line','route'=>route('reportes.index'),'active'=>request()->routeIs('reportes.*')],
        ['name'=>'Distribución','icon'=>'fa-solid fa-truck','route'=>'#',
            'active'=>request()->routeIs('distribucion.solicitud.*')||request()->routeIs('distribucion.pedidos.*'),
            'submenu'=>[
                ['name'=>'Solicitud','icon'=>'fa-solid fa-file-signature','route'=>route('distribucion.solicitud.index'),'active'=>request()->routeIs('distribucion.solicitud.*')],
                ['name'=>'Pedidos','icon'=>'fa-solid fa-truck-fast','route'=>route('distribucion.pedidos.index'),'active'=>request()->routeIs('distribucion.pedidos.*')],
            ],
        ],
    ];
@endphp

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-48 h-screen pt-20 bg-white border-r">
  <div class="h-full px-3 pb-4 overflow-y-auto">
    <ul class="space-y-2 font-medium">

      {{-- INICIO --}}
      <li>
        <a href="{{ $links[0]['route'] }}"
           class="flex items-center p-2 rounded-lg {{ $links[0]['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100' }}">
          <i class="{{ $links[0]['icon'] }} w-5 h-5"></i>
          <span class="ml-3">{{ $links[0]['name'] }}</span>
        </a>
      </li>

      {{-- ENCABEZADO MENÚ --}}
      <li><div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">{{ $links[1]['header'] }}</div></li>

      {{-- USUARIOS: solo Administrador --}}
      @role('Administrador')
        @php $item = $links[2]; @endphp
        <li>
          <button type="button"
                  class="flex items-center justify-between w-full p-2 rounded-lg {{ $item['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100' }}"
                  onclick="toggleSubmenu(this)">
            <div class="flex items-center">
              <i class="{{ $item['icon'] }} w-5 h-5 {{ $item['active'] ? 'text-white' : '' }}"></i>
              <span class="ml-3">{{ $item['name'] }}</span>
            </div>
            <svg class="w-3 h-3 {{ $item['active'] ? 'rotate-180' : '' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </button>
          <ul class="py-2 space-y-2 {{ $item['active'] ? '' : 'hidden' }}">
            @foreach($item['submenu'] as $sub)
              <li>
                <a href="{{ $sub['route'] }}"
                   class="flex items-center p-2 pl-11 rounded-lg {{ $sub['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100' }}">
                  <i class="{{ $sub['icon'] }} w-4 h-4 mr-2"></i>
                  {{ $sub['name'] }}
                </a>
              </li>
            @endforeach
          </ul>
        </li>
      @endrole

      {{-- INVENTARIO: Jefe Abasto y Admin pueden ver y gestionar, Solicitante solo ver --}}
     {{-- INVENTARIO: 
     - Usuarios con permiso `inventario.ver` (Solicitante, Jefe Abasto y Admin) ven “Inventario”
     - Solo Jefe Abasto y Admin (roles) ven además “Partidas” y “Movimientos” 
--}}
@can('inventario.ver')
    @php 
        // es el item 3 de tu array $links
        $item = $links[3];
    @endphp
    <li>
      <button type="button"
              class="flex items-center justify-between w-full p-2 rounded-lg {{ $item['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100' }}"
              onclick="toggleSubmenu(this)">
        <div class="flex items-center">
          <i class="{{ $item['icon'] }} w-5 h-5 {{ $item['active'] ? 'text-white' : '' }}"></i>
          <span class="ml-3">{{ $item['name'] }}</span>
        </div>
        <svg class="w-3 h-3 {{ $item['active'] ? 'rotate-180' : '' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
      </button>
      <ul class="py-2 space-y-2 {{ $item['active'] ? '' : 'hidden' }}">
        {{-- Inventario (solo lectura) --}}
        <li>
          <a href="{{ route('inventario.index') }}"
             class="flex items-center p-2 pl-11 rounded-lg {{ request()->routeIs('inventario.index') ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-warehouse w-4 h-4 mr-2"></i>
            Inventario
          </a>
        </li>

        {{-- Partidas (solo Jefe Abasto y Admin) --}}
        @role('Administrador|Jefe Abasto')
        <li>
          <a href="{{ route('inventario.partida') }}"
             class="flex items-center p-2 pl-11 rounded-lg {{ request()->routeIs('inventario.partida') ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-list-ol w-4 h-4 mr-2"></i>
            Partidas
          </a>
        </li>
        @endrole

        {{-- Movimientos (solo Jefe Abasto y Admin) --}}
        @role('Administrador|Jefe Abasto')
        <li>
          <a href="{{ route('inventario.movimientos.index') }}"
             class="flex items-center p-2 pl-11 rounded-lg {{ request()->routeIs('inventario.movimientos.*') ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-exchange-alt w-4 h-4 mr-2"></i>
            Movimientos
          </a>
        </li>
        @endrole

      </ul>
    </li>
@endcan


      {{-- REPORTES: solo Administrador y Jefe Abasto --}}
      @can('reportes.ver')
        @php $item = $links[4]; @endphp
        <li>
          <a href="{{ $item['route'] }}"
             class="flex items-center p-2 rounded-lg {{ $item['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100' }}">
            <i class="{{ $item['icon'] }} w-5 h-5 {{ $item['active'] ? 'text-white' : '' }}"></i>
            <span class="ml-3">{{ $item['name'] }}</span>
          </a>
        </li>
      @endcan

      {{-- DISTRIBUCIÓN: Solicitudes para Solicitante/Jefe, Pedidos para Jefe/Admin --}}
      @if(auth()->user()->can('solicitudes.ver') || auth()->user()->can('pedidos.ver'))
        @php $item = $links[5]; @endphp
        <li>
          <button type="button"
                  class="flex items-center justify-between w-full p-2 rounded-lg {{ $item['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100' }}"
                  onclick="toggleSubmenu(this)">
            <div class="flex items-center">
              <i class="{{ $item['icon'] }} w-5 h-5 {{ $item['active'] ? 'text-white' : '' }}"></i>
              <span class="ml-3">{{ $item['name'] }}</span>
            </div>
            <svg class="w-3 h-3 {{ $item['active'] ? 'rotate-180' : '' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </button>
          <ul class="py-2 space-y-2 {{ $item['active'] ? '' : 'hidden' }}">
            @can('solicitudes.ver')
              <li>
                <a href="{{ $item['submenu'][0]['route'] }}"
                   class="flex items-center p-2 pl-11 rounded-lg {{ $item['submenu'][0]['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100' }}">
                  <i class="{{ $item['submenu'][0]['icon'] }} w-4 h-4 mr-2"></i>
                  {{ $item['submenu'][0]['name'] }}
                </a>
              </li>
            @endcan
            @can('pedidos.ver')
              <li>
                <a href="{{ $item['submenu'][1]['route'] }}"
                   class="flex items-center p-2 pl-11 rounded-lg {{ $item['submenu'][1]['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100' }}">
                  <i class="{{ $item['submenu'][1]['icon'] }} w-4 h-4 mr-2"></i>
                  {{ $item['submenu'][1]['name'] }}
                </a>
              </li>
            @endcan
          </ul>
        </li>
      @endif

    </ul>
  </div>
</aside>

<script>
  function toggleSubmenu(btn) {
    btn.nextElementSibling.classList.toggle('hidden');
  }
</script>

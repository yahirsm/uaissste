<x-app-layout>
  @include('layouts.partials.admin.navigation')
  @include('layouts.partials.admin.sidebar')

  <div class="sm:ml-64 p-4 pt-20">
    <div class="bg-white p-6 rounded-lg shadow">
      {{-- título --}}
      <h2 class="flex items-center text-3xl font-bold text-red-700 mb-6">
        <i class="fas fa-id-card mr-2"></i> Detalle del Empleado
      </h2>

      {{-- datos generales --}}
      <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-6 text-gray-700">
        <div>
          <dt class="font-semibold">Nombre</dt>
          <dd class="mt-1">{{ $empleado->nombre }}</dd>
        </div>
        <div>
          <dt class="font-semibold">Primer Apellido</dt>
          <dd class="mt-1">{{ $empleado->primer_apellido }}</dd>
        </div>
        <div>
          <dt class="font-semibold">Segundo Apellido</dt>
          <dd class="mt-1">{{ $empleado->segundo_apellido }}</dd>
        </div>
        <div>
          <dt class="font-semibold">Número de Empleado</dt>
          <dd class="mt-1">{{ $empleado->numero_empleado }}</dd>
        </div>
        <div>
          <dt class="font-semibold">RFC</dt>
          <dd class="mt-1">{{ $empleado->rfc }}</dd>
        </div>
        <div>
          <dt class="font-semibold">Servicio Actual</dt>
          <dd class="mt-1">{{ $empleado->servicioActual?->nombre ?? 'N/A' }}</dd>
        </div>
        <div>
          <dt class="font-semibold">Plaza</dt>
          <dd class="mt-1">{{ $empleado->plaza?->nombre ?? 'N/A' }}</dd>
        </div>
        <div>
          <dt class="font-semibold">Rol</dt>
          <dd class="mt-1">{{ optional($empleado->user)->getRoleNames()->join(', ') ?: '—' }}</dd>
        </div>
      </dl>

      {{-- divisor --}}
      <div class="border-t border-gray-200 mb-6"></div>

      {{-- credenciales --}}
      @if($empleado->user)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
          <div class="max-w-xs w-full">
            <label class="block text-sm font-medium text-gray-600 mb-1">Usuario</label>
            <div class="bg-blue-50 dark:bg-gray-800 px-3 py-2 rounded border border-gray-300 dark:border-gray-600">
              {{ $empleado->user->username }}
            </div>
          </div>
          <div class="max-w-xs w-full">
            <label class="block text-sm font-medium text-gray-600 mb-1">Contraseña</label>
            <div class="relative">
              <input
                type="password"
                id="passwordField"
                readonly
                value="{{ strtolower(substr($empleado->nombre,0,1)) . strtolower(substr($empleado->primer_apellido,0,1)) . strtolower(substr($empleado->segundo_apellido ?? 'x',0,1)) . $empleado->numero_empleado }}#"
                class="w-full p-2 pr-10 rounded border border-gray-300 dark:border-gray-600 bg-blue-50 dark:bg-gray-800 text-gray-800 dark:text-gray-100"
              >
              <button
                type="button"
                onclick="togglePassword()"
                class="absolute inset-y-0 right-2 flex items-center text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white"
              >
                <i id="eyeIcon" class="fas fa-eye"></i>
              </button>
            </div>
          </div>
        </div>
      @endif

      {{-- servicios anteriores --}}
      <div class="mb-6">
        <h3 class="flex items-center text-xl font-bold text-red-700 dark:text-white mb-3">
          <i class="fas fa-history mr-2"></i> Servicios Anteriores
        </h3>
        @if($empleado->serviciosAnteriores->isNotEmpty())
          <ul class="list-disc pl-5 text-gray-700">
            @foreach($empleado->serviciosAnteriores as $srv)
              <li class="mb-2">
                <span class="font-semibold">{{ $srv->nombre }}</span>
                <span class="text-sm text-gray-600">
                  ({{ $srv->pivot->fecha_inicio }} – {{ $srv->pivot->fecha_fin }})
                </span>
              </li>
            @endforeach
          </ul>
        @else
          <p class="text-gray-600 italic">No hay servicios anteriores.</p>
        @endif
      </div>

      {{-- acciones --}}
      <div class="flex justify-end space-x-3">
        <a href="{{ route('usuarios.index') }}"
           class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded shadow text-gray-700">
           Volver
        </a>
        <a href="{{ route('usuarios.edit', $empleado->id) }}"
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded shadow text-white">
           Editar
        </a>
      </div>
    </div>
  </div>
</x-app-layout>

<script>
function togglePassword(){
  const fld = document.getElementById('passwordField');
  const ic  = document.getElementById('eyeIcon');
  if(fld.type === 'password'){
    fld.type = 'text';
    ic.classList.replace('fa-eye','fa-eye-slash');
  } else {
    fld.type = 'password';
    ic.classList.replace('fa-eye-slash','fa-eye');
  }
}
</script>

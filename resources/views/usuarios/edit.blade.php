<x-app-layout>
  @include('layouts.partials.admin.navigation')
  @include('layouts.partials.admin.sidebar')

  <div class="sm:ml-64 p-4 pt-20">
    <div class="bg-white p-6 rounded-lg shadow">
      {{-- título --}}
      <h2 class="flex items-center text-3xl font-bold text-red-700 mb-6">
        <i class="fas fa-user-edit mr-2"></i> Editar Empleado
      </h2>

      @if ($errors->any())
        <div class="bg-red-600 text-white p-3 mb-6 rounded">
          <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('usuarios.update', $empleado->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Datos no editables --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700">Nombre</label>
            <input
              type="text"
              value="{{ $empleado->nombre }}"
              disabled
              class="mt-1 w-full bg-gray-100 border border-gray-300 rounded px-3 py-2"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Primer Apellido</label>
            <input
              type="text"
              value="{{ $empleado->primer_apellido }}"
              disabled
              class="mt-1 w-full bg-gray-100 border border-gray-300 rounded px-3 py-2"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Segundo Apellido</label>
            <input
              type="text"
              value="{{ $empleado->segundo_apellido }}"
              disabled
              class="mt-1 w-full bg-gray-100 border border-gray-300 rounded px-3 py-2"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Número de Empleado</label>
            <input
              type="text"
              value="{{ $empleado->numero_empleado }}"
              disabled
              class="mt-1 w-full bg-gray-100 border border-gray-300 rounded px-3 py-2"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">RFC</label>
            <input
              type="text"
              value="{{ $empleado->rfc }}"
              disabled
              class="mt-1 w-full bg-gray-100 border border-gray-300 rounded px-3 py-2"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Usuario</label>
            <input
              type="text"
              value="{{ $empleado->user->username ?? '—' }}"
              disabled
              class="mt-1 w-full bg-gray-100 border border-gray-300 rounded px-3 py-2"
            />
          </div>
        </div>

        {{-- campos editables --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          {{-- Rol --}}
          <div>
            <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
            <select
              id="rol"
              name="rol"
              required
              class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
            >
              @foreach(['Administrador','Jefe Abasto','Solicitante'] as $rol)
                <option
                  value="{{ $rol }}"
                  {{ old('rol', $empleado->user->roles->pluck('name')->first() ?? '') === $rol ? 'selected' : '' }}
                >{{ $rol }}</option>
              @endforeach
            </select>
          </div>

          {{-- Plaza --}}
          <div>
            <label for="plaza_id" class="block text-sm font-medium text-gray-700">Plaza</label>
            <select
              id="plaza_id"
              name="plaza_id"
              required
              class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
            >
              <option value="" disabled>Seleccione una plaza</option>
              @foreach($plazas as $plaza)
                <option
                  value="{{ $plaza->id }}"
                  {{ old('plaza_id', $empleado->plaza_id) == $plaza->id ? 'selected' : '' }}
                >{{ $plaza->nombre }}</option>
              @endforeach
            </select>
          </div>

          {{-- Servicio --}}
          <div>
            <label for="servicio_id" class="block text-sm font-medium text-gray-700">Servicio</label>
            <select
              id="servicio_id"
              name="servicio_id"
              required
              class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
            >
              <option value="" disabled>Seleccione un servicio</option>
              @foreach($servicios as $servicio)
                <option
                  value="{{ $servicio->id }}"
                  {{ old('servicio_id', $empleado->servicio_actual_id) == $servicio->id ? 'selected' : '' }}
                >{{ $servicio->nombre }}</option>
              @endforeach
            </select>
          </div>

          {{-- Contraseña nueva --}}
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Nueva Contraseña</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Dejar en blanco para mantener la actual"
              class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
            />
          </div>
        </div>

        {{-- botones --}}
        <div class="flex justify-end space-x-3 mt-6">
          <a
            href="{{ route('usuarios.index') }}"
            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded shadow text-gray-700 transition"
          >Cancelar</a>
          <button
            type="submit"
            class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded shadow text-white transition"
          >Guardar Cambios</button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>

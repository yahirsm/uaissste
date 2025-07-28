<x-app-layout>
  @include('layouts.partials.admin.navigation')
  @include('layouts.partials.admin.sidebar')

  <div class="sm:ml-64 p-4 pt-20">
    <div class="bg-white p-6 rounded-lg shadow">

      <h2 class="text-3xl font-bold text-red-700 mb-6">
        <i class="fas fa-user-edit mr-2"></i> Editar Empleado
      </h2>

      @if($errors->any())
        <div class="bg-red-600 text-white p-3 mb-6 rounded">
          <ul class="list-disc list-inside">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('usuarios.update', $empleado->id) }}" method="POST" class="space-y-6">
        @csrf @method('PUT')

        {{-- Campos deshabilitados --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          @foreach([
            'Nombre'             => $empleado->nombre,
            'Primer Apellido'    => $empleado->primer_apellido,
            'Segundo Apellido'   => $empleado->segundo_apellido,
            'Número de Empleado' => $empleado->numero_empleado,
            'RFC'                => $empleado->rfc,
            'Usuario'            => $empleado->user->username ?? '—',
          ] as $label => $value)
            <div>
              <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
              <input
                type="text"
                value="{{ $value }}"
                disabled
                class="mt-1 w-full bg-gray-100 border border-gray-300 rounded px-3 py-2"
              />
            </div>
          @endforeach
        </div>

        {{-- Editables --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          {{-- Rol --}}
          <div>
            <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
            <select id="rol" name="rol"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-red-600">
              @foreach(['Administrador','Jefe Abasto','Solicitante'] as $rol)
                <option value="{{ $rol }}"
                  {{ old('rol', $empleado->user->roles->pluck('name')->first() ?? '') === $rol ? 'selected' : '' }}>
                  {{ $rol }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Plaza --}}
          <div>
            <label for="plaza_id" class="block text-sm font-medium text-gray-700">Plaza</label>
            <select id="plaza_id" name="plaza_id"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-red-600">
              <option value="" disabled>Seleccione una plaza</option>
              @foreach($plazas as $p)
                <option value="{{ $p->id }}"
                  {{ old('plaza_id', $empleado->plaza_id) == $p->id ? 'selected' : '' }}>
                  {{ $p->nombre }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Servicio --}}
          <div>
            <label for="servicio_id" class="block text-sm font-medium text-gray-700">Servicio</label>
            <select id="servicio_id" name="servicio_id"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-red-600">
              <option value="" disabled>Seleccione un servicio</option>
              @foreach($servicios as $s)
                <option value="{{ $s->id }}"
                  {{ old('servicio_id', $empleado->servicio_actual_id) == $s->id ? 'selected' : '' }}>
                  {{ $s->nombre }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Contraseña --}}
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Nueva Contraseña</label>
            <input id="password" name="password" type="password"
                   placeholder="Dejar en blanco para no cambiar"
                   class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-red-600"/>
          </div>
        </div>

        {{-- Botones --}}
        <div class="flex justify-end space-x-3 mt-6">
          <a href="{{ route('usuarios.index') }}"
             class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-gray-700">Cancelar</a>
          <button type="submit"
                  class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded text-white">Guardar Cambios</button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>

{{-- resources/views/inventario/edit.blade.php --}}
<x-app-layout>
  @include('layouts.partials.admin.navigation')
  @include('layouts.partials.admin.sidebar')

  <div class="sm:ml-64 p-6 pt-20">
    <div class="bg-white rounded-lg shadow p-6">
      <h1 class="text-2xl font-bold text-yellow-600 mb-4">
        <i class="fas fa-edit mr-2"></i> Editar Material
      </h1>

      @if($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 p-4 mb-6 rounded">
          <strong class="block mb-1">Hay errores en el formulario:</strong>
          <ul class="list-disc list-inside">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('inventario.update', $material) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Clave (visible pero no editable) --}}
        <div class="mb-4">
          <label for="clave" class="block font-medium mb-1">Clave</label>
          <input id="clave" type="text"
                 value="{{ old('clave', $material->clave) }}"
                 readonly
                 aria-describedby="clave-note"
                 class="w-full border px-3 py-2 rounded bg-gray-100 cursor-not-allowed" />
          <p id="clave-note" class="text-sm text-gray-600 mt-1">
            La clave no se puede modificar aquí. Si necesitas cambiarla, crea un nuevo material o usa el módulo correspondiente.
          </p>
          {{-- Si por algún motivo el backend espera la clave en el request y no la toma, puedes descomentar esta línea oculta: --}}
          {{-- <input type="hidden" name="clave" value="{{ old('clave', $material->clave) }}"> --}}
          @error('clave')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Descripción --}}
        <div class="mb-4">
          <label for="descripcion" class="block font-medium mb-1">Descripción</label>
          <textarea id="descripcion" name="descripcion"
                    class="w-full border px-3 py-2 rounded"
                    required>{{ old('descripcion', $material->descripcion) }}</textarea>
          @error('descripcion')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Partida y Tipo de Insumo --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div>
            <label for="partida_id" class="block font-medium mb-1">Partida</label>
            <select id="partida_id" name="partida_id" class="w-full border px-3 py-2 rounded" required>
              @foreach($partidas as $id => $nombre)
                <option value="{{ $id }}" @selected(old('partida_id', $material->partida_id) == $id)>
                  {{ $nombre }}
                </option>
              @endforeach
            </select>
            @error('partida_id')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="tipo_insumo_id" class="block font-medium mb-1">Tipo de Insumo</label>
            <select id="tipo_insumo_id" name="tipo_insumo_id" class="w-full border px-3 py-2 rounded" required>
              @foreach($tipos as $tipoId => $tipoNombre)
                <option value="{{ $tipoId }}" @selected(old('tipo_insumo_id', $material->tipo_insumo_id) == $tipoId)>
                  {{ $tipoNombre }}
                </option>
              @endforeach
            </select>
            @error('tipo_insumo_id')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        {{-- Botones --}}
        <div class="flex space-x-3">
          <a href="{{ route('inventario.index') }}"
             id="btn-cancelar"
             class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
            Cancelar
          </a>
          <button type="submit"
                  class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 transition">
            Actualizar
          </button>
        </div>
      </form>
    </div>
  </div>

  {{-- Script de confirmación de cancelar con SweetAlert2 --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const btnCancelar = document.getElementById('btn-cancelar');
      if (!btnCancelar) return;

      btnCancelar.addEventListener('click', function (e) {
        e.preventDefault();
        const url = this.getAttribute('href');

        // Verifica que SweetAlert2 esté disponible
        if (typeof Swal === 'undefined') {
          // Si no está, cae a la redirección directa
          window.location.href = url;
          return;
        }

        Swal.fire({
          title: '¿Estás seguro?',
          text: 'Se perderán los cambios no guardados. ¿Quieres cancelar la edición?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, cancelar',
          cancelButtonText: 'Seguir editando',
          reverseButtons: true,
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 1500,
              icon: 'info',
              title: 'Continúas editando'
            });
          }
        });
      });
    });
  </script>
</x-app-layout>

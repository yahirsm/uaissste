{{-- resources/views/inventario/edit.blade.php --}}
<x-app-layout>
  @include('layouts.partials.admin.navigation')
  @include('layouts.partials.admin.sidebar')

  <div class="sm:ml-64 p-6 pt-20">
    <div class="bg-white rounded-lg shadow p-6">
      <h1 class="text-2xl font-bold text-yellow-600 mb-4">
        <i class="fas fa-edit mr-2"></i> Editar Material
      </h1>

     <form action="{{ route('inventario.update', $material) }}" method="POST">
    @csrf
    @method('PUT')

        <div class="mb-4">
          <label class="block font-medium mb-1">Clave</label>
          <input name="clave"
                 value="{{ old('clave',$material->clave) }}"
                 class="w-full border px-3 py-2 rounded" />
          @error('clave')
            <p class="text-red-600 text-sm">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label class="block font-medium mb-1">Descripción</label>
          <textarea name="descripcion"
                    class="w-full border px-3 py-2 rounded">{{ old('descripcion',$material->descripcion) }}</textarea>
          @error('descripcion')
            <p class="text-red-600 text-sm">{{ $message }}</p>
          @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
          <div>
            <label class="block font-medium mb-1">Partida</label>
            <select name="partida_id" class="w-full border px-3 py-2 rounded">
              @foreach($partidas as $id => $nombre)
                <option value="{{ $id }}"
                  @selected(old('partida_id',$material->partida_id)==$id)>
                  {{ $nombre }}
                </option>
              @endforeach
            </select>
            @error('partida_id')
              <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label class="block font-medium mb-1">Tipo de Insumo</label>
            <select name="tipo_insumo_id" class="w-full border px-3 py-2 rounded">
              @foreach($tipos as $tipoId => $tipoNombre)
                <option value="{{ $tipoId }}"
                  @selected(old('tipo_insumo_id',$material->tipo_insumo_id)==$tipoId)>
                  {{ $tipoNombre }}
                </option>
              @endforeach
            </select>
            @error('tipo_insumo_id')
              <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="flex space-x-3">
          <a href="{{ route('inventario.index') }}"
             class="px-4 py-2 bg-gray-500 text-white rounded">Cancelar</a>
          <button type="submit"
                  class="px-4 py-2 bg-yellow-600 text-white rounded">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>

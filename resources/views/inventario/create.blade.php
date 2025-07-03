<x-app-layout>
  @include('layouts.partials.admin.navigation')
  @include('layouts.partials.admin.sidebar')

  <div class="sm:ml-64 p-6 pt-20">
    <div class="bg-white rounded-lg shadow p-6">
      <h1 class="text-2xl font-bold text-red-700 mb-4">
        <i class="fas fa-plus mr-2"></i> Agregar Material
      </h1>

      <form id="materialForm" action="{{ route('inventario.store') }}" method="POST" novalidate>
        @csrf

        {{-- Checkbox de “Material Básico” --}}
        <div class="mb-4">
          <label class="inline-flex items-center">
            <input type="checkbox" id="basico" name="basico" class="form-checkbox h-5 w-5 text-red-600">
            <span class="ml-2">Este es un material básico</span>
          </label>
        </div>

        {{-- Clave --}}
        <div class="mb-4">
          <label class="block font-medium mb-1">Clave</label>
          <input
            id="clave"
            name="clave"
            value="{{ old('clave') }}"
            maxlength="10"
            class="w-full border px-3 py-2 rounded transition-colors"
            placeholder="Ingresa la clave"
          />
          @error('clave')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Descripción --}}
        <div class="mb-4">
          <label class="block font-medium mb-1">Descripción</label>
          <textarea
            id="descripcion"
            name="descripcion"
            rows="3"
            class="w-full border px-3 py-2 rounded transition-colors"
            placeholder="Describe el material"
          >{{ old('descripcion') }}</textarea>
          @error('descripcion')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Partida + Tipo de Insumo --}}
        <div class="grid grid-cols-2 gap-4 mb-6">
          <div>
            <label class="block font-medium mb-1">Partida</label>
            <select
              id="partida"
              name="partida_id"
              class="w-full border px-3 py-2 rounded transition-colors"
            >
              <option value="">Selecciona...</option>
              @foreach($partidas as $id => $nombre)
                <option value="{{ $id }}" @selected(old('partida_id') == $id)>
                  {{ $nombre }}
                </option>
              @endforeach
            </select>
            @error('partida_id')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label class="block font-medium mb-1">Tipo de Insumo</label>
            <select
              id="tipo"
              name="tipo_insumo_id"
              class="w-full border px-3 py-2 rounded transition-colors"
            >
              <option value="">Selecciona...</option>
              @foreach($tipos as $tipoId => $tipoNombre)
                <option value="{{ $tipoId }}" @selected(old('tipo_insumo_id') == $tipoId)>
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
             class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Cancelar
          </a>
          <button
            id="btnSubmit"
            type="submit"
            disabled
            class="px-4 py-2 bg-green-600 text-white rounded opacity-50 cursor-not-allowed hover:opacity-100"
          >
            Guardar
          </button>
        </div>
      </form>
    </div>
  </div>

  {{-- Scripts de validación en vivo --}}
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const basico      = document.getElementById('basico');
      const clave       = document.getElementById('clave');
      const descripcion = document.getElementById('descripcion');
      const partida     = document.getElementById('partida');
      const tipo        = document.getElementById('tipo');
      const btnSubmit   = document.getElementById('btnSubmit');

      function validaInput(el, regex) {
        const val = el.value.trim();
        el.classList.remove('border-red-500','border-green-500');
        if (!val || !regex.test(val)) {
          el.classList.add('border-red-500');
          return false;
        }
        el.classList.add('border-green-500');
        return true;
      }
      function validaSelect(el) {
        const ok = el.value !== '';
        el.classList.remove('border-red-500','border-green-500');
        el.classList.add(ok ? 'border-green-500' : 'border-red-500');
        return ok;
      }

      function validarTodo() {
        const esBasico = basico.checked;
        const reClave = esBasico
          ? /^MFCB\d{6}$/
          : /^\d{10}$/;
        const okClave = validaInput(clave, reClave);
        const okDesc  = !!descripcion.value.trim();
        descripcion.classList.remove('border-red-500','border-green-500');
        descripcion.classList.add(okDesc ? 'border-green-500' : 'border-red-500');
        const okPart  = validaSelect(partida);
        const okTipo  = validaSelect(tipo);

        const todoOk = okClave && okDesc && okPart && okTipo;
        btnSubmit.disabled = !todoOk;
        if (todoOk) {
          btnSubmit.classList.remove('opacity-50','cursor-not-allowed');
        } else {
          btnSubmit.classList.add('opacity-50','cursor-not-allowed');
        }
      }

      // Al cambiar checkbox
      basico.addEventListener('change', () => {
        if (basico.checked) {
          clave.value = 'MFCB';
        } else {
          clave.value = '';
        }
        clave.maxLength = 10;
        validarTodo();
      });

      // Revalidar en cada input
      [clave, descripcion, partida, tipo].forEach(el => {
        el.addEventListener('input', validarTodo);
      });

      // Primera validación
      validarTodo();
    });
  </script>
</x-app-layout>

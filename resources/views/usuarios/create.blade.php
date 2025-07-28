<x-app-layout>
  @include('layouts.partials.admin.navigation')
  @include('layouts.partials.admin.sidebar')

  <div class="sm:ml-64 p-4 pt-20">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
      <h2 class="text-3xl font-bold text-red-700 dark:text-red-400 mb-6">
        <i class="fas fa-user-plus mr-2"></i> Agregar Nuevo Usuario
      </h2>

      {{-- Errores de validación --}}
      @if ($errors->any())
        <div class="bg-red-500 text-white p-3 mb-4 rounded">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form
        id="formUsuario"
        action="{{ route('usuarios.store') }}"
        method="POST"
        class="grid grid-cols-1 md:grid-cols-2 gap-4"
      >
        @csrf

        {{-- Número de empleado --}}
        <div>
          <label for="numero_empleado" class="block text-sm font-medium text-gray-700">Número de Empleado</label>
          <input
            type="text"
            name="numero_empleado"
            id="numero_empleado"
            maxlength="6"
            required
            placeholder="123456"
            value="{{ old('numero_empleado') }}"
            class="w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
        </div>

        {{-- Nombre --}}
        <div>
          <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
          <input
            type="text"
            name="nombre"
            id="nombre"
            required
            placeholder="Juan Carlos"
            value="{{ old('nombre') }}"
            class="w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
        </div>

        {{-- Primer Apellido --}}
        <div>
          <label for="primer_apellido" class="block text-sm font-medium text-gray-700">Primer Apellido</label>
          <input
            type="text"
            name="primer_apellido"
            id="primer_apellido"
            required
            placeholder="Pérez"
            value="{{ old('primer_apellido') }}"
            class="w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
        </div>

        {{-- Segundo Apellido --}}
        <div>
          <label for="segundo_apellido" class="block text-sm font-medium text-gray-700">Segundo Apellido</label>
          <input
            type="text"
            name="segundo_apellido"
            id="segundo_apellido"
            placeholder="López"
            value="{{ old('segundo_apellido') }}"
            class="w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
        </div>

        {{-- RFC --}}
        <div>
          <label for="rfc" class="block text-sm font-medium text-gray-700">RFC</label>
          <input
            type="text"
            name="rfc"
            id="rfc"
            maxlength="13"
            required
            placeholder="ABCD901212XYZ"
            value="{{ old('rfc') }}"
            class="w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50 uppercase"
          >
        </div>

        {{-- Rol --}}
        <div>
          <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
          <select
            id="rol"
            name="rol"
            required
            class="mt-1 block w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
            <option value="" disabled {{ old('rol') ? '' : 'selected' }}>Seleccione un rol</option>
            <option value="Administrador" {{ old('rol')=='Administrador' ? 'selected':'' }}>Administrador</option>
            <option value="Jefe Abasto"     {{ old('rol')=='Jefe Abasto'    ? 'selected':'' }}>Jefe Abasto</option>
            <option value="Solicitante"     {{ old('rol')=='Solicitante'    ? 'selected':'' }}>Solicitante</option>
          </select>
        </div>

        {{-- Plaza --}}
        <div>
          <label for="plaza_id" class="block text-sm font-medium text-gray-700">Plaza</label>
          <select
            name="plaza_id"
            id="plaza_id"
            required
            class="mt-1 block w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
            <option value="" disabled {{ old('plaza_id') ? '' : 'selected' }}>Seleccione una plaza</option>
            @foreach($plazas as $plaza)
              <option value="{{ $plaza->id }}" {{ old('plaza_id')==$plaza->id ? 'selected':'' }}>
                {{ $plaza->nombre }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Servicio --}}
        <div>
          <label for="servicio_id" class="block text-sm font-medium text-gray-700">Servicio Actual</label>
          <select
            name="servicio_id"
            id="servicio_id"
            required
            class="mt-1 block w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
            <option value="" disabled {{ old('servicio_id') ? '' : 'selected' }}>Seleccione un servicio</option>
            @foreach($servicios as $servicio)
              <option value="{{ $servicio->id }}" {{ old('servicio_id')==$servicio->id ? 'selected':'' }}>
                {{ $servicio->nombre }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Campos generados (solo lectura) --}}
        <div>
          <label class="block text-sm font-medium text-gray-700">Usuario generado</label>
          <input
            type="text"
            id="username"
            readonly
            class="w-full p-2 border rounded bg-gray-100 text-gray-700"
          >
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Contraseña generada</label>
          <input
            type="text"
            id="password"
            readonly
            class="w-full p-2 border rounded bg-gray-100 text-gray-700"
          >
        </div>

        {{-- Botones --}}
        <div class="col-span-2 flex justify-end space-x-4 mt-4">
          <a href="{{ route('usuarios.index') }}"
             class="px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
            Cancelar
          </a>
          <button
            type="submit"
            id="guardarBtn"
            class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition"
          >
            Guardar Usuario
          </button>
        </div>
      </form>
    </div>
  </div>

  {{-- JS para generar usuario/password --}}
  <script>
    const numEmp    = document.getElementById('numero_empleado');
    const ape1      = document.getElementById('primer_apellido');
    const ape2      = document.getElementById('segundo_apellido');
    const nom       = document.getElementById('nombre');
    const userField = document.getElementById('username');
    const passField = document.getElementById('password');

    function generarCredenciales() {
      const n1 = ape1.value.trim().toLowerCase();
      const n2 = ape2.value.trim().toLowerCase();
      const nm = nom.value.trim().toLowerCase();
      const num= numEmp.value.trim();
      if (!n1 || !nm || !num) return;

      // usuario
      let u = n1;
      fetch(`/verificar-usuario/${u}`)
        .then(r=>r.json())
        .then(d=>{
          if (d.exists && n2) u += n2.charAt(0);
          userField.value = u;
        });

      // contraseña
      const i1 = nm.charAt(0) || '';
      const i2 = n1.charAt(0) || '';
      const i3 = n2.charAt(0) || 'x';
      passField.value = `${i1}${i2}${i3}${num}#`;
    }

    [numEmp, ape1, ape2, nom].forEach(el=>
      el.addEventListener('input', generarCredenciales)
    );
  </script>
</x-app-layout>

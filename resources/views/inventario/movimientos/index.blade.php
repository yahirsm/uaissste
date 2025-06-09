<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
      <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold text-red-700 mb-4">
          <i class="fas fa-exchange-alt mr-2"></i> Movimientos de Inventario
        </h2>

        @if(session('success'))
          <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
          </div>
        @endif
@if($errors->any())
  <div class="bg-red-500 text-white p-3 rounded mb-4">
    <ul class="list-disc list-inside">
      @foreach($errors->all() as $err)
        <li>{{ $err }}</li>
      @endforeach
    </ul>
  </div>
@endif

        <!-- Formulario para nueva entrada/salida -->
        <form action="{{ route('inventario.movimientos.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-6">
          @csrf

          <div class="col-span-2">
            <label for="material_id" class="block font-medium">Material</label>
            <select name="material_id" id="material_id" required
              class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
              <option value="" disabled selected>Selecciona material</option>
              @foreach($materiales as $m)
                <option value="{{ $m->id }}">
                  {{ $m->clave }} — {{ Str::limit($m->descripcion, 40) }}
                </option>
              @endforeach
            </select>
          </div>

          <div>
            <label for="tipo" class="block font-medium">Tipo</label>
            <select name="tipo" id="tipo" required
              class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
              <option value="entrada">Entrada</option>
              <option value="salida">Salida</option>
            </select>
          </div>

          <div>
            <label for="cantidad" class="block font-medium">Cantidad</label>
            <input type="number" step="0.01" name="cantidad" id="cantidad" required
              class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
          </div>

          <div>
            <label for="unidad" class="block font-medium">Unidad</label>
            <input type="text" name="unidad" id="unidad" value="pieza" required
              class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
          </div>

          <div>
            <label for="fecha_movimiento" class="block font-medium">Fecha</label>
            <input type="date" name="fecha_movimiento" id="fecha_movimiento" required
              class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
          </div>

          <div>
            <label for="fecha_caducidad" class="block font-medium">Caducidad (opcional)</label>
            <input type="date" name="fecha_caducidad" id="fecha_caducidad"
              class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
          </div>

          <div class="col-span-full flex justify-end">
            <button type="submit"
              class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded flex items-center gap-2">
              <i class="fas fa-save"></i> Registrar
            </button>
          </div>
        </form>

        <!-- Tabla de movimientos -->
        <div class="overflow-x-auto">
          <table class="w-full table-auto border-collapse">
            <thead>
              <tr class="bg-red-700 text-white">
                <th class="p-2">#</th>
                <th class="p-2">Material</th>
                <th class="p-2">Tipo</th>
                <th class="p-2">Cantidad</th>
                <th class="p-2">Unidad</th>
                <th class="p-2">Fecha</th>
                <th class="p-2">Caducidad</th>
              </tr>
            </thead>
            <tbody>
              @foreach($movimientos as $mov)
                <tr class="border-b">
                  <td class="p-2">{{ $mov->id }}</td>
                  <td class="p-2">{{ $mov->material->clave }} – {{ Str::limit($mov->material->descripcion, 30) }}</td>
                  <td class="p-2 capitalize">{{ $mov->tipo }}</td>
                  <td class="p-2">{{ $mov->cantidad }}</td>
                  <td class="p-2">{{ $mov->unidad }}</td>
                  <td class="p-2">{{ $mov->fecha_movimiento->format('d/m/Y') }}</td>
                  <td class="p-2">{{ optional($mov->fecha_caducidad)->format('d/m/Y') ?: '–' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="mt-4">
          {{ $movimientos->links() }}
        </div>
      </div>
    </div>
</x-app-layout>

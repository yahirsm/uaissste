{{-- resources/views/distribucion/solicitud/create.blade.php --}}
<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
      <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold text-red-700 mb-2">
          <i class="fas fa-clipboard-list mr-2"></i> Nueva Solicitud
        </h2>

        {{-- Mensaje informativo --}}
        <p class="mb-4 text-gray-600 italic">
          Aquí sólo podrás ver los materiales con los que se cuenta con existencia.
        </p>

        @if(session('error'))
          <div class="bg-red-500 text-white p-2 rounded mb-4">
            {{ session('error') }}
          </div>
        @endif

        <form action="{{ route('distribucion.solicitud.store') }}" method="POST">
          @csrf

          <table class="w-full table-auto mb-4">
            <thead>
              <tr class="bg-gray-100">
                <th class="px-4 py-2">Clave</th>
                <th class="px-4 py-2">Descripción</th>
                <th class="px-4 py-2">Stock</th>
                <th class="px-4 py-2">Cantidad</th>
              </tr>
            </thead>
            <tbody>
              @foreach($materiales as $m)
                <tr>
                  <td class="border px-4 py-2">{{ $m->clave }}</td>
                  <td class="border px-4 py-2">{{ $m->descripcion }}</td>
                  <td class="border px-4 py-2">{{ $m->stock_actual }}</td>
                  <td class="border px-4 py-2">
                    <input
                      type="number"
                      name="items[{{ $m->id }}][cantidad]"
                      min="0"
                      max="{{ $m->stock_actual }}"
                      value="{{ old("items.{$m->id}.cantidad", 0) }}"
                      class="w-20 p-1 border rounded"
                    >
                    <input type="hidden" name="items[{{ $m->id }}][material_id]" value="{{ $m->id }}">
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <button
            type="submit"
            class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded"
          >
            <i class="fas fa-paper-plane mr-1"></i> Enviar Solicitud
          </button>
        </form>
      </div>
    </div>
</x-app-layout>

{{-- resources/views/distribucion/solicitud/index.blade.php --}}
<x-app-layout>
  @include('layouts.partials.admin.navigation')
  @include('layouts.partials.admin.sidebar')

  <div class="sm:ml-64 p-4 pt-20">
    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-2xl font-bold text-red-700 mb-2">
        <i class="fas fa-clipboard-list mr-2"></i> Nueva Solicitud
      </h2>
      <p class="mb-4 text-gray-600 italic">
        Aquí sólo podrás ver los materiales con los que se cuenta con existencia.
      </p>

      @if(session('error'))
        <div class="bg-red-500 text-white p-2 rounded mb-4">
          {{ session('error') }}
        </div>
      @endif

      <form id="solicitudForm" action="{{ route('distribucion.solicitud.store') }}" method="POST">
        @csrf
        <table class="w-full table-auto mb-4">
          <thead>
            <tr class="bg-gray-100">
              <th class="px-4 py-2">Clave</th>
              <th class="px-4 py-2">Descripción</th>
              <th class="px-4 py-2">Stock</th>
              <th class="px-4 py-2">Cantidad</th>
              <th class="px-4 py-2">Observaciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($materiales as $m)
              <tr>
                <td class="border px-4 py-2">{{ $m->clave }}</td>
                <td class="border px-4 py-2">{{ $m->descripcion }}</td>
                <td class="border px-4 py-2 text-center">{{ $m->stock_actual }}</td>
                <td class="border px-4 py-2 text-center">
                  <input
                    type="number"
                    name="items[{{ $m->id }}][cantidad]"
                    min="0"
                    max="{{ $m->stock_actual }}"
                    value="{{ old("items.{$m->id}.cantidad", 0) }}"
                    class="w-20 p-1 border rounded text-center cantidad-input"
                  >
                  <input type="hidden" name="items[{{ $m->id }}][material_id]" value="{{ $m->id }}">
                </td>
                <td class="border px-4 py-2">
                  <input
                    type="text"
                    name="items[{{ $m->id }}][observaciones]"
                    value="{{ old("items.{$m->id}.observaciones") }}"
                    placeholder="(opcional)"
                    class="w-full p-1 border rounded"
                  >
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <button
          id="submitBtn"
          type="submit"
          class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2"
        >
          <i class="fas fa-paper-plane mr-1"></i> Enviar Solicitud
        </button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const submitBtn = document.querySelector('#submitBtn');
      const qtyInputs = document.querySelectorAll('.cantidad-input');

      function validateAll() {
        const anyTooHigh = Array.from(qtyInputs).some(i => (parseInt(i.value,10)||0) > parseInt(i.max,10));
        const anyPositive = Array.from(qtyInputs).some(i => (parseInt(i.value,10)||0) > 0);
        submitBtn.disabled = anyTooHigh || !anyPositive;
      }

      qtyInputs.forEach(input => {
        input.addEventListener('blur', () => {
          const val = parseInt(input.value,10)||0;
          const max = parseInt(input.max,10);
          if (val > max) {
            Swal.fire({ icon:'error', toast:true, position:'top-end',
              title:`No puede superar el stock (${max}).`, timer:2000, showConfirmButton:false });
          } else if (! Array.from(qtyInputs).some(i => (parseInt(i.value,10)||0) > 0)) {
            Swal.fire({ icon:'warning', toast:true, position:'top-end',
              title:'Debes solicitar al menos un material', timer:2000, showConfirmButton:false });
          }
          validateAll();
        });
      });

      validateAll();
    });
  </script>
</x-app-layout>

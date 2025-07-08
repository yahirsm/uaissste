{{-- resources/views/inventario/index.blade.php --}}
<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">

            {{-- Encabezado --}}
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-3xl font-bold text-red-700 dark:text-red-400 flex items-center gap-2">
                    <i class="fas fa-cogs"></i>
                    Inventario de Materiales
                </h2>
                @can('inventario.crear')
                    <a href="{{ route('inventario.create') }}"
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
                        <i class="fas fa-plus mr-1"></i> Agregar Material
                    </a>
                @endcan
            </div>

            {{-- Buscador + Filtro de existencias --}}
            <form method="GET" action="{{ route('inventario.index') }}" class="mb-4">
                @php
                    // request()->boolean() devuelve true si ?in_stock=1 o in_stock=on
                    $inStock = request()->boolean('in_stock');
                @endphp
                <div class="flex flex-wrap items-center gap-2">
                    <input
                        type="text"
                        name="search"
                        placeholder="Buscar clave o descripción"
                        value="{{ request('search') }}"
                        class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-700 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                    />
                    <button
                        type="submit"
                        class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg transition flex items-center gap-1"
                    >
                        <i class="fas fa-search"></i> Buscar
                    </button>

                    <label
                        for="in_stock"
                        class="inline-flex items-center gap-1 px-3 py-2 border rounded-lg cursor-pointer
                            {{ $inStock
                                ? 'bg-green-100 border-green-500 text-green-700'
                                : 'bg-gray-100 border-gray-300 text-gray-700' }}
                            transition"
                    >
                        <input
                            type="checkbox"
                            id="in_stock"
                            name="in_stock"
                            class="sr-only"
                            onchange="this.form.submit()"
                            {{ $inStock ? 'checked' : '' }}
                        />
                        <i class="fas fa-box-check"></i>
                        <span class="text-sm">Solo existencias ≥ 1</span>
                    </label>
                </div>
            </form>

            {{-- Mensajes --}}
            @if(session('success'))
                <div class="bg-green-500 text-white p-2 mb-4 rounded shadow-md dark:bg-green-700">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-500 text-white p-2 mb-4 rounded shadow-md dark:bg-red-700">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Tabla de materiales --}}
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                    <thead class="bg-red-700 text-white text-sm uppercase tracking-wider dark:bg-red-800">
                        <tr>
                            <th class="px-4 py-3">Clave</th>
                            <th class="px-4 py-3">Descripción</th>
                            <th class="px-4 py-3">Tipo de Insumo</th>
                            <th class="px-4 py-3">Partida</th>
                            <th class="px-4 py-3">Stock</th>
                            @canany(['inventario.editar','inventario.eliminar'])
                                <th class="px-4 py-3 text-center">Acciones</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materiales as $material)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-300 dark:border-gray-700">
                                <td class="px-4 py-3">{{ $material->clave }}</td>
                                <td class="px-4 py-3">{{ $material->descripcion }}</td>
                                <td class="px-4 py-3">{{ $material->tipoInsumo->nombre ?? '—' }}</td>
                                <td class="px-4 py-3">{{ $material->partida->nombre ?? '—' }}</td>
                                <td class="px-4 py-3 flex items-center gap-1">
                                    @if($material->stock_actual >= 1)
                                        <i class="fas fa-check-circle text-green-600"></i>
                                    @else
                                        <i class="fas fa-times-circle text-red-600"></i>
                                    @endif
                                    {{ number_format($material->stock_actual, 2) }}
                                </td>

                                @canany(['inventario.editar','inventario.eliminar'])
                                    <td class="px-4 py-3">
                                        <div class="flex justify-center gap-2">
                                            @can('inventario.editar')
                                                <a href="{{ route('inventario.edit', $material) }}"
                                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded flex items-center gap-1 transition">
                                                    <i class="fas fa-pencil-alt"></i> Editar
                                                </a>
                                            @endcan

                                            @can('inventario.eliminar')
                                                <form
                                                    action="{{ route('inventario.destroy', $material) }}"
                                                    method="POST"
                                                    class="delete-material-form"
                                                    data-nombre="{{ $material->descripcion }}"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded flex items-center gap-1 transition">
                                                        <i class="fas fa-trash-alt"></i> Eliminar
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                @endcanany
                            </tr>
                        @empty
                            @php
                                // Si no hay columnas de acciones, colspan = 5, si sí, colspan = 6
                                $colspan = Auth::user()->canany(['inventario.editar','inventario.eliminar']) ? 6 : 5;
                            @endphp
                            <tr>
                                <td
                                    colspan="{{ $colspan }}"
                                    class="px-4 py-4 text-center text-yellow-800 dark:text-yellow-200 bg-yellow-100 dark:bg-yellow-900"
                                >
                                    No hay materiales que coincidan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="mt-4">
                {{ $materiales
                    ->withQueryString()
                    ->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    {{-- SweetAlert2 para confirmar borrado --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      document.querySelectorAll('.delete-material-form').forEach(form => {
        form.addEventListener('submit', async function(e) {
          e.preventDefault();
          const nombre = this.dataset.nombre;
          const result = await Swal.fire({
            title: '¿Eliminar material?',
            html: `¿Estás seguro de eliminar <strong>${nombre}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
          });
          if (result.isConfirmed) {
            this.submit();
          }
        });
      });
    </script>
</x-app-layout>

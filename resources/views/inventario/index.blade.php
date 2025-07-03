{{-- resources/views/inventario/index.blade.php --}}
<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-3xl font-bold text-red-700 dark:text-red-400">
                    <i class="fas fa-cogs mr-2"></i> Inventario de Materiales
                </h2>
                <a href="{{ route('inventario.create') }}"
                   class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2">
                    <i class="fas fa-plus-circle"></i>
                    <span>Agregar Material</span>
                </a>
            </div>

            {{-- Buscador --}}
            <form method="GET" action="{{ route('inventario.index') }}" class="mb-4">
                <div class="flex items-center gap-2">
                    <input type="text" name="search" placeholder="Buscar clave o descripción"
                        value="{{ request('search') }}"
                        class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-700 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                    >
                    <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-search mr-1"></i> Buscar
                    </button>
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

            {{-- Tabla --}}
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                    <thead class="bg-red-700 text-white text-sm uppercase tracking-wider dark:bg-red-800">
                        <tr>
                            <th class="px-4 py-3">Clave</th>
                            <th class="px-4 py-3">Descripción</th>
                            <th class="px-4 py-3">Tipo de Insumo</th>
                            <th class="px-4 py-3">Partida</th>
                            <th class="px-4 py-3">Stock</th>
                            <th class="px-4 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($materiales as $material)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-300 dark:border-gray-700">
                            <td class="px-4 py-3">{{ $material->clave }}</td>
                            <td class="px-4 py-3">{{ $material->descripcion }}</td>
                            <td class="px-4 py-3">{{ $material->tipoInsumo->nombre ?? 'Sin tipo' }}</td>
                            <td class="px-4 py-3">{{ $material->partida->nombre ?? 'Sin partida' }}</td>
                            <td class="px-4 py-3">{{ number_format($material->stock_actual,2) }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    {{-- Editar --}}
                                    <a href="{{ route('inventario.edit', $material) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2">
                                        <i class="fas fa-pencil-alt"></i>
                                        <span>Editar</span>
                                    </a>
                                    {{-- Eliminar --}}
                                    <form action="{{ route('inventario.destroy', $material) }}"
                                          method="POST"
                                          class="delete-material-form"
                                          data-nombre="{{ $material->descripcion }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded flex items-center gap-2">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Eliminar</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-yellow-800 dark:text-yellow-200 bg-yellow-100 dark:bg-yellow-900">
                                No hay materiales.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="mt-4">
                {{ $materiales->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      document.querySelectorAll('.delete-material-form').forEach(form => {
        form.addEventListener('submit', async function(e) {
          e.preventDefault();
          const nombre = this.dataset.nombre;
          const result = await Swal.fire({
            title: '¿Eliminar material?',
            html: `¿Estás seguro de que deseas eliminar <strong>${nombre}</strong>? Esta acción no se puede deshacer.`,
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

<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-3xl font-bold text-red-700 dark:text-white mb-4">
                <i class="fas fa-cogs"></i> Inventario de Materiales
            </h2>

            <p class="text-gray-600 dark:text-gray-300 mb-4">
                Aquí puedes revisar los materiales en el inventario con sus datos detallados.
            </p>

            <!-- Campo de búsqueda y botón de agregar -->
            <div class="flex justify-between items-center mb-4">
                <form method="GET" action="{{ route('inventario.index') }}" class="flex space-x-2">
                    <input type="text" name="search" placeholder="Buscar por clave o descripción" 
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:border-red-700 focus:ring focus:ring-red-300 w-64"
                        value="{{ request('search') }}">
                    <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded-lg hover:bg-red-800">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </form>

                <button class="bg-red-700 text-white py-2 px-4 rounded hover:bg-red-800">
                    <i class="fas fa-plus-circle"></i> Agregar Material
                </button>
            </div>

            <!-- Tabla -->
            <table class="table-auto w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                <thead class="bg-red-700 text-white">
                    <tr>
                        <th class="px-6 py-3">Clave</th>
                        <th class="px-6 py-3">Descripción</th>
                        <th class="px-6 py-3">Tipo de Insumo</th>
                        <th class="px-6 py-3">Partida</th>
                        <th class="px-6 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($materiales->isEmpty())
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-red-600 font-semibold">
                                No se encontraron coincidencias.
                            </td>
                        </tr>
                    @else
                        @foreach ($materiales as $material)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-6 py-3">{{ $material->clave }}</td>
                                <td class="px-6 py-3">{{ $material->descripcion }}</td>
                                <td class="px-6 py-3">
                                    @if ($material->tipoInsumo)
                                        {{ $material->tipoInsumo->nombre }}
                                    @else
                                        <span class="text-red-600">Sin tipo</span>
                                    @endif
                                </td>                                <td class="px-6 py-3">
                                    @if ($material->partida)
                                        {{ $material->partida->nombre }}
                                    @else
                                        <span class="text-red-600">Sin partida</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3 flex justify-center space-x-2">
                                    <button class="bg-yellow-600 text-white py-1 px-3 rounded hover:bg-yellow-700">
                                        <i class="fas fa-pencil-alt"></i> Modificar
                                    </button>
                                    <button class="bg-red-600 text-white py-1 px-3 rounded hover:bg-red-700">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="mt-4">
                {{ $materiales->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    @stack('modals')
    <script>
    const input = document.querySelector('input[name="search"]');
    input.addEventListener('input', function () {
        if (this.value.trim() === '') {
            window.location.href = "{{ route('inventario.index') }}";
        }
    });
</script>
</x-app-layout>

@if ($materiales->isEmpty())
    <p class="text-red-600">No se encontraron coincidencias.</p>
@else
    <table class="table-auto w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
        <thead class="bg-red-700 text-white">
            <tr>
                <th class="px-6 py-3">Clave</th>
                <th class="px-6 py-3">Descripción</th>
                <th class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($materiales as $material)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-6 py-3">{{ $material->clave }}</td>
                    <td class="px-6 py-3">{{ $material->descripcion }}</td>
                    <td class="px-6 py-3 flex space-x-2">
                        <button class="bg-yellow-600 text-white p-2 rounded hover:bg-yellow-700">
                            <i class="fas fa-pencil-alt"></i> Editar
                        </button>
                        <button class="bg-red-600 text-white p-2 rounded hover:bg-red-700">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $materiales->links('pagination::tailwind') }}
    </div>
@endif

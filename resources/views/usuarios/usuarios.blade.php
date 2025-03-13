<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-3xl font-bold text-red-700 dark:text-white mb-4">
                <i class="fas fa-users"></i> Lista de Empleados
            </h2>

            @if (session('success'))
                <div class="bg-green-500 text-white p-2 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabla de empleados -->
            <div class="overflow-x-auto">
                <table class="table-fixed w-full text-sm text-left text-gray-600 dark:text-gray-300 border-collapse">
                    <thead class="bg-red-700 text-white">
                        <tr>
                            <th class="px-4 py-2 w-32">Nombre</th>
                            <th class="px-4 py-2 w-32">Primer Apellido</th>
                            <th class="px-4 py-2 w-32">Segundo Apellido</th>
                            <th class="px-4 py-2 w-32">Número de Empleado</th>
                            <th class="px-4 py-2 w-40">RFC</th>
                            <th class="px-4 py-2 w-40">Servicio Actual</th>
                            <th class="px-4 py-2 w-32">Plaza</th>
                            <th class="px-4 py-2 w-40 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($empleados as $empleado)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-2 truncate">{{ $empleado->nombre }}</td>
                                <td class="px-4 py-2 truncate">{{ $empleado->primer_apellido }}</td>
                                <td class="px-4 py-2 truncate">{{ $empleado->segundo_apellido }}</td>
                                <td class="px-4 py-2 truncate">{{ $empleado->numero_empleado }}</td>
                                <td class="px-4 py-2 truncate">{{ $empleado->rfc }}</td>
                                <td class="px-4 py-2 truncate">
                                    {{ $empleado->servicioActual?->nombre ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-2 truncate">
                                    {{ $empleado->plaza?->nombre ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-2 flex justify-center space-x-2">
                                    <!-- Botón para ver empleado -->
                                    <a href="{{ route('usuarios.show', $empleado->id) }}"
                                        class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-700"
                                        aria-label="Ver empleado" title="Ver">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>

                                    <!-- Botón para editar empleado -->
                                    <a href="{{ route('usuarios.edit', $empleado->id) }}"
                                        class="bg-yellow-600 text-white py-1 px-3 rounded hover:bg-yellow-700"
                                        aria-label="Editar empleado" title="Editar">
                                        <i class="fas fa-pencil-alt"></i> Editar
                                    </a>

                                    <!-- Botón para eliminar empleado -->
                                    <form action="{{ route('usuarios.destroy', $empleado->id) }}" method="POST"
                                        onsubmit="return confirmarEliminacion('{{ $empleado->nombre }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white py-1 px-3 rounded hover:bg-red-700"
                                            aria-label="Eliminar empleado" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script para confirmación personalizada -->
    <script>
        function confirmarEliminacion(nombre) {
            return confirm(`¿Estás seguro de que deseas eliminar a ${nombre}?`);
        }
    </script>
</x-app-layout>

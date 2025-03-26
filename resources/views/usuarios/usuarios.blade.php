<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-3xl font-bold text-red-700 dark:text-red-400">
                    <i class="fas fa-users mr-2"></i> Lista de Usuarios
                </h2>
                <!-- Botón para agregar un nuevo usuario -->
                <a href="{{ route('usuarios.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2 transition">
                    <i class="fas fa-user-plus"></i>
                    <span>Agregar Usuario</span>
                </a>
            </div>

            @if (session('success'))
                <div class="bg-green-500 text-white p-2 mb-4 rounded shadow-md dark:bg-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabla de empleados -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                    <thead class="bg-red-700 text-white text-sm uppercase tracking-wider dark:bg-red-800">
                        <tr>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Primer Apellido</th>
                            <th class="px-4 py-3">Segundo Apellido</th>
                            <th class="px-4 py-3">Número de Empleado</th>
                            <th class="px-4 py-3">RFC</th>
                            <th class="px-4 py-3">Servicio Actual</th>
                            <th class="px-4 py-3">Plaza</th>
                            <th class="px-4 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleados as $empleado)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-300 dark:border-gray-700">
                                <td class="px-4 py-3 truncate">{{ $empleado->nombre }}</td>
                                <td class="px-4 py-3 truncate">{{ $empleado->primer_apellido }}</td>
                                <td class="px-4 py-3 truncate">{{ $empleado->segundo_apellido }}</td>
                                <td class="px-4 py-3 truncate">{{ $empleado->numero_empleado }}</td>
                                <td class="px-4 py-3 truncate">{{ $empleado->rfc }}</td>
                                <td class="px-4 py-3 truncate">
                                    {{ $empleado->servicioActual?->nombre ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3 truncate">
                                    {{ $empleado->plaza?->nombre ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-center gap-2">
                                        <!-- Ver -->
                                        <a href="{{ route('usuarios.show', $empleado->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2 transition">
                                            <i class="fas fa-eye"></i>
                                            <span>Ver</span>
                                        </a>

                                        <!-- Editar -->
                                        <a href="{{ route('usuarios.edit', $empleado->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2 transition">
                                            <i class="fas fa-pencil-alt"></i>
                                            <span>Editar</span>
                                        </a>

                                        <!-- Eliminar -->
                                        <form action="{{ route('usuarios.destroy', $empleado->id) }}" method="POST"
                                            onsubmit="return confirmarEliminacion('{{ $empleado->nombre }}');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2">
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Eliminar</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-4">
                {{ $empleados->links() }}
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

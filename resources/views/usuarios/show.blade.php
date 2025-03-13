<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-3xl font-bold text-red-700 dark:text-white mb-4">
                <i class="fas fa-id-card"></i> Detalle del Empleado
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nombre -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Nombre:</p>
                    <p class="text-lg text-gray-900 dark:text-white">{{ $empleado->nombre }}</p>
                </div>

                <!-- Primer Apellido -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Primer Apellido:</p>
                    <p class="text-lg text-gray-900 dark:text-white">{{ $empleado->primer_apellido }}</p>
                </div>

                <!-- Segundo Apellido -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Segundo Apellido:</p>
                    <p class="text-lg text-gray-900 dark:text-white">{{ $empleado->segundo_apellido }}</p>
                </div>

                <!-- Número de Empleado -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Número de Empleado:</p>
                    <p class="text-lg text-gray-900 dark:text-white">{{ $empleado->numero_empleado }}</p>
                </div>

                <!-- RFC -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">RFC:</p>
                    <p class="text-lg text-gray-900 dark:text-white">{{ $empleado->rfc }}</p>
                </div>

                <!-- Servicio Actual -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Servicio Actual:</p>
                    <p class="text-lg text-gray-900 dark:text-white">
                        {{ $empleado->servicioActual?->nombre ?? 'N/A' }}
                    </p>
                </div>

                <!-- Plaza -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Plaza:</p>
                    <p class="text-lg text-gray-900 dark:text-white">
                        {{ $empleado->plaza?->nombre ?? 'N/A' }}
                    </p>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex justify-end space-x-2">
                <a href="{{ route('usuarios.index') }}"
                    class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition">
                    Volver
                </a>
                <a href="{{ route('usuarios.edit', $empleado->id) }}"
                    class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                    Editar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

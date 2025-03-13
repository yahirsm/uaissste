<x-app-layout>
    @section('content')
        @include('layouts.partials.admin.navigation')
        @include('layouts.partials.admin.sidebar')

        <div class="sm:ml-64 p-4 pt-20">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-3xl font-bold text-red-700 dark:text-white mb-4">
                    <i class="fas fa-user-edit"></i> Editar Empleado
                </h2>

                @if ($errors->any())
                    <div class="bg-red-600 text-white p-3 mb-4 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('usuarios.update', $empleado->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Nombre
                        </label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $empleado->nombre) }}"
                            required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <!-- Primer Apellido -->
                    <div>
                        <label for="primer_apellido" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Primer Apellido
                        </label>
                        <input type="text" id="primer_apellido" name="primer_apellido"
                            value="{{ old('primer_apellido', $empleado->primer_apellido) }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <!-- Segundo Apellido -->
                    <div>
                        <label for="segundo_apellido" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Segundo Apellido
                        </label>
                        <input type="text" id="segundo_apellido" name="segundo_apellido"
                            value="{{ old('segundo_apellido', $empleado->segundo_apellido) }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <!-- Número de Empleado -->
                    <div>
                        <label for="numero_empleado" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Número de Empleado
                        </label>
                        <input type="number" id="numero_empleado" name="numero_empleado"
                            value="{{ old('numero_empleado', $empleado->numero_empleado) }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <!-- RFC -->
                    <div>
                        <label for="rfc" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            RFC
                        </label>
                        <input type="text" id="rfc" name="rfc" value="{{ old('rfc', $empleado->rfc) }}" required
                            pattern="[A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3}"
                            title="Formato RFC inválido (Ejemplo: ABCD123456XYZ)"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <!-- Plaza -->
                    <div>
                        <label for="plaza" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Plaza
                        </label>
                        <select id="plaza" name="plaza" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach($plazas as $plaza)
                                <option value="{{ $plaza->nombre }}"
                                    {{ $empleado->plaza?->nombre === $plaza->nombre ? 'selected' : '' }}>
                                    {{ $plaza->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Servicio -->
                    <div>
                        <label for="servicio_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Servicio
                        </label>
                        <select id="servicio_id" name="servicio_id" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-600 focus:border-red-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="" disabled>Seleccione un servicio</option>
                            @foreach ($servicios as $servicio)
                                <option value="{{ $servicio->id }}"
                                    {{ old('servicio_id', $empleado->servicio_id) == $servicio->id ? 'selected' : '' }}>
                                    {{ $servicio->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end space-x-3 mt-6">
                        <a href="{{ route('usuarios.index') }}"
                            class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</x-app-layout>

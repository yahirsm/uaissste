{{-- resources/views/inventario/movimientos.blade.php --}}
<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold text-red-700 mb-4">
                <i class="fas fa-exchange-alt mr-2"></i> Movimientos de Inventario
            </h2>

            {{-- Mensajes de éxito / error --}}
            @if (session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulario: 2 filas × 6 columnas --}}
            <form action="{{ route('inventario.movimientos.store') }}" method="POST"
                class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-6">
                @csrf

                {{-- FILA 1: MATERIAL ocupa todo --}}
                <div class="col-span-full">
                    <label for="material_id" class="block font-medium mb-1">Material</label>
                    <select id="material_id" name="material_id" required
                        class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
                        <option value="" disabled selected>Selecciona o busca material</option>
                        @foreach ($materiales as $m)
                            <option value="{{ $m->id }}" data-stock="{{ $m->stock_actual }}">
                                {{ $m->clave }} — {{ $m->descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- FILA 2: Tipo --}}
                <div>
                    <label for="tipo" class="block font-medium mb-1">Tipo</label>
                    <select name="tipo" id="tipo" required
                        class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
                        <option value="entrada">Entrada</option>
                        <option value="salida">Salida</option>
                    </select>
                </div>

                {{-- Cantidad --}}
                <div>
                    <label for="cantidad" class="block font-medium mb-1">Cantidad</label>
                    <input type="number" step="0.01" name="cantidad" id="cantidad" required
                        class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600" />
                    <p id="cantidadError" class="mt-1 text-sm text-red-600 hidden">
                        La cantidad excede el stock actual.
                    </p>
                </div>

                {{-- Unidad --}}
                <div>
                    <label for="unidad" class="block font-medium mb-1">Unidad</label>
                    <input type="text" name="unidad" id="unidad" value="pieza" required
                        class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600" />
                </div>

                {{-- Fecha Mov --}}
                <div>
                    <label for="fecha_movimiento" class="block font-medium mb-1">Fecha</label>
                    <input type="date" name="fecha_movimiento" id="fecha_movimiento" required
                        class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600" />
                </div>

                {{-- Caducidad --}}
                <div>
                    <label for="fecha_caducidad" class="block font-medium mb-1">
                        Caducidad (opcional)
                    </label>
                    <input type="date" name="fecha_caducidad" id="fecha_caducidad"
                        class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600" />
                </div>

                {{-- Botón Registrar --}}
                <div class="flex items-end justify-end">
                    <button type="submit" id="submitBtn"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold px-4 py-2 rounded flex items-center gap-2 disabled:opacity-50">
                        <i class="fas fa-save"></i> Registrar
                    </button>
                </div>
            </form>
            {{-- Mensaje antes de la tabla --}}
            <p class="mb-4 text-gray-700 italic">
               Movimientos de entradas y salidas de insumos registrados de la Unidad de Abasto.
            </p>

            {{-- Tabla de movimientos --}}
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-red-700 text-white">
                            <th class="p-2">#</th>
                            <th class="p-2">Material</th>
                            <th class="p-2">Tipo</th>
                            <th class="p-2">Cantidad</th>
                            <th class="p-2">Unidad</th>
                            <th class="p-2">Fecha</th>
                            <th class="p-2">Caducidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movimientos as $mov)
                            <tr class="border-b align-top">
                                <td class="p-2">{{ $mov->id }}</td>
                                <td class="p-2 whitespace-normal break-words">
                                    {{ $mov->material->clave }} — {{ $mov->material->descripcion }}
                                </td>
                                <td class="p-2 capitalize">{{ $mov->tipo }}</td>
                                <td class="p-2">{{ $mov->cantidad }}</td>
                                <td class="p-2">{{ $mov->unidad }}</td>
                                <td class="p-2">{{ $mov->fecha_movimiento->format('d/m/Y') }}</td>
                                <td class="p-2">{{ optional($mov->fecha_caducidad)->format('d/m/Y') ?: 'Sin fecha de caducidad' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="mt-4">
                {{ $movimientos->links() }}
            </div>
        </div>
    </div>

    {{-- Choices.js CSS y JS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Choices.js para select con búsqueda
            const materialSelect = document.getElementById('material_id');
            new Choices(materialSelect, {
                searchEnabled: true,
                itemSelectText: '',
                shouldSort: false,
                placeholder: true,
                placeholderValue: 'Selecciona o busca material',
                searchPlaceholderValue: 'Escribe para buscar…',
                noResultsText: 'No se encontró ese material',
                noChoicesText: 'No hay materiales disponibles',
                position: 'bottom',
                searchResultLimit: 100,
            });

            // Elementos de validación
            const tipoInput = document.getElementById('tipo');
            const cantidadInput = document.getElementById('cantidad');
            const errorP = document.getElementById('cantidadError');
            const submitBtn = document.getElementById('submitBtn');

            function validarCantidad() {
                // stock obtenido del option seleccionado
                const opt = materialSelect.selectedOptions[0];
                const stock = parseFloat(opt?.dataset.stock || 0);
                const qty = parseFloat(cantidadInput.value) || 0;

                // para salidas, qty > stock deshabilita el botón
                if (tipoInput.value === 'salida' && qty > stock) {
                    errorP.textContent = `La cantidad excede el stock actual (${stock}).`;
                    errorP.classList.remove('hidden');
                    submitBtn.disabled = true;
                } else {
                    errorP.classList.add('hidden');
                    submitBtn.disabled = false;
                }
            }

            // dispara al cambiar material, tipo o al salir del campo cantidad
            materialSelect.addEventListener('change', validarCantidad);
            tipoInput.addEventListener('change', validarCantidad);
            cantidadInput.addEventListener('blur', validarCantidad);
        });
    </script>
</x-app-layout>

<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-6 pt-20">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-3xl font-bold text-red-700 mb-4">
                <i class="fas fa-boxes mr-2"></i> Inventario
            </h1>

            <!-- Tabs -->
            <ul class="flex border-b mb-6" role="tablist">
                <li class="mr-1">
                    <button id="tab-materiales-btn"
                            class="bg-white inline-block py-2 px-4 font-semibold rounded-t-lg focus:outline-none"
                            data-target="#tab-materiales">Materiales</button>
                </li>
                <li class="mr-1">
                    <button id="tab-movimientos-btn"
                            class="text-gray-600 hover:text-gray-800 inline-block py-2 px-4 font-semibold"
                            data-target="#tab-movimientos">Movimientos</button>
                </li>
            </ul>

            <!-- Contenido Materiales -->
            <div id="tab-materiales">
                <div class="flex flex-wrap items-center justify-between mb-4">
                    <form method="GET" action="{{ route('inventario.index') }}" class="flex space-x-2">
                        <input type="search" name="search" placeholder="Buscar clave o descripción"
                            class="border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-red-300">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                            <i class="fas fa-search mr-1"></i> Buscar
                        </button>
                    </form>
                    <a href="{{ route('inventario.create') }}"
                       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        <i class="fas fa-plus mr-1"></i> Agregar Material
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="sticky top-0 bg-red-700 text-white">
                            <tr>
                                <th class="p-3 text-left">Clave</th>
                                <th class="p-3 text-left">Descripción</th>
                                <th class="p-3 text-center">Stock</th>
                                <th class="p-3 text-left">Tipo</th>
                                <th class="p-3 text-left">Partida</th>
                                <th class="p-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materiales as $m)
                                <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                                    <td class="p-2 text-sm text-gray-700">{{ $m->clave }}</td>
                                    <td class="p-2 text-sm text-gray-700 truncate max-w-xs" title="{{ $m->descripcion }}">{{ $m->descripcion }}</td>
                                    <td class="p-2 text-center">
                                        <span class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                            {{ number_format($m->stock_actual, 2) }}
                                        </span>
                                    </td>
                                    <td class="p-2 text-sm text-gray-700">{{ $m->tipoInsumo->nombre }}</td>
                                    <td class="p-2 text-sm text-gray-700">{{ $m->partida->nombre }}</td>
                                    <td class="p-2 text-center space-x-1">
                                        <a href="{{ route('inventario.edit', $m) }}"
                                           class="inline-block px-3 py-1 text-sm font-medium bg-yellow-500 hover:bg-yellow-600 text-white rounded">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('inventario.destroy', $m) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="inline-block px-3 py-1 text-sm font-medium bg-red-600 hover:bg-red-700 text-white rounded">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $materiales->links() }}
                </div>
            </div>

            <!-- Contenido Movimientos -->
            <div id="tab-movimientos" class="hidden">
                <div class="flex flex-wrap items-center justify-between mb-4">
                    <form method="GET" action="{{ route('inventario.movimientos.index') }}" class="flex space-x-2">
                        <input type="date" name="from" class="border border-gray-300 rounded px-4 py-2">
                        <input type="date" name="to" class="border border-gray-300 rounded px-4 py-2">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                            <i class="fas fa-filter mr-1"></i> Filtrar
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="sticky top-0 bg-red-700 text-white">
                            <tr>
                                <th class="p-3">Fecha</th>
                                <th class="p-3">Material</th>
                                <th class="p-3">Tipo</th>
                                <th class="p-3">Cantidad</th>
                                <th class="p-3">Unidad</th>
                                <th class="p-3">Caducidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($movimientos as $mov)
                                <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                                    <td class="p-2 text-sm">
                                        <span class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            {{ $mov->fecha_movimiento->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="p-2 text-sm text-gray-700">{{ $mov->material->clave }}</td>
                                    <td class="p-2 text-sm text-center">
                                        @if($mov->tipo === 'entrada')
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Entrada</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Salida</span>
                                        @endif
                                    </td>
                                    <td class="p-2 text-sm text-gray-700">{{ number_format($mov->cantidad, 2) }}</td>
                                    <td class="p-2 text-sm text-gray-700">{{ $mov->unidad }}</td>
                                    <td class="p-2 text-sm text-gray-700">
                                        {{ optional($mov->fecha_caducidad)->format('d/m/Y') ?? '–' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $movimientos->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching sencillo
        document.querySelectorAll('[data-target]').forEach(btn => {
            btn.addEventListener('click', () => {
                const target = document.querySelector(btn.dataset.target);
                document.querySelectorAll('#tab-materiales, #tab-movimientos')
                    .forEach(tab => tab.classList.add('hidden'));
                target.classList.remove('hidden');

                document.querySelectorAll('[data-target]').forEach(b => b.classList.remove('border-b-2', 'border-red-600', 'text-red-600'));
                btn.classList.add('border-b-2', 'border-red-600', 'text-red-600');
            });
        });
        // Inicializar Tab Materiales
        document.getElementById('tab-materiales-btn').click();
    </script>
</x-app-layout>

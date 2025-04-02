<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-3xl font-bold text-red-700 dark:text-white mb-4">
                <i class="fas fa-file-pdf"></i> Generación de Reportes
            </h2>

            <p class="text-gray-700 dark:text-gray-300">Selecciona el reporte que deseas generar:</p>

            <ul class="mt-4 space-y-3">
                <li class="p-3 bg-gray-100 dark:bg-gray-900 rounded-lg shadow-md">
                    <a href="{{ route('reportes.inventario.pdf') }}" 
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition">
                        <i class="fas fa-download"></i> Descargar Reporte de Inventario (PDF)
                    </a>
                </li>
            </ul>
        </div>
    </div>
</x-app-layout>

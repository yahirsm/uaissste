{{-- resources/views/errors/404.blade.php --}}
<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-red-700 mb-4">Página no encontrada</h1>
            <p class="text-gray-600 mb-6">La página que estás buscando no existe o ha sido eliminada.</p>
            <a href="{{ route('dashboard') }}" 
               class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                Volver al inicio
            </a>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Usuarios</h2>
            <p class="text-gray-600 dark:text-gray-300">Aquí puedes gestionar los usuarios .</p>
        </div>
    </div>

    @stack('modals')
</x-app-layout>
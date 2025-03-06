<?php
    $links = [
        [
            'name' => 'Dashboard', // Nombre del enlace
            'icon' => 'fa-solid fa-gauge-high', // Ícono de FontAwesome
            'route' => 'dashboard', // Ruta asociada
            'active' => request()->routeIs('dashboard'), // Verifica si la ruta actual coincide
        ],
        [
            'header' => 'Separación', // Elemento de separación (no tiene 'route')
        ],
        [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-users',
            'route' => route('usuarios.usuarios'),
            'active' => request()->routeIs('usuarios.usuarios') || request()->routeIs('usuarios'), // Añadido 'usuarios.*' para enlaces relacionados
         ],
        [
            'name' => 'Inventario',
            'icon' => 'fa-solid fa-boxes',
            'route' => route('inventario.index'), // Aquí está la corrección
            'active' => request()->routeIs('inventario.index'),
        ],
        [
            'name' => 'Reportes', // Nuevo elemento
            'icon' => 'fa-solid fa-chart-line', // Ícono de FontAwesome
            'route' => '#', // Sin ruta específica
            'active' => false,
        ],
        [
            'name' => 'Distribución', // Nuevo elemento con submenú
            'icon' => 'fa-solid fa-truck', // Ícono de FontAwesome
            'route' => '#', // Sin ruta específica
            'active' => false,
            'submenu' => [ // Submenú
                [
                    'name' => 'Vales', // Subelemento
                    'route' => '#', // Sin ruta específica
                    'active' => false,
                ],
                [
                    'name' => 'Pedidos', // Subelemento
                    'route' => '#', // Sin ruta específica
                    'active' => false,
                ],
            ],
        ],
    ];
?>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($item['header'])): ?> <!-- Verifica si es un elemento de separación -->
                    <li>
                        <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">
                            <?php echo e($item['header']); ?> <!-- Muestra el texto de separación -->
                        </div>
                    </li>
                <?php elseif(isset($item['submenu'])): ?> <!-- Verifica si es un elemento con submenú -->
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="w-5 h-5 inline-flex justify-center items-center">
                                <i class="<?php echo e($item['icon']); ?> text-gray-800"></i>
                            </span>
                            <span class="ms-3"><?php echo e($item['name']); ?></span>
                            <svg class="w-3 h-3 ms-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <ul class="py-2 space-y-2">
                            <?php $__currentLoopData = $item['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e($subitem['route']); ?>"
                                        class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                        <span class="ms-3"><?php echo e($subitem['name']); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php else: ?> <!-- Si es un enlace normal -->
                    <li>
                        <a href="<?php echo e($item['route']); ?>"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group <?php echo e($item['active'] ? 'bg-gray-100 dark:bg-gray-700' : ''); ?>">
                            <span class="w-5 h-5 inline-flex justify-center items-center">
                                <i class="<?php echo e($item['icon']); ?> text-gray-800"></i>
                            </span>
                            <span class="ms-3"><?php echo e($item['name']); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>
    </div>
</aside><?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/layouts/partials/admin/sidebar.blade.php ENDPATH**/ ?>
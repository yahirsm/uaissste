<?php
    $links = [
        [
            'name' => 'Inicio',
            'icon' => 'fa-solid fa-house-flag',
            'route' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
        ],
        [
            'header' => 'Menú',
        ],
        [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-users',
            'route' => route('usuarios.index'),
            'active' =>
                request()->routeIs('usuarios.index') ||
                request()->routeIs('servicios.index') ||
                request()->routeIs('plazas.index'),
            'submenu' => [
                [
                    'name' => 'Usuarios',
                    'icon' => 'fa-solid fa-user',
                    'route' => route('usuarios.index'),
                    'active' => request()->routeIs('usuarios.index'),
                ],
                [
                    'name' => 'Servicios',
                    'icon' => 'fa-solid fa-stethoscope',
                    'route' => route('servicios.index'),
                    'active' => request()->routeIs('servicios.index'),
                ],
                [
                    'name' => 'Plazas',
                    'icon' => 'fa-solid fa-briefcase',
                    'route' => route('plazas.index'),
                    'active' => request()->routeIs('plazas.index'),
                ],
            ],
        ],
        [
            'name' => 'Inventario',
            'icon' => 'fa-solid fa-boxes-stacked',
            'route' => route('inventario.index'),
            'active' => request()->routeIs('inventario.index'),
            'submenu' => [
                [
                    'name' => 'Inventario',
                    'icon' => 'fa-solid fa-warehouse',
                    'route' => route('inventario.index'),
                    'active' => request()->routeIs('inventario.index'),
                ],
                [
                    'name' => 'Partidas',
                    'icon' => 'fa-solid fa-list-ol',
                    'route' => route('inventario.partida'),
                    'active' => request()->routeIs('inventario.partida'),
                ],
            ],
        ],
        [
            'name' => 'Reportes',
            'icon' => 'fa-solid fa-chart-line',
            'route' => route('reportes.index'),
            'active' => request()->routeIs('reportes.index'),
        ],
        [
            'name' => 'Distribución',
            'icon' => 'fa-solid fa-truck',
            'route' => '#',
            'active' => request()->routeIs('solicitud') || request()->routeIs('pedidos'),
            'submenu' => [
                [
                    'name' => 'Solicitud',
                    'icon' => 'fa-solid fa-file-signature',
                    'route' => '#',
                    'active' => false,
                ],
                [
                    'name' => 'Pedidos',
                    'icon' => 'fa-solid fa-truck-fast',
                    'route' => '#',
                    'active' => false,
                ],
            ],
        ],
    ];
?>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-48 h-screen pt-20 transition-all duration-300 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($item['header'])): ?>
                    <li>
                        <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">
                            <?php echo e($item['header']); ?>

                        </div>
                    </li>
                <?php elseif(isset($item['submenu'])): ?>
                    <li>
                        <button type="button"
                            class="flex items-center justify-between w-full p-2 rounded-lg transition duration-300 
                            <?php echo e($item['active'] ? 'bg-[#7A0019] text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'); ?>"
                            onclick="toggleSubmenu(this)">
                            <div class="flex items-center">
                                <span class="w-5 h-5 flex justify-center items-center">
                                    <i class="<?php echo e($item['icon']); ?> <?php echo e($item['active'] ? 'text-white' : 'text-gray-800'); ?>"></i>
                                </span>
                                <span class="ms-3"><?php echo e($item['name']); ?></span>
                            </div>
                            <svg class="w-3 h-3 transition-transform duration-200 <?php echo e($item['active'] ? 'rotate-180' : ''); ?>" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul class="py-2 space-y-2 <?php echo e($item['active'] ? '' : 'hidden'); ?>">
                            <?php $__currentLoopData = $item['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e($subitem['route']); ?>"
                                        class="flex items-center p-2 pl-11 rounded-lg transition duration-300 
                                        <?php echo e($subitem['active'] ? 'bg-[#7A0019] text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'); ?>">
                                        <i class="<?php echo e($subitem['icon']); ?> w-4 h-4 mr-2"></i>
                                        <?php echo e($subitem['name']); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo e($item['route']); ?>"
                            class="flex items-center p-2 rounded-lg transition duration-300 
                            <?php echo e($item['active'] ? 'bg-[#7A0019] text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'); ?>">
                            <span class="w-5 h-5 flex justify-center items-center">
                                <i class="<?php echo e($item['icon']); ?> <?php echo e($item['active'] ? 'text-white' : 'text-gray-800'); ?>"></i>
                            </span>
                            <span class="ms-3"><?php echo e($item['name']); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>
    </div>
</aside>

<script>
    function toggleSubmenu(button) {
        let submenu = button.nextElementSibling;
        let icon = button.querySelector('svg');

        submenu.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/layouts/partials/admin/sidebar.blade.php ENDPATH**/ ?>
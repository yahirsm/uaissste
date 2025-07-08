<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>

                <a href="" class="flex items-center gap-3">
                    <img src="<?php echo e(asset('images/logo.svg')); ?>" class="h-10 md:h-12" alt="Logo ISSSTE" />
                    <div class="flex flex-col">
                        <span class="text-lg font-semibold sm:text-xl whitespace-nowrap dark:text-white">
                            UNIDAD DE ABASTO
                        </span>
                        <span class="text-sm font-medium sm:text-base text-gray-600 dark:text-gray-300">
                            HOSPITAL PRESIDENTE BENITO JUÁREZ DEL ISSSTE
                        </span>
                    </div>
                </a>
            </div>
            <!-- Perfil de Usuario -->
            <div class="flex items-center">
                <div class="relative ms-3">
                    <?php if(auth()->guard()->check()): ?>
                        <!-- Botón con imagen y nombre para abrir el menú -->
                        <button type="button"
                            class="flex items-center gap-2 px-3 py-2 text-sm focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Abrir menú de usuario</span>
                            <img class="w-10 h-10 rounded-full" src="<?php echo e(auth()->user()->profile_photo_url); ?>"
                                alt="user photo">
                            <span class="text-gray-800 dark:text-white font-semibold">
                                <?php echo e(auth()->user()->name); ?>

                            </span>
                        </button>

                        <!-- Menú desplegable del usuario -->
                        <div class="absolute right-0 z-50 hidden mt-2 w-64 bg-white divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-4 text-center">
                                <img class="w-16 h-16 rounded-full mx-auto" src="<?php echo e(auth()->user()->profile_photo_url); ?>"
                                    alt="user photo">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white mt-2">
                                    <?php echo e(auth()->user()->name); ?>

                                </p>
                                <p class="text-xs font-medium text-gray-600 dark:text-gray-400">
                                  Rol :  <?php echo e(auth()->user()->getRoleNames()->first() ?? 'Sin rol asignado'); ?>


                                </p>
                            </div>
                            <div class="flex justify-around px-4 py-3">
                                <a href="<?php echo e(route('profile.show')); ?>"
                                    class="flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                    <i class="fas fa-user mr-2"></i>
                                    <span>Perfil</span>
                                </a>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                        class="flex items-center px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-md hover:bg-red-700">
                                        <i class="fas fa-power-off mr-2"></i>
                                        <span>Cerrar sesión</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>"
                            class="text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Iniciar sesión
                        </a>
                    <?php endif; ?>
                </div>
            </div>



</nav>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/layouts/partials/admin/navigation.blade.php ENDPATH**/ ?>
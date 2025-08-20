<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php echo $__env->make('layouts.partials.admin.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('layouts.partials.admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-3xl font-bold text-red-700 dark:text-red-400">
                    <i class="fas fa-users mr-2"></i> Lista de Usuarios
                </h2>
                <!-- Botón para agregar un nuevo usuario -->
                <a href="<?php echo e(route('usuarios.create')); ?>"
                    class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2 transition">
                    <i class="fas fa-user-plus"></i>
                    <span>Agregar Usuario</span>
                </a>
            </div>
            <!-- Buscador por número de empleado -->
            <form method="GET" action="<?php echo e(route('usuarios.index')); ?>" class="mb-4">
                <div class="flex items-center gap-2">
                    <input type="text" name="buscar" placeholder="Buscar por número de empleado"
                        value="<?php echo e(request('buscar')); ?>" maxlength="6" pattern="\d{6}"
                        title="Ingresa un número de empleado de 6 dígitos"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-700 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                        required>
                    <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-search mr-1"></i> Buscar
                    </button>
                </div>
            </form>


            <?php if(session('success')): ?>
                <div class="bg-green-500 text-white p-2 mb-4 rounded shadow-md dark:bg-green-700">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="bg-red-500 text-white p-2 mb-4 rounded shadow-md dark:bg-red-700">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <?php if($empleados->isEmpty()): ?>
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-4">
                    No se encontraron empleados con ese número.
                </div>
            <?php endif; ?>


            <!-- Tabla de empleados -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                    <thead class="bg-red-700 text-white text-sm uppercase tracking-wider dark:bg-red-800">
                        <tr>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Primer Apellido</th>
                            <th class="px-4 py-3">Segundo Apellido</th>
                            <th class="px-4 py-3">Número de Empleado</th>
                            <th class="px-4 py-3">RFC</th>
                            <th class="px-4 py-3">Servicio Actual</th>
                            <th class="px-4 py-3">Plaza</th>
                            <th class="px-4 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr
                                class="hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-300 dark:border-gray-700">
                                <td class="px-4 py-3 truncate"><?php echo e($empleado->nombre); ?></td>
                                <td class="px-4 py-3 truncate"><?php echo e($empleado->primer_apellido); ?></td>
                                <td class="px-4 py-3 truncate"><?php echo e($empleado->segundo_apellido); ?></td>
                                <td class="px-4 py-3 truncate"><?php echo e($empleado->numero_empleado); ?></td>
                                <td class="px-4 py-3 truncate"><?php echo e($empleado->rfc); ?></td>
                                <td class="px-4 py-3 truncate">
                                    <?php echo e($empleado->servicioActual?->nombre ?? 'N/A'); ?>

                                </td>
                                <td class="px-4 py-3 truncate">
                                    <?php echo e($empleado->plaza?->nombre ?? 'N/A'); ?>

                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-center gap-2">
                                        <!-- Ver -->
                                        <a href="<?php echo e(route('usuarios.show', $empleado->id)); ?>"
                                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2 transition">
                                            <i class="fas fa-eye"></i>
                                            <span>Ver</span>
                                        </a>

                                        <!-- Editar -->
                                        <a href="<?php echo e(route('usuarios.edit', $empleado->id)); ?>"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2 transition">
                                            <i class="fas fa-pencil-alt"></i>
                                            <span>Editar</span>
                                        </a>

                                        <!-- Eliminar -->
                                        <form action="<?php echo e(route('usuarios.destroy', $empleado->id)); ?>" method="POST"
                                            onsubmit="return confirmarEliminacion('<?php echo e($empleado->nombre); ?>');"
                                            class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                class="bg-red-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2">
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Eliminar</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-4">
                <?php echo e($empleados->appends(request()->query())->links()); ?>

            </div>
        </div>
    </div>


    <script>
        const input = document.querySelector('input[name="buscar"]');
        input.addEventListener('input', function() {
            if (this.value.trim() === '') {
                window.location.href = "<?php echo e(route('usuarios.index')); ?>";
            }
        });

        function confirmarEliminacion(nombre) {
            return new Promise((resolve) => {
                Swal.fire({
                    title: '¿Eliminar usuario?',
                    text: `¿Estás seguro de que deseas eliminar a ${nombre}? Esta acción no se puede deshacer.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    resolve(result.isConfirmed);
                });
            });
        }

        // Interceptar formularios con onsubmit para usar SweetAlert2
        document.addEventListener('DOMContentLoaded', () => {
            const forms = document.querySelectorAll('form[onsubmit^="return confirmarEliminacion"]');

            forms.forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const nombre = this.getAttribute('onsubmit').match(/'([^']+)'/)[1];
                    const confirmado = await confirmarEliminacion(nombre);

                    if (confirmado) this.submit();
                });
            });
        });
    </script>


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/usuarios/usuarios.blade.php ENDPATH**/ ?>
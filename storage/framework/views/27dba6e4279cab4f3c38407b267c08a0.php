
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
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold text-red-700 mb-4">
                <i class="fas fa-truck mr-2"></i> Pedidos Realizados
            </h2>

            
            <?php if(session('success')): ?>
                <div class="flex items-center bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 20 20"><path d="M10 15a1.5 1.5 0 11-.001-2.999A1.5 1.5 0 0110 15zm1-9h-2v6h2V6z"/></svg>
                    <p class="text-sm"><?php echo e(session('success')); ?></p>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="flex items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 20 20"><path d="M10 15a1.5 1.5 0 11-.001-2.999A1.5 1.5 0 0110 15zm1-9h-2v6h2V6z"/></svg>
                    <p class="text-sm"><?php echo e(session('error')); ?></p>
                </div>
            <?php endif; ?>

            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Fecha</th>
                            <th class="px-4 py-2">Solicita</th>
                            <th class="px-4 py-2">Área</th>
                            <th class="px-4 py-2">Estado</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2"><?php echo e($p->id); ?></td>
                                <td class="border px-4 py-2"><?php echo e($p->created_at->format('d/m/Y H:i')); ?></td>
                                <td class="border px-4 py-2"><?php echo e($p->user->name); ?></td>
                                <td class="border px-4 py-2"><?php echo e($p->servicio->nombre); ?></td>
                                <td class="border px-4 py-2">
                                    <?php if($p->atendido): ?>
                                        <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">
                                            Atendido
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-block px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded">
                                            Pendiente
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="border px-4 py-2 space-x-2">
                                    
                                    <a href="<?php echo e(route('distribucion.pedidos.show', $p)); ?>"
                                       class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                        <i class="fas fa-eye mr-1"></i> Ver
                                    </a>

                                    
                                    <?php if (! ($p->atendido)): ?>
                                        <form action="<?php echo e(route('distribucion.pedidos.autorizar', $p)); ?>"
                                              method="POST"
                                              class="inline-block js-autorizar-form">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit"
                                                    class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded js-autorizar-btn">
                                                <i class="fas fa-check mr-1"></i> Autorizar
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    
                                    <a href="<?php echo e(route('distribucion.pedidos.pdf', $p)); ?>"
                                       class="inline-flex items-center bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
                                        <i class="fas fa-download mr-1"></i> PDF
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            
            <div class="mt-4">
                <?php echo e($pedidos->links('pagination::tailwind')); ?>

            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.js-autorizar-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: '¿Autorizar pedido?',
                    text: 'Se generará el movimiento de salida y se descontará del stock.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, autorizar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true,
                    focusCancel: true,
                    customClass: {
                        confirmButton: 'bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded',
                        cancelButton: 'bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded'
                    },
                    buttonsStyling: false
                }).then(result => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/distribucion/pedidos/index.blade.php ENDPATH**/ ?>
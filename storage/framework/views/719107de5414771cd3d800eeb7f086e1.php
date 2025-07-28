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
            
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-red-700">
                    <i class="fas fa-eye mr-2"></i> Detalle del Pedido #<?php echo e($solicitud->id); ?>

                </h2>
                <a href="<?php echo e(route('distribucion.pedidos.index')); ?>"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <p><strong>Fecha creación:</strong> <?php echo e($solicitud->created_at->format('d/m/Y H:i')); ?></p>
                </div>
                <div>
                    <p><strong>Solicita:</strong> <?php echo e($solicitud->user->name); ?></p>
                </div>
                <div>
                    <p><strong>Área:</strong> <?php echo e($solicitud->servicio->nombre); ?></p>
                </div>
                <div class="md:col-span-3">
                    <p><strong>Estado:</strong>
                        <?php if($solicitud->atendido): ?>
                            <span
                                class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">
                                Atendido
                            </span>
                        <?php else: ?>
                            <span
                                class="inline-block px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded">
                                Pendiente
                            </span>
                        <?php endif; ?>
                    </p>

                    
                    <?php if($solicitud->atendido): ?>
                        <p class="mt-1 text-gray-600">
                            <strong>Atendido el:</strong>
                            <?php echo e($solicitud->updated_at->format('d/m/Y H:i')); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-red-700 text-white">
                            <th class="p-2">Clave</th>
                            <th class="p-2">Descripción</th>
                            <th class="p-2 text-center">Cantidad</th>
                            <th class="p-2">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $solicitud->materiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-2"><?php echo e($m->clave); ?></td>
                                <td class="p-2"><?php echo e($m->descripcion); ?></td>
                                <td class="p-2 text-center"><?php echo e($m->pivot->cantidad); ?></td>
                                <td class="p-2 whitespace-normal break-words">
                                    <?php echo e($m->pivot->observaciones ?: 'Sin observaciones'); ?>

                                </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            
            <div class="mt-6 flex items-center space-x-4">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('solicitudes.aprobar')): ?>
                    <?php if (! ($solicitud->atendido)): ?>
                        <form action="<?php echo e(route('distribucion.pedidos.autorizar', $solicitud)); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded flex items-center gap-2 js-autorizar-btn">
                                <i class="fas fa-check"></i> Autorizar Pedido
                            </button>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>

                <a href="<?php echo e(route('distribucion.pedidos.pdf', $solicitud)); ?>"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded flex items-center gap-2">
                    <i class="fas fa-download"></i> Descargar PDF
                </a>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('.js-autorizar-btn').forEach(btn => {
                    btn.addEventListener('click', e => {
                        e.preventDefault();
                        const form = btn.closest('form');
                        Swal.fire({
                            title: '¿Autorizar este pedido?',
                            text: 'Se generarán los movimientos de salida y se descontará del stock.',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Sí, autorizar',
                            cancelButtonText: 'Cancelar',
                            reverseButtons: true,
                            customClass: {
                                confirmButton: 'bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded',
                                cancelButton: 'bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded'
                            },
                            buttonsStyling: false
                        }).then(result => {
                            if (result.isConfirmed) form.submit();
                        });
                    });
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/distribucion/pedidos/show.blade.php ENDPATH**/ ?>
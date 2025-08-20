
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
            <h2 class="text-2xl font-bold text-red-700 mb-2">
                <i class="fas fa-clipboard-list mr-2"></i> Nueva Solicitud
            </h2>
            <p class="mb-4 text-gray-600 italic">
                Aquí sólo podrás ver los materiales con los que se cuenta con existencia.
            </p>

            <?php if(session('error')): ?>
                <div class="bg-red-500 text-white p-2 rounded mb-4">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <form id="solicitudForm" action="<?php echo e(route('distribucion.solicitud.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <table class="w-full table-auto mb-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Clave</th>
                            <th class="px-4 py-2">Descripción</th>
                            <th class="px-4 py-2">Stock</th>
                            <th class="px-4 py-2">Cantidad</th>
                            <th class="px-4 py-2">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $materiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="border px-4 py-2"><?php echo e($m->clave); ?></td>
                                <td class="border px-4 py-2"><?php echo e($m->descripcion); ?></td>
                                <td class="border px-4 py-2 text-center"><?php echo e($m->stock_actual); ?></td>
                                <td class="border px-4 py-2 text-center">
                                    <input type="number" name="items[<?php echo e($m->id); ?>][cantidad]" min="0"
                                        max="<?php echo e($m->stock_actual); ?>" value="<?php echo e(old("items.{$m->id}.cantidad", 0)); ?>"
                                        class="w-20 p-1 border rounded text-center cantidad-input">
                                    <input type="hidden" name="items[<?php echo e($m->id); ?>][material_id]"
                                        value="<?php echo e($m->id); ?>">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="text" name="items[<?php echo e($m->id); ?>][observaciones]"
                                        value="<?php echo e(old("items.{$m->id}.observaciones")); ?>" placeholder="(opcional)"
                                        class="w-full p-1 border rounded">
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <button id="submitBtn" type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2">
                    <i class="fas fa-paper-plane mr-1"></i> Enviar Solicitud
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('#solicitudForm');
            const submitBtn = document.querySelector('#submitBtn');
            const qtyInputs = document.querySelectorAll('.cantidad-input');

            function clampValue(input) {
                const max = parseInt(input.max, 10);
                let val = parseInt(input.value, 10);

                if (isNaN(val)) val = 0;
                if (val < 0) val = 0; // nunca negativos
                if (val > max) {
                    val = max; // no pasar stock
                    Swal.fire({
                        icon: 'error',
                        toast: true,
                        position: 'top-end',
                        title: `No puede superar el stock (${max}).`,
                        timer: 1800,
                        showConfirmButton: false
                    });
                }
                input.value = String(val);
                return val;
            }

            function anyPositive() {
                return Array.from(qtyInputs).some(i => (parseInt(i.value, 10) || 0) > 0);
            }

            function validateAll() {
                // clamp por si alguien pegó texto
                qtyInputs.forEach(clampValue);
                submitBtn.disabled = !anyPositive();
            }

            qtyInputs.forEach(input => {
                // Bloquear la tecla '-' y 'e' (algunos navegadores permiten notación científica)
                input.addEventListener('keydown', (e) => {
                    if (e.key === '-' || e.key === 'e' || e.key === 'E' || e.key === '+') {
                        e.preventDefault();
                    }
                });

                // Evitar que la rueda del mouse cambie el valor accidentalmente
                input.addEventListener('wheel', (e) => e.target.blur(), {
                    passive: true
                });

                // Sanitizar en tiempo real
                input.addEventListener('input', () => {
                    clampValue(input);
                    validateAll();
                });

                // Por si el usuario pega un valor
                input.addEventListener('paste', (e) => {
                    setTimeout(() => {
                        clampValue(input);
                        validateAll();
                    }, 0);
                });

                // Al salir del campo, volver a validar todo
                input.addEventListener('blur', () => {
                    clampValue(input);
                    if (!anyPositive()) {
                        Swal.fire({
                            icon: 'warning',
                            toast: true,
                            position: 'top-end',
                            title: 'Debes solicitar al menos un material',
                            timer: 1800,
                            showConfirmButton: false
                        });
                    }
                    validateAll();
                });
            });

            // Validación final antes de enviar
            form.addEventListener('submit', (e) => {
                validateAll();
                if (!anyPositive()) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        toast: true,
                        position: 'top-end',
                        title: 'Debes solicitar al menos un material',
                        timer: 1800,
                        showConfirmButton: false
                    });
                    return false;
                }
            });

            validateAll();
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/distribucion/solicitud/index.blade.php ENDPATH**/ ?>
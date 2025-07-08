
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

        <form action="<?php echo e(route('distribucion.solicitud.store')); ?>" method="POST">
          <?php echo csrf_field(); ?>

          <table class="w-full table-auto mb-4">
            <thead>
              <tr class="bg-gray-100">
                <th class="px-4 py-2">Clave</th>
                <th class="px-4 py-2">Descripción</th>
                <th class="px-4 py-2">Stock</th>
                <th class="px-4 py-2">Cantidad</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $materiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td class="border px-4 py-2"><?php echo e($m->clave); ?></td>
                  <td class="border px-4 py-2"><?php echo e($m->descripcion); ?></td>
                  <td class="border px-4 py-2"><?php echo e($m->stock_actual); ?></td>
                  <td class="border px-4 py-2">
                    <input
                      type="number"
                      name="items[<?php echo e($m->id); ?>][cantidad]"
                      min="0"
                      max="<?php echo e($m->stock_actual); ?>"
                      value="<?php echo e(old("items.{$m->id}.cantidad", 0)); ?>"
                      class="w-20 p-1 border rounded"
                    >
                    <input type="hidden" name="items[<?php echo e($m->id); ?>][material_id]" value="<?php echo e($m->id); ?>">
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>

          <button
            type="submit"
            class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded"
          >
            <i class="fas fa-paper-plane mr-1"></i> Enviar Solicitud
          </button>
        </form>
      </div>
    </div>
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/distribucion/solicitud/index.blade.php ENDPATH**/ ?>
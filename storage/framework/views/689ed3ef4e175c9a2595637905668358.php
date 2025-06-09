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
          <i class="fas fa-exchange-alt mr-2"></i> Movimientos de Inventario
        </h2>

        <?php if(session('success')): ?>
          <div class="bg-green-500 text-white p-2 rounded mb-4">
            <?php echo e(session('success')); ?>

          </div>
        <?php endif; ?>
<?php if($errors->any()): ?>
  <div class="bg-red-500 text-white p-3 rounded mb-4">
    <ul class="list-disc list-inside">
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($err); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
<?php endif; ?>

        <!-- Formulario para nueva entrada/salida -->
        <form action="<?php echo e(route('inventario.movimientos.store')); ?>" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-6">
          <?php echo csrf_field(); ?>

          <div class="col-span-2">
            <label for="material_id" class="block font-medium">Material</label>
            <select name="material_id" id="material_id" required
              class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
              <option value="" disabled selected>Selecciona material</option>
              <?php $__currentLoopData = $materiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($m->id); ?>">
                  <?php echo e($m->clave); ?> — <?php echo e(Str::limit($m->descripcion, 40)); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <div>
            <label for="tipo" class="block font-medium">Tipo</label>
            <select name="tipo" id="tipo" required
              class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
              <option value="entrada">Entrada</option>
              <option value="salida">Salida</option>
            </select>
          </div>

          <div>
            <label for="cantidad" class="block font-medium">Cantidad</label>
            <input type="number" step="0.01" name="cantidad" id="cantidad" required
              class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
          </div>

          <div>
            <label for="unidad" class="block font-medium">Unidad</label>
            <input type="text" name="unidad" id="unidad" value="pieza" required
              class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
          </div>

          <div>
            <label for="fecha_movimiento" class="block font-medium">Fecha</label>
            <input type="date" name="fecha_movimiento" id="fecha_movimiento" required
              class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
          </div>

          <div>
            <label for="fecha_caducidad" class="block font-medium">Caducidad (opcional)</label>
            <input type="date" name="fecha_caducidad" id="fecha_caducidad"
              class="w-full p-2 border rounded bg-blue-50 focus:ring-2 focus:ring-red-600">
          </div>

          <div class="col-span-full flex justify-end">
            <button type="submit"
              class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded flex items-center gap-2">
              <i class="fas fa-save"></i> Registrar
            </button>
          </div>
        </form>

        <!-- Tabla de movimientos -->
        <div class="overflow-x-auto">
          <table class="w-full table-auto border-collapse">
            <thead>
              <tr class="bg-red-700 text-white">
                <th class="p-2">#</th>
                <th class="p-2">Material</th>
                <th class="p-2">Tipo</th>
                <th class="p-2">Cantidad</th>
                <th class="p-2">Unidad</th>
                <th class="p-2">Fecha</th>
                <th class="p-2">Caducidad</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $movimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b">
                  <td class="p-2"><?php echo e($mov->id); ?></td>
                  <td class="p-2"><?php echo e($mov->material->clave); ?> – <?php echo e(Str::limit($mov->material->descripcion, 30)); ?></td>
                  <td class="p-2 capitalize"><?php echo e($mov->tipo); ?></td>
                  <td class="p-2"><?php echo e($mov->cantidad); ?></td>
                  <td class="p-2"><?php echo e($mov->unidad); ?></td>
                  <td class="p-2"><?php echo e($mov->fecha_movimiento->format('d/m/Y')); ?></td>
                  <td class="p-2"><?php echo e(optional($mov->fecha_caducidad)->format('d/m/Y') ?: '–'); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>

        <div class="mt-4">
          <?php echo e($movimientos->links()); ?>

        </div>
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/inventario/movimientos/index.blade.php ENDPATH**/ ?>
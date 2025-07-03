
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

  <div class="sm:ml-64 p-6 pt-20">
    <div class="bg-white rounded-lg shadow p-6">
      <h1 class="text-2xl font-bold text-yellow-600 mb-4">
        <i class="fas fa-edit mr-2"></i> Editar Material
      </h1>

     <form action="<?php echo e(route('inventario.update', $material)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

        <div class="mb-4">
          <label class="block font-medium mb-1">Clave</label>
          <input name="clave"
                 value="<?php echo e(old('clave',$material->clave)); ?>"
                 class="w-full border px-3 py-2 rounded" />
          <?php $__errorArgs = ['clave'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-600 text-sm"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
          <label class="block font-medium mb-1">Descripción</label>
          <textarea name="descripcion"
                    class="w-full border px-3 py-2 rounded"><?php echo e(old('descripcion',$material->descripcion)); ?></textarea>
          <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-600 text-sm"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
          <div>
            <label class="block font-medium mb-1">Partida</label>
            <select name="partida_id" class="w-full border px-3 py-2 rounded">
              <?php $__currentLoopData = $partidas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>"
                  <?php if(old('partida_id',$material->partida_id)==$id): echo 'selected'; endif; ?>>
                  <?php echo e($nombre); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['partida_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="text-red-600 text-sm"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
          <div>
            <label class="block font-medium mb-1">Tipo de Insumo</label>
            <select name="tipo_insumo_id" class="w-full border px-3 py-2 rounded">
              <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoId => $tipoNombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($tipoId); ?>"
                  <?php if(old('tipo_insumo_id',$material->tipo_insumo_id)==$tipoId): echo 'selected'; endif; ?>>
                  <?php echo e($tipoNombre); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['tipo_insumo_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="text-red-600 text-sm"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>

        <div class="flex space-x-3">
          <a href="<?php echo e(route('inventario.index')); ?>"
             class="px-4 py-2 bg-gray-500 text-white rounded">Cancelar</a>
          <button type="submit"
                  class="px-4 py-2 bg-yellow-600 text-white rounded">Actualizar</button>
        </div>
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/inventario/edit.blade.php ENDPATH**/ ?>
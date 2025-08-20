
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

      <?php if($errors->any()): ?>
        <div class="bg-red-100 border border-red-300 text-red-700 p-4 mb-6 rounded">
          <strong class="block mb-1">Hay errores en el formulario:</strong>
          <ul class="list-disc list-inside">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($err); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="<?php echo e(route('inventario.update', $material)); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="mb-4">
          <label for="clave" class="block font-medium mb-1">Clave</label>
          <input id="clave" type="text"
                 value="<?php echo e(old('clave', $material->clave)); ?>"
                 readonly
                 aria-describedby="clave-note"
                 class="w-full border px-3 py-2 rounded bg-gray-100 cursor-not-allowed" />
          <p id="clave-note" class="text-sm text-gray-600 mt-1">
            La clave no se puede modificar aquí. Si necesitas cambiarla, crea un nuevo material o usa el módulo correspondiente.
          </p>
          
          
          <?php $__errorArgs = ['clave'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="mb-4">
          <label for="descripcion" class="block font-medium mb-1">Descripción</label>
          <textarea id="descripcion" name="descripcion"
                    class="w-full border px-3 py-2 rounded"
                    required><?php echo e(old('descripcion', $material->descripcion)); ?></textarea>
          <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div>
            <label for="partida_id" class="block font-medium mb-1">Partida</label>
            <select id="partida_id" name="partida_id" class="w-full border px-3 py-2 rounded" required>
              <?php $__currentLoopData = $partidas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>" <?php if(old('partida_id', $material->partida_id) == $id): echo 'selected'; endif; ?>>
                  <?php echo e($nombre); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['partida_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div>
            <label for="tipo_insumo_id" class="block font-medium mb-1">Tipo de Insumo</label>
            <select id="tipo_insumo_id" name="tipo_insumo_id" class="w-full border px-3 py-2 rounded" required>
              <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoId => $tipoNombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($tipoId); ?>" <?php if(old('tipo_insumo_id', $material->tipo_insumo_id) == $tipoId): echo 'selected'; endif; ?>>
                  <?php echo e($tipoNombre); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['tipo_insumo_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>

        
        <div class="flex space-x-3">
          <a href="<?php echo e(route('inventario.index')); ?>"
             id="btn-cancelar"
             class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
            Cancelar
          </a>
          <button type="submit"
                  class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 transition">
            Actualizar
          </button>
        </div>
      </form>
    </div>
  </div>

  
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const btnCancelar = document.getElementById('btn-cancelar');
      if (!btnCancelar) return;

      btnCancelar.addEventListener('click', function (e) {
        e.preventDefault();
        const url = this.getAttribute('href');

        // Verifica que SweetAlert2 esté disponible
        if (typeof Swal === 'undefined') {
          // Si no está, cae a la redirección directa
          window.location.href = url;
          return;
        }

        Swal.fire({
          title: '¿Estás seguro?',
          text: 'Se perderán los cambios no guardados. ¿Quieres cancelar la edición?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, cancelar',
          cancelButtonText: 'Seguir editando',
          reverseButtons: true,
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 1500,
              icon: 'info',
              title: 'Continúas editando'
            });
          }
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/inventario/edit.blade.php ENDPATH**/ ?>
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
      <h1 class="text-2xl font-bold text-red-700 mb-4">
        <i class="fas fa-plus mr-2"></i> Agregar Material
      </h1>

      <form id="materialForm" action="<?php echo e(route('inventario.store')); ?>" method="POST" novalidate>
        <?php echo csrf_field(); ?>

        
        <div class="mb-4">
          <label class="inline-flex items-center">
            <input type="checkbox" id="basico" name="basico" class="form-checkbox h-5 w-5 text-red-600">
            <span class="ml-2">Este es un material básico</span>
          </label>
        </div>

        
        <div class="mb-4">
          <label class="block font-medium mb-1">Clave</label>
          <input
            id="clave"
            name="clave"
            value="<?php echo e(old('clave')); ?>"
            maxlength="10"
            class="w-full border px-3 py-2 rounded transition-colors"
            placeholder="Ingresa la clave"
          />
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
          <label class="block font-medium mb-1">Descripción</label>
          <textarea
            id="descripcion"
            name="descripcion"
            rows="3"
            class="w-full border px-3 py-2 rounded transition-colors"
            placeholder="Describe el material"
          ><?php echo e(old('descripcion')); ?></textarea>
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

        
        <div class="grid grid-cols-2 gap-4 mb-6">
          <div>
            <label class="block font-medium mb-1">Partida</label>
            <select
              id="partida"
              name="partida_id"
              class="w-full border px-3 py-2 rounded transition-colors"
            >
              <option value="">Selecciona...</option>
              <?php $__currentLoopData = $partidas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>" <?php if(old('partida_id') == $id): echo 'selected'; endif; ?>>
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
            <label class="block font-medium mb-1">Tipo de Insumo</label>
            <select
              id="tipo"
              name="tipo_insumo_id"
              class="w-full border px-3 py-2 rounded transition-colors"
            >
              <option value="">Selecciona...</option>
              <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoId => $tipoNombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($tipoId); ?>" <?php if(old('tipo_insumo_id') == $tipoId): echo 'selected'; endif; ?>>
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
             class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Cancelar
          </a>
          <button
            id="btnSubmit"
            type="submit"
            disabled
            class="px-4 py-2 bg-green-600 text-white rounded opacity-50 cursor-not-allowed hover:opacity-100"
          >
            Guardar
          </button>
        </div>
      </form>
    </div>
  </div>

  
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const basico      = document.getElementById('basico');
      const clave       = document.getElementById('clave');
      const descripcion = document.getElementById('descripcion');
      const partida     = document.getElementById('partida');
      const tipo        = document.getElementById('tipo');
      const btnSubmit   = document.getElementById('btnSubmit');

      function validaInput(el, regex) {
        const val = el.value.trim();
        el.classList.remove('border-red-500','border-green-500');
        if (!val || !regex.test(val)) {
          el.classList.add('border-red-500');
          return false;
        }
        el.classList.add('border-green-500');
        return true;
      }
      function validaSelect(el) {
        const ok = el.value !== '';
        el.classList.remove('border-red-500','border-green-500');
        el.classList.add(ok ? 'border-green-500' : 'border-red-500');
        return ok;
      }

      function validarTodo() {
        const esBasico = basico.checked;
        const reClave = esBasico
          ? /^MFCB\d{6}$/
          : /^\d{10}$/;
        const okClave = validaInput(clave, reClave);
        const okDesc  = !!descripcion.value.trim();
        descripcion.classList.remove('border-red-500','border-green-500');
        descripcion.classList.add(okDesc ? 'border-green-500' : 'border-red-500');
        const okPart  = validaSelect(partida);
        const okTipo  = validaSelect(tipo);

        const todoOk = okClave && okDesc && okPart && okTipo;
        btnSubmit.disabled = !todoOk;
        if (todoOk) {
          btnSubmit.classList.remove('opacity-50','cursor-not-allowed');
        } else {
          btnSubmit.classList.add('opacity-50','cursor-not-allowed');
        }
      }

      // Al cambiar checkbox
      basico.addEventListener('change', () => {
        if (basico.checked) {
          clave.value = 'MFCB';
        } else {
          clave.value = '';
        }
        clave.maxLength = 10;
        validarTodo();
      });

      // Revalidar en cada input
      [clave, descripcion, partida, tipo].forEach(el => {
        el.addEventListener('input', validarTodo);
      });

      // Primera validación
      validarTodo();
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/inventario/create.blade.php ENDPATH**/ ?>
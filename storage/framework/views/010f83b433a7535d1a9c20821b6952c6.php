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
      
      <h2 class="flex items-center text-3xl font-bold text-red-700 mb-6">
        <i class="fas fa-user-edit mr-2"></i> Editar Empleado
      </h2>

      <?php if($errors->any()): ?>
        <div class="bg-red-600 text-white p-3 mb-6 rounded">
          <ul class="list-disc list-inside">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="<?php echo e(route('usuarios.update', $empleado->id)); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700">Nombre</label>
            <input
              type="text"
              value="<?php echo e($empleado->nombre); ?>"
              disabled
              class="mt-1 w-full bg-gray-100 border border-gray-300 rounded px-3 py-2"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Primer Apellido</label>
            <input
              type="text"
              value="<?php echo e($empleado->primer_apellido); ?>"
              disabled
              class="mt-1 w-full bg-gray-100 border border-gray-300 rounded px-3 py-2"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Segundo Apellido</label>
            <input
              type="text"
              value="<?php echo e($empleado->segundo_apellido); ?>"
              disabled
              class="mt-1 w-full bg-gray-100 border border-gray-300 rounded px-3 py-2"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Número de Empleado</label>
            <input
              type="text"
              value="<?php echo e($empleado->numero_empleado); ?>"
              disabled
              class="mt-1 w-full bg-gray-100 border border-gray-300 rounded px-3 py-2"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">RFC</label>
            <input
              type="text"
              value="<?php echo e($empleado->rfc); ?>"
              disabled
              class="mt-1 w-full bg-gray-100 border border-gray-300 rounded px-3 py-2"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Usuario</label>
            <input
              type="text"
              value="<?php echo e($empleado->user->username ?? '—'); ?>"
              disabled
              class="mt-1 w-full bg-gray-100 border border-gray-300 rounded px-3 py-2"
            />
          </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          
          <div>
            <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
            <select
              id="rol"
              name="rol"
              required
              class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
            >
              <?php $__currentLoopData = ['Administrador','Jefe Abasto','Solicitante']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                  value="<?php echo e($rol); ?>"
                  <?php echo e(old('rol', $empleado->user->roles->pluck('name')->first() ?? '') === $rol ? 'selected' : ''); ?>

                ><?php echo e($rol); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          
          <div>
            <label for="plaza_id" class="block text-sm font-medium text-gray-700">Plaza</label>
            <select
              id="plaza_id"
              name="plaza_id"
              required
              class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
            >
              <option value="" disabled>Seleccione una plaza</option>
              <?php $__currentLoopData = $plazas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plaza): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                  value="<?php echo e($plaza->id); ?>"
                  <?php echo e(old('plaza_id', $empleado->plaza_id) == $plaza->id ? 'selected' : ''); ?>

                ><?php echo e($plaza->nombre); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          
          <div>
            <label for="servicio_id" class="block text-sm font-medium text-gray-700">Servicio</label>
            <select
              id="servicio_id"
              name="servicio_id"
              required
              class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
            >
              <option value="" disabled>Seleccione un servicio</option>
              <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                  value="<?php echo e($servicio->id); ?>"
                  <?php echo e(old('servicio_id', $empleado->servicio_actual_id) == $servicio->id ? 'selected' : ''); ?>

                ><?php echo e($servicio->nombre); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Nueva Contraseña</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Dejar en blanco para mantener la actual"
              class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
            />
          </div>
        </div>

        
        <div class="flex justify-end space-x-3 mt-6">
          <a
            href="<?php echo e(route('usuarios.index')); ?>"
            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded shadow text-gray-700 transition"
          >Cancelar</a>
          <button
            type="submit"
            class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded shadow text-white transition"
          >Guardar Cambios</button>
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/usuarios/edit.blade.php ENDPATH**/ ?>
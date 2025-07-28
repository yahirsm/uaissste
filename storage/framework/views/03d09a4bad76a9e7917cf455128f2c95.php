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
      <h2 class="text-3xl font-bold text-red-700 dark:text-red-400 mb-6">
        <i class="fas fa-user-plus mr-2"></i> Agregar Nuevo Usuario
      </h2>

      
      <?php if($errors->any()): ?>
        <div class="bg-red-500 text-white p-3 mb-4 rounded">
          <ul class="list-disc pl-5">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <form
        id="formUsuario"
        action="<?php echo e(route('usuarios.store')); ?>"
        method="POST"
        class="grid grid-cols-1 md:grid-cols-2 gap-4"
      >
        <?php echo csrf_field(); ?>

        
        <div>
          <label for="numero_empleado" class="block text-sm font-medium text-gray-700">Número de Empleado</label>
          <input
            type="text"
            name="numero_empleado"
            id="numero_empleado"
            maxlength="6"
            required
            placeholder="123456"
            value="<?php echo e(old('numero_empleado')); ?>"
            class="w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
        </div>

        
        <div>
          <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
          <input
            type="text"
            name="nombre"
            id="nombre"
            required
            placeholder="Juan Carlos"
            value="<?php echo e(old('nombre')); ?>"
            class="w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
        </div>

        
        <div>
          <label for="primer_apellido" class="block text-sm font-medium text-gray-700">Primer Apellido</label>
          <input
            type="text"
            name="primer_apellido"
            id="primer_apellido"
            required
            placeholder="Pérez"
            value="<?php echo e(old('primer_apellido')); ?>"
            class="w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
        </div>

        
        <div>
          <label for="segundo_apellido" class="block text-sm font-medium text-gray-700">Segundo Apellido</label>
          <input
            type="text"
            name="segundo_apellido"
            id="segundo_apellido"
            placeholder="López"
            value="<?php echo e(old('segundo_apellido')); ?>"
            class="w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
        </div>

        
        <div>
          <label for="rfc" class="block text-sm font-medium text-gray-700">RFC</label>
          <input
            type="text"
            name="rfc"
            id="rfc"
            maxlength="13"
            required
            placeholder="ABCD901212XYZ"
            value="<?php echo e(old('rfc')); ?>"
            class="w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50 uppercase"
          >
        </div>

        
        <div>
          <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
          <select
            id="rol"
            name="rol"
            required
            class="mt-1 block w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
            <option value="" disabled <?php echo e(old('rol') ? '' : 'selected'); ?>>Seleccione un rol</option>
            <option value="Administrador" <?php echo e(old('rol')=='Administrador' ? 'selected':''); ?>>Administrador</option>
            <option value="Jefe Abasto"     <?php echo e(old('rol')=='Jefe Abasto'    ? 'selected':''); ?>>Jefe Abasto</option>
            <option value="Solicitante"     <?php echo e(old('rol')=='Solicitante'    ? 'selected':''); ?>>Solicitante</option>
          </select>
        </div>

        
        <div>
          <label for="plaza_id" class="block text-sm font-medium text-gray-700">Plaza</label>
          <select
            name="plaza_id"
            id="plaza_id"
            required
            class="mt-1 block w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
            <option value="" disabled <?php echo e(old('plaza_id') ? '' : 'selected'); ?>>Seleccione una plaza</option>
            <?php $__currentLoopData = $plazas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plaza): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($plaza->id); ?>" <?php echo e(old('plaza_id')==$plaza->id ? 'selected':''); ?>>
                <?php echo e($plaza->nombre); ?>

              </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>

        
        <div>
          <label for="servicio_id" class="block text-sm font-medium text-gray-700">Servicio Actual</label>
          <select
            name="servicio_id"
            id="servicio_id"
            required
            class="mt-1 block w-full p-2 border rounded focus:ring-red-600 focus:border-red-600 bg-blue-50"
          >
            <option value="" disabled <?php echo e(old('servicio_id') ? '' : 'selected'); ?>>Seleccione un servicio</option>
            <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($servicio->id); ?>" <?php echo e(old('servicio_id')==$servicio->id ? 'selected':''); ?>>
                <?php echo e($servicio->nombre); ?>

              </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>

        
        <div>
          <label class="block text-sm font-medium text-gray-700">Usuario generado</label>
          <input
            type="text"
            id="username"
            readonly
            class="w-full p-2 border rounded bg-gray-100 text-gray-700"
          >
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Contraseña generada</label>
          <input
            type="text"
            id="password"
            readonly
            class="w-full p-2 border rounded bg-gray-100 text-gray-700"
          >
        </div>

        
        <div class="col-span-2 flex justify-end space-x-4 mt-4">
          <a href="<?php echo e(route('usuarios.index')); ?>"
             class="px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
            Cancelar
          </a>
          <button
            type="submit"
            id="guardarBtn"
            class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition"
          >
            Guardar Usuario
          </button>
        </div>
      </form>
    </div>
  </div>

  
  <script>
    const numEmp    = document.getElementById('numero_empleado');
    const ape1      = document.getElementById('primer_apellido');
    const ape2      = document.getElementById('segundo_apellido');
    const nom       = document.getElementById('nombre');
    const userField = document.getElementById('username');
    const passField = document.getElementById('password');

    function generarCredenciales() {
      const n1 = ape1.value.trim().toLowerCase();
      const n2 = ape2.value.trim().toLowerCase();
      const nm = nom.value.trim().toLowerCase();
      const num= numEmp.value.trim();
      if (!n1 || !nm || !num) return;

      // usuario
      let u = n1;
      fetch(`/verificar-usuario/${u}`)
        .then(r=>r.json())
        .then(d=>{
          if (d.exists && n2) u += n2.charAt(0);
          userField.value = u;
        });

      // contraseña
      const i1 = nm.charAt(0) || '';
      const i2 = n1.charAt(0) || '';
      const i3 = n2.charAt(0) || 'x';
      passField.value = `${i1}${i2}${i3}${num}#`;
    }

    [numEmp, ape1, ape2, nom].forEach(el=>
      el.addEventListener('input', generarCredenciales)
    );
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/usuarios/create.blade.php ENDPATH**/ ?>
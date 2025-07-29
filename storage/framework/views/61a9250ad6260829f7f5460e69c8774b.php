<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
  <div
    class="w-full max-w-md p-8
           bg-yellow-50 bg-opacity-60 backdrop-blur-sm
           rounded-lg border-2 border-yellow-600
           shadow-lg space-y-6"
  >
    
    <div class="text-center mb-4">
      <img src="<?php echo e(asset('images/logo.svg')); ?>"
           alt="ISSSTE Logo"
           class="mx-auto w-40 h-auto"/>
    </div>

    
    <?php if(session('error')): ?>
      <div class="px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded flex justify-between items-center">
        <div>
          <strong>¡Error!</strong> <?php echo e(session('error')); ?>

        </div>
        <button type="button" onclick="closeAlert()">
          <i class="fas fa-times text-red-700 hover:text-red-500"></i>
        </button>
      </div>
    <?php endif; ?>

    
    <div id="formAlert" class="hidden px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded flex justify-between items-center">
      <div>
        <strong>¡Error!</strong> <span id="alertMessage"></span>
      </div>
      <button type="button" onclick="closeFormAlert()">
        <i class="fas fa-times text-red-700 hover:text-red-500"></i>
      </button>
    </div>

    
    <form id="loginForm" method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
      <?php echo csrf_field(); ?>

      
      <div class="relative">
        <?php if (isset($component)) { $__componentOriginald8ba2b4c22a13c55321e34443c386276 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8ba2b4c22a13c55321e34443c386276 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.label','data' => ['for' => 'username','value' => 'Usuario']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'username','value' => 'Usuario']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $attributes = $__attributesOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__attributesOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $component = $__componentOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__componentOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
          <i class="fas fa-user text-gray-700"></i>
        </div>
        <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['id' => 'username','name' => 'username','type' => 'text','required' => true,'autofocus' => true,'placeholder' => 'ej. ramirez','value' => ''.e(old('username')).'','class' => 'block w-full pl-10 pr-3 py-2 border rounded focus:ring-red-700 focus:border-red-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'username','name' => 'username','type' => 'text','required' => true,'autofocus' => true,'placeholder' => 'ej. ramirez','value' => ''.e(old('username')).'','class' => 'block w-full pl-10 pr-3 py-2 border rounded focus:ring-red-700 focus:border-red-700']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
      </div>

      
      <div class="relative">
        <?php if (isset($component)) { $__componentOriginald8ba2b4c22a13c55321e34443c386276 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8ba2b4c22a13c55321e34443c386276 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.label','data' => ['for' => 'password','value' => 'Contraseña']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'password','value' => 'Contraseña']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $attributes = $__attributesOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__attributesOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $component = $__componentOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__componentOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
          <i class="fas fa-lock text-gray-700"></i>
        </div>
        <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['id' => 'password','name' => 'password','type' => 'password','required' => true,'placeholder' => '********','class' => 'block w-full pl-10 pr-10 py-2 border rounded focus:ring-red-700 focus:border-red-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'password','name' => 'password','type' => 'password','required' => true,'placeholder' => '********','class' => 'block w-full pl-10 pr-10 py-2 border rounded focus:ring-red-700 focus:border-red-700']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePassword()">
          <i id="eyeIcon" class="fas fa-eye text-gray-500"></i>
        </div>
      </div>

      
      <div class="flex items-center">
        <?php if (isset($component)) { $__componentOriginal74b62b190a03153f11871f645315f4de = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74b62b190a03153f11871f645315f4de = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.checkbox','data' => ['id' => 'remember_me','name' => 'remember']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'remember_me','name' => 'remember']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal74b62b190a03153f11871f645315f4de)): ?>
<?php $attributes = $__attributesOriginal74b62b190a03153f11871f645315f4de; ?>
<?php unset($__attributesOriginal74b62b190a03153f11871f645315f4de); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal74b62b190a03153f11871f645315f4de)): ?>
<?php $component = $__componentOriginal74b62b190a03153f11871f645315f4de; ?>
<?php unset($__componentOriginal74b62b190a03153f11871f645315f4de); ?>
<?php endif; ?>
        <label for="remember_me" class="ml-2 text-sm text-gray-900">Recuérdame</label>
      </div>

      
      <div class="flex justify-end">
        <button type="submit"
                class="inline-flex items-center gap-2
                       bg-yellow-600 hover:bg-yellow-700 text-white
                       font-bold px-4 py-2 rounded-lg"
        >
          <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
        </button>
      </div>
    </form>
  </div>

  
  <script>
    // Prevent empty submit
    document.getElementById('loginForm').addEventListener('submit', function(e){
      e.preventDefault();
      const u = document.getElementById('username').value.trim(),
            p = document.getElementById('password').value.trim();
      if (!u||!p) {
        let m = '';
        if (!u) m += 'El usuario es obligatorio. ';
        if (!p) m += 'La contraseña es obligatoria.';
        showFormAlert(m);
      } else { this.submit(); }
    });

    // Username blur validation
    document.getElementById('username').addEventListener('blur', function(){
      const v = this.value.trim();
      if(!/^[a-zA-Z]{3,}$/.test(v)) {
        showFormAlert('El usuario solo puede contener letras y al menos 3 caracteres.');
      } else {
        closeFormAlert();
      }
    });

    // Toggle password
    function togglePassword(){
      const inp = document.getElementById('password'),
            ico = document.getElementById('eyeIcon');
      if(inp.type==='password'){
        inp.type='text';
        ico.classList.replace('fa-eye','fa-eye-slash');
      } else {
        inp.type='password';
        ico.classList.replace('fa-eye-slash','fa-eye');
      }
    }

    function showFormAlert(msg){
      const a = document.getElementById('formAlert');
      document.getElementById('alertMessage').textContent = msg;
      a.classList.remove('hidden');
    }
    function closeFormAlert(){
      document.getElementById('formAlert').classList.add('hidden');
    }
    function closeAlert(){
      const e = document.getElementById('alert');
      if(e) e.remove();
    }
  </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/auth/login.blade.php ENDPATH**/ ?>
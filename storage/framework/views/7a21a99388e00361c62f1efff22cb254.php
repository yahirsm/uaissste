<?php
    $links = [
        ['name'=>'Inicio','icon'=>'fa-solid fa-house-flag','route'=>route('dashboard'),'active'=>request()->routeIs('dashboard')],
        ['header'=>'Menú'],
        ['name'=>'Usuarios','icon'=>'fa-solid fa-users','route'=>route('usuarios.index'),
            'active'=>request()->routeIs('usuarios.index')||request()->routeIs('servicios.index')||request()->routeIs('plazas.index'),
            'submenu'=>[
                ['name'=>'Usuarios','icon'=>'fa-solid fa-user','route'=>route('usuarios.index'),'active'=>request()->routeIs('usuarios.index')],
                ['name'=>'Servicios','icon'=>'fa-solid fa-stethoscope','route'=>route('servicios.index'),'active'=>request()->routeIs('servicios.index')],
                ['name'=>'Plazas','icon'=>'fa-solid fa-briefcase','route'=>route('plazas.index'),'active'=>request()->routeIs('plazas.index')],
            ],
        ],
        ['name'=>'Inventario','icon'=>'fa-solid fa-boxes-stacked','route'=>route('inventario.index'),
            'active'=>request()->routeIs('inventario.index')||request()->routeIs('inventario.partida')||request()->routeIs('inventario.movimientos.*'),
            'submenu'=>[
                ['name'=>'Inventario','icon'=>'fa-solid fa-warehouse','route'=>route('inventario.index'),'active'=>request()->routeIs('inventario.index')],
                ['name'=>'Partidas','icon'=>'fa-solid fa-list-ol','route'=>route('inventario.partida'),'active'=>request()->routeIs('inventario.partida')],
                ['name'=>'Movimientos','icon'=>'fa-solid fa-exchange-alt','route'=>route('inventario.movimientos.index'),'active'=>request()->routeIs('inventario.movimientos.*')],
            ],
        ],
        ['name'=>'Reportes','icon'=>'fa-solid fa-chart-line','route'=>route('reportes.index'),'active'=>request()->routeIs('reportes.*')],
        ['name'=>'Distribución','icon'=>'fa-solid fa-truck','route'=>'#',
            'active'=>request()->routeIs('distribucion.solicitud.*')||request()->routeIs('distribucion.pedidos.*'),
            'submenu'=>[
                ['name'=>'Solicitud','icon'=>'fa-solid fa-file-signature','route'=>route('distribucion.solicitud.index'),'active'=>request()->routeIs('distribucion.solicitud.*')],
                ['name'=>'Pedidos','icon'=>'fa-solid fa-truck-fast','route'=>route('distribucion.pedidos.index'),'active'=>request()->routeIs('distribucion.pedidos.*')],
            ],
        ],
    ];
?>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-48 h-screen pt-20 bg-white border-r">
  <div class="h-full px-3 pb-4 overflow-y-auto">
    <ul class="space-y-2 font-medium">

      
      <li>
        <a href="<?php echo e($links[0]['route']); ?>"
           class="flex items-center p-2 rounded-lg <?php echo e($links[0]['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100'); ?>">
          <i class="<?php echo e($links[0]['icon']); ?> w-5 h-5"></i>
          <span class="ml-3"><?php echo e($links[0]['name']); ?></span>
        </a>
      </li>

      
      <li><div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase"><?php echo e($links[1]['header']); ?></div></li>

      
      <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Administrador')): ?>
        <?php $item = $links[2]; ?>
        <li>
          <button type="button"
                  class="flex items-center justify-between w-full p-2 rounded-lg <?php echo e($item['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100'); ?>"
                  onclick="toggleSubmenu(this)">
            <div class="flex items-center">
              <i class="<?php echo e($item['icon']); ?> w-5 h-5 <?php echo e($item['active'] ? 'text-white' : ''); ?>"></i>
              <span class="ml-3"><?php echo e($item['name']); ?></span>
            </div>
            <svg class="w-3 h-3 <?php echo e($item['active'] ? 'rotate-180' : ''); ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </button>
          <ul class="py-2 space-y-2 <?php echo e($item['active'] ? '' : 'hidden'); ?>">
            <?php $__currentLoopData = $item['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li>
                <a href="<?php echo e($sub['route']); ?>"
                   class="flex items-center p-2 pl-11 rounded-lg <?php echo e($sub['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100'); ?>">
                  <i class="<?php echo e($sub['icon']); ?> w-4 h-4 mr-2"></i>
                  <?php echo e($sub['name']); ?>

                </a>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </li>
      <?php endif; ?>

      
     
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario.ver')): ?>
    <?php 
        // es el item 3 de tu array $links
        $item = $links[3];
    ?>
    <li>
      <button type="button"
              class="flex items-center justify-between w-full p-2 rounded-lg <?php echo e($item['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100'); ?>"
              onclick="toggleSubmenu(this)">
        <div class="flex items-center">
          <i class="<?php echo e($item['icon']); ?> w-5 h-5 <?php echo e($item['active'] ? 'text-white' : ''); ?>"></i>
          <span class="ml-3"><?php echo e($item['name']); ?></span>
        </div>
        <svg class="w-3 h-3 <?php echo e($item['active'] ? 'rotate-180' : ''); ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
      </button>
      <ul class="py-2 space-y-2 <?php echo e($item['active'] ? '' : 'hidden'); ?>">
        
        <li>
          <a href="<?php echo e(route('inventario.index')); ?>"
             class="flex items-center p-2 pl-11 rounded-lg <?php echo e(request()->routeIs('inventario.index') ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100'); ?>">
            <i class="fa-solid fa-warehouse w-4 h-4 mr-2"></i>
            Inventario
          </a>
        </li>

        
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Administrador|Jefe Abasto')): ?>
        <li>
          <a href="<?php echo e(route('inventario.partida')); ?>"
             class="flex items-center p-2 pl-11 rounded-lg <?php echo e(request()->routeIs('inventario.partida') ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100'); ?>">
            <i class="fa-solid fa-list-ol w-4 h-4 mr-2"></i>
            Partidas
          </a>
        </li>
        <?php endif; ?>

        
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Administrador|Jefe Abasto')): ?>
        <li>
          <a href="<?php echo e(route('inventario.movimientos.index')); ?>"
             class="flex items-center p-2 pl-11 rounded-lg <?php echo e(request()->routeIs('inventario.movimientos.*') ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100'); ?>">
            <i class="fa-solid fa-exchange-alt w-4 h-4 mr-2"></i>
            Movimientos
          </a>
        </li>
        <?php endif; ?>

      </ul>
    </li>
<?php endif; ?>


      
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reportes.ver')): ?>
        <?php $item = $links[4]; ?>
        <li>
          <a href="<?php echo e($item['route']); ?>"
             class="flex items-center p-2 rounded-lg <?php echo e($item['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100'); ?>">
            <i class="<?php echo e($item['icon']); ?> w-5 h-5 <?php echo e($item['active'] ? 'text-white' : ''); ?>"></i>
            <span class="ml-3"><?php echo e($item['name']); ?></span>
          </a>
        </li>
      <?php endif; ?>

      
      <?php if(auth()->user()->can('solicitudes.ver') || auth()->user()->can('pedidos.ver')): ?>
        <?php $item = $links[5]; ?>
        <li>
          <button type="button"
                  class="flex items-center justify-between w-full p-2 rounded-lg <?php echo e($item['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100'); ?>"
                  onclick="toggleSubmenu(this)">
            <div class="flex items-center">
              <i class="<?php echo e($item['icon']); ?> w-5 h-5 <?php echo e($item['active'] ? 'text-white' : ''); ?>"></i>
              <span class="ml-3"><?php echo e($item['name']); ?></span>
            </div>
            <svg class="w-3 h-3 <?php echo e($item['active'] ? 'rotate-180' : ''); ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </button>
          <ul class="py-2 space-y-2 <?php echo e($item['active'] ? '' : 'hidden'); ?>">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('solicitudes.ver')): ?>
              <li>
                <a href="<?php echo e($item['submenu'][0]['route']); ?>"
                   class="flex items-center p-2 pl-11 rounded-lg <?php echo e($item['submenu'][0]['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100'); ?>">
                  <i class="<?php echo e($item['submenu'][0]['icon']); ?> w-4 h-4 mr-2"></i>
                  <?php echo e($item['submenu'][0]['name']); ?>

                </a>
              </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pedidos.ver')): ?>
              <li>
                <a href="<?php echo e($item['submenu'][1]['route']); ?>"
                   class="flex items-center p-2 pl-11 rounded-lg <?php echo e($item['submenu'][1]['active'] ? 'bg-[#7A0019] text-white' : 'hover:bg-gray-100'); ?>">
                  <i class="<?php echo e($item['submenu'][1]['icon']); ?> w-4 h-4 mr-2"></i>
                  <?php echo e($item['submenu'][1]['name']); ?>

                </a>
              </li>
            <?php endif; ?>
          </ul>
        </li>
      <?php endif; ?>

    </ul>
  </div>
</aside>

<script>
  function toggleSubmenu(btn) {
    btn.nextElementSibling.classList.toggle('hidden');
  }
</script>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/layouts/partials/admin/sidebar.blade.php ENDPATH**/ ?>
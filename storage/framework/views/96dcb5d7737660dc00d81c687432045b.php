<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_','-',app()->getLocale())); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title>
    <?php echo e(config('app.name','Laravel')); ?>

    <?php if(request()->routeIs('login')): ?> · Iniciar Sesión <?php endif; ?>
  </title>

  
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

  
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>
  
  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


  <style>
    html, body { height:100%; margin:0; padding:0; overflow:hidden; background:#000; }
  </style>
</head>
<body class="antialiased">

  <?php if(request()->routeIs('login')): ?>
    
    <div
      class="fixed inset-0 bg-center bg-no-repeat"
      style="
        background-image: url('<?php echo e(asset('images/unidad2.png')); ?>');
        background-size: 105% auto;
      "
    ></div>
    
    <div class="fixed inset-0 bg-black/40"></div>
  <?php endif; ?>

  
  <div class="fixed inset-0 flex items-center justify-center">
    <?php echo e($slot); ?>

  </div>

  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/layouts/guest.blade.php ENDPATH**/ ?>
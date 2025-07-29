<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'ISSSTE')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/png">

    <!-- Choices.js CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
    />

    <!-- Your Tailwind/App CSS & JS via Vite -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <!-- Livewire styles -->
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


    <style>
      /* globally scale down if you like */
      body { zoom: 0.8; }
      /* limit dropdown height and enable scroll */
      .choices__list--dropdown {
        max-height: 300px !important;
        overflow-y: auto !important;
      }
    </style>
</head>
<body class="font-sans antialiased">
    <?php if (isset($component)) { $__componentOriginalff9615640ecc9fe720b9f7641382872b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff9615640ecc9fe720b9f7641382872b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.banner','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff9615640ecc9fe720b9f7641382872b)): ?>
<?php $attributes = $__attributesOriginalff9615640ecc9fe720b9f7641382872b; ?>
<?php unset($__attributesOriginalff9615640ecc9fe720b9f7641382872b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff9615640ecc9fe720b9f7641382872b)): ?>
<?php $component = $__componentOriginalff9615640ecc9fe720b9f7641382872b; ?>
<?php unset($__componentOriginalff9615640ecc9fe720b9f7641382872b); ?>
<?php endif; ?>

    <div class="min-h-screen bg-gray-100">
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('navigation-menu');

$__html = app('livewire')->mount($__name, $__params, 'lw-174085915-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

        <!-- Optional page header -->
        <?php if(isset($header)): ?>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <!-- Main content slot -->
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo e($slot ?? ''); ?>

    </div>

    <!-- Livewire scripts -->
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    <!-- SweetAlert2 (already in your snippet) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Choices.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('select[data-trigger]').forEach((el) => {
          new Choices(el, {
            placeholder: true,
            placeholderValue: 'Buscar o seleccionar...',
            searchPlaceholderValue: 'Escribe para buscar...',
            shouldSort: false,
            itemSelectText: '',
            position: 'bottom',
            searchEnabled: true,
            removeItemButton: false,
            maxItemCount: 1,
            renderChoiceLimit: 300,
            classNames: {
              containerOuter: 'choices bg-blue-50 rounded',
            }
          });
        });
      });
    </script>
</body>
</html>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/layouts/app.blade.php ENDPATH**/ ?>
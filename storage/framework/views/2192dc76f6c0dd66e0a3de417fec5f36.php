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
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-3xl font-bold text-red-700 mb-6">
                <i class="fas fa-file-pdf mr-2"></i> Generación de Reportes
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="flex flex-col p-5 bg-red-50 rounded-lg shadow hover:shadow-lg transition">
                    <div class="w-12 h-12 flex items-center justify-center bg-red-500 text-white rounded-full">
                        <i class="fas fa-boxes fa-lg"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-red-700">Inventario Completo</h3>
                    <p class="flex-1 mt-2 text-gray-600">
                        Lista detallada de todos los materiales con su stock actual.
                    </p>
                    <a href="<?php echo e(route('reportes.inventario.pdf')); ?>"
                        class="mt-4 inline-flex items-center justify-center bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-download mr-2"></i> Descargar PDF
                    </a>
                </div>

                
                <div class="flex flex-col p-5 bg-yellow-50 rounded-lg shadow hover:shadow-lg transition">
                    <div class="w-12 h-12 flex items-center justify-center bg-yellow-500 text-white rounded-full">
                        <i class="fas fa-exclamation-triangle fa-lg"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-yellow-700">Stock Bajo</h3>
                    <p class="flex-1 mt-2 text-gray-600">
                        Materiales con existencias inferiores a 3 unidades.
                    </p>
                    <a href="<?php echo e(route('reportes.stockBajo.pdf')); ?>"
                        class="mt-4 inline-flex items-center justify-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-download mr-2"></i> Descargar PDF
                    </a>
                </div>

                
                <div class="flex flex-col p-5 bg-green-50 rounded-lg shadow hover:shadow-lg transition">
                    <div class="w-12 h-12 flex items-center justify-center bg-green-500 text-white rounded-full">
                        <i class="fas fa-calendar-alt fa-lg"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-green-700">Próximos a Caducar</h3>
                    <p class="mt-2 text-gray-600">
                        Genera un reporte de materiales cuya caducidad caiga dentro del mes seleccionado.
                    </p>
                    <p class="mt-4 text-sm text-gray-500 italic">
                        Selecciona el mes para el cual quieres ver los materiales próximos a caducar.
                    </p>
                    <form action="<?php echo e(route('reportes.caducidad.pdf')); ?>" method="GET" class="mt-2 w-full">
                        <label for="from" class="block text-sm font-medium text-gray-700 mb-1">
                            Mes de caducidad
                        </label>
                        <input type="month" id="from" name="from" required
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-300 mb-3" />
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-download mr-2"></i> Descargar PDF
                        </button>
                    </form>
                </div>

                
                <div class="flex flex-col p-5 bg-blue-50 rounded-lg shadow hover:shadow-lg transition">
                    <div class="w-12 h-12 flex items-center justify-center bg-blue-500 text-white rounded-full">
                        <i class="fas fa-calendar fa-lg"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-blue-700">Movimientos Mensuales</h3>
                    <p class="mt-2 text-gray-600">
                        Genera un reporte de todas las entradas y salidas de un mes específico.
                    </p>
                    <form action="<?php echo e(route('reportes.movimientosMes.pdf')); ?>" method="GET" class="mt-4 w-full">
                        <label for="month" class="block text-sm font-medium text-gray-700 mb-1">
                            Mes
                        </label>
                        <input type="month" id="month" name="month" required
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 mb-3" />
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-download mr-2"></i> Descargar PDF
                        </button>
                    </form>
                </div>

                
                <div class="flex flex-col p-5 bg-indigo-50 rounded-lg shadow hover:shadow-lg transition">
                    <div class="w-12 h-12 flex items-center justify-center bg-indigo-500 text-white rounded-full">
                        <i class="fas fa-calendar-week fa-lg"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-indigo-700">Movimientos Semanales</h3>
                    <p class="mt-2 text-gray-600">
                        Genera un reporte de entradas y salidas de una semana específica.
                    </p>
                    <form action="<?php echo e(route('reportes.movimientosSemana.pdf')); ?>" method="GET" class="mt-4 w-full">
                        <label for="week" class="block text-sm font-medium text-gray-700 mb-1">
                            Semana (YYYY‑Www)
                        </label>
                        <input type="week" id="week" name="week" required
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300 mb-3" />
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-download mr-2"></i> Descargar PDF
                        </button>
                    </form>
                </div>

                
                <div class="flex flex-col p-5 bg-pink-50 rounded-lg shadow hover:shadow-lg transition">
                    <div class="w-12 h-12 flex items-center justify-center bg-pink-500 text-white rounded-full">
                        <i class="fas fa-calendar-day fa-lg"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-pink-700">Entradas por Día</h3>
                    <p class="flex-1 mt-2 text-gray-600">
                        Genera un reporte de todas las entradas de inventario de un día específico.
                    </p>
                    <form action="<?php echo e(route('reportes.entradasDia.pdf')); ?>" method="GET" class="mt-4 w-full">
                        <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Día</label>
                        <input type="date" id="fecha" name="fecha" required
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300 mb-4" />
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center
                   bg-pink-500 hover:bg-pink-600 text-white font-bold
                   py-2 px-4 rounded transition">
                            <i class="fas fa-download mr-2"></i> Descargar PDF
                        </button>
                    </form>
                </div>


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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/reportes/index.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Stock Bajo</title>
    <style>
        @page { margin: 160px 40px 100px 40px; footer: html_footer; }
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .encabezado { text-align: center; margin-top: -120px; }
        .encabezado h2 { color: #800000; margin: 5px 0; }
        .encabezado p { margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; page-break-inside: auto; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #800000; color: white; }
        thead { display: table-header-group; }
        tr { page-break-inside: avoid; }
        .footer { font-size: 10px; color: #666; text-align: center; }
    </style>
</head>
<body>

<?php
    \Carbon\Carbon::setLocale('es');
    $fecha = \Carbon\Carbon::now()->translatedFormat('l j \d\e F \d\e\l Y \a \l\a\s H:i') . ' hrs';
?>

<div class="encabezado">
    <img src="<?php echo e(public_path('images/Logo.svg')); ?>" alt="Logo ISSSTE" width="80">
    <h2>REPORTES DE STOCK BAJO</h2>
    <p>Materiales con existencias menores a 3 unidades</p>
    <p>Generado el <?php echo e($fecha); ?></p>
</div>

<table>
    <thead>
        <tr>
            <th class="text-center">Clave</th>
            <th>Descripción</th>
            <th>Partida</th>
            <th>Tipo de Material</th>
            <th class="text-right">Stock Actual</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $materiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center"><?php echo e($m->clave); ?></td>
            <td><?php echo e($m->descripcion); ?></td>
            <td><?php echo e($m->partida->nombre ?? 'N/A'); ?></td>
            <td><?php echo e($m->tipoInsumo->nombre ?? 'N/A'); ?></td>
            <td class="text-right"><?php echo e(number_format($m->stock_actual,2)); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<htmlpagefooter name="footer">
    <div class="footer">
        Hospital Regional Presidente Benito Juárez del ISSSTE - Unidad de Abasto<br>
        Página {PAGENO} de {nbpg}
    </div>
</htmlpagefooter>

</body>
</html><?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/reportes/bajostock_pdf.blade.php ENDPATH**/ ?>
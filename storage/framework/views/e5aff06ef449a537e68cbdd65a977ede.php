<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Movimientos Semanales</title>
  <style>
    @page { margin: 160px 40px 100px 40px; header: header; footer: footer; }
    body { font-family: Arial, sans-serif; font-size: 12px; margin:0; padding:0; }
    table { width:100%; border-collapse: collapse; margin-top:10px; }
    th, td { border:1px solid #000; padding:5px; font-size:11px; }
    th { background-color:#4F46E5; color:#fff; }
    thead { display: table-header-group; }
    tr { page-break-inside: avoid; }
  </style>
</head>
<body>

<?php
  \Carbon\Carbon::setLocale('es');
  $fechaGen = now()->translatedFormat('l j \d\e F \d\e\l Y \a \l\a\s H:i') . ' hrs';
?>

<htmlpageheader name="header">
  <div style="text-align:center;">
    <img src="<?php echo e(public_path('images/Logo.svg')); ?>" width="80" alt="Logo ISSSTE"><br>
    <h2 style="color:#4F46E5; margin:5px 0;">REPORTE DE MOVIMIENTOS SEMANALES</h2>
    <p style="margin:2px 0;">Semana del <?php echo e($from->format('d/m/Y')); ?> al <?php echo e($to->format('d/m/Y')); ?></p>
    <p style="margin:2px 0;font-size:11px;">Generado el <?php echo e($fechaGen); ?></p>
    <hr style="border-color:#4F46E5; margin-top:5px;">
  </div>
</htmlpageheader>

<htmlpagefooter name="footer">
  <div style="font-size:10px; color:#666; text-align:center;">
    Unidad de Abasto – Página {PAGENO} de {nbpg}
  </div>
</htmlpagefooter>

<sethtmlpageheader name="header" value="on" show-this-page="1"/>
<sethtmlpagefooter name="footer" value="on"/>

<table>
  <thead>
    <tr>
      <th>Fecha</th>
      <th>Clave</th>
      <th>Descripción</th>
      <th>Tipo</th>
      <th>Cantidad</th>
      <th>Movimiento</th>
    </tr>
  </thead>
  <tbody>
    <?php $__currentLoopData = $movimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($mov->fecha_movimiento->format('d/m/Y')); ?></td>
        <td><?php echo e($mov->material->clave); ?></td>
        <td><?php echo e($mov->material->descripcion); ?></td>
        <td><?php echo e($mov->material->tipoInsumo->nombre ?? ''); ?></td>
        <td style="text-align:right;"><?php echo e(number_format($mov->cantidad,2)); ?></td>
        <td><?php echo e(ucfirst($mov->tipo)); ?></td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>

</body>
</html>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/reportes/semanal_movimientos_pdf.blade.php ENDPATH**/ ?>
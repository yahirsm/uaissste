<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Entradas del <?php echo e($fecha->format('d/m/Y')); ?></title>
  <style>
    @page { margin: 140px 40px 60px 40px; }
    body { font-family: Arial, sans-serif; font-size:12px; margin:0; padding:0; }
    table { width:100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border:1px solid #000; padding:5px; font-size:11px; }
    th { background-color:#800000; color:#fff; }
    thead { display: table-header-group; }
    tr { page-break-inside: avoid; }
  </style>
</head>
<body>
  
  <htmlpageheader name="header">
    <div style="text-align:center;">
      <img src="<?php echo e(public_path('images/Logo.svg')); ?>" width="80" alt="Logo ISSSTE">
      <h2 style="color:#800000; margin:5px 0;">Entradas del <?php echo e($fecha->format('d/m/Y')); ?></h2>
      <hr style="border-color:#800000; margin-top:5px;">
    </div>
  </htmlpageheader>
  <sethtmlpageheader name="header" value="on" show-this-page="1"/>

  
  <htmlpagefooter name="footer">
    <div style="font-size:10px; color:#666; text-align:center;">
      Página {PAGENO} de {nbpg}
    </div>
  </htmlpagefooter>
  <sethtmlpagefooter name="footer" value="on"/>

  
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Clave</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Fecha y hora</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $entradas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td style="text-align:center;"><?php echo e($loop->iteration); ?></td>
          <td><?php echo e($e->material->clave); ?></td>
          <td><?php echo e($e->material->descripcion); ?></td>
          <td style="text-align:center;"><?php echo e(number_format($e->cantidad, 2)); ?></td>
          <td style="text-align:center;"><?php echo e($e->fecha_movimiento->format('d/m/Y H:i')); ?></td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php if($entradas->isEmpty()): ?>
        <tr>
          <td colspan="5" style="text-align:center; padding:10px;">
            No se encontraron entradas para esta fecha.
          </td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/reportes/entradas_dia_pdf.blade.php ENDPATH**/ ?>
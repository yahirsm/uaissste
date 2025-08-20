<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Entradas del <?php echo e($fecha->format('d/m/Y')); ?></title>
  <style>
    @page {
      margin: 160px 40px 100px 40px;
      header: header;
      footer: footer;
    }
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      margin: 0; padding: 0;
    }
    table {
      width:100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      border:1px solid #000;
      padding:5px;
      font-size:11px;
      text-align:left;
    }
    th {
      background-color:#800000;
      color:#fff;
    }
    thead { display: table-header-group; }
    tr { page-break-inside: avoid; }
  </style>
</head>
<body>

<?php
  \Carbon\Carbon::setLocale('es');
  $fechaGen = now()->translatedFormat('l j \d\e F \d\e\l Y \a \l\a\s H:i') . ' hrs';
  $fechaFmt = $fecha->format('d/m/Y');
?>

<htmlpageheader name="header">
  <div style="text-align:center;">
    <img src="<?php echo e(public_path('images/Logo.svg')); ?>" width="80" alt="Logo ISSSTE">
    <h2 style="color:#800000; margin:5px 0;">ENTRADAS DEL <?php echo e($fechaFmt); ?></h2>
    <p style="margin:2px 0;font-size:11px;">Generado el <?php echo e($fechaGen); ?></p>
    <hr style="border-color:#800000; margin-top:5px;">
  </div>
</htmlpageheader>

<sethtmlpageheader name="header" value="on" show-this-page="1"/>

<htmlpagefooter name="footer">
  <div style="font-size:10px;color:#666;text-align:center;width:100%;">
    Hospital Regional Presidente Benito Juárez del ISSSTE – Unidad de Abasto<br>
    Página {PAGENO} de {nbpg}
  </div>
</htmlpagefooter>

<sethtmlpagefooter name="footer" value="on"/>

<table>
  <thead>
    <tr>
      <th style="text-align:center;">#</th>
      <th>Clave</th>
      <th>Descripción</th>
      <th style="text-align:center;">Cantidad</th>
      <th style="text-align:center;">Fecha y hora</th>
    </tr>
  </thead>
  <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $entradas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td style="text-align:center;"><?php echo e($loop->iteration); ?></td>
        <td><?php echo e($e->material->clave); ?></td>
        <td><?php echo e($e->material->descripcion); ?></td>
        <td style="text-align:center;"><?php echo e(number_format($e->cantidad, 2)); ?></td>
        <td style="text-align:center;"><?php echo e($e->fecha_movimiento->format('d/m/Y H:i')); ?></td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
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
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\uaissste\resources\views/reportes/entradas_dia_pdf.blade.php ENDPATH**/ ?>
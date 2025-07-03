
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reportes de Stock Bajo</title>
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
?>


<htmlpageheader name="header">
  <div style="text-align:center;">
    <img src="<?php echo e(public_path('images/Logo.svg')); ?>" width="80" alt="Logo ISSSTE">
    <h2 style="color:#800000; margin:5px 0;">REPORTES DE STOCK BAJO</h2>
    <p style="margin:2px 0;">Materiales con existencias menores a 3 unidades</p>
    <p style="margin:2px 0;font-size:11px;">Generado el <?php echo e($fechaGen); ?></p>
    <hr style="border-color:#800000; margin-top:5px;">
  </div>
</htmlpageheader>


<htmlpagefooter name="footer">
  <div style="font-size:10px; color:#666; text-align:center; width:100%;">
    Hospital Regional Presidente Benito Juárez del ISSSTE – Unidad de Abasto<br>
    Página {PAGENO} de {nbpg}
  </div>
</htmlpagefooter>

<sethtmlpageheader name="header" value="on" show-this-page="1"/>
<sethtmlpagefooter name="footer" value="on"/>


<table>
  <thead>
    <tr>
      <th style="text-align:center;">Clave</th>
      <th>Descripción</th>
      <th>Partida</th>
      <th>Tipo de Material</th>
      <th style="text-align:center;">Stock Actual</th>
    </tr>
  </thead>
  <tbody>
    <?php $__currentLoopData = $materiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td style="text-align:center;"><?php echo e($m->clave); ?></td>
        <td><?php echo e($m->descripcion); ?></td>
        <td><?php echo e($m->partida->nombre ?? 'N/A'); ?></td>
        <td><?php echo e($m->tipoInsumo->nombre ?? 'N/A'); ?></td>
        <td style="text-align:center;"><?php echo e(number_format($m->stock_actual,2)); ?></td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>

</body>
</html>
<?php /**PATH C:\Users\Lenovo\Documents\GitHub\ejercicio\resources\views/reportes/bajostock_pdf.blade.php ENDPATH**/ ?>
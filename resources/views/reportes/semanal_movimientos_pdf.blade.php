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

@php
  \Carbon\Carbon::setLocale('es');
  $fechaGen = now()->translatedFormat('l j \d\e F \d\e\l Y \a \l\a\s H:i') . ' hrs';
@endphp

<htmlpageheader name="header">
  <div style="text-align:center;">
    <img src="{{ public_path('images/Logo.svg') }}" width="80" alt="Logo ISSSTE"><br>
    <h2 style="color:#4F46E5; margin:5px 0;">REPORTE DE MOVIMIENTOS SEMANALES</h2>
    <p style="margin:2px 0;">Semana del {{ $from->format('d/m/Y') }} al {{ $to->format('d/m/Y') }}</p>
    <p style="margin:2px 0;font-size:11px;">Generado el {{ $fechaGen }}</p>
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
    @foreach($movimientos as $mov)
      <tr>
        <td>{{ $mov->fecha_movimiento->format('d/m/Y') }}</td>
        <td>{{ $mov->material->clave }}</td>
        <td>{{ $mov->material->descripcion }}</td>
        <td>{{ $mov->material->tipoInsumo->nombre ?? '' }}</td>
        <td style="text-align:right;">{{ number_format($mov->cantidad,2) }}</td>
        <td>{{ ucfirst($mov->tipo) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

</body>
</html>

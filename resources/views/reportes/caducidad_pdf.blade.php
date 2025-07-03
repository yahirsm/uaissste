{{-- resources/views/reportes/caducidad_pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Próximos a Caducar</title>
  <style>
    @page {
      margin: 160px 40px 100px 40px;
      header: header;   /* coincide con name="header" */
      footer: footer;   /* coincide con name="footer" */
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

@php
  \Carbon\Carbon::setLocale('es');
  $fechaGen = now()->translatedFormat('l j \d\e F \d\e\l Y');
  $fromFmt  = \Carbon\Carbon::parse($from)->format('d/m/Y');
  $toFmt    = \Carbon\Carbon::parse($to)->format('d/m/Y');
@endphp

{{-- ENCABEZADO FIJO --}}
<htmlpageheader name="header">
  <div style="text-align:center;">
    <img src="{{ public_path('images/Logo.svg') }}" width="80" alt="Logo ISSSTE">
    <h2 style="color:#800000;margin:5px 0;">MATERIALES PRÓXIMOS A CADUCAR</h2>
    <p style="margin:2px 0;">Rango: {{ $fromFmt }} – {{ $toFmt }}</p>
    <p style="margin:2px 0;font-size:11px;">Generado el {{ $fechaGen }}</p>
    <hr style="border-color:#800000;margin-top:5px;">
  </div>
</htmlpageheader>

{{-- PIE FIJO --}}
<htmlpagefooter name="footer">
  <div style="font-size:10px;color:#666;text-align:center;width:100%;">
    Hospital Regional Presidente Benito Juárez del ISSSTE – Unidad de Abasto<br>
    Página {PAGENO} de {nbpg}
  </div>
</htmlpagefooter>

<sethtmlpageheader name="header" value="on" show-this-page="1"/>
<sethtmlpagefooter name="footer" value="on"/>

{{-- TABLA DE CADUCIDAD --}}
<table>
  <thead>
    <tr>
      <th style="text-align:center;">Fecha Caducidad</th>
      <th>Clave</th>
      <th>Descripción</th>
      <th style="text-align:center;">Cantidad</th>
      <th>Unidad</th>
    </tr>
  </thead>
  <tbody>
    @foreach($movimientos as $mov)
      <tr>
        <td style="text-align:center;">{{ \Carbon\Carbon::parse($mov->fecha_caducidad)->format('d/m/Y') }}</td>
        <td>{{ $mov->material->clave }}</td>
        <td>{{ $mov->material->descripcion }}</td>
        <td style="text-align:center;">{{ number_format($mov->cantidad,2) }}</td>
        <td>{{ $mov->unidad }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

</body>
</html>

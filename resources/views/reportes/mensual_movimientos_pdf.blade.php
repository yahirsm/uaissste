{{-- resources/views/reportes/mensual_movimientos_pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Movimientos Mensuales</title>
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
  $fechaGen = now()->translatedFormat('l j \\d\\e F \\d\\e\\l Y');
  $fromFmt = $from->format('d/m/Y');
  $toFmt   = $to->format('d/m/Y');
@endphp

{{-- HEADER --}}
<htmlpageheader name="header">
  <div style="text-align:center;">
    <img src="{{ public_path('images/Logo.svg') }}" width="80" alt="Logo ISSSTE">
    <h2 style="color:#800000;margin:5px 0;">MOVIMIENTOS MENSUALES</h2>
    <p style="margin:2px 0;">
      Período: {{ $fromFmt }} – {{ $toFmt }}
    </p>
    <p style="margin:2px 0;font-size:11px;">
      Generado el {{ $fechaGen }}
    </p>
    <hr style="border-color:#800000;margin-top:5px;">
  </div>
</htmlpageheader>

{{-- FOOTER --}}
<htmlpagefooter name="footer">
  <div style="font-size:10px;color:#666;text-align:center;">
    Hospital Regional Presidente Benito Juárez del ISSSTE – Unidad de Abasto<br>
    Página {PAGENO} de {nbpg}
  </div>
</htmlpagefooter>

<sethtmlpageheader name="header" value="on" show-this-page="1"/>
<sethtmlpagefooter name="footer" value="on"/>

<table>
  <thead>
    <tr>
      <th>Fecha</th>
      <th>Clave</th>
      <th>Tipo</th>
      <th style="text-align:center;">Cantidad</th>
      <th>Unidad</th>
    </tr>
  </thead>
  <tbody>
    @foreach($movimientos as $mov)
      <tr>
        <td>{{ \Carbon\Carbon::parse($mov->fecha_movimiento)->format('d/m/Y') }}</td>
        <td>{{ $mov->material->clave }}</td>
        <td>{{ ucfirst($mov->tipo) }}</td>
        <td style="text-align:center;">{{ number_format($mov->cantidad,2) }}</td>
        <td>{{ $mov->unidad }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

</body>
</html>

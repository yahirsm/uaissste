{{-- resources/views/reportes/inventario_pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Inventario</title>
  <style>
    @page {
      margin: 160px 40px 100px 40px;
      header: header;   /* coincide con name="header" */
      footer: footer;   /* coincide con name="footer" */
    }
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      margin:0; padding:0;
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
  $fechaGen = now()->translatedFormat('l j \d\e F \d\e\l Y \a \l\a\s H:i') . ' hrs';
@endphp

{{-- ENCABEZADO FIJO --}}
<htmlpageheader name="header">
  <div style="text-align:center;">
    <img src="{{ public_path('images/Logo.svg') }}" width="80" alt="Logo ISSSTE">
    <h2 style="color:#800000; margin:5px 0;">REPORTE DE INVENTARIO</h2>
    <p style="margin:2px 0;">UNIDAD DE ABASTO – HOSPITAL REGIONAL PRESIDENTE BENITO JUÁREZ DEL ISSSTE</p>
    <p style="margin:2px 0;font-size:11px;">Generado el {{ $fechaGen }}</p>
    <hr style="border-color:#800000; margin-top:5px;">
  </div>
</htmlpageheader>

{{-- PIE FIJO --}}
<htmlpagefooter name="footer">
  <div style="font-size:10px; color:#666; text-align:center; width:100%;">
    Hospital Regional Presidente Benito Juárez del ISSSTE – Unidad de Abasto<br>
    Página {PAGENO} de {nbpg}
  </div>
</htmlpagefooter>

<sethtmlpageheader name="header" value="on" show-this-page="1"/>
<sethtmlpagefooter name="footer" value="on"/>

{{-- TABLA DE INVENTARIO --}}
<table>
  <thead>
    <tr>
      <th>Clave</th>
      <th>Descripción</th>
      <th>Partida</th>
      <th>Tipo de Material</th>
    </tr>
  </thead>
  <tbody>
    @foreach($materiales as $material)
      <tr>
        <td>{{ $material->clave }}</td>
        <td>{{ $material->descripcion }}</td>
        <td>{{ $material->partida->nombre ?? 'N/A' }}</td>
        <td>{{ $material->tipoInsumo->nombre ?? 'N/A' }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

</body>
</html>

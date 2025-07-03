{{-- resources/views/distribucion/pedidos/pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Solicitud de Material #{{ $solicitud->id }}</title>
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
  $fechaGen = \Carbon\Carbon::now()->translatedFormat('l j \d\e F \d\e\l Y');
  $horaGen  = \Carbon\Carbon::now()->format('H:i');
@endphp

{{-- DECLARO EL ENCABEZADO con name="header" --}}
<htmlpageheader name="header">
  <div style="text-align:center;">
    <img src="{{ public_path('images/Logo.svg') }}" width="80" alt="Logo ISSSTE">
    <h2 style="color:#800000;margin:5px 0;">SOLICITUD DE MATERIAL #{{ $solicitud->id }}</h2>
    <p style="margin:2px 0;">
      Fecha: {{ $solicitud->created_at->format('d/m/Y H:i') }} |
      Solicitante: {{ $solicitud->user->name }} |
      Área: {{ $solicitud->servicio->nombre }}
    </p>
    <p style="margin:2px 0;font-size:11px;">
      Generado el {{ $fechaGen }} a las {{ $horaGen }} hrs
    </p>
    <hr style="border-color:#800000;margin-top:5px;">
  </div>
</htmlpageheader>

{{-- DECLARO EL PIE con name="footer" --}}
<htmlpagefooter name="footer">
  <div style="font-size:10px;color:#666;text-align:center;">
    Hospital Regional Presidente Benito Juárez del ISSSTE – Unidad de Abasto<br>
    Página {PAGENO} de {nbpg}
  </div>
</htmlpagefooter>

{{-- Activo ambos bloques --}}
<sethtmlpageheader name="header" value="on" show-this-page="1"/>
<sethtmlpagefooter name="footer" value="on"/>

{{-- AQUÍ EMPIEZA TU TABLA --}}
<table>
  <thead>
    <tr><th>Clave</th><th>Descripción</th><th style="text-align:center;">Cantidad</th></tr>
  </thead>
  <tbody>
    @foreach($solicitud->materiales as $m)
      <tr>
        <td>{{ $m->clave }}</td>
        <td>{{ $m->descripcion }}</td>
        <td style="text-align:center">{{ $m->pivot->cantidad }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Entradas del {{ $fecha->format('d/m/Y') }}</title>
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
  {{-- Encabezado --}}
  <htmlpageheader name="header">
    <div style="text-align:center;">
      <img src="{{ public_path('images/Logo.svg') }}" width="80" alt="Logo ISSSTE">
      <h2 style="color:#800000; margin:5px 0;">Entradas del {{ $fecha->format('d/m/Y') }}</h2>
      <hr style="border-color:#800000; margin-top:5px;">
    </div>
  </htmlpageheader>
  <sethtmlpageheader name="header" value="on" show-this-page="1"/>

  {{-- Pie --}}
  <htmlpagefooter name="footer">
    <div style="font-size:10px; color:#666; text-align:center;">
      Página {PAGENO} de {nbpg}
    </div>
  </htmlpagefooter>
  <sethtmlpagefooter name="footer" value="on"/>

  {{-- Tabla --}}
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
      @foreach($entradas as $e)
        <tr>
          <td style="text-align:center;">{{ $loop->iteration }}</td>
          <td>{{ $e->material->clave }}</td>
          <td>{{ $e->material->descripcion }}</td>
          <td style="text-align:center;">{{ number_format($e->cantidad, 2) }}</td>
          <td style="text-align:center;">{{ $e->fecha_movimiento->format('d/m/Y H:i') }}</td>
        </tr>
      @endforeach
      @if($entradas->isEmpty())
        <tr>
          <td colspan="5" style="text-align:center; padding:10px;">
            No se encontraron entradas para esta fecha.
          </td>
        </tr>
      @endif
    </tbody>
  </table>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Movimientos Mensuales</title>
    <style>
        @page { margin: 160px 40px 100px 40px; footer: html_footer; }
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .encabezado { text-align: center; margin-top: -120px; }
        .encabezado h2 { color: #800000; margin: 5px 0; }
        .encabezado p { margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 5px; }
        th { background-color: #800000; color: white; }
        thead { display: table-header-group; }
        tr { page-break-inside: avoid; }
        .footer { font-size: 10px; color: #666; text-align: center; }
    </style>
</head>
<body>

@php
    \Carbon\Carbon::setLocale('es');
@endphp

<div class="encabezado">
    <img src="{{ public_path('images/Logo.svg') }}" alt="Logo ISSSTE" width="80">
    <h2>MOVIMIENTOS MENSUALES</h2>
    <p>Período: {{ $from->format('d/m/Y') }} – {{ $to->format('d/m/Y') }}</p>
    <p>Generado: {{ now()->translatedFormat('l j \\d\\e F \\d\\e\\l Y') }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Clave</th>
            <th>Tipo</th>
            <th class="text-right">Cantidad</th>
            <th>Unidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach($movimientos as $mov)
        <tr>
            <td>{{ \Carbon\Carbon::parse($mov->fecha_movimiento)->format('d/m/Y') }}</td>
            <td>{{ $mov->material->clave }}</td>
            <td>{{ ucfirst($mov->tipo) }}</td>
            <td align="right">{{ number_format($mov->cantidad,2) }}</td>
            <td>{{ $mov->unidad }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<htmlpagefooter name="footer">
    <div class="footer">
        Hospital Regional Presidente Benito Juárez del ISSSTE – Unidad de Abasto<br>
        Página {PAGENO} de {nbpg}
    </div>
</htmlpagefooter>

</body>
</html>

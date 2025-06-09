<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Próximos a Caducar</title>
    <style>
        @page { margin: 160px 40px 100px 40px; footer: html_footer; }
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .encabezado { text-align: center; margin-top: -120px; }
        .encabezado h2 { color: #800000; margin: 5px 0; }
        .encabezado p { margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; page-break-inside: auto; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #800000; color: white; }
        thead { display: table-header-group; }
        tr { page-break-inside: avoid; }
        .footer { font-size: 10px; color: #666; text-align: center; }
    </style>
</head>
<body>

@php
    \Carbon\Carbon::setLocale('es');
    $hoy = \Carbon\Carbon::now()->translatedFormat('l j \d\e F \d\e\l Y');
@endphp

<div class="encabezado">
    <img src="{{ public_path('images/Logo.svg') }}" alt="Logo ISSSTE" width="80">
    <h2>MATERIALES PRÓXIMOS A CADUCAR</h2>
    <p>Rango: {{ \Carbon\Carbon::parse($from)->format('d/m/Y') }} – {{ \Carbon\Carbon::parse($to)->format('d/m/Y') }}</p>
    <p>Generado el {{ $hoy }}</p>
</div>

<table>
    <thead>
        <tr>
            <th class="text-center">Fecha Caducidad</th>
            <th>Clave</th>
            <th>Descripción</th>
            <th class="text-right">Cantidad</th>
            <th>Unidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movimientos as $mov)
        <tr>
            <td class="text-center">{{ $mov->fecha_caducidad->format('d/m/Y') }}</td>
            <td>{{ $mov->material->clave }}</td>
            <td>{{ $mov->material->descripcion }}</td>
            <td class="text-right">{{ number_format($mov->cantidad,2) }}</td>
            <td>{{ $mov->unidad }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<htmlpagefooter name="footer">
    <div class="footer">
        Hospital Regional Presidente Benito Juárez del ISSSTE - Unidad de Abasto<br>
        Página {PAGENO} de {nbpg}
    </div>
</htmlpagefooter>

</body>
</html>

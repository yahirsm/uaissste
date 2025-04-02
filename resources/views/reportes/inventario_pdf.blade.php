<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Inventario</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 14px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
        }
        .header h2 {
            color: #800000; /* Guinda */
            margin: 5px 0;
        }
        .subtitulo {
            font-size: 16px;
            color: #333;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid black; 
            padding: 8px; 
            text-align: left; 
        }
        th { 
            background-color: #800000; /* Guinda */
            color: white;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('images/Logo.svg') }}" alt="Logo ISSSTE"> 
        <h2>REPORTE DE INVENTARIO</h2>
        <p class="subtitulo">UNIDAD DE ABASTO - HOSPITAL REGIONAL PRESIDENTE BENITO JUÁREZ DEL ISSSTE</p>
    </div>

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
            @foreach ($materiales as $material)
                <tr>
                    <td>{{ $material->id }}</td>
                    <td>{{ $material->descripcion }}</td>
                    <td>{{ $material->partida->nombre ?? 'N/A' }}</td>
                    <td>{{ $material->tipoInsumo->nombre ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

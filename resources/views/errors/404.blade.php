<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página no encontrada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">
    <div class="bg-white px-8 py-10 rounded-2xl shadow-2xl max-w-lg w-full text-center border-t-8 border-red-700">
        
        <!-- Logo + texto institucional -->
        <div class="flex flex-col items-center justify-center mb-6">
            <img src="{{ asset('images/Logo.svg') }}" alt="Logo ISSSTE" class="w-20 mb-2">
            <p class="text-xs text-yellow-600 font-semibold leading-tight">INSTITUTO DE SEGURIDAD Y SERVICIOS SOCIALES DE LOS TRABAJADORES DEL ESTADO</p>
        </div>

        <!-- Mensaje de error -->
        <h1 class="text-3xl font-extrabold text-red-700 mb-2">Página no encontrada</h1>
        <p class="text-gray-600 mb-6">
            Lo sentimos, la página que estás buscando no existe o ha sido eliminada.
        </p>

        <!-- Botón -->
        <a href="{{ route('dashboard') }}"
           class="inline-block px-6 py-2 bg-red-700 text-white font-semibold rounded-lg shadow-md hover:bg-red-800 transition">
            Volver al inicio
        </a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
    {{ config('app.name','Laravel') }}
    @if(request()->routeIs('login')) · Iniciar Sesión @endif
  </title>

  {{-- Fuentes --}}
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

  {{-- Vite --}}
  @vite(['resources/css/app.css','resources/js/app.js'])
  {{-- Livewire --}}
  @livewireStyles

  <style>
    html, body { height:100%; margin:0; padding:0; overflow:hidden; background:#000; }
  </style>
</head>
<body class="antialiased">

  @if(request()->routeIs('login'))
    {{-- Imagen de fondo ampliada al 120% y centrada --}}
    <div
      class="fixed inset-0 bg-center bg-no-repeat"
      style="
        background-image: url('{{ asset('images/unidad2.png') }}');
        background-size: 105% auto;
      "
    ></div>
    {{-- Capa seminegra encima --}}
    <div class="fixed inset-0 bg-black/40"></div>
  @endif

  {{-- Contenido centrado siempre --}}
  <div class="fixed inset-0 flex items-center justify-center">
    {{ $slot }}
  </div>

  @livewireScripts
</body>
</html>

{{-- resources/views/components/guest-layout.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}
    @if(request()->routeIs('login')) · Iniciar Sesión @endif
  </title>

  <!-- Fuentes -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

  <!-- Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Livewire / Alpine si los usas -->
  @livewireStyles

  <style>
    html, body { height: 100%; margin: 0; padding: 0; }
  </style>
</head>
<body class="antialiased">
  <div class="h-screen flex items-center justify-center relative overflow-hidden">

    {{-- Solo en /login: fondo + capa oscura --}}
    @if(request()->routeIs('login'))
      <div
        class="absolute inset-0 bg-top bg-cover"
        style="background-image: url('{{ asset('images/unidad2.png') }}');">
      </div>
      <div class="absolute inset-0 bg-black/40"></div>
    @endif

    {{-- Slot de la vista (login, register, etc.) --}}
    <div class="relative z-10 w-full max-w-md px-4">
      {{ $slot }}
    </div>
  </div>

  @livewireScripts
</body>
</html>

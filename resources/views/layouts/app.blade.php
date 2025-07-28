<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ISSSTE') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/png">

    <!-- Choices.js CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
    />

    <!-- Your Tailwind/App CSS & JS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire styles -->
    @livewireStyles

    <style>
      /* globally scale down if you like */
      body { zoom: 0.8; }
      /* limit dropdown height and enable scroll */
      .choices__list--dropdown {
        max-height: 300px !important;
        overflow-y: auto !important;
      }
    </style>
</head>
<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Optional page header -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Main content slot -->
        @yield('content')
        {{ $slot ?? '' }}
    </div>

    <!-- Livewire scripts -->
    @livewireScripts

    <!-- SweetAlert2 (already in your snippet) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Choices.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('select[data-trigger]').forEach((el) => {
          new Choices(el, {
            placeholder: true,
            placeholderValue: 'Buscar o seleccionar...',
            searchPlaceholderValue: 'Escribe para buscar...',
            shouldSort: false,
            itemSelectText: '',
            position: 'bottom',
            searchEnabled: true,
            removeItemButton: false,
            maxItemCount: 1,
            renderChoiceLimit: 300,
            classNames: {
              containerOuter: 'choices bg-blue-50 rounded',
            }
          });
        });
      });
    </script>
</body>
</html>

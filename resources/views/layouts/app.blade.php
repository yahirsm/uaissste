<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!---
<script>
    let isClosing = false;
    window.addEventListener('pagehide', (event) => {
        const navigationType = performance.getEntriesByType('navigation')[0]?.type;
        if (navigationType !== 'reload' && navigationType !== 'navigate' && !isClosing) {
            isClosing = true;
            const data = new FormData();
            data.append('_token', '{{ csrf_token() }}');
            navigator.sendBeacon('/logout', data);
            setTimeout(() => { isClosing = false; }, 100);
        }
    });
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            isClosing = false;
        }
    });
</script> -->

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

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/png">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        @yield('content')

        {{ $slot ?? '' }}
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>

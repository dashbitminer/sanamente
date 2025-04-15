<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- <script src="{{ asset('resources/js/component.js') }}"></script> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @fluxStyles
</head>

<body class="h-full font-sans antialiased">
    <div class="min-h-screen bg-gray-100 ">

        <div x-data="{ open: false, openMenu: true }" @keydown.window.escape="open = false; openMenu = false">

            <livewire:layout.sidebar>

            <div :class="{ 'lg:pl-72': openMenu }">
                <livewire:layout.topbar>

                <main class="py-10">
                    <div 
                        class="px-4 mx-auto sm:px-6 lg:px-8"
                        :class="{ 'max-w-8xl': openMenu }">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

    </div>
    @fluxScripts
</body>

</html>

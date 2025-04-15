<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{ asset('images/glasswing-butterfly.png') }}" type="image/png">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">

        {{-- <div class="w-full max-w-xs px-6 py-4 mt-6 overflow-hidden">
            <a href="/" wire:navigate>
                <div class="flex flex-col items-center justify-center">
                    <div class="w-full mb-4">
                        <img src="{{ asset('images/Azul_SM.png') }}" alt="Azul SM" class="w-full">
                    </div>
                    <div class="w-full">
                        <img src="{{ asset('images/Glasswing-logo.png') }}" alt="Glasswing" class="w-full">
                    </div>
                </div>
            </a>
        </div> --}}


        <div class="w-full max-w-lg px-6 py-4 mt-6 overflow-hidden">
            <a href="/" wire:navigate>
            <div class="flex flex-col items-center justify-between sm:flex-row">
                <div class="flex w-full mt-4 sm:w-1/2">
                    <img src="{{ asset('images/Azul_SM.png') }}" alt="Azul SM" class="w-full">
                </div>
                <div class="flex w-full sm:w-1/2">
                    <img src="{{ asset('images/Glasswing-logo.png') }}" alt="Glasswing" class="w-full">
                </div>
            </div>
            </a>
        </div>

        <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>

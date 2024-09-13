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

    <!-- Scripts -->
    @vite(['resources/css/app.css'])

</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="h-dvh flex flex-col justify-center bg-white dark:bg-gray-900">

        <div class="w-full m-auto md:max-w-96 md:w-96">
            <div class="flex justify-center">
                <a href="/">

                    <div
                        class="h-52 w-52 bg-white dark:bg-gray-800 flex flex-col gap-3 items-center justify-center rounded-full shadow">
                        <img class="h-28 -mt-5" src="{{ Vite::asset('resources/js/assets/app-logo.png') }}" alt="">
                        <h2 class="text uppercase font-semibold dark:text-white"> DISCITE ADMIN </h2>
                    </div>
                </a>
            </div>

            <div class="w-full px-6 py-4 ">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
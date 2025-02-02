<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </div>
        
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'JAZAKH-ALLAH VENTURES' }}</title>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>


           {{ $slot }}
           <body class="mt-16 bg-yellow-100">
           @livewire('nav')
           <br/>

           @livewire('footer')

    </body>
</html>

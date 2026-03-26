<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/x-icon" href="{{ asset('favela-v8.ico') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favela-v8.ico') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favela-v8.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('favela-v8.png') }}">

        @yield('head')

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Sora:wght@300;400;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @yield('styles')
        </style>
    </head>
    <body>
        @yield('content')
        @yield('scripts')
    </body>
</html>

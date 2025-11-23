<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="livewire-base-path" content="{{ parse_url(config('app.url'), PHP_URL_PATH) }}">
        <base href="{{ config('app.url') }}/">

        <title>{{ config('barangay.name', 'Barangay') }} - Monitoring Dashboard</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <style>
            body {
                margin: 0;
                padding: 0;
                background: #0f172a;
                color: #e2e8f0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
        </style>
        
        @livewireStyles
    </head>
    <body>
        {{ $slot }}
        @livewireScripts
    </body>
</html>


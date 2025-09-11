<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Fallback CSS -->
        <style>
            .auth-bg {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 1rem;
                background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
                position: relative;
                overflow: hidden;
            }

            .bg-decoration {
                position: absolute;
                border-radius: 50%;
                filter: blur(60px);
                opacity: 0.2;
            }

            .bg-decoration:nth-child(1) {
                top: -5rem;
                right: -5rem;
                width: 15rem;
                height: 15rem;
                background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            }

            .bg-decoration:nth-child(2) {
                bottom: -5rem;
                left: -5rem;
                width: 15rem;
                height: 15rem;
                background: linear-gradient(45deg, #8b5cf6, #ec4899);
            }
        </style>
    </head>
    <body style="font-family: 'Inter', sans-serif; color: #1f2937; margin: 0; padding: 0;">
        <div class="auth-bg min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 to-indigo-50">
            <!-- Background decorative elements -->
            <div class="bg-decoration"></div>
            <div class="bg-decoration"></div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
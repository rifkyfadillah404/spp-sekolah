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
            .login-container {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 1.5rem 1rem;
                background: linear-gradient(135deg, #f0f9ff 0%, #e0e7ff 50%, #f3e8ff 100%);
                position: relative;
                overflow: hidden;
            }

            .bg-decoration {
                position: absolute;
                border-radius: 50%;
                filter: blur(60px);
                opacity: 0.3;
                animation: float 6s ease-in-out infinite;
            }

            .bg-decoration:nth-child(1) {
                top: -10rem;
                right: -8rem;
                width: 20rem;
                height: 20rem;
                background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            }

            .bg-decoration:nth-child(2) {
                bottom: -10rem;
                left: -8rem;
                width: 20rem;
                height: 20rem;
                background: linear-gradient(45deg, #8b5cf6, #ec4899);
                animation-delay: 2s;
            }

            .bg-decoration:nth-child(3) {
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 24rem;
                height: 24rem;
                background: linear-gradient(45deg, #6366f1, #3b82f6);
                animation-delay: 4s;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }

            .login-card {
                position: relative;
                z-index: 10;
                width: 100%;
                max-width: 28rem;
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 1.5rem;
                padding: 2.5rem 2rem;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                transition: all 0.3s ease;
            }

            .login-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 32px 64px -12px rgba(0, 0, 0, 0.35);
            }

            .logo-container {
                text-align: center;
                margin-bottom: 2rem;
            }

            .logo {
                display: inline-block;
                width: 5rem;
                height: 5rem;
                background: linear-gradient(135deg, #3b82f6, #8b5cf6);
                border-radius: 1rem;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.5rem;
                box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.4);
                animation: pulse-slow 3s ease-in-out infinite;
            }

            @keyframes pulse-slow {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }

            .title {
                font-size: 2.5rem;
                font-weight: 700;
                color: #1f2937;
                margin-bottom: 0.5rem;
            }

            .subtitle {
                font-size: 1.125rem;
                color: #6b7280;
                margin-bottom: 2rem;
            }

            .welcome-text {
                font-size: 1.5rem;
                font-weight: 700;
                color: #1f2937;
                margin-bottom: 0.5rem;
            }

            .welcome-desc {
                font-size: 0.875rem;
                color: #6b7280;
                margin-bottom: 2rem;
            }
        </style>
    </head>
    <body style="font-family: 'Inter', sans-serif; color: #1f2937; margin: 0; padding: 0;">
        <div class="login-container min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
            <!-- Background decorative elements -->
            <div class="bg-decoration"></div>
            <div class="bg-decoration"></div>
            <div class="bg-decoration"></div>

            <div class="logo-container">
                <a href="/">
                    <div class="logo w-20 h-20 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 pulse-slow shadow-lg">
                        <svg style="width: 2.5rem; height: 2.5rem; color: white;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </a>
                <h1 class="title text-4xl font-bold text-gray-900 mb-2">SPP Sekolah</h1>
                <p class="subtitle text-lg text-gray-600">Sistem Pembayaran SPP Digital</p>
            </div>

            <!-- Login Card -->
            <div class="login-card w-full sm:max-w-md mt-6 px-8 py-10 bg-white/80 backdrop-blur-sm shadow-2xl overflow-hidden sm:rounded-3xl border border-white/20 card-hover">
                <div style="text-align: center; margin-bottom: 2rem;">
                    <h2 class="welcome-text text-2xl font-bold text-gray-900">Selamat Datang</h2>
                    <p class="welcome-desc mt-2 text-sm text-gray-600">Silakan masuk ke akun Anda</p>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPP Sekolah - Sistem Pembayaran SPP Digital</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        secondary: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --gradient-primary: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
            --gradient-secondary: linear-gradient(135deg, #7dd3fc 0%, #0ea5e9 100%);
            --gradient-accent: linear-gradient(135deg, #06b6d4 0%, #0e7490 100%);
        }

        .hero-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0c4a6e 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .btn-primary {
            background: var(--gradient-primary);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(2, 132, 199, 0.4);
        }

        .btn-outline {
            border: 2px solid white;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: white;
            color: #0f172a;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
        }

        .feature-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.1) 0%, rgba(2, 132, 199, 0.1) 100%);
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1);
            background: var(--gradient-primary);
        }

        .stats-card {
            transition: all 0.3s ease;
            border-radius: 20px;
            overflow: hidden;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .cta-gradient {
            background: var(--gradient-primary);
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(2, 132, 199, 0.2);
        }

        /* Scroll indicator animation */
        .scroll-indicator {
            animation: scrollBounce 2s infinite;
        }

        @keyframes scrollBounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-10px);}
            60% {transform: translateY(-5px);}
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .hero-content {
                padding-top: 80px;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.25rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="font-inter antialiased">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-effect">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-graduation-cap text-2xl text-white mr-3"></i>
                        <h1 class="text-2xl font-bold text-white font-poppins">SPP Sekolah</h1>
                    </div>
                </div>

                @if (Route::has('login'))
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-white hover:text-blue-200 px-5 py-2.5 rounded-xl text-base font-medium transition-all duration-300 hover:bg-white/10">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-white text-primary-800 hover:bg-gray-100 px-6 py-2.5 rounded-xl text-base font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Masuk
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient min-h-screen flex items-center justify-center relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-1/4 left-10 w-64 h-64 bg-white opacity-5 rounded-full floating"></div>
            <div class="absolute bottom-1/3 right-10 w-80 h-80 bg-white opacity-5 rounded-full floating" style="animation-delay: -3s;"></div>
            <div class="absolute top-1/3 right-1/4 w-40 h-40 bg-blue-300 opacity-10 rounded-full floating" style="animation-delay: -5s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 hero-content">
            <div class="fade-in delay-1">
                <h1 class="hero-title text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight font-poppins">
                    Portal Pembayaran
                    <span class="block bg-clip-text text-transparent bg-gradient-to-r from-cyan-300 to-blue-100">
                        SPP Sekolah
                    </span>
                </h1>
            </div>

            <div class="fade-in delay-2 max-w-3xl mx-auto">
                <p class="hero-subtitle text-xl md:text-2xl text-gray-200 mb-10 leading-relaxed">
                    Bayar SPP dengan mudah dan aman melalui sistem pembayaran digital sekolah.
                    Akses untuk siswa, orang tua, dan administrasi sekolah.
                </p>
            </div>

            <div class="fade-in delay-3">
                <div class="flex flex-col sm:flex-row gap-5 justify-center items-center">
                    @guest
                        <a href="{{ route('login') }}" class="btn-primary text-white px-8 py-4 rounded-2xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-xl">
                            <i class="fas fa-sign-in-alt mr-3"></i>
                            Masuk ke Akun
                        </a>
                        <a href="{{ route('register') }}" class="btn-outline text-white px-8 py-4 rounded-2xl text-lg font-semibold transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-user-plus mr-3"></i>
                            Daftar Sekarang
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="btn-primary text-white px-8 py-4 rounded-2xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-xl">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Buka Dashboard
                        </a>
                    @endguest
                </div>
            </div>/
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="fade-in">
                    <h2 class="text-4xl md:text-5xl font-bold text-secondary-900 mb-6 font-poppins">
                        Fitur Unggulan
                    </h2>
                    <p class="text-xl text-secondary-600 max-w-3xl mx-auto leading-relaxed">
                        Fitur-fitur yang memudahkan pembayaran dan pengelolaan SPP sekolah dengan teknologi terkini
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 feature-grid">
                <!-- Feature 1 -->
                <div class="bg-white rounded-3xl p-8 shadow-lg card-hover feature-card fade-in delay-1">
                    <div class="feature-icon mb-6">
                        <i class="fas fa-wallet text-2xl text-primary-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-secondary-900 mb-4">Pembayaran Digital</h3>
                    <p class="text-secondary-600 leading-relaxed">
                        Bayar SPP dengan mudah melalui berbagai metode pembayaran digital yang aman dan terpercaya.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-3xl p-8 shadow-lg card-hover feature-card fade-in delay-2">
                    <div class="feature-icon mb-6">
                        <i class="fas fa-sync-alt text-2xl text-primary-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-secondary-900 mb-4">Tracking Real-time</h3>
                    <p class="text-secondary-600 leading-relaxed">
                        Pantau status pembayaran secara real-time dengan notifikasi otomatis untuk setiap transaksi.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-3xl p-8 shadow-lg card-hover feature-card fade-in delay-3">
                    <div class="feature-icon mb-6">
                        <i class="fas fa-chart-line text-2xl text-primary-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-secondary-900 mb-4">Laporan Lengkap</h3>
                    <p class="text-secondary-600 leading-relaxed">
                        Dapatkan laporan pembayaran yang detail dan komprehensif untuk keperluan administrasi sekolah.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white rounded-3xl p-8 shadow-lg card-hover feature-card fade-in delay-4">
                    <div class="feature-icon mb-6">
                        <i class="fas fa-shield-alt text-2xl text-primary-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-secondary-900 mb-4">Keamanan Terjamin</h3>
                    <p class="text-secondary-600 leading-relaxed">
                        Sistem keamanan berlapis dengan enkripsi data untuk melindungi informasi pribadi dan keuangan.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white rounded-3xl p-8 shadow-lg card-hover feature-card fade-in delay-5">
                    <div class="feature-icon mb-6">
                        <i class="fas fa-bell text-2xl text-primary-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-secondary-900 mb-4">Notifikasi Otomatis</h3>
                    <p class="text-secondary-600 leading-relaxed">
                        Terima notifikasi otomatis untuk pengingat pembayaran dan konfirmasi transaksi yang berhasil.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white rounded-3xl p-8 shadow-lg card-hover feature-card fade-in delay-6">
                    <div class="feature-icon mb-6">
                        <i class="fas fa-users text-2xl text-primary-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-secondary-900 mb-4">Multi User Access</h3>
                    <p class="text-secondary-600 leading-relaxed">
                        Akses untuk siswa, orang tua, dan admin sekolah dengan hak akses yang disesuaikan dengan peran masing-masing.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="fade-in">
                    <h2 class="text-4xl md:text-5xl font-bold text-secondary-900 mb-8 font-poppins">
                        Mengapa Menggunakan Sistem Ini?
                    </h2>
                    <div class="space-y-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-clock text-primary-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-2xl font-bold text-secondary-900 mb-2">Efisiensi Waktu</h3>
                                <p class="text-secondary-600 text-lg leading-relaxed">
                                    Hemat waktu dengan proses pembayaran yang cepat dan otomatis tanpa perlu antri.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-eye text-primary-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-2xl font-bold text-secondary-900 mb-2">Transparansi Penuh</h3>
                                <p class="text-secondary-600 text-lg leading-relaxed">
                                    Lihat riwayat pembayaran dan status tagihan dengan jelas dan transparan.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-mobile-alt text-primary-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-2xl font-bold text-secondary-900 mb-2">Akses 24/7</h3>
                                <p class="text-secondary-600 text-lg leading-relaxed">
                                    Bayar SPP kapan saja dan dimana saja dengan akses sistem yang tersedia 24 jam.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative fade-in">
                    <div class="cta-gradient p-1 rounded-3xl">
                        <div class="bg-white rounded-3xl p-10 text-center">
                            <div class="w-24 h-24 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-rocket text-primary-600 text-4xl"></i>
                            </div>
                            <h3 class="text-3xl font-bold text-secondary-900 mb-4">Siap Memulai?</h3>
                            <p class="text-secondary-600 text-lg mb-8 leading-relaxed">
                                Mulai gunakan sistem pembayaran SPP digital yang mudah dan aman untuk sekolah kita.
                            </p>
                            @guest
                                <a href="{{ route('register') }}" class="btn-primary text-white px-8 py-4 rounded-2xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 inline-block shadow-xl">
                                    <i class="fas fa-user-plus mr-3"></i>
                                    Daftar Sekarang
                                </a>
                            @else
                                <a href="{{ url('/dashboard') }}" class="btn-primary text-white px-8 py-4 rounded-2xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 inline-block shadow-xl">
                                    <i class="fas fa-tachometer-alt mr-3"></i>
                                    Buka Dashboard
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-24 bg-gradient-to-r from-primary-700 to-primary-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 fade-in">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-poppins">
                    Keunggulan Sistem
                </h2>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                    Manfaat yang didapatkan dengan menggunakan sistem pembayaran SPP digital
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 stats-grid">
                <div class="stats-card bg-white/10 backdrop-blur-sm p-8 text-center fade-in delay-1">
                    <div class="text-5xl font-bold text-white mb-3">24/7</div>
                    <div class="text-xl text-blue-100 font-medium">Akses Kapan Saja</div>
                    <p class="text-blue-200 mt-3">Bayar SPP kapan saja, di mana saja tanpa batasan waktu</p>
                </div>

                <div class="stats-card bg-white/10 backdrop-blur-sm p-8 text-center fade-in delay-2">
                    <div class="text-5xl font-bold text-white mb-3">100%</div>
                    <div class="text-xl text-blue-100 font-medium">Aman & Terpercaya</div>
                    <p class="text-blue-200 mt-3">Keamanan data terjamin dengan enkripsi tingkat tinggi</p>
                </div>

                <div class="stats-card bg-white/10 backdrop-blur-sm p-8 text-center fade-in delay-3">
                    <div class="text-5xl font-bold text-white mb-3">Real-time</div>
                    <div class="text-xl text-blue-100 font-medium">Update Status</div>
                    <p class="text-blue-200 mt-3">Informasi pembayaran selalu diperbarui secara langsung</p>
                </div>

                <div class="stats-card bg-white/10 backdrop-blur-sm p-8 text-center fade-in delay-4">
                    <div class="text-5xl font-bold text-white mb-3">Multi</div>
                    <div class="text-xl text-blue-100 font-medium">Metode Bayar</div>
                    <p class="text-blue-200 mt-3">Berbagai pilihan pembayaran yang mudah dan aman</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-secondary-900 pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 mb-16">
                <div class="lg:col-span-2">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-graduation-cap text-3xl text-white mr-3"></i>
                        <h3 class="text-3xl font-bold text-white font-poppins">SPP Sekolah</h3>
                    </div>
                    <p class="text-secondary-300 mb-6 text-lg leading-relaxed max-w-md">
                        Portal pembayaran SPP sekolah yang modern, aman, dan mudah digunakan untuk siswa, orang tua, dan admin sekolah.
                    </p>
                    <div class="flex space-x-5">
                        <a href="#" class="text-secondary-400 hover:text-white transition-all duration-300 hover:scale-110">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-secondary-400 hover:text-white transition-all duration-300 hover:scale-110">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-secondary-400 hover:text-white transition-all duration-300 hover:scale-110">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-secondary-400 hover:text-white transition-all duration-300 hover:scale-110">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-xl font-bold text-white mb-6">Produk</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-secondary-300 hover:text-white transition-colors duration-300 text-lg">Pembayaran SPP</a></li>
                        <li><a href="#" class="text-secondary-300 hover:text-white transition-colors duration-300 text-lg">Laporan Keuangan</a></li>
                        <li><a href="#" class="text-secondary-300 hover:text-white transition-colors duration-300 text-lg">Manajemen Siswa</a></li>
                        <li><a href="#" class="text-secondary-300 hover:text-white transition-colors duration-300 text-lg">Notifikasi</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-bold text-white mb-6">Dukungan</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-secondary-300 hover:text-white transition-colors duration-300 text-lg">Bantuan</a></li>
                        <li><a href="#" class="text-secondary-300 hover:text-white transition-colors duration-300 text-lg">Dokumentasi</a></li>
                        <li><a href="#" class="text-secondary-300 hover:text-white transition-colors duration-300 text-lg">Kontak</a></li>
                        <li><a href="#" class="text-secondary-300 hover:text-white transition-colors duration-300 text-lg">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-bold text-white mb-6">Perusahaan</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-secondary-300 hover:text-white transition-colors duration-300 text-lg">Tentang Kami</a></li>
                        <li><a href="#" class="text-secondary-300 hover:text-white transition-colors duration-300 text-lg">Karir</a></li>
                        <li><a href="#" class="text-secondary-300 hover:text-white transition-colors duration-300 text-lg">Privacy Policy</a></li>
                        <li><a href="#" class="text-secondary-300 hover:text-white transition-colors duration-300 text-lg">Terms of Service</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-secondary-800 pt-10 text-center">
                <p class="text-secondary-400 text-lg">
                    &copy; {{ date('Y') }} SPP Sekolah. Semua hak dilindungi.
                    <span class="text-secondary-600 block mt-2">Laravel v{{ Illuminate\Foundation\Application::VERSION }}</span>
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Simple fade-in animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1
            });

            fadeElements.forEach(element => {
                element.style.opacity = 0;
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                observer.observe(element);
            });
        });
    </script>
</body>
</html>

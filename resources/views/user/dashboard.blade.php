<x-app-layout>

    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-xl mb-8 overflow-hidden">
                <div class="px-6 py-8 sm:px-10 sm:py-10">
                    <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                        <div class="flex-1 text-center lg:text-left">
                            <div class="inline-flex items-center px-3 py-1 bg-white bg-opacity-20 rounded-full mb-4">
                                <i class="fas fa-graduation-cap mr-2"></i>
                                <span class="text-sm font-medium text-blue-100">Sistem Pembayaran SPP</span>
                            </div>
                            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-4">
                                Selamat Datang, <span class="underline decoration-white decoration-2">{{ Auth::user()->name }}</span>!
                            </h1>
                            <p class="text-blue-100 text-base sm:text-lg md:text-xl mb-8 max-w-2xl leading-relaxed">
                                Kelola pembayaran SPP Anda dengan mudah dan aman melalui dashboard yang intuitif dan responsif.
                            </p>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                                <a href="{{ route('user.bills') }}"
                                   class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-semibold rounded-xl hover:bg-blue-50 transition-all duration-300 shadow-md hover:shadow-lg">
                                    <i class="fas fa-file-invoice mr-2"></i>
                                    Lihat Tagihan Saya
                                </a>
                                <a href="{{ route('profile.edit') }}"
                                   class="inline-flex items-center px-6 py-3 bg-transparent border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:bg-opacity-10 transition-all duration-300">
                                    <i class="fas fa-user-edit mr-2"></i>
                                    Edit Profil
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="inline-block">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="flex-shrink-0 relative">
                            <div class="relative w-32 h-32 sm:w-40 sm:h-40 md:w-48 md:h-48">
                                <div class="absolute inset-0 bg-white bg-opacity-20 rounded-full flex items-center justify-center animate-pulse"></div>
                                <div class="absolute inset-2 bg-white bg-opacity-10 rounded-full flex items-center justify-center"></div>
                                <div class="absolute inset-4 bg-white rounded-full flex items-center justify-center shadow-lg">
                                    <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-graduate text-3xl sm:text-4xl md:text-5xl text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-crown text-yellow-800"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-3 bg-black bg-opacity-10">
                    <div class="flex flex-wrap items-center justify-center gap-6 text-sm text-blue-100">
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt mr-2"></i>
                            <span>Keamanan Terjamin</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-bolt mr-2"></i>
                            <span>Pembayaran Cepat</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-receipt mr-2"></i>
                            <span>Riwayat Transaksi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Unpaid Bills Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-14 h-14 {{ $unpaidBills->count() > 0 ? 'bg-red-100' : 'bg-green-100' }} rounded-xl flex items-center justify-center">
                                @if ($unpaidBills->count() > 0)
                                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                                @else
                                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                                @endif
                            </div>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-500">Tagihan Belum Dibayar</p>
                            <p
                                class="text-2xl font-bold {{ $unpaidBills->count() > 0 ? 'text-red-600' : 'text-green-600' }} mt-1">
                                {{ $unpaidBills->count() }}
                            </p>
                        </div>
                    </div>
                    @if ($unpaidBills->count() > 0)
                        <div class="mt-4">
                            <a href="{{ route('user.bills') }}"
                               class="text-sm text-red-600 hover:text-red-700 font-medium flex items-center">
                                <i class="fas fa-eye mr-1"></i>
                                Lihat detail
                                <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Paid Bills Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-500">Tagihan Lunas</p>
                            <p class="text-2xl font-bold text-green-600 mt-1">{{ $paidBills->count() }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('user.bills') }}"
                           class="text-sm text-green-600 hover:text-green-700 font-medium flex items-center">
                            <i class="fas fa-history mr-1"></i>
                            Riwayat pembayaran
                            <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Bills Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-file-invoice text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-500">Total Tagihan</p>
                            <p class="text-2xl font-bold text-blue-600 mt-1">{{ $totalBills }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('user.bills') }}"
                           class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center">
                            <i class="fas fa-list mr-1"></i>
                            Lihat semua
                            <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Menu Utama</h3>
                    <div class="w-12 h-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Lihat Tagihan -->
                    <a href="{{ route('user.bills') }}"
                        class="group relative bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 hover:from-blue-100 hover:to-blue-200 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg border border-blue-100">
                        <div
                            class="absolute top-4 right-4 opacity-10 group-hover:opacity-20 transition-opacity duration-300">
                            <i class="fas fa-file-invoice text-4xl text-blue-600"></i>
                        </div>
                        <div class="relative">
                            <div
                                class="w-14 h-14 bg-blue-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-700 transition-colors duration-300">
                                <i class="fas fa-file-invoice text-white text-xl"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">Tagihan SPP</h4>
                            <p class="text-sm text-gray-600">Lihat semua tagihan dan status pembayaran</p>
                            <div class="flex items-center mt-3 text-blue-600 font-medium">
                                <span class="text-sm">Lihat Detail</span>
                                <i
                                    class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Edit Profil -->
                    <a href="{{ route('profile.edit') }}"
                        class="group relative bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 hover:from-green-100 hover:to-green-200 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg border border-green-100">
                        <div
                            class="absolute top-4 right-4 opacity-10 group-hover:opacity-20 transition-opacity duration-300">
                            <i class="fas fa-user-edit text-4xl text-green-600"></i>
                        </div>
                        <div class="relative">
                            <div
                                class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-700 transition-colors duration-300">
                                <i class="fas fa-user-edit text-white text-xl"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">Profil Saya</h4>
                            <p class="text-sm text-gray-600">Update informasi dan data pribadi</p>
                            <div class="flex items-center mt-3 text-green-600 font-medium">
                                <span class="text-sm">Edit Sekarang</span>
                                <i
                                    class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Riwayat Pembayaran -->
                    <a href="#"
                        class="group relative bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 hover:from-purple-100 hover:to-purple-200 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg border border-purple-100">
                        <div
                            class="absolute top-4 right-4 opacity-10 group-hover:opacity-20 transition-opacity duration-300">
                            <i class="fas fa-receipt text-4xl text-purple-600"></i>
                        </div>
                        <div class="relative">
                            <div
                                class="w-14 h-14 bg-purple-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-700 transition-colors duration-300">
                                <i class="fas fa-receipt text-white text-xl"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">Riwayat Bayar</h4>
                            <p class="text-sm text-gray-600">Lihat histori semua pembayaran</p>
                            <div class="flex items-center mt-3 text-purple-600 font-medium">
                                <span class="text-sm">Lihat Riwayat</span>
                                <i
                                    class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Support -->
                    <a href="#"
                        class="group relative bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 hover:from-orange-100 hover:to-orange-200 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg border border-orange-100">
                        <div
                            class="absolute top-4 right-4 opacity-10 group-hover:opacity-20 transition-opacity duration-300">
                            <i class="fas fa-life-ring text-4xl text-orange-600"></i>
                        </div>
                        <div class="relative">
                            <div
                                class="w-14 h-14 bg-orange-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-700 transition-colors duration-300">
                                <i class="fas fa-life-ring text-white text-xl"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">Bantuan</h4>
                            <p class="text-sm text-gray-600">Hubungi tim support untuk bantuan</p>
                            <div class="flex items-center mt-3 text-orange-600 font-medium">
                                <span class="text-sm">Hubungi Kami</span>
                                <i
                                    class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Bills Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Tagihan Terbaru</h3>
                    <a href="{{ route('user.bills') }}"
                        class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center">
                        <i class="fas fa-list mr-1"></i>
                        Lihat Semua
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                <div class="p-6">
                    @if ($recentBills->count() > 0)
                        <div class="space-y-4">
                            @foreach ($recentBills as $bill)
                                <div
                                    class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200 border border-gray-100">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0
                                        @if ($bill->status === 'paid') bg-green-100
                                        @elseif($bill->status === 'pending') bg-yellow-100
                                        @else bg-red-100 @endif">
                                            @if ($bill->status === 'paid')
                                                <i class="fas fa-check text-green-600"></i>
                                            @elseif($bill->status === 'pending')
                                                <i class="fas fa-clock text-yellow-600"></i>
                                            @else
                                                <i class="fas fa-times text-red-600"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">SPP {{ $bill->month }}
                                                {{ $bill->year }}</h4>
                                            <p class="text-sm text-gray-500 mt-1">
                                                <i class="far fa-calendar-alt mr-1"></i>
                                                Jatuh tempo: {{ $bill->due_date->format('d M Y') }}
                                                @if ($bill->is_overdue && $bill->status === 'unpaid')
                                                    <span class="text-red-500 font-medium ml-2">
                                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                                        (Terlambat)
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <div class="font-bold text-gray-900 text-lg mb-1">{{ $bill->formatted_amount }}</div>
                                        @if ($bill->status === 'paid')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                Lunas
                                            </span>
                                        @elseif($bill->status === 'pending')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i>
                                                Pending
                                            </span>
                                        @elseif($bill->is_overdue)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                                Terlambat
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <i class="fas fa-hourglass-half mr-1"></i>
                                                Belum Bayar
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 text-center">
                            <a href="{{ route('user.bills') }}"
                                class="inline-flex items-center px-6 py-2.5 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors duration-200 shadow-sm">
                                <i class="fas fa-file-invoice mr-2"></i>
                                Lihat Semua Tagihan
                            </a>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-file-invoice text-2xl text-gray-400"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Tagihan</h4>
                            <p class="text-gray-500 mb-6 max-w-md mx-auto">
                                Saat ini belum ada tagihan SPP yang tersedia.
                            </p>
                            <div
                                class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg text-sm">
                                <i class="fas fa-info-circle mr-2"></i>
                                Periksa kembali nanti
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Information Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <!-- Payment Methods -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center mb-5">
                        <h3 class="text-lg font-semibold text-gray-900">Metode Pembayaran</h3>
                        <div class="ml-3 w-3 h-3 bg-blue-500 rounded-full"></div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-university text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Transfer Bank</h4>
                                <p class="text-sm text-gray-500">Transfer langsung ke rekening sekolah</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-green-50 rounded-lg">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-credit-card text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Virtual Account</h4>
                                <p class="text-sm text-gray-500">Bayar melalui virtual account</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-purple-50 rounded-lg">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-wallet text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">E-Wallet</h4>
                                <p class="text-sm text-gray-500">Bayar via e-wallet (OVO, Gopay, dll)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center mb-5">
                        <h3 class="text-lg font-semibold text-gray-900">Hubungi Kami</h3>
                        <div class="ml-3 w-3 h-3 bg-green-500 rounded-full"></div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-envelope text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Email</h4>
                                <p class="text-sm text-gray-500">admin@sekolah.com</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-green-50 rounded-lg">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-phone text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Telepon</h4>
                                <p class="text-sm text-gray-500">(021) 1234-5678</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-yellow-50 rounded-lg">
                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Jam Operasional</h4>
                                <p class="text-sm text-gray-500">Senin - Jumat, 08:00 - 17:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Status Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Status Card -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-8">
                    <!-- Status Header -->
                    <div class="text-center mb-8">
                        @if($payment->transaction_status === 'settlement')
                            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-check-circle text-4xl text-green-600"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-green-600 mb-2">Pembayaran Berhasil!</h2>
                            <p class="text-gray-600">Terima kasih, pembayaran SPP Anda telah berhasil diproses.</p>
                        @elseif($payment->transaction_status === 'pending')
                            <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-clock text-4xl text-yellow-600"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-yellow-600 mb-2">Pembayaran Pending</h2>
                            <p class="text-gray-600">Pembayaran Anda sedang diproses. Mohon tunggu konfirmasi.</p>
                        @elseif(in_array($payment->transaction_status, ['cancel', 'deny', 'expire']))
                            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-times-circle text-4xl text-red-600"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-red-600 mb-2">Pembayaran Gagal</h2>
                            <p class="text-gray-600">Pembayaran tidak dapat diproses. Silakan coba lagi.</p>
                        @else
                            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-info-circle text-4xl text-blue-600"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-blue-600 mb-2">Status Pembayaran</h2>
                            <p class="text-gray-600">Status: {{ ucfirst($payment->transaction_status) }}</p>
                        @endif
                    </div>

                    <!-- Payment Details -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Detail Pembayaran</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Order ID:</span>
                                        <span class="font-medium">{{ $payment->order_id }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Transaction ID:</span>
                                        <span class="font-medium">{{ $payment->transaction_id ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Jumlah:</span>
                                        <span class="font-bold text-lg text-blue-600">{{ $payment->formatted_amount }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Metode Bayar:</span>
                                        <span class="font-medium">{{ $payment->payment_type ? ucfirst($payment->payment_type) : '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Status:</span>
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            @if($payment->transaction_status === 'settlement') bg-green-100 text-green-800
                                            @elseif($payment->transaction_status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($payment->transaction_status) }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Waktu Bayar:</span>
                                        <span class="font-medium">
                                            {{ $payment->transaction_time ? $payment->transaction_time->format('d F Y H:i:s') : '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-semibold mb-3">Tagihan yang Dibayar:</h4>
                                @if($payment->sppBills->count() > 0)
                                    <div class="space-y-2">
                                        @foreach($payment->sppBills as $bill)
                                            <div class="flex items-center justify-between p-3 bg-white rounded-lg border">
                                                <div>
                                                    <div class="font-medium">{{ $bill->month }} {{ $bill->year }}</div>
                                                    <div class="text-sm text-gray-600">{{ $bill->student->name }}</div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="font-semibold text-blue-600">{{ $bill->formatted_amount }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 text-center py-4">Tidak ada tagihan terkait.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Status Messages -->
                    @if($payment->transaction_status === 'settlement')
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-green-800">Pembayaran Berhasil!</h4>
                                    <p class="text-green-700 text-sm">
                                        Pembayaran SPP Anda telah berhasil diproses dan tagihan telah lunas.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @elseif($payment->transaction_status === 'pending')
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-clock text-yellow-600 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-yellow-800">Pembayaran Sedang Diproses</h4>
                                    <p class="text-yellow-700 text-sm">
                                        Pembayaran Anda sedang dalam proses verifikasi. Status akan diperbarui secara otomatis.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @elseif(in_array($payment->transaction_status, ['cancel', 'deny', 'expire']))
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-times-circle text-red-600 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-red-800">Pembayaran Tidak Berhasil</h4>
                                    <p class="text-red-700 text-sm">
                                        Pembayaran tidak dapat diproses. Silakan coba lagi atau hubungi admin jika masalah berlanjut.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="{{ route('user.dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                        </a>
                        <a href="{{ route('user.bills') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                            <i class="fas fa-file-invoice mr-2"></i> Lihat Semua Tagihan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

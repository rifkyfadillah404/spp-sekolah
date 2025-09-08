<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tagihan SPP') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-8 mb-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Tagihan SPP Anda</h1>
                        <p class="text-blue-100">Kelola pembayaran SPP dengan mudah dan transparan</p>
                    </div>
                    <div class="hidden sm:block">
                        <i class="fas fa-file-invoice-dollar text-6xl opacity-20"></i>
                    </div>
                </div>
            </div>

            @if($bills->count() > 0)
                <!-- Quick Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                        <div class="text-3xl font-bold text-blue-600 mb-2">{{ $bills->total() }}</div>
                        <div class="text-sm text-gray-600">Total Tagihan</div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                        <div class="text-3xl font-bold text-green-600 mb-2">{{ $bills->where('status', 'paid')->count() }}</div>
                        <div class="text-sm text-gray-600">Sudah Lunas</div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                        <div class="text-3xl font-bold text-yellow-600 mb-2">{{ $bills->where('status', 'pending')->count() }}</div>
                        <div class="text-sm text-gray-600">Pending</div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                        <div class="text-3xl font-bold text-red-600 mb-2">{{ $bills->where('status', 'unpaid')->count() }}</div>
                        <div class="text-sm text-gray-600">Belum Bayar</div>
                    </div>
                </div>

                <!-- Bills List -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4">Daftar Tagihan</h3>

                        <div class="space-y-4">
                            @foreach($bills as $bill)
                                <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-calendar-alt text-blue-600"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold text-lg">{{ $bill->month }} {{ $bill->year }}</h4>
                                                    <p class="text-sm text-gray-600">Jatuh tempo: {{ $bill->due_date->format('d/m/Y') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <div class="text-2xl font-bold text-gray-900 mb-2">{{ $bill->formatted_amount }}</div>

                                            @if($bill->status === 'paid')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-check mr-1"></i> Lunas
                                                </span>
                                            @elseif($bill->status === 'pending')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-clock mr-1"></i> Pending
                                                </span>
                                            @elseif($bill->is_overdue)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i> Terlambat
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                                    <i class="fas fa-times mr-1"></i> Belum Bayar
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if($bill->payment && $bill->payment->transaction_time)
                                        <div class="mt-3 pt-3 border-t">
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-gray-600">Dibayar pada: {{ $bill->payment->transaction_time->format('d/m/Y H:i') }}</span>
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                                                    {{ ucfirst($bill->payment->payment_type) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                    @if($bill->is_overdue && $bill->status === 'unpaid')
                                        <div class="mt-3 p-3 bg-red-50 rounded-lg">
                                            <div class="flex items-center text-red-700">
                                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                                <span class="text-sm">Terlambat {{ $bill->due_date->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $bills->links() }}
                        </div>
                    </div>
                </div>

                <!-- Financial Summary -->
                <div class="mt-8 bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4">Ringkasan Keuangan</h3>

                        @php
                            $totalAmount = $bills->sum('amount');
                            $paidAmount = $bills->where('status', 'paid')->sum('amount');
                            $unpaidAmount = $bills->where('status', 'unpaid')->sum('amount');
                        @endphp

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <div class="text-2xl font-bold text-blue-600 mb-1">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                                <div class="text-sm text-gray-600">Total Tagihan</div>
                            </div>
                            <div class="text-center p-4 bg-green-50 rounded-lg">
                                <div class="text-2xl font-bold text-green-600 mb-1">Rp {{ number_format($paidAmount, 0, ',', '.') }}</div>
                                <div class="text-sm text-gray-600">Sudah Dibayar</div>
                            </div>
                            <div class="text-center p-4 bg-red-50 rounded-lg">
                                <div class="text-2xl font-bold text-red-600 mb-1">Rp {{ number_format($unpaidAmount, 0, ',', '.') }}</div>
                                <div class="text-sm text-gray-600">Belum Dibayar</div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-invoice text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Tagihan</h3>
                    <p class="text-gray-600 mb-6">Anda belum memiliki tagihan SPP. Hubungi admin jika ada pertanyaan.</p>
                    <a href="{{ route('user.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

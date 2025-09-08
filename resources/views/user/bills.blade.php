<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tagihan SPP') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl p-6 mb-6 text-white shadow-xl">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-2xl md:text-3xl font-bold mb-2">Tagihan SPP Anda</h1>
                        <p class="text-blue-100 text-sm md:text-base">Kelola pembayaran SPP dengan mudah dan transparan</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-full">
                        <i class="fas fa-file-invoice-dollar text-3xl opacity-90"></i>
                    </div>
                </div>
            </div>

            @if($bills->count() > 0)
                <!-- Quick Summary Cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-xl shadow-md p-4 border border-gray-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-blue-100 mr-4">
                                <i class="fas fa-receipt text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">{{ $bills->total() }}</div>
                                <div class="text-xs text-gray-500">Total Tagihan</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md p-4 border border-gray-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-green-100 mr-4">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">{{ $bills->where('status', 'paid')->count() }}</div>
                                <div class="text-xs text-gray-500">Sudah Lunas</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md p-4 border border-gray-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-amber-100 mr-4">
                                <i class="fas fa-clock text-amber-600 text-xl"></i>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">{{ $bills->where('status', 'pending')->count() }}</div>
                                <div class="text-xs text-gray-500">Pending</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md p-4 border border-gray-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-rose-100 mr-4">
                                <i class="fas fa-exclamation-circle text-rose-600 text-xl"></i>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">{{ $bills->where('status', 'unpaid')->count() }}</div>
                                <div class="text-xs text-gray-500">Belum Bayar</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bills List -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-6">
                    <div class="p-5 border-b border-gray-200 bg-gray-50">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                            <h3 class="text-lg font-semibold text-gray-900">Daftar Tagihan</h3>
                            <button id="pay-selected" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg hover:opacity-90 transition-all duration-300 shadow-md hidden text-sm font-medium">
                                <i class="fas fa-credit-card mr-2"></i> Bayar Tagihan Terpilih
                            </button>
                        </div>
                    </div>

                    <div class="divide-y divide-gray-200">
                        @foreach($bills as $bill)
                            <div class="p-5 hover:bg-blue-50 transition-colors duration-200">
                                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                                    <div class="flex items-center w-full md:w-auto">
                                        @if($bill->status === 'unpaid')
                                        <div class="mr-3">
                                            <input type="checkbox" class="bill-checkbox w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 focus:ring-2 cursor-pointer" 
                                                data-bill-id="{{ $bill->id }}" 
                                                data-amount="{{ $bill->amount }}" 
                                                data-description="{{ $bill->month }} {{ $bill->year }}"
                                            >
                                        </div>
                                        @endif
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-calendar-alt text-blue-600"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900">{{ $bill->month }} {{ $bill->year }}</h4>
                                                <p class="text-xs text-gray-500">Jatuh tempo: {{ $bill->due_date->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-full md:w-auto md:text-right">
                                        <div class="text-xl font-bold text-gray-900 mb-2">{{ $bill->formatted_amount }}</div>

                                        @if($bill->status === 'paid')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                <i class="fas fa-check mr-1"></i> Lunas
                                            </span>
                                        @elseif($bill->status === 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                                <i class="fas fa-clock mr-1"></i> Pending
                                            </span>
                                        @elseif($bill->is_overdue)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-800 border border-rose-200">
                                                <i class="fas fa-exclamation-triangle mr-1"></i> Terlambat
                                            </span>
                                        @else
                                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                                    <i class="fas fa-times mr-1"></i> Belum Bayar
                                                </span>
                                                <button 
                                                    class="mt-1 sm:mt-0 inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-md hover:opacity-90 transition-all duration-300 text-xs font-medium shadow-sm"
                                                    data-bill-id="{{ $bill->id }}"
                                                    data-amount="{{ $bill->amount }}"
                                                    data-description="Pembayaran SPP {{ $bill->month }} {{ $bill->year }}"
                                                >
                                                    <i class="fas fa-credit-card mr-1"></i> Bayar
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if($bill->payment && $bill->payment->transaction_time)
                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between text-xs gap-2">
                                            <span class="text-gray-600">Dibayar pada: {{ $bill->payment->transaction_time->format('d/m/Y H:i') }}</span>
                                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full border border-blue-200">
                                                {{ ucfirst($bill->payment->payment_type) }}
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                @if($bill->is_overdue && $bill->status === 'unpaid')
                                    <div class="mt-3 p-3 bg-rose-50 rounded-lg border border-rose-200">
                                        <div class="flex items-center text-rose-700 text-sm">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            <span>Terlambat {{ $bill->due_date->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="p-5 border-t border-gray-200 bg-gray-50">
                        {{ $bills->links() }}
                    </div>
                </div>

                <!-- Financial Summary -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                    <div class="p-5 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Ringkasan Keuangan</h3>
                    </div>
                    <div class="p-5">
                        @php
                            $totalAmount = $bills->sum('amount');
                            $paidAmount = $bills->where('status', 'paid')->sum('amount');
                            $unpaidAmount = $bills->where('status', 'unpaid')->sum('amount');
                        @endphp

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="p-4 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl border border-blue-200 shadow-sm">
                                <div class="text-lg font-bold text-blue-700 mb-1">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                                <div class="text-xs text-gray-600">Total Tagihan</div>
                                <div class="mt-2 w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border border-green-200 shadow-sm">
                                <div class="text-lg font-bold text-green-700 mb-1">Rp {{ number_format($paidAmount, 0, ',', '.') }}</div>
                                <div class="text-xs text-gray-600">Sudah Dibayar</div>
                                <div class="mt-2 w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $totalAmount > 0 ? ($paidAmount/$totalAmount)*100 : 0 }}%"></div>
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl border border-amber-200 shadow-sm">
                                <div class="text-lg font-bold text-amber-700 mb-1">Rp {{ number_format($unpaidAmount, 0, ',', '.') }}</div>
                                <div class="text-xs text-gray-600">Belum Dibayar</div>
                                <div class="mt-2 w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-amber-600 h-2.5 rounded-full" style="width: {{ $totalAmount > 0 ? ($unpaidAmount/$totalAmount)*100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-md p-10 text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-invoice text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Tagihan</h3>
                    <p class="text-gray-600 mb-6 text-sm">Anda belum memiliki tagihan SPP. Hubungi admin jika ada pertanyaan.</p>
                    <a href="{{ route('user.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-lg hover:opacity-90 transition-all duration-300 shadow-md text-sm font-medium">
                        <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                    </a>
                </div>
            @endif
        </div>
    </div>
    <!-- Midtrans Script -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Individual payment buttons
            const payButtons = document.querySelectorAll('.pay-button');
            payButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const billId = this.getAttribute('data-bill-id');
                    const amount = this.getAttribute('data-amount');
                    const description = this.getAttribute('data-description');
                    
                    processPayment([billId], amount, description);
                });
            });

            // Checkboxes for multiple bills
            const billCheckboxes = document.querySelectorAll('.bill-checkbox');
            const paySelectedButton = document.getElementById('pay-selected');
            
            // Show/hide pay selected button based on checkbox selection
            billCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const checkedBoxes = document.querySelectorAll('.bill-checkbox:checked');
                    if (checkedBoxes.length > 0) {
                        paySelectedButton.classList.remove('hidden');
                    } else {
                        paySelectedButton.classList.add('hidden');
                    }
                });
            });
            
            // Pay selected bills
            paySelectedButton.addEventListener('click', function() {
                const checkedBoxes = document.querySelectorAll('.bill-checkbox:checked');
                if (checkedBoxes.length === 0) return;
                
                const billIds = [];
                let totalAmount = 0;
                let descriptions = [];
                
                checkedBoxes.forEach(checkbox => {
                    billIds.push(checkbox.getAttribute('data-bill-id'));
                    totalAmount += parseInt(checkbox.getAttribute('data-amount'));
                    descriptions.push(checkbox.getAttribute('data-description'));
                });
                
                const description = `Pembayaran SPP: ${descriptions.join(', ')}`;
                processPayment(billIds, totalAmount, description);
            });
            
            // Process payment with Midtrans
            function processPayment(billIds, amount, description) {
                // Show loading indicator
                const loadingOverlay = document.createElement('div');
                loadingOverlay.className = 'fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50';
                loadingOverlay.innerHTML = `
                    <div class="bg-white p-6 rounded-xl shadow-2xl text-center animate-pulse">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                        <p class="text-gray-800 font-medium text-lg">Memproses pembayaran...</p>
                    </div>
                `;
                document.body.appendChild(loadingOverlay);
                
                // Call payment API
                fetch('{{ route("payment.create") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        spp_bill_ids: billIds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Remove loading overlay
                    document.body.removeChild(loadingOverlay);
                    
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    
                    // Open Midtrans Snap popup
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            window.location.href = '/payment/finish?order_id=' + data.order_id;
                        },
                        onPending: function(result) {
                            window.location.href = '/payment/finish?order_id=' + data.order_id;
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal: ' + result.status_message);
                            window.location.reload();
                        },
                        onClose: function() {
                            alert('Anda menutup popup pembayaran sebelum menyelesaikan pembayaran');
                        }
                    });
                })
                .catch(error => {
                    // Remove loading overlay
                    document.body.removeChild(loadingOverlay);
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
                });
            }
        });
    </script>
</x-app-layout>

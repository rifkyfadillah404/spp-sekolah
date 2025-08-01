<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Demo Mode Banner -->
            @if (config('services.midtrans.server_key') === 'SB-Mid-server-CtVCUiLZBY6ivDfRtGAyBHNt')
                <div class="alert alert-warning mb-4">
                    <h5><i class="fas fa-exclamation-triangle"></i> DEMO MODE</h5>
                    <p class="mb-0">Aplikasi berjalan dalam mode demo. Pembayaran akan disimulasikan tanpa transaksi
                        nyata.</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Selamat datang, {{ $student->name }}!</h3>
                            <p class="text-muted">NIS: {{ $student->nis }} | Kelas: {{ $student->class }}</p>

                            @if ($unpaidBills->count() > 0)
                                <div class="card mt-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Tagihan SPP Belum Dibayar</h5>
                                        <button class="btn btn-primary" onclick="paySelectedBills()">
                                            Bayar Sekarang
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <form id="paymentForm">
                                            @csrf
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <input type="checkbox" id="selectAll"
                                                                    onchange="toggleAll()">
                                                            </th>
                                                            <th>Bulan</th>
                                                            <th>Tahun</th>
                                                            <th>Jumlah</th>
                                                            <th>Jatuh Tempo</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($unpaidBills as $bill)
                                                            <tr class="{{ $bill->is_overdue ? 'table-danger' : '' }}">
                                                                <td>
                                                                    <input type="checkbox" name="spp_bill_ids[]"
                                                                        value="{{ $bill->id }}"
                                                                        class="bill-checkbox">
                                                                </td>
                                                                <td>{{ $bill->month }}</td>
                                                                <td>{{ $bill->year }}</td>
                                                                <td>{{ $bill->formatted_amount }}</td>
                                                                <td>{{ $bill->due_date->format('d/m/Y') }}</td>
                                                                <td>
                                                                    @if ($bill->is_overdue)
                                                                        <span class="badge bg-danger">Terlambat</span>
                                                                    @else
                                                                        <span class="badge bg-warning">Belum
                                                                            Bayar</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-success mt-4">
                                    <h5>Selamat!</h5>
                                    <p>Semua tagihan SPP Anda sudah lunas.</p>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Riwayat Pembayaran Terakhir</h5>
                                </div>
                                <div class="card-body">
                                    @if ($recentPayments->count() > 0)
                                        @foreach ($recentPayments as $payment)
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <small
                                                        class="text-muted">{{ $payment->created_at->format('d/m/Y') }}</small>
                                                    <br>
                                                    <span class="fw-bold">{{ $payment->formatted_amount }}</span>
                                                </div>
                                                <span class="badge bg-{{ $payment->status_badge }}">
                                                    {{ ucfirst($payment->transaction_status) }}
                                                </span>
                                            </div>
                                            <hr>
                                        @endforeach
                                        <a href="{{ route('user.bills') }}"
                                            class="btn btn-sm btn-outline-primary w-100">
                                            Lihat Semua
                                        </a>
                                    @else
                                        <p class="text-muted">Belum ada riwayat pembayaran.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Demo Payment Modal -->
    <div class="modal fade" id="demoPaymentModal" tabindex="-1" aria-labelledby="demoPaymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="demoPaymentModalLabel">
                        <i class="fas fa-credit-card"></i> Pilih Metode Pembayaran (DEMO MODE)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <strong>Mode Demo:</strong> Pilih metode pembayaran untuk simulasi. Tidak ada transaksi nyata
                        yang akan terjadi.
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method" data-method="credit_card" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <i class="fas fa-credit-card fa-3x text-primary mb-2"></i>
                                    <h6>Kartu Kredit/Debit</h6>
                                    <small class="text-muted">Visa, Mastercard, JCB</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method" data-method="bank_transfer" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <i class="fas fa-university fa-3x text-success mb-2"></i>
                                    <h6>Transfer Bank</h6>
                                    <small class="text-muted">BCA, BNI, BRI, Mandiri</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method" data-method="gopay" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <i class="fas fa-mobile-alt fa-3x text-info mb-2"></i>
                                    <h6>GoPay</h6>
                                    <small class="text-muted">Pembayaran digital</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method" data-method="ovo" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <i class="fas fa-wallet fa-3x text-warning mb-2"></i>
                                    <h6>OVO</h6>
                                    <small class="text-muted">E-wallet</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method" data-method="dana" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <i class="fas fa-coins fa-3x text-primary mb-2"></i>
                                    <h6>DANA</h6>
                                    <small class="text-muted">Digital wallet</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method" data-method="indomaret" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <i class="fas fa-store fa-3x text-danger mb-2"></i>
                                    <h6>Indomaret</h6>
                                    <small class="text-muted">Bayar di toko</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <style>
            .payment-method {
                transition: all 0.3s ease;
                border: 2px solid transparent;
            }

            .payment-method:hover {
                border-color: #007bff;
                box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
                transform: translateY(-2px);
            }

            .payment-method:active {
                transform: translateY(0);
            }
        </style>
        <script>
            function toggleAll() {
                const selectAll = document.getElementById('selectAll');
                const checkboxes = document.querySelectorAll('.bill-checkbox');

                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAll.checked;
                });
            }

            function paySelectedBills() {
                const selectedBills = document.querySelectorAll('.bill-checkbox:checked');

                if (selectedBills.length === 0) {
                    alert('Pilih tagihan yang akan dibayar terlebih dahulu.');
                    return;
                }

                const billIds = Array.from(selectedBills).map(cb => cb.value);

                fetch('{{ route('payment.create') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            spp_bill_ids: billIds
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.snap_token) {
                            // Check if it's demo mode
                            if (data.snap_token.startsWith('demo-snap-token-')) {
                                // Demo mode - show payment method selection
                                showDemoPaymentModal(data.order_id, billIds);
                            } else {
                                // Real Midtrans
                                snap.pay(data.snap_token, {
                                    onSuccess: function(result) {
                                        alert("Pembayaran berhasil!");
                                        window.location.reload();
                                    },
                                    onPending: function(result) {
                                        alert("Menunggu pembayaran!");
                                        window.location.reload();
                                    },
                                    onError: function(result) {
                                        alert("Pembayaran gagal!");
                                    }
                                });
                            }
                        } else {
                            alert('Error: ' + (data.error || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memproses pembayaran.');
                    });
            }

            function showDemoPaymentModal(orderId, billIds) {
                // Store data for later use
                window.currentOrderId = orderId;
                window.currentBillIds = billIds;

                // Show modal
                const modal = new bootstrap.Modal(document.getElementById('demoPaymentModal'));
                modal.show();
            }

            // Handle payment method selection
            document.addEventListener('DOMContentLoaded', function() {
                const paymentMethods = document.querySelectorAll('.payment-method');

                paymentMethods.forEach(method => {
                    method.addEventListener('click', function() {
                        const selectedMethod = this.getAttribute('data-method');
                        const methodName = this.querySelector('h6').textContent;

                        // Close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'demoPaymentModal'));
                        modal.hide();

                        // Show confirmation
                        if (confirm(
                                `Konfirmasi pembayaran dengan ${methodName}?\n\nMode Demo: Pembayaran akan berhasil secara otomatis.`
                            )) {
                            // Simulate successful payment
                            fetch('{{ route('payment.notification') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    order_id: window.currentOrderId,
                                    transaction_status: 'settlement',
                                    status_code: '200',
                                    gross_amount: '500000',
                                    payment_type: selectedMethod
                                })
                            }).then(() => {
                                alert(`DEMO: Pembayaran berhasil dengan ${methodName}!`);
                                window.location.reload();
                            });
                        }
                    });

                    // Add hover effect
                    method.addEventListener('mouseenter', function() {
                        this.style.transform = 'scale(1.05)';
                        this.style.transition = 'transform 0.2s';
                    });

                    method.addEventListener('mouseleave', function() {
                        this.style.transform = 'scale(1)';
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>

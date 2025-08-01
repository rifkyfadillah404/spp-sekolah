<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 fw-bold text-dark">Dashboard Siswa</h2>
                <p class="text-muted mb-0">Selamat datang, {{ $student->name }}!</p>
            </div>
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                style="width: 60px; height: 60px; font-size: 24px;">
                {{ strtoupper(substr($student->name, 0, 2)) }}
            </div>
        </div>
    </x-slot>

    <div class="row">
        <!-- Demo Mode Banner -->
        @if (config('services.midtrans.server_key') === 'SB-Mid-server-CtVCUiLZBY6ivDfRtGAyBHNt')
            <div class="col-12 mb-4">
                <div class="alert alert-warning border-0" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-20 rounded-circle p-2 me-3">
                            <i class="fas fa-exclamation-triangle text-warning"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold">Mode Demo Aktif</h6>
                            <p class="mb-0 small">
                                Aplikasi berjalan dalam mode demo. Pembayaran akan disimulasikan tanpa transaksi nyata.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Student Info Card -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-user me-2"></i>
                        Informasi Siswa
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 80px; height: 80px; font-size: 32px;">
                            {{ strtoupper(substr($student->name, 0, 2)) }}
                        </div>
                        <h5 class="fw-bold">{{ $student->name }}</h5>
                        <p class="text-muted mb-0">{{ $student->class }}</p>
                    </div>

                    <hr>

                    <div class="row text-center">
                        <div class="col-6">
                            <div class="bg-primary bg-opacity-10 rounded p-3 mb-2">
                                <h4 class="mb-1 fw-bold text-primary">{{ $student->nis }}</h4>
                                <small class="text-muted">NIS</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-success bg-opacity-10 rounded p-3 mb-2">
                                <h4 class="mb-1 fw-bold text-success">{{ $student->class }}</h4>
                                <small class="text-muted">Kelas</small>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <p class="mb-1"><i class="fas fa-envelope me-2 text-muted"></i> {{ $student->user->email }}
                        </p>
                        <p class="mb-0"><i class="fas fa-phone me-2 text-muted"></i>
                            {{ $student->phone ?? 'Belum diisi' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-chart-pie me-2"></i>
                        Ringkasan Pembayaran
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center mb-4">
                        <div class="col-md-4 mb-3">
                            <div class="bg-info bg-opacity-10 rounded p-3">
                                <h3 class="mb-1 fw-bold text-info">{{ $bills->count() }}</h3>
                                <small class="text-muted">Total Tagihan</small>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="bg-success bg-opacity-10 rounded p-3">
                                <h3 class="mb-1 fw-bold text-success">{{ $bills->where('status', 'paid')->count() }}
                                </h3>
                                <small class="text-muted">Sudah Lunas</small>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="bg-warning bg-opacity-10 rounded p-3">
                                <h3 class="mb-1 fw-bold text-warning">{{ $bills->where('status', 'unpaid')->count() }}
                                </h3>
                                <small class="text-muted">Belum Bayar</small>
                            </div>
                        </div>
                    </div>

                    @if ($bills->where('status', 'unpaid')->count() > 0)
                        <div class="alert alert-warning border-0 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <span>Anda memiliki <strong>{{ $bills->where('status', 'unpaid')->count() }}</strong>
                                    tagihan yang belum dibayar.</span>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-success border-0 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2"></i>
                                <span>Selamat! Semua tagihan Anda sudah lunas.</span>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Total yang harus dibayar:</h6>
                            <h4 class="mb-0 fw-bold text-danger">
                                Rp {{ number_format($bills->where('status', 'unpaid')->sum('amount'), 0, ',', '.') }}
                            </h4>
                        </div>
                        @if ($bills->where('status', 'unpaid')->count() > 0)
                            <button class="btn btn-primary" onclick="scrollToPayment()">
                                <i class="fas fa-credit-card me-1"></i>
                                Bayar Sekarang
                            </button>
                        @else
                            <span class="text-success">
                                <i class="fas fa-check-circle me-1"></i>
                                Semua tagihan lunas
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Bills Table -->
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-file-invoice me-2"></i>
                        Daftar Tagihan SPP
                    </h5>
                    <div class="d-flex align-items-center">
                        @if ($bills->where('status', 'unpaid')->count() > 0)
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                                <label class="form-check-label" for="selectAll">
                                    Pilih Semua
                                </label>
                            </div>
                            <button class="btn btn-success" id="paySelectedBtn" onclick="paySelected()" disabled>
                                <i class="fas fa-credit-card me-1"></i>
                                Bayar Terpilih
                            </button>
                        @else
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>
                                Semua tagihan sudah lunas
                            </span>
                        @endif
                    </div>
                </div>
                <div class="card-body" id="payment-section">
                    @if ($bills->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        @if ($bills->where('status', 'unpaid')->count() > 0)
                                            <th width="50">
                                                <input type="checkbox" id="selectAllTable" class="form-check-input">
                                            </th>
                                        @endif
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Jumlah</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bills as $bill)
                                        <tr>
                                            @if ($bills->where('status', 'unpaid')->count() > 0)
                                                <td>
                                                    @if ($bill->status === 'unpaid')
                                                        <input type="checkbox" class="form-check-input bill-checkbox"
                                                            value="{{ $bill->id }}" onchange="updatePayButton()">
                                                    @endif
                                                </td>
                                            @endif
                                            <td class="fw-bold">{{ $bill->month }}</td>
                                            <td>{{ $bill->year }}</td>
                                            <td class="fw-bold text-primary">Rp
                                                {{ number_format($bill->amount, 0, ',', '.') }}</td>
                                            <td>
                                                <small
                                                    class="text-muted">{{ $bill->due_date->format('d M Y') }}</small>
                                                @if ($bill->status === 'unpaid' && $bill->due_date->isPast())
                                                    <br><span class="badge bg-danger">Terlambat</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($bill->status === 'paid')
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>Lunas
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning">
                                                        <i class="fas fa-clock me-1"></i>Belum Bayar
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($bill->status === 'unpaid')
                                                    <button class="btn btn-sm btn-primary"
                                                        onclick="payBill({{ $bill->id }})">
                                                        <i class="fas fa-credit-card me-1"></i>
                                                        Bayar
                                                    </button>
                                                @else
                                                    <span class="text-success">
                                                        <i class="fas fa-check-circle me-1"></i>
                                                        Sudah Dibayar
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-file-invoice fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada Tagihan</h5>
                            <p class="text-muted">Belum ada tagihan SPP yang tersedia.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Method Modal -->
    <div class="modal fade" id="demoPaymentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-credit-card me-2"></i>
                        Pilih Metode Pembayaran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted mb-4">Pilih metode pembayaran yang Anda inginkan:</p>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method h-100" data-method="credit_card"
                                style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <i class="fas fa-credit-card fa-3x text-primary mb-3"></i>
                                    <h6 class="fw-bold">Kartu Kredit/Debit</h6>
                                    <small class="text-muted">Visa, Mastercard, JCB</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method h-100" data-method="bank_transfer"
                                style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <i class="fas fa-university fa-3x text-success mb-3"></i>
                                    <h6 class="fw-bold">Transfer Bank</h6>
                                    <small class="text-muted">BCA, BNI, BRI, Mandiri</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method h-100" data-method="gopay" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <i class="fas fa-mobile-alt fa-3x text-info mb-3"></i>
                                    <h6 class="fw-bold">GoPay</h6>
                                    <small class="text-muted">Pembayaran digital</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method h-100" data-method="ovo" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <i class="fas fa-wallet fa-3x text-warning mb-3"></i>
                                    <h6 class="fw-bold">OVO</h6>
                                    <small class="text-muted">E-wallet</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method h-100" data-method="dana" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <i class="fas fa-coins fa-3x text-primary mb-3"></i>
                                    <h6 class="fw-bold">DANA</h6>
                                    <small class="text-muted">Digital wallet</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method h-100" data-method="indomaret" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <i class="fas fa-store fa-3x text-danger mb-3"></i>
                                    <h6 class="fw-bold">Indomaret</h6>
                                    <small class="text-muted">Bayar di toko</small>
                                </div>
                            </div>
                        </div>
                    </div>
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
                border-color: var(--primary-color);
                transform: translateY(-5px);
                box-shadow: var(--shadow-md);
            }

            .payment-method:active {
                transform: translateY(0);
            }
        </style>
        <script>
            function scrollToPayment() {
                document.getElementById('payment-section').scrollIntoView({
                    behavior: 'smooth'
                });
            }

            function toggleAll() {
                const selectAll = document.getElementById('selectAll');
                const selectAllTable = document.getElementById('selectAllTable');
                const checkboxes = document.querySelectorAll('.bill-checkbox');

                if (selectAll) {
                    selectAll.addEventListener('change', function() {
                        checkboxes.forEach(checkbox => {
                            checkbox.checked = this.checked;
                        });
                        if (selectAllTable) selectAllTable.checked = this.checked;
                        updatePayButton();
                    });
                }

                if (selectAllTable) {
                    selectAllTable.addEventListener('change', function() {
                        checkboxes.forEach(checkbox => {
                            checkbox.checked = this.checked;
                        });
                        if (selectAll) selectAll.checked = this.checked;
                        updatePayButton();
                    });
                }
            }

            function updatePayButton() {
                const checkboxes = document.querySelectorAll('.bill-checkbox:checked');
                const payButton = document.getElementById('paySelectedBtn');

                if (payButton) {
                    payButton.disabled = checkboxes.length === 0;
                }
            }

            function paySelected() {
                const checkboxes = document.querySelectorAll('.bill-checkbox:checked');
                const billIds = Array.from(checkboxes).map(cb => cb.value);

                if (billIds.length === 0) {
                    alert('Pilih tagihan yang ingin dibayar terlebih dahulu.');
                    return;
                }

                const orderId = 'ORDER-' + Date.now();
                showDemoPaymentModal(orderId, billIds);
            }

            function payBill(billId) {
                const orderId = 'ORDER-' + Date.now();
                showDemoPaymentModal(orderId, [billId]);
            }

            function showDemoPaymentModal(orderId, billIds) {
                window.currentOrderId = orderId;
                window.currentBillIds = billIds;

                const modal = new bootstrap.Modal(document.getElementById('demoPaymentModal'));
                modal.show();
            }

            // Handle payment method selection
            document.addEventListener('DOMContentLoaded', function() {
                toggleAll();

                const paymentMethods = document.querySelectorAll('.payment-method');

                paymentMethods.forEach(method => {
                    method.addEventListener('click', function() {
                        const selectedMethod = this.getAttribute('data-method');
                        const methodName = this.querySelector('h6').textContent;

                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'demoPaymentModal'));
                        modal.hide();

                        if (confirm(
                                `Konfirmasi pembayaran dengan ${methodName}?\n\nMode Demo: Pembayaran akan berhasil secara otomatis.`
                            )) {
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
                });
            });
        </script>
    @endpush
</x-app-layout>

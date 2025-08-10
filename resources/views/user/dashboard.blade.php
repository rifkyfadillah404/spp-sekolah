<x-app-layout>
    <x-slot name="header">
        <div class="modern-header">
            <div class="header-content">
                <div class="header-text">
                    <h1 class="header-title">Dashboard Siswa</h1>
                    <p class="header-subtitle">Selamat datang kembali, {{ $student->name }}! 👋</p>
                    <div class="header-stats">
                        <span class="stat-item">
                            <i class="fas fa-calendar-alt"></i>
                            {{ now()->format('d M Y') }}
                        </span>
                        <span class="stat-item">
                            <i class="fas fa-clock"></i>
                            {{ now()->format('H:i') }} WIB
                        </span>
                    </div>
                </div>
                <div class="header-avatar">
                    <div class="avatar-container">
                        <div class="avatar-circle">
                            {{ strtoupper(substr($student->name, 0, 2)) }}
                        </div>
                        <div class="avatar-status"></div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <style>
        .modern-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .modern-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .header-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #fff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-subtitle {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .header-stats {
            display: flex;
            gap: 1.5rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .avatar-container {
            position: relative;
        }

        .avatar-circle {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 700;
            backdrop-filter: blur(10px);
            animation: pulse-slow 3s ease-in-out infinite;
        }

        .avatar-status {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 20px;
            height: 20px;
            background: #10b981;
            border: 3px solid white;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        @keyframes pulse-slow {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        .modern-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .modern-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .modern-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .payment-method-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
        }

        .payment-method-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            transition: left 0.5s;
        }

        .payment-method-card:hover::before {
            left: 100%;
        }

        .payment-method-card:hover {
            border-color: #667eea;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
        }

        .table-modern {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .table-modern thead th {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #64748b;
            padding: 1rem;
        }

        .table-modern tbody tr {
            transition: all 0.2s ease;
        }

        .table-modern tbody tr:hover {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            transform: scale(1.01);
        }

        .badge-modern {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .btn-modern {
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
    </style>

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


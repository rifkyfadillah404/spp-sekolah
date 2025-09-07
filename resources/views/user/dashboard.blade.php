<x-app-layout>
    @php
        $totalBills = $bills->count();
        $paidCount = $bills->where('status', 'paid')->count();
        $unpaidCount = $bills->where('status', 'unpaid')->count();
        $unpaidTotal = $bills->where('status', 'unpaid')->sum('amount');
    @endphp

    <x-slot name="header">
        <div class="hero-section">
            <div class="hero-background">
                <div class="hero-gradient"></div>
                <div class="hero-particles"></div>
            </div>
            <div class="hero-content">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center gap-4">
                                <div class="user-avatar">
                                    <div class="avatar-ring"></div>
                                    <span class="avatar-text">{{ strtoupper(substr($student->name, 0, 2)) }}</span>
                                </div>
                                <div class="user-info">
                                    <h1 class="hero-title">Selamat Datang, {{ $student->name }}! 👋</h1>
                                    <p class="hero-subtitle">Kelola pembayaran SPP dengan mudah dan aman</p>
                                    <div class="user-meta">
                                        <span class="meta-chip">
                                            <i class="fas fa-id-card me-2"></i>
                                            <strong>NIS:</strong> {{ $student->nis }}
                                        </span>
                                        <span class="meta-chip">
                                            <i class="fas fa-school me-2"></i>
                                            <strong>Kelas:</strong> {{ $student->class }}
                                        </span>
                                        <span class="meta-chip">
                                            <i class="fas fa-envelope me-2"></i>
                                            {{ $student->user->email }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="hero-stats">
                                <div class="stat-item">
                                    <div class="stat-value">{{ $totalBills }}</div>
                                    <div class="stat-label">Total Tagihan</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value text-success">{{ $paidCount }}</div>
                                    <div class="stat-label">Sudah Lunas</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value text-warning">{{ $unpaidCount }}</div>
                                    <div class="stat-label">Belum Bayar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            --warning-gradient: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            --danger-gradient: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
            --dark-gradient: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 30px 60px rgba(0, 0, 0, 0.15);
            --border-radius: 16px;
            --border-radius-lg: 24px;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            margin-bottom: 2rem;
            min-height: 280px;
            background: var(--primary-gradient);
        }

        .hero-background {
            position: absolute;
            inset: 0;
            overflow: hidden;
        }

        .hero-gradient {
            position: absolute;
            inset: 0;
            background: var(--primary-gradient);
            opacity: 0.9;
        }

        .hero-particles {
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 3rem 2rem;
            color: white;
        }

        .user-avatar {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--glass-bg);
            border: 3px solid var(--glass-border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 800;
            backdrop-filter: blur(10px);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .avatar-ring {
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.3);
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .avatar-text {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0 0 0.5rem 0;
            letter-spacing: -0.5px;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0 0 1.5rem 0;
        }

        .user-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .meta-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 999px;
            font-size: 0.9rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .meta-chip:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .hero-stats {
            display: flex;
            justify-content: space-around;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Modern Cards */
        .modern-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            backdrop-filter: blur(20px);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .modern-card:hover {
            box-shadow: var(--shadow-xl);
            transform: translateY(-5px);
        }

        .card-header-modern {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            padding: 1.5rem 2rem;
            font-weight: 700;
            color: #1e293b;
            font-size: 1.1rem;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .action-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: var(--border-radius);
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .action-card:hover::before {
            left: 100%;
        }

        .action-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .action-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
            position: relative;
            z-index: 2;
        }

        .action-icon.primary { background: var(--primary-gradient); }
        .action-icon.success { background: var(--success-gradient); }
        .action-icon.warning { background: var(--warning-gradient); }

        .action-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #1e293b;
        }

        .action-description {
            color: #64748b;
            margin-bottom: 1.5rem;
        }

        .action-button {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 999px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .action-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        /* Bill Cards */
        .bill-card-modern {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .bill-card-modern:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(102, 126, 234, 0.3);
        }

        .bill-card-modern.unpaid {
            border-left: 4px solid #f59e0b;
        }

        .bill-card-modern.paid {
            border-left: 4px solid #10b981;
        }

        .bill-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .bill-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .bill-amount {
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .bill-meta {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            color: #64748b;
            font-size: 0.9rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.paid {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-badge.unpaid {
            background: rgba(245, 158, 11, 0.1);
            color: #b45309;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .status-badge.pending {
            background: rgba(59, 130, 246, 0.1);
            color: #1d4ed8;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .status-badge.late {
            background: rgba(239, 68, 68, 0.1);
            color: #b91c1c;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        /* Sidebar Cards */
        .sidebar-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .sidebar-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .sidebar-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .sidebar-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
            color: #1e293b;
        }

        /* Floating Action Button */
        .fab-container {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
        }

        .fab-main {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: white;
            border: none;
            font-size: 1.5rem;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .fab-main:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-xl);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .user-meta {
                flex-direction: column;
            }

            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }

            .fab-container {
                bottom: 1rem;
                right: 1rem;
            }
        }

        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideInUp 0.6s ease-out;
        }

        /* Loading Animation */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>

    <div class="container-fluid px-0">
        <!-- Demo Mode Banner -->
        @if (config('services.midtrans.server_key') === 'SB-Mid-server-CtVCUiLZBY6ivDfRtGAyBHNt')
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Mode Demo Aktif:</strong> Pembayaran akan disimulasikan tanpa transaksi nyata.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Quick Actions -->
                <div class="modern-card mb-4 animate-slide-up">
                    <div class="card-header-modern">
                        <i class="fas fa-bolt me-2"></i>
                        Akses Cepat
                    </div>
                    <div class="p-4">
                        <div class="quick-actions">
                            <div class="action-card" onclick="scrollToPayment()">
                                <div class="action-icon primary">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h4 class="action-title">Bayar Tagihan</h4>
                                <p class="action-description">Lunasi tagihan SPP yang belum dibayar</p>
                                @if($unpaidCount > 0)
                                    <span class="badge bg-warning position-absolute top-0 end-0 m-3">
                                        {{ $unpaidCount }} belum bayar
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('user.bills') }}" class="action-card">
                                <div class="action-icon success">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                                <h4 class="action-title">Riwayat Tagihan</h4>
                                <p class="action-description">Lihat semua tagihan dan pembayaran</p>
                            </a>

                            <a href="{{ route('profile.edit') }}" class="action-card">
                                <div class="action-icon warning">
                                    <i class="fas fa-user-cog"></i>
                                </div>
                                <h4 class="action-title">Pengaturan Akun</h4>
                                <p class="action-description">Kelola informasi akun Anda</p>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bills Section -->
                <div id="payment-section" class="modern-card animate-slide-up">
                    <div class="card-header-modern">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-wallet me-2"></i>
                                Tagihan SPP
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-outline-primary active" data-filter="all">
                                    Semua
                                </button>
                                <button class="btn btn-sm btn-outline-warning" data-filter="unpaid">
                                    Belum Bayar
                                </button>
                                <button class="btn btn-sm btn-outline-success" data-filter="paid">
                                    Lunas
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        @if($bills->count() > 0)
                            @if($unpaidCount > 0)
                                <div class="alert alert-warning alert-modern mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <strong>{{ $unpaidCount }} tagihan</strong> belum dibayar
                                        </div>
                                        <div class="text-end">
                                            <div class="small text-muted">Total yang harus dibayar</div>
                                            <div class="h5 mb-0 text-danger">
                                                Rp {{ number_format($unpaidTotal, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="vstack gap-3" id="bills-container">
                                @foreach($bills->take(5) as $bill)
                                    <div class="bill-card-modern {{ $bill->status }}" data-status="{{ $bill->status }}">
                                        <div class="bill-header">
                                            <div>
                                                <h5 class="bill-title">{{ $bill->month }} {{ $bill->year }}</h5>
                                                <div class="bill-meta">
                                                    <span><i class="fas fa-calendar me-1"></i>Jatuh tempo: {{ $bill->due_date->format('d M Y') }}</span>
                                                    @if($bill->status === 'unpaid' && $bill->due_date->isPast())
                                                        <span class="text-danger">
                                                            <i class="fas fa-exclamation-circle me-1"></i>Terlambat
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <div class="bill-amount">Rp {{ number_format($bill->amount, 0, ',', '.') }}</div>
                                                <span class="status-badge {{ $bill->status }}">
                                                    @if($bill->status === 'paid')
                                                        LUNAS
                                                    @elseif($bill->status === 'pending')
                                                        MENUNGGU
                                                    @else
                                                        BELUM BAYAR
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        @if($bill->status === 'unpaid')
                                            <button class="btn btn-primary w-100" onclick="payBill({{ $bill->id }})">
                                                <i class="fas fa-credit-card me-2"></i>
                                                Bayar Sekarang
                                            </button>
                                        @elseif($bill->status === 'paid')
                                            <div class="text-center text-success">
                                                <i class="fas fa-check-circle me-2"></i>
                                                Pembayaran berhasil
                                            </div>
                                        @elseif($bill->status === 'pending')
                                            <div class="text-center text-warning">
                                                <i class="fas fa-clock me-2"></i>
                                                Menunggu konfirmasi pembayaran
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            @if($bills->count() > 5)
                                <div class="text-center mt-4">
                                    <a href="{{ route('user.bills') }}" class="btn btn-outline-primary">
                                        Lihat Semua Tagihan
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-file-invoice fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum Ada Tagihan</h5>
                                <p class="text-muted">Belum ada tagihan SPP yang tersedia untuk Anda.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Summary Card -->
                <div class="sidebar-card animate-slide-up">
                    <div class="sidebar-header">
                        <div class="sidebar-icon" style="background: var(--primary-gradient);">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h5 class="sidebar-title">Ringkasan Pembayaran</h5>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="text-center p-3 bg-light rounded-3">
                                <div class="h3 fw-bold text-primary mb-1">{{ $totalBills }}</div>
                                <div class="small text-muted">Total Tagihan</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 bg-light rounded-3">
                                <div class="h3 fw-bold text-success mb-1">{{ $paidCount }}</div>
                                <div class="small text-muted">Sudah Lunas</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 bg-warning bg-opacity-10 border border-warning border-opacity-25 rounded-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="small text-muted">Belum Bayar</div>
                                        <div class="h5 fw-bold text-warning mb-0">{{ $unpaidCount }} Tagihan</div>
                                    </div>
                                    <div class="text-end">
                                        <div class="h5 fw-bold text-danger mb-0">
                                            Rp {{ number_format($unpaidTotal, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($unpaidCount > 0)
                        <button class="btn btn-primary w-100 mt-3" onclick="scrollToPayment()">
                            <i class="fas fa-credit-card me-2"></i>
                            Bayar Semua Tagihan
                        </button>
                    @endif
                </div>

                <!-- Recent Payments -->
                <div class="sidebar-card animate-slide-up">
                    <div class="sidebar-header">
                        <div class="sidebar-icon" style="background: var(--success-gradient);">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <h5 class="sidebar-title">Pembayaran Terbaru</h5>
                    </div>
                    @if($recentPayments->count() > 0)
                        <div class="vstack gap-3">
                            @foreach($recentPayments as $payment)
                                <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                                    <div>
                                        <div class="fw-semibold">#{{ $payment->order_id }}</div>
                                        <small class="text-muted">
                                            {{ $payment->created_at->format('d M Y H:i') }}
                                        </small>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
                                        <span class="badge bg-success">Berhasil</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-receipt fa-2x mb-3 opacity-50"></i>
                            <p>Belum ada pembayaran</p>
                        </div>
                    @endif
                </div>

                <!-- Help & Support -->
                <div class="sidebar-card animate-slide-up">
                    <div class="sidebar-header">
                        <div class="sidebar-icon" style="background: var(--secondary-gradient);">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h5 class="sidebar-title">Butuh Bantuan?</h5>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-question-circle fa-3x text-primary mb-3"></i>
                        <p class="text-muted mb-3">Jika mengalami masalah dengan pembayaran, silakan hubungi admin sekolah.</p>
                        <button class="btn btn-outline-primary w-100">
                            <i class="fas fa-phone me-2"></i>
                            Hubungi Admin
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <div class="fab-container">
        <button class="fab-main" onclick="scrollToPayment()" title="Bayar Tagihan">
            <i class="fas fa-credit-card"></i>
        </button>
    </div>

    @push('scripts')
        <script src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
                data-client-key="{{ config('services.midtrans.client_key') }}"></script>

        <script>
            function formatIDR(number) {
                try {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        maximumFractionDigits: 0
                    }).format(number);
                } catch (_) {
                    return 'Rp ' + (number || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }
            }

            function scrollToPayment() {
                const element = document.getElementById('payment-section');
                if (element) {
                    element.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    // Add highlight effect
                    element.style.boxShadow = '0 0 0 3px rgba(102, 126, 234, 0.3)';
                    setTimeout(() => {
                        element.style.boxShadow = '';
                    }, 2000);
                }
            }

            function payBill(billId) {
                // Show loading state
                const button = event.target;
                const originalText = button.innerHTML;
                button.innerHTML = '<span class="loading-spinner"></span> Memproses...';
                button.disabled = true;

                // Simulate payment processing
                setTimeout(() => {
                    requestSnap([billId]);
                    button.innerHTML = originalText;
                    button.disabled = false;
                }, 1000);
            }

            function requestSnap(billIds) {
                fetch('{{ route('payment.create') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ spp_bill_ids: billIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.snap_token) {
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                window.location.href = '{{ route('payment.finish') }}' + '?order_id=' + encodeURIComponent(result.order_id || data.order_id);
                            },
                            onPending: function() {
                                alert('Transaksi dalam proses. Anda dapat mengecek status di riwayat pembayaran.');
                                window.location.reload();
                            },
                            onError: function(err) {
                                console.error(err);
                                alert('Terjadi kesalahan saat memproses pembayaran.');
                            },
                            onClose: function() {
                                // User closed the popup
                            }
                        });
                    } else {
                        alert('Gagal membuat transaksi: ' + (data.error || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memproses pembayaran. Silakan coba lagi.');
                });
            }

            // Filter functionality
            document.addEventListener('DOMContentLoaded', function() {
                const filterButtons = document.querySelectorAll('[data-filter]');
                const billCards = document.querySelectorAll('.bill-card-modern');

                filterButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const filter = this.getAttribute('data-filter');

                        // Update active button
                        filterButtons.forEach(btn => btn.classList.remove('active'));
                        this.classList.add('active');

                        // Filter cards
                        billCards.forEach(card => {
                            const status = card.getAttribute('data-status');
                            if (filter === 'all' || status === filter) {
                                card.style.display = 'block';
                                card.classList.add('animate-slide-up');
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    });
                });

                // Add smooth scroll for all internal links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });

                // Add entrance animations
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate-slide-up');
                        }
                    });
                }, observerOptions);

                document.querySelectorAll('.modern-card, .sidebar-card').forEach(card => {
                    observer.observe(card);
                });
            });
        </script>
    @endpush
</x-app-layout>

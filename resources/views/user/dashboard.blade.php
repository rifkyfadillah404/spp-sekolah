<x-app-layout>
    @php
        $totalBills = $bills->count();
        $paidCount = $bills->where('status', 'paid')->count();
        $unpaidCount = $bills->where('status', 'unpaid')->count();
        $unpaidTotal = $bills->where('status', 'unpaid')->sum('amount');
    @endphp

    <x-slot name="header">
        <div class="hero-header">
            <div class="hero-bg"></div>
            <div class="hero-overlay">
                <div class="hero-content container-fluid px-0">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-xl">
                                    <span>{{ strtoupper(substr($student->name, 0, 2)) }}</span>
                                </div>
                                <div>
                                    <h1 class="hero-title">Beranda Kamu, {{ $student->name }} 👋</h1>
                                    <p class="hero-subtitle mb-2">Kelola dan bayar SPP dengan cepat, aman, dan terpantau realtime.</p>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="chip">
                                            <i class="fas fa-id-card me-1"></i> NIS: <strong>{{ $student->nis }}</strong>
                                        </span>
                                        <span class="chip">
                                            <i class="fas fa-school me-1"></i> Kelas: <strong>{{ $student->class }}</strong>
                                        </span>
                                        <span class="chip">
                                            <i class="fas fa-envelope me-1"></i> {{ $student->user->email }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="d-flex flex-lg-column gap-2 justify-content-lg-end justify-content-start">
                                @if ($unpaidCount > 0)
                                    <button class="btn cta-btn w-100" onclick="scrollToPayment()">
                                        <i class="fas fa-credit-card me-2"></i> Bayar Tagihan Sekarang
                                    </button>
                                @else
                                    <div class="badge-success-cta w-100 text-center">
                                        <i class="fas fa-check-circle me-1"></i> Semua tagihan sudah lunas
                                    </div>
                                @endif
                                <div class="d-flex gap-2 w-100">
                                    <div class="stat-chip flex-fill">
                                        <div class="stat-label">Total</div>
                                        <div class="stat-value">{{ $totalBills }}</div>
                                    </div>
                                    <div class="stat-chip flex-fill">
                                        <div class="stat-label">Lunas</div>
                                        <div class="stat-value text-success">{{ $paidCount }}</div>
                                    </div>
                                    <div class="stat-chip flex-fill">
                                        <div class="stat-label">Belum Bayar</div>
                                        <div class="stat-value text-warning">{{ $unpaidCount }}</div>
                                    </div>
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
            --brand-1: #667eea;
            --brand-2: #764ba2;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --muted: #64748b;
            --text: #1f2937;
            --card-bg: #ffffff;
            --soft-shadow: 0 10px 30px rgba(2, 8, 20, 0.08);
            --soft-shadow-lg: 0 20px 60px rgba(2, 8, 20, 0.12);
        }

        .hero-header {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            min-height: 180px;
        }
        .hero-bg {
            position: absolute;
            inset: 0;
            background: radial-gradient(1200px 400px at -5% -50%, rgba(255,255,255,0.16), transparent),
                        radial-gradient(800px 300px at 110% 10%, rgba(255,255,255,0.12), transparent),
                        linear-gradient(135deg, var(--brand-1) 0%, var(--brand-2) 100%);
            filter: saturate(120%);
        }
        .hero-overlay {
            position: relative;
            padding: 28px;
            color: #fff;
        }
        .hero-content { position: relative; z-index: 2; }

        .avatar-xl {
            width: 76px;
            height: 76px;
            border-radius: 20px;
            background: rgba(255,255,255,0.16);
            border: 2px solid rgba(255,255,255,0.25);
            display: grid;
            place-items: center;
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
            user-select: none;
            box-shadow: inset 0 0 0 2px rgba(255,255,255,0.07);
        }
        .hero-title {
            margin: 0;
            font-weight: 800;
            letter-spacing: -0.3px;
        }
        .hero-subtitle {
            opacity: 0.9;
            margin: 0;
        }
        .chip {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .5rem .75rem;
            border-radius: 999px;
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.25);
            font-size: .85rem;
        }
        .cta-btn {
            background: #fff;
            color: #111827;
            font-weight: 700;
            padding: .9rem 1.25rem;
            border-radius: 14px;
            border: none;
            box-shadow: var(--soft-shadow);
            transition: transform .15s ease, box-shadow .2s ease;
        }
        .cta-btn:hover { transform: translateY(-2px); box-shadow: var(--soft-shadow-lg); }
        .badge-success-cta {
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.28);
            padding: .8rem 1rem;
            border-radius: 14px;
            font-weight: 600;
        }
        .stat-chip {
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 14px;
            padding: .6rem .9rem;
            text-align: center;
        }
        .stat-label { font-size: .8rem; opacity: .85; }
        .stat-value { font-size: 1.25rem; font-weight: 800; }

        /* Cards */
        .modern-card {
            background: var(--card-bg);
            border: 1px solid rgba(2, 8, 20, 0.06);
            border-radius: 18px;
            box-shadow: var(--soft-shadow);
            overflow: hidden;
        }
        .modern-card .card-header {
            background: linear-gradient(180deg, rgba(2,8,20,0.02), rgba(2,8,20,0));
            border-bottom: 1px solid rgba(2, 8, 20, 0.06);
        }

        /* Filters */
        .filter-pills {
            background: #f8fafc;
            border-radius: 999px;
            padding: .35rem;
            display: inline-flex;
            gap: .35rem;
            border: 1px solid #e5e7eb;
        }
        .filter-pill {
            padding: .5rem .85rem;
            border-radius: 999px;
            font-weight: 600;
            color: var(--muted);
            background: transparent;
            border: none;
        }
        .filter-pill.active {
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            color: #fff;
        }

        /* Bill list */
        #payment-section { scroll-margin-top: 100px; }
        .bill-card {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1rem;
            padding: 1rem 1.125rem;
            border: 1px solid rgba(2, 8, 20, 0.06);
            border-radius: 16px;
            transition: transform .15s ease, box-shadow .2s ease, border-color .2s ease;
            background: #fff;
        }
        .bill-card:hover { transform: translateY(-2px); box-shadow: var(--soft-shadow-lg); border-color: rgba(102,126,234,.35); }
        .bill-title { font-weight: 800; margin: 0; }
        .bill-meta { color: var(--muted); font-size: .9rem; }
        .amount-lg {
            font-size: 1.35rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .badge-modern {
            padding: .4rem .7rem;
            border-radius: 999px;
            font-weight: 700;
            font-size: .75rem;
        }
        .badge-paid { background: rgba(16,185,129,.12); color: #059669; border: 1px solid rgba(16,185,129,.25); }
        .badge-unpaid { background: rgba(245,158,11,.12); color: #b45309; border: 1px solid rgba(245,158,11,.25); }
        .badge-late { background: rgba(239,68,68,.12); color: #b91c1c; border: 1px solid rgba(239,68,68,.25); }

        /* Quick actions */
        .quick-actions { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 1rem; }
        @media (max-width: 992px) { .quick-actions { grid-template-columns: 1fr; } }
        .quick-action-card {
            display: flex; align-items: center; gap: 1rem;
            padding: 1rem; border-radius: 16px; border: 1px solid rgba(2,8,20,.06);
            background: #fff; box-shadow: var(--soft-shadow);
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
            text-decoration: none; color: inherit;
        }
        .quick-action-card:hover { transform: translateY(-3px); box-shadow: var(--soft-shadow-lg); border-color: rgba(102,126,234,.35); }
        .qa-icon { width: 56px; height: 56px; border-radius: 14px; display: grid; place-items: center; color: #fff; }
        .qa-primary { background: linear-gradient(135deg, var(--brand-1), var(--brand-2)); }
        .qa-success { background: linear-gradient(135deg, #10b981, #059669); }
        .qa-warning { background: linear-gradient(135deg, #f59e0b, #d97706); }

        /* Sticky pay bar */
        .sticky-paybar {
            position: sticky; bottom: 0; z-index: 30;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(8px);
            border-top: 1px solid rgba(2,8,20,.06);
            padding: .9rem 1rem;
            box-shadow: 0 -10px 30px rgba(2,8,20,.05);
        }
        .sticky-paybar.hidden { display: none; }

        .btn-modern {
            border-radius: 12px; padding: .7rem 1rem; font-weight: 700; position: relative; overflow: hidden;
        }
        .btn-modern.btn-primary {
            background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
            border: none;
        }
        .btn-modern.btn-outline {
            background: transparent;
            border: 1px solid rgba(2,8,20,.12);
            color: var(--text);
        }
        .btn-modern:hover { transform: translateY(-1px); box-shadow: var(--soft-shadow); }

        .soft { color: var(--muted); }

        .alert-soft {
            background: #fff8e6;
            border: 1px solid #fde68a;
            color: #92400e;
            border-radius: 12px;
            padding: .9rem 1rem;
        }

        /* Homepage additions */
        .section-title { font-weight: 800; letter-spacing: -0.2px; }
        .feature-card {
            display: flex; align-items: center; gap: 1rem;
            padding: 1rem; border-radius: 16px; border: 1px solid rgba(2,8,20,.06);
            background: #fff; box-shadow: var(--soft-shadow);
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }
        .feature-card:hover { transform: translateY(-3px); box-shadow: var(--soft-shadow-lg); border-color: rgba(102,126,234,.35); }
    </style>

    <div class="container-fluid px-0">
        <div class="row g-4">

            <!-- Left Column -->
            <div class="col-lg-8">

                <!-- Demo Mode Banner -->
                @if (config('services.midtrans.server_key') === 'SB-Mid-server-CtVCUiLZBY6ivDfRtGAyBHNt')
                    <div class="alert-soft mb-2">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Mode Demo aktif. Pembayaran akan disimulasikan tanpa transaksi nyata.
                    </div>
                @endif

                <!-- Quick Actions -->
                <div class="modern-card p-3 mb-4">
                    <div class="d-flex justify-content-between align-items-center px-2">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-bolt me-2"></i> Akses Cepat</h5>
                    </div>
                    <div class="quick-actions mt-3">
                        <a class="quick-action-card" href="#payment-section" onclick="scrollToPayment()">
                            <div class="qa-icon qa-primary"><i class="fas fa-credit-card"></i></div>
                            <div>
                                <div class="fw-bold">Bayar Tagihan</div>
                                <small class="soft">Lunasi tagihan yang belum dibayar</small>
                            </div>
                            <div class="ms-auto">
                                <span class="badge bg-primary">{{ $unpaidCount }}</span>
                            </div>
                        </a>
                        <a class="quick-action-card" href="{{ route('user.bills') }}">
                            <div class="qa-icon qa-success"><i class="fas fa-file-invoice"></i></div>
                            <div>
                                <div class="fw-bold">Semua Tagihan</div>
                                <small class="soft">Lihat riwayat dan detail tagihan</small>
                            </div>
                            <div class="ms-auto">
                                <i class="fas fa-arrow-right text-success"></i>
                            </div>
                        </a>
                        <a class="quick-action-card" href="{{ route('profile.edit') }}">
                            <div class="qa-icon qa-warning"><i class="fas fa-user-cog"></i></div>
                            <div>
                                <div class="fw-bold">Pengaturan Profil</div>
                                <small class="soft">Perbarui data akun Anda</small>
                            </div>
                            <div class="ms-auto">
                                <i class="fas fa-arrow-right text-warning"></i>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Highlights / Features -->
                <div class="modern-card p-3 mb-4">
                    <div class="d-flex justify-content-between align-items-center px-2">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-stars me-2"></i> Sorotan</h5>
                    </div>
                    <div class="row g-2 mt-2">
                        <div class="col-md-4">
                            <div class="feature-card">
                                <div class="qa-icon qa-primary"><i class="fas fa-shield-alt"></i></div>
                                <div>
                                    <div class="fw-bold">Aman & Terpercaya</div>
                                    <small class="soft">Transaksi terenkripsi</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card">
                                <div class="qa-icon qa-success"><i class="fas fa-bolt"></i></div>
                                <div>
                                    <div class="fw-bold">Cepat & Praktis</div>
                                    <small class="soft">Bayar dalam hitungan detik</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card">
                                <div class="qa-icon qa-warning"><i class="fas fa-bell"></i></div>
                                <div>
                                    <div class="fw-bold">Notifikasi Otomatis</div>
                                    <small class="soft">Pengingat jatuh tempo</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bills Section -->
                <div id="payment-section" class="modern-card">
                    <div class="card-header p-3">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="mb-0 fw-bold"><i class="fas fa-wallet me-2"></i> Tagihan SPP</h5>
                                @if ($unpaidCount > 0)
                                    <span class="badge bg-warning text-dark ms-1">Belum Bayar: {{ $unpaidCount }}</span>
                                @endif
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="filter-pills">
                                    <button class="filter-pill active" data-filter="all" type="button">Semua</button>
                                    <button class="filter-pill" data-filter="unpaid" type="button">Belum Bayar</button>
                                    <button class="filter-pill" data-filter="paid" type="button">Lunas</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-3">
                        @if ($totalBills > 0)
                            @if ($unpaidCount > 0)
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAllCards">
                                        <label class="form-check-label" for="selectAllCards">Pilih Semua yang Belum Bayar</label>
                                    </div>
                                    <div class="text-end">
                                        <div class="soft small">Total yang harus dibayar</div>
                                        <div class="h5 mb-0 text-danger">
                                            Rp {{ number_format($unpaidTotal, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="vstack gap-2" id="billCardsContainer">
                                @foreach ($bills as $bill)
                                    <div class="bill-card" data-status="{{ $bill->status }}">
                                        <div class="d-flex align-items-center gap-3">
                                            @if ($bill->status === 'unpaid')
                                                <div class="form-check mt-1">
                                                    <input type="checkbox"
                                                           class="form-check-input bill-checkbox"
                                                           value="{{ $bill->id }}"
                                                           data-amount="{{ (int) $bill->amount }}"
                                                           onchange="updateSelections()">
                                                </div>
                                            @else
                                                <div style="width: 18px;"></div>
                                            @endif

                                            <div class="flex-grow-1">
                                                <div class="d-flex flex-wrap align-items-center gap-2">
                                                    <h6 class="bill-title mb-0">{{ $bill->month }} {{ $bill->year }}</h6>
                                                    @if ($bill->status === 'paid')
                                                        <span class="badge-modern badge-paid"><i class="fas fa-check me-1"></i> Lunas</span>
                                                    @else
                                                        <span class="badge-modern badge-unpaid"><i class="fas fa-clock me-1"></i> Belum Bayar</span>
                                                    @endif
                                                    @if ($bill->status === 'unpaid' && $bill->due_date->isPast())
                                                        <span class="badge-modern badge-late"><i class="fas fa-exclamation-circle me-1"></i> Terlambat</span>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-wrap gap-3 mt-1">
                                                    <div class="amount-lg">
                                                        Rp {{ number_format($bill->amount, 0, ',', '.') }}
                                                    </div>
                                                    <div class="bill-meta">
                                                        <i class="far fa-calendar-alt me-1"></i>
                                                        Jatuh Tempo: {{ $bill->due_date->format('d M Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-2">
                                            @if ($bill->status === 'unpaid')
                                                <button class="btn btn-modern btn-primary btn-sm" onclick="payBill({{ $bill->id }})">
                                                    <i class="fas fa-credit-card me-1"></i> Bayar
                                                </button>
                                            @else
                                                <span class="soft">
                                                    <i class="fas fa-check-circle text-success me-1"></i> Sudah Dibayar
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-file-invoice fa-4x soft mb-3"></i>
                                <h5 class="text-muted">Belum Ada Tagihan</h5>
                                <p class="soft">Belum ada tagihan SPP yang tersedia.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Sticky Paybar -->
                    <div id="stickyPaybar" class="sticky-paybar hidden">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="soft">
                                    <i class="fas fa-list-check me-1"></i>
                                    <span id="selectedCount">0</span> tagihan dipilih
                                </div>
                                <div class="soft d-none d-md-inline">•</div>
                                <div>
                                    <small class="soft d-block">Total Bayar</small>
                                    <span class="h5 mb-0" id="selectedTotal">Rp 0</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-modern btn-outline" id="clearSelectionBtn" type="button">Bersihkan</button>
                                <button class="btn btn-modern btn-primary" id="paySelectedBtn" onclick="paySelected()" disabled>
                                    <i class="fas fa-credit-card me-2"></i> Bayar Terpilih
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">

                <!-- Ringkasan -->
                <div class="modern-card mb-4">
                    <div class="card-header p-3">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-chart-pie me-2"></i> Ringkasan</h5>
                    </div>
                    <div class="p-3">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="p-3 rounded-3" style="background: #f0f5ff; border: 1px solid #dbeafe;">
                                    <div class="soft small">Total Tagihan</div>
                                    <div class="h4 mb-0 fw-bold">{{ $totalBills }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded-3" style="background: #ecfdf5; border: 1px solid #d1fae5;">
                                    <div class="soft small">Sudah Lunas</div>
                                    <div class="h4 mb-0 fw-bold text-success">{{ $paidCount }}</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 rounded-3" style="background: #fff7ed; border: 1px solid #fed7aa;">
                                    <div class="soft small">Belum Bayar</div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="h5 mb-0 fw-bold text-warning">{{ $unpaidCount }} Tagihan</div>
                                        <div class="fw-bold text-danger">
                                            Rp {{ number_format($unpaidTotal, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($unpaidCount > 0)
                            <button class="btn btn-modern btn-primary w-100 mt-3" onclick="scrollToPayment()">
                                <i class="fas fa-credit-card me-2"></i> Bayar Semua Tagihan Belum Lunas
                            </button>
                        @else
                            <div class="text-center soft mt-3">
                                <i class="fas fa-check-circle text-success me-1"></i> Tidak ada tagihan tertunda
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Payments -->
                <div class="modern-card mb-4">
                    <div class="card-header p-3">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-receipt me-2"></i> Pembayaran Terbaru</h5>
                    </div>
                    <div class="p-3">
                        @if ($recentPayments->count())
                            <div class="vstack gap-2">
                                @foreach ($recentPayments as $p)
                                    <div class="d-flex justify-content-between align-items-center p-2 border rounded-3">
                                        <div>
                                            <div class="fw-semibold">#{{ $p->order_id }}</div>
                                            <small class="soft">{{ optional($p->created_at)->format('d M Y H:i') }} • {{ strtoupper($p->payment_type ?? '-') }}</small>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-bold">Rp {{ number_format($p->amount, 0, ',', '.') }}</div>
                                            @php
                                                $st = $p->transaction_status ?? 'settlement';
                                            @endphp
                                            <span class="badge-modern {{ $st === 'settlement' ? 'badge-paid' : ($st === 'pending' ? 'badge-unpaid' : 'badge-late') }}">
                                                {{ $st === 'settlement' ? 'Lunas' : ($st === 'pending' ? 'Menunggu' : ucfirst($st)) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="soft">Belum ada pembayaran terbaru.</div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Payment Method Modal (Demo) -->
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
                    <p class="soft mb-4">Pilih metode pembayaran yang Anda inginkan:</p>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method h-100" data-method="credit_card" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <i class="fas fa-credit-card fa-3x text-primary mb-3"></i>
                                    <h6 class="fw-bold">Kartu Kredit/Debit</h6>
                                    <small class="text-muted">Visa, Mastercard, JCB</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card payment-method h-100" data-method="bank_transfer" style="cursor: pointer;">
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
        <script>
            function formatIDR(number) {
                try {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
                } catch (_) {
                    return 'Rp ' + (number || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }
            }

            function scrollToPayment() {
                const el = document.getElementById('payment-section');
                if (!el) return;
                el.scrollIntoView({ behavior: 'smooth' });
            }

            function updateSelections() {
                const checkboxes = document.querySelectorAll('.bill-checkbox:checked');
                const selectedCount = document.getElementById('selectedCount');
                const selectedTotal = document.getElementById('selectedTotal');
                const payBtn = document.getElementById('paySelectedBtn');
                const bar = document.getElementById('stickyPaybar');

                let total = 0;
                checkboxes.forEach(cb => total += parseInt(cb.getAttribute('data-amount') || '0', 10));

                if (selectedCount) selectedCount.textContent = checkboxes.length;
                if (selectedTotal) selectedTotal.textContent = formatIDR(total);
                if (payBtn) payBtn.disabled = checkboxes.length === 0;
                if (bar) bar.classList.toggle('hidden', checkboxes.length === 0);
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

                const modalEl = document.getElementById('demoPaymentModal');
                if (!modalEl) return;
                const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.show();
            }

            document.addEventListener('DOMContentLoaded', function () {
                // Select All handler
                const selectAll = document.getElementById('selectAllCards');
                if (selectAll) {
                    selectAll.addEventListener('change', function () {
                        const checkboxes = document.querySelectorAll('.bill-checkbox');
                        checkboxes.forEach(cb => cb.checked = selectAll.checked);
                        updateSelections();
                    });
                }

                // Clear selection
                const clearBtn = document.getElementById('clearSelectionBtn');
                if (clearBtn) {
                    clearBtn.addEventListener('click', function () {
                        const checkboxes = document.querySelectorAll('.bill-checkbox:checked');
                        checkboxes.forEach(cb => cb.checked = false);
                        if (selectAll) selectAll.checked = false;
                        updateSelections();
                    });
                }

                // Filter pills
                const pills = document.querySelectorAll('.filter-pill');
                const cards = document.querySelectorAll('.bill-card');
                pills.forEach(p => {
                    p.addEventListener('click', function () {
                        pills.forEach(x => x.classList.remove('active'));
                        this.classList.add('active');
                        const filter = this.getAttribute('data-filter');
                        cards.forEach(card => {
                            const status = card.getAttribute('data-status');
                            if (filter === 'all') {
                                card.style.display = '';
                            } else if (filter === 'paid') {
                                card.style.display = (status === 'paid') ? '' : 'none';
                            } else if (filter === 'unpaid') {
                                card.style.display = (status === 'unpaid') ? '' : 'none';
                            }
                        });
                    });
                });

                // Payment method selection (DEMO)
                const methods = document.querySelectorAll('.payment-method');
                methods.forEach(method => {
                    method.addEventListener('click', function () {
                        const selectedMethod = this.getAttribute('data-method');
                        const methodName = this.querySelector('h6')?.textContent?.trim() || selectedMethod;

                        const modal = bootstrap.Modal.getInstance(document.getElementById('demoPaymentModal'));
                        if (modal) modal.hide();

                        if (confirm(`Konfirmasi pembayaran dengan ${methodName}?\n\nMode Demo: Pembayaran akan berhasil secara otomatis.`)) {
                            fetch('{{ route('payment.notification') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    order_id: window.currentOrderId,
                                    transaction_status: 'settlement',
                                    status_code: '200',
                                    gross_amount: '{{ (int) $unpaidTotal }}',
                                    payment_type: selectedMethod
                                })
                            }).then(() => {
                                alert(`DEMO: Pembayaran berhasil dengan ${methodName}!`);
                                window.location.reload();
                            }).catch(() => {
                                alert('Terjadi kesalahan saat simulasi pembayaran.');
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>

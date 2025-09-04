<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between w-100">
            <div class="mb-3 mb-sm-0">
                <h1 class="fw-bold fs-1 text-gray-900 mb-2">Dashboard Admin</h1>
                <div class="d-flex align-items-center">
                    <span class="text-muted fs-6 me-3">Ringkasan sistem SPP</span>
                    <span class="badge badge-light-primary fs-8">{{ now()->format('d M Y') }}</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <div class="text-gray-600 fs-8">Terakhir diperbarui</div>
                    <div class="text-gray-900 fw-semibold fs-7">{{ now()->format('H:i') }}</div>
                </div>
                <button type="button" class="btn btn-light-primary btn-sm" id="btnRefresh">
                   <i class="fas fa-rotate-right me-1"></i>Refresh
                </button>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Stats Cards -->
        <div class="row g-4 mb-6">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-6">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="flex-grow-1">
                                <div class="text-gray-500 fw-semibold fs-7 mb-1">TOTAL SISWA</div>
                                <div class="fs-2x fw-bold text-gray-900 mb-2" data-kt-countup="true" data-kt-countup-value="{{ $stats['total_students'] }}">0</div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-arrow-up text-success fs-8 me-1"></i>
                                    <span class="text-success fw-semibold fs-8">5% bulan ini</span>
                                </div>
                            </div>
                            <div class="symbol symbol-60px">
                                <div class="symbol-label bg-light-primary">
                                    <i class="fas fa-users text-primary fs-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-6">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="flex-grow-1">
                                <div class="text-gray-500 fw-semibold fs-7 mb-1">BELUM BAYAR</div>
                                <div class="fs-2x fw-bold text-gray-900 mb-2" data-kt-countup="true" data-kt-countup-value="{{ $stats['total_unpaid_bills'] }}">0</div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-arrow-down text-success fs-8 me-1"></i>
                                    <span class="text-success fw-semibold fs-8">12% minggu ini</span>
                                </div>
                            </div>
                            <div class="symbol symbol-60px">
                                <div class="symbol-label bg-light-warning">
                                    <i class="fas fa-clock text-warning fs-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-6">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="flex-grow-1">
                                <div class="text-gray-500 fw-semibold fs-7 mb-1">SUDAH LUNAS</div>
                                <div class="fs-2x fw-bold text-gray-900 mb-2" data-kt-countup="true" data-kt-countup-value="{{ $stats['total_paid_bills'] }}">0</div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-arrow-up text-success fs-8 me-1"></i>
                                    <span class="text-success fw-semibold fs-8">18% minggu ini</span>
                                </div>
                            </div>
                            <div class="symbol symbol-60px">
                                <div class="symbol-label bg-light-success">
                                    <i class="fas fa-check-circle text-success fs-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-6">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="flex-grow-1">
                                <div class="text-gray-500 fw-semibold fs-7 mb-1">TOTAL PENDAPATAN</div>
                                <div class="fs-2x fw-bold text-gray-900 mb-2">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-arrow-up text-success fs-8 me-1"></i>
                                    <span class="text-success fw-semibold fs-8">25% bulan ini</span>
                                </div>
                            </div>
                            <div class="symbol symbol-60px">
                                <div class="symbol-label bg-light-info">
                                    <i class="fas fa-money-bill-wave text-info fs-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-4 mb-6">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header border-0 pt-6 pb-2">
                        <div class="card-title">
                            <h3 class="fw-bold text-gray-900 m-0">Tren Pembayaran</h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex align-items-center">
                                <span class="text-muted fs-7 me-2">7 hari terakhir</span>
                                <div class="symbol symbol-20px">
                                    <div class="symbol-label bg-success"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="h-300px">
                            <canvas id="paymentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header border-0 pt-6 pb-2">
                        <div class="card-title">
                           <h3 class="fw-bold text-gray-900 m-0">Status Pembayaran</h3>
                       </div>
                   </div>
                   <div class="card-body pt-2">
                       <div class="h-250px mb-6">
                           <canvas id="statusChart"></canvas>
                       </div>
                       <div class="border-top pt-4">
                           @php
                               $totalBills = max($stats['total_paid_bills'] + $stats['total_unpaid_bills'], 1);
                               $progress = round(($stats['total_paid_bills'] / $totalBills) * 100, 1);
                           @endphp
                           <div class="d-flex justify-content-between align-items-center mb-3">
                               <span class="text-gray-600 fw-semibold">Tingkat Pembayaran</span>
                               <span class="fw-bold text-gray-900 fs-4">{{ $progress }}%</span>
                           </div>
                           <div class="progress h-6px bg-light-success">
                               <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%"></div>
                           </div>
                           <div class="text-muted fs-8 mt-2">Target: 85% per bulan</div>
                       </div>
                   </div>
                </div>
            </div>
        </div>

        <!-- Activity Section -->
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <h3 class="fw-bold text-gray-900 m-0">Aktivitas Terbaru</h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge badge-light-primary">{{ $recent_payments->count() }} transaksi</span>
                                <a href="{{ route('admin.spp-bills.index') }}" class="btn btn-sm btn-light-primary">
                                    Lihat Semua
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        @if ($recent_payments->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-rounded table-row-gray-300 table-hover align-middle fs-6 mb-0">
                                    <thead>
                                        <tr class="text-gray-500 fw-bold text-uppercase fs-7">
                                            <th class="min-w-200px">Siswa</th>
                                            <th class="min-w-100px">Order ID</th>
                                            <th class="min-w-100px">Jumlah</th>
                                            <th class="min-w-100px">Status</th>
                                            <th class="min-w-100px">Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach ($recent_payments as $payment)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-40px symbol-circle me-3">
                                                            <div class="symbol-label bg-light-primary text-primary fw-bold">
                                                                {{ strtoupper(substr($payment->user->name, 0, 2)) }}
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <div class="text-gray-900 fw-bold">{{ $payment->user->name }}</div>
                                                            <span class="text-muted fs-7">Pembayaran SPP</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-primary fs-8">{{ $payment->order_id }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-success fw-bold">{{ $payment->formatted_amount }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success">{{ ucfirst($payment->transaction_status) }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-muted fs-7">{{ $payment->created_at->diffForHumans() }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="symbol symbol-100px symbol-circle mx-auto mb-4">
                                    <div class="symbol-label bg-light-primary">
                                        <i class="fas fa-receipt text-primary fs-2x"></i>
                                    </div>
                                </div>
                                <div class="fw-semibold text-gray-600 fs-6 mb-2">Belum ada aktivitas pembayaran</div>
                                <div class="text-muted fs-7">Aktivitas pembayaran akan muncul di sini</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <h3 class="fw-bold text-gray-900 m-0">Tagihan Terlambat</h3>
                        </div>
                        <div class="card-toolbar">
                            @if ($overdue_bills->count() > 0)
                                <span class="badge badge-light-danger">{{ $overdue_bills->count() }} tagihan</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        @if ($overdue_bills->count() > 0)
                            <div class="d-flex flex-column gap-4">
                                @foreach ($overdue_bills->take(5) as $bill)
                                    <div class="d-flex align-items-center p-4 bg-light-danger rounded">
                                        <div class="symbol symbol-40px symbol-circle me-3">
                                            <div class="symbol-label bg-danger text-white fw-bold">
                                                {{ strtoupper(substr($bill->student->name, 0, 2)) }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-bold text-gray-900 fs-6">{{ $bill->student->name }}</div>
                                            <div class="text-muted fs-7 mb-1">{{ $bill->month }} {{ $bill->year }}</div>
                                            <div class="text-danger fw-bold fs-6">{{ $bill->formatted_amount }}</div>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge badge-danger fs-8">
                                                @if ($bill->due_date)
                                                    {{ $bill->due_date->diffForHumans() }}
                                                @else
                                                    Terlambat
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if ($overdue_bills->count() > 5)
                                <div class="text-center mt-6">
                                    <a href="{{ route('admin.spp-bills.index') }}?status=overdue" class="btn btn-light-danger btn-sm">
                                        Lihat {{ $overdue_bills->count() - 5 }} lainnya
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-12">
                                <div class="symbol symbol-100px symbol-circle mx-auto mb-4">
                                    <div class="symbol-label bg-light-success">
                                        <i class="fas fa-check-circle text-success fs-2x"></i>
                                    </div>
                                </div>
                                <div class="fw-semibold text-success fs-6 mb-2">Semua tagihan up-to-date!</div>
                                <div class="text-muted fs-7">Tidak ada tagihan yang terlambat</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Fallback countup if Metronic auto-init not available
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('[data-kt-countup="true"]').forEach(el => {
                    const target = parseInt(el.getAttribute('data-kt-countup-value') || '0', 10);
                    if (!isNaN(target)) {
                        let current = 0;
                        const step = Math.max(1, Math.round(target / 60));
                        const tick = () => {
                            current += step;
                            if (current >= target) {
                                el.textContent = target.toLocaleString('id-ID');
                                return;
                            }
                            el.textContent = current.toLocaleString('id-ID');
                            requestAnimationFrame(tick);
                        };
                        tick();
                    }
                });

                // Charts
                const paymentCtx = document.getElementById('paymentChart').getContext('2d');
                new Chart(paymentCtx, {
                    type: 'line',
                    data: {
                        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                        datasets: [{
                            label: 'Pembayaran',
                            data: [12, 19, 3, 5, 2, 3, 9],
                            borderColor: '#4f46e5',
                            backgroundColor: 'rgba(79, 70, 229, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                            x: { grid: { display: false } }
                        }
                    }
                });

                const statusCtx = document.getElementById('statusChart').getContext('2d');
                new Chart(statusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Lunas', 'Belum Bayar', 'Pending'],
                        datasets: [{
                            data: [{{ $stats['total_paid_bills'] }}, {{ $stats['total_unpaid_bills'] }}, {{ $stats['pending_payments'] }}],
                            backgroundColor: ['#10b981', '#f59e0b', '#6b7280'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom', labels: { usePointStyle: true, padding: 16 } }
                        }
                    }
                });

                // Refresh button
                const btnRefresh = document.getElementById('btnRefresh');
                if (btnRefresh) {
                    btnRefresh.addEventListener('click', () => {
                        btnRefresh.disabled = true;
                        setTimeout(() => { btnRefresh.disabled = false; }, 1200);
                    });
                }
            });
        </script>
    @endpush
</x-admin-layout>

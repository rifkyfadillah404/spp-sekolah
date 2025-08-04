<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-1 fw-bold text-dark">Dashboard Admin</h2>
                <p class="text-muted mb-0">Selamat datang kembali! Berikut ringkasan sistem SPP hari ini.</p>
            </div>
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <small class="text-muted">Last updated:</small>
                    <div class="fw-bold text-primary" id="lastUpdated">{{ now()->format('H:i:s') }}</div>
                </div>
                <button class="btn btn-outline-primary" onclick="refreshDashboard()">
                    <i class="fas fa-sync-alt me-1"></i>
                    Refresh
                </button>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Enhanced Statistics Cards with Animations -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 stat-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body position-relative overflow-hidden">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1 fw-semibold">Total Siswa</h6>
                                <h2 class="mb-0 fw-bold text-primary counter"
                                    data-target="{{ $stats['total_students'] }}">0</h2>
                                <small class="text-success">
                                    <i class="fas fa-arrow-up me-1"></i>
                                    +5% dari bulan lalu
                                </small>
                            </div>
                            <div class="stat-icon bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 4px;">
                            <div class="progress-bar bg-primary" style="width: 85%"></div>
                        </div>
                        <div class="stat-bg-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 stat-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body position-relative overflow-hidden">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1 fw-semibold">Belum Bayar</h6>
                                <h2 class="mb-0 fw-bold text-warning counter"
                                    data-target="{{ $stats['total_unpaid_bills'] }}">0</h2>
                                <small class="text-danger">
                                    <i class="fas fa-arrow-down me-1"></i>
                                    -12% dari minggu lalu
                                </small>
                            </div>
                            <div class="stat-icon bg-warning bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-clock fa-2x text-warning"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 4px;">
                            <div class="progress-bar bg-warning" style="width: 65%"></div>
                        </div>
                        <div class="stat-bg-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 stat-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-body position-relative overflow-hidden">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1 fw-semibold">Sudah Lunas</h6>
                                <h2 class="mb-0 fw-bold text-success counter"
                                    data-target="{{ $stats['total_paid_bills'] }}">0</h2>
                                <small class="text-success">
                                    <i class="fas fa-arrow-up me-1"></i>
                                    +18% dari minggu lalu
                                </small>
                            </div>
                            <div class="stat-icon bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-check-circle fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 4px;">
                            <div class="progress-bar bg-success" style="width: 92%"></div>
                        </div>
                        <div class="stat-bg-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 stat-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="card-body position-relative overflow-hidden">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1 fw-semibold">Total Pendapatan</h6>
                                <h2 class="mb-0 fw-bold text-info">Rp
                                    {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h2>
                                <small class="text-success">
                                    <i class="fas fa-arrow-up me-1"></i>
                                    +25% dari bulan lalu
                                </small>
                            </div>
                            <div class="stat-icon bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-money-bill-wave fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 4px;">
                            <div class="progress-bar bg-info" style="width: 78%"></div>
                        </div>
                        <div class="stat-bg-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Analytics Row -->
        <div class="row mb-4">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="500">
                    <div class="card-header bg-white border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-chart-line me-2 text-primary"></i>
                                Tren Pembayaran
                            </h5>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-primary active">7 Hari</button>
                                <button type="button" class="btn btn-outline-primary">30 Hari</button>
                                <button type="button" class="btn btn-outline-primary">90 Hari</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="height: 300px;">
                            <canvas id="paymentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="600">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-chart-pie me-2 text-success"></i>
                            Status Pembayaran
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="height: 250px;">
                            <canvas id="statusChart"></canvas>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Tingkat Pembayaran</span>
                                <span
                                    class="fw-bold text-success">{{ round(($stats['total_paid_bills'] / max($stats['total_paid_bills'] + $stats['total_unpaid_bills'], 1)) * 100, 1) }}%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success"
                                    style="width: {{ round(($stats['total_paid_bills'] / max($stats['total_paid_bills'] + $stats['total_unpaid_bills'], 1)) * 100, 1) }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities and Overdue Bills -->
        <div class="row mb-4">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="700">
                    <div class="card-header bg-white border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-history me-2 text-primary"></i>
                                Aktivitas Terbaru
                            </h5>
                            <span class="badge bg-primary">{{ $recent_payments->count() }} transaksi</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if ($recent_payments->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="border-0 fw-bold">Siswa</th>
                                            <th class="border-0 fw-bold">Order ID</th>
                                            <th class="border-0 fw-bold">Jumlah</th>
                                            <th class="border-0 fw-bold">Status</th>
                                            <th class="border-0 fw-bold">Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recent_payments as $payment)
                                            <tr class="activity-row">
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                            style="width: 40px; height: 40px; font-size: 14px;">
                                                            {{ strtoupper(substr($payment->user->name, 0, 2)) }}
                                                        </div>
                                                        <div>
                                                            <div class="fw-bold">{{ $payment->user->name }}</div>
                                                            <small class="text-muted">Pembayaran SPP</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="badge bg-light text-dark">{{ $payment->order_id }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="fw-bold text-success">{{ $payment->formatted_amount }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="badge bg-{{ $payment->status_badge }}">
                                                        {{ ucfirst($payment->transaction_status) }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <small
                                                        class="text-muted">{{ $payment->created_at->diffForHumans() }}</small>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">Belum ada aktivitas pembayaran</h6>
                                <p class="text-muted mb-0">Aktivitas pembayaran akan muncul di sini</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="800">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-exclamation-triangle me-2 text-danger"></i>
                            Tagihan Terlambat
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($overdue_bills->count() > 0)
                            <div class="overdue-list">
                                @foreach ($overdue_bills->take(5) as $bill)
                                    <div
                                        class="overdue-item d-flex align-items-center p-3 mb-3 bg-danger bg-opacity-5 rounded-3 border border-danger border-opacity-25">
                                        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 40px; height: 40px; font-size: 14px;">
                                            {{ strtoupper(substr($bill->student->name, 0, 2)) }}
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-bold text-dark">{{ $bill->student->name }}</div>
                                            <small class="text-muted">{{ $bill->month }} {{ $bill->year }}</small>
                                            <div class="text-danger fw-bold">{{ $bill->formatted_amount }}</div>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-danger">
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
                                <div class="text-center">
                                    <a href="{{ route('admin.spp-bills.index') }}?status=overdue"
                                        class="btn btn-outline-danger btn-sm">
                                        Lihat {{ $overdue_bills->count() - 5 }} lainnya
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                <h6 class="text-success">Semua tagihan up-to-date!</h6>
                                <p class="text-muted mb-0">Tidak ada tagihan yang terlambat</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            .stat-card {
                transition: all 0.3s ease;
                cursor: pointer;
            }

            .stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
            }

            .stat-icon {
                transition: all 0.3s ease;
            }

            .stat-card:hover .stat-icon {
                transform: scale(1.1);
            }

            .stat-bg-icon {
                position: absolute;
                right: -20px;
                top: -20px;
                font-size: 120px;
                opacity: 0.05;
                z-index: 0;
            }

            .quick-action {
                transition: all 0.3s ease;
                cursor: pointer;
            }

            .quick-action:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            }

            .quick-action-icon {
                transition: all 0.3s ease;
            }

            .quick-action:hover .quick-action-icon {
                transform: scale(1.1) rotate(5deg);
            }

            .activity-row {
                transition: all 0.2s ease;
            }

            .activity-row:hover {
                background-color: #f8f9fa;
                transform: translateX(5px);
            }

            .overdue-item {
                transition: all 0.3s ease;
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% {
                    box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4);
                }

                70% {
                    box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
                }

                100% {
                    box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
                }
            }

            .chart-container {
                position: relative;
            }

            .counter {
                transition: all 0.3s ease;
            }

            .progress-bar {
                transition: width 1.5s ease-in-out;
            }

            @media (max-width: 768px) {
                .stat-card:hover {
                    transform: none;
                }

                .quick-action:hover {
                    transform: none;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });

            // Counter animation
            function animateCounters() {
                const counters = document.querySelectorAll('.counter');

                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-target'));
                    const increment = target / 100;
                    let current = 0;

                    const updateCounter = () => {
                        if (current < target) {
                            current += increment;
                            counter.textContent = Math.ceil(current);
                            setTimeout(updateCounter, 20);
                        } else {
                            counter.textContent = target;
                        }
                    };

                    updateCounter();
                });
            }

            // Payment trend chart
            function initPaymentChart() {
                const ctx = document.getElementById('paymentChart').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                        datasets: [{
                            label: 'Pembayaran',
                            data: [12, 19, 3, 5, 2, 3, 9],
                            borderColor: '#2563eb',
                            backgroundColor: 'rgba(37, 99, 235, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            // Status pie chart
            function initStatusChart() {
                const ctx = document.getElementById('statusChart').getContext('2d');

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Lunas', 'Belum Bayar', 'Pending'],
                        datasets: [{
                            data: [{{ $stats['total_paid_bills'] }}, {{ $stats['total_unpaid_bills'] }},
                                {{ $stats['pending_payments'] }}
                            ],
                            backgroundColor: [
                                '#10b981',
                                '#f59e0b',
                                '#6b7280'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true
                                }
                            }
                        }
                    }
                });
            }

            // Refresh dashboard
            function refreshDashboard() {
                const button = event.target.closest('button');
                const icon = button.querySelector('i');

                // Add spinning animation
                icon.classList.add('fa-spin');
                button.disabled = true;

                // Update timestamp
                document.getElementById('lastUpdated').textContent = new Date().toLocaleTimeString();

                // Simulate refresh
                setTimeout(() => {
                    icon.classList.remove('fa-spin');
                    button.disabled = false;

                    // Re-animate counters
                    animateCounters();

                    // Show success message
                    showNotification('Dashboard berhasil diperbarui!', 'success');
                }, 1500);
            }

            // Show notification
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
                notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
                notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }

            // Auto refresh every 5 minutes
            setInterval(() => {
                document.getElementById('lastUpdated').textContent = new Date().toLocaleTimeString();
            }, 300000);

            // Initialize everything when DOM is loaded
            document.addEventListener('DOMContentLoaded', function() {
                // Delay counter animation to sync with AOS
                setTimeout(() => {
                    animateCounters();
                }, 500);

                // Initialize charts
                setTimeout(() => {
                    initPaymentChart();
                    initStatusChart();
                }, 800);

                // Add click handlers for stat cards
                document.querySelectorAll('.stat-card').forEach(card => {
                    card.addEventListener('click', function() {
                        const cardText = this.querySelector('h6').textContent;
                        showNotification(`Menampilkan detail ${cardText}`, 'info');
                    });
                });
            });
        </script>
    @endpush
</x-admin-layout>

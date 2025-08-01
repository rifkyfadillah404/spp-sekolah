<x-admin-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Siswa</h6>
                                <h3 class="mb-0 fw-bold text-primary">{{ $stats['total_students'] }}</h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 rounded p-3">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Belum Bayar</h6>
                                <h3 class="mb-0 fw-bold text-warning">{{ $stats['total_unpaid_bills'] }}</h3>
                            </div>
                            <div class="bg-warning bg-opacity-10 rounded p-3">
                                <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Sudah Lunas</h6>
                                <h3 class="mb-0 fw-bold text-success">{{ $stats['total_paid_bills'] }}</h3>
                            </div>
                            <div class="bg-success bg-opacity-10 rounded p-3">
                                <i class="fas fa-check-circle fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Pendapatan</h6>
                                <h3 class="mb-0 fw-bold text-info">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
                            </div>
                            <div class="bg-info bg-opacity-10 rounded p-3">
                                <i class="fas fa-money-bill-wave fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Payments -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-chart-line me-2"></i>
                            Pembayaran Terbaru
                        </h5>
                        <span class="badge bg-primary">{{ $recent_payments->count() }} transaksi</span>
                    </div>
                    <div class="card-body">
                        @if($recent_payments->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Siswa</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recent_payments as $payment)
                                            <tr>
                                                <td>
                                                    <span class="fw-bold text-primary">{{ $payment->order_id }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                                             style="width: 32px; height: 32px; font-size: 12px;">
                                                            {{ strtoupper(substr($payment->user->name, 0, 2)) }}
                                                        </div>
                                                        {{ $payment->user->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fw-bold text-success">{{ $payment->formatted_amount }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $payment->status_badge }}">
                                                        {{ ucfirst($payment->transaction_status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $payment->created_at->format('d/m/Y H:i') }}</small>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada pembayaran.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Overdue Bills -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Tagihan Terlambat
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($overdue_bills->count() > 0)
                            @foreach($overdue_bills as $bill)
                                <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded">
                                    <div>
                                        <strong class="text-dark">{{ $bill->student->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $bill->month }} {{ $bill->year }}</small>
                                        <br>
                                        <span class="text-danger fw-bold">{{ $bill->formatted_amount }}</span>
                                    </div>
                                    <span class="badge bg-danger">
                                        {{ $bill->due_date->diffForHumans() }}
                                    </span>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                <p class="text-muted">Tidak ada tagihan terlambat.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-bolt me-2"></i>
                            Aksi Cepat
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="{{ route('admin.students.index') }}" class="btn btn-primary w-100 py-3">
                                    <i class="fas fa-users fa-2x mb-2 d-block"></i>
                                    <span class="fw-bold">Kelola Siswa</span>
                                    <br>
                                    <small class="opacity-75">Lihat semua siswa</small>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="{{ route('admin.students.by-class') }}" class="btn btn-success w-100 py-3">
                                    <i class="fas fa-graduation-cap fa-2x mb-2 d-block"></i>
                                    <span class="fw-bold">Siswa Per Kelas</span>
                                    <br>
                                    <small class="opacity-75">Lihat per kelas</small>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="{{ route('admin.spp-bills.index') }}" class="btn btn-warning w-100 py-3">
                                    <i class="fas fa-file-invoice fa-2x mb-2 d-block"></i>
                                    <span class="fw-bold">Kelola Tagihan</span>
                                    <br>
                                    <small class="opacity-75">Semua tagihan SPP</small>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="{{ route('admin.students.create') }}" class="btn btn-info w-100 py-3">
                                    <i class="fas fa-user-plus fa-2x mb-2 d-block"></i>
                                    <span class="fw-bold">Tambah Siswa</span>
                                    <br>
                                    <small class="opacity-75">Siswa baru</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

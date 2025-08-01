<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Siswa</h5>
                                    <h2 class="card-text">{{ $stats['total_students'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Tagihan Belum Bayar</h5>
                                    <h2 class="card-text">{{ $stats['total_unpaid_bills'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Tagihan Lunas</h5>
                                    <h2 class="card-text">{{ $stats['total_paid_bills'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Pendapatan</h5>
                                    <h2 class="card-text">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Pembayaran Terbaru</h5>
                                </div>
                                <div class="card-body">
                                    @if($recent_payments->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-striped">
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
                                                            <td>{{ $payment->order_id }}</td>
                                                            <td>{{ $payment->user->name }}</td>
                                                            <td>{{ $payment->formatted_amount }}</td>
                                                            <td>
                                                                <span class="badge bg-{{ $payment->status_badge }}">
                                                                    {{ ucfirst($payment->transaction_status) }}
                                                                </span>
                                                            </td>
                                                            <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-muted">Belum ada pembayaran.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Tagihan Terlambat</h5>
                                </div>
                                <div class="card-body">
                                    @if($overdue_bills->count() > 0)
                                        @foreach($overdue_bills as $bill)
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <strong>{{ $bill->student->name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $bill->month }} {{ $bill->year }}</small>
                                                    <br>
                                                    <span class="text-danger">{{ $bill->formatted_amount }}</span>
                                                </div>
                                                <span class="badge bg-danger">
                                                    {{ $bill->due_date->diffForHumans() }}
                                                </span>
                                            </div>
                                            <hr>
                                        @endforeach
                                    @else
                                        <p class="text-muted">Tidak ada tagihan terlambat.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Aksi Cepat</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="{{ route('admin.students.index') }}" class="btn btn-primary w-100 mb-2">
                                                <i class="fas fa-users"></i> Kelola Siswa
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="{{ route('admin.students.create') }}" class="btn btn-success w-100 mb-2">
                                                <i class="fas fa-user-plus"></i> Tambah Siswa
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="{{ route('admin.spp-bills.index') }}" class="btn btn-warning w-100 mb-2">
                                                <i class="fas fa-file-invoice"></i> Kelola Tagihan
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="{{ route('admin.spp-bills.create') }}" class="btn btn-info w-100 mb-2">
                                                <i class="fas fa-plus"></i> Buat Tagihan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

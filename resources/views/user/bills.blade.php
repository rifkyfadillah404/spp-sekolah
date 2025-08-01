<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Tagihan SPP') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>Semua Tagihan SPP</h4>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                        </a>
                    </div>

                    @if($bills->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Periode</th>
                                        <th>Jumlah</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Status</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Metode Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bills as $bill)
                                        <tr class="{{ $bill->is_overdue && $bill->status === 'unpaid' ? 'table-danger' : '' }}">
                                            <td>
                                                <strong>{{ $bill->month }} {{ $bill->year }}</strong>
                                            </td>
                                            <td>
                                                <span class="fw-bold">{{ $bill->formatted_amount }}</span>
                                            </td>
                                            <td>
                                                {{ $bill->due_date->format('d/m/Y') }}
                                                @if($bill->is_overdue && $bill->status === 'unpaid')
                                                    <br><small class="text-danger">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                        Terlambat {{ $bill->due_date->diffForHumans() }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($bill->status === 'paid')
                                                    <span class="badge bg-success fs-6">
                                                        <i class="fas fa-check"></i> Lunas
                                                    </span>
                                                @elseif($bill->status === 'pending')
                                                    <span class="badge bg-warning fs-6">
                                                        <i class="fas fa-clock"></i> Pending
                                                    </span>
                                                @elseif($bill->is_overdue)
                                                    <span class="badge bg-danger fs-6">
                                                        <i class="fas fa-exclamation-triangle"></i> Terlambat
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary fs-6">
                                                        <i class="fas fa-times"></i> Belum Bayar
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($bill->payment && $bill->payment->transaction_time)
                                                    {{ $bill->payment->transaction_time->format('d/m/Y H:i') }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($bill->payment && $bill->payment->payment_type)
                                                    <span class="badge bg-info">
                                                        {{ ucfirst($bill->payment->payment_type) }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $bills->links() }}
                        </div>

                        <!-- Summary Statistics -->
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body text-center">
                                        <h5>Total Tagihan</h5>
                                        <h3>{{ $bills->total() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <h5>Sudah Lunas</h5>
                                        <h3>{{ $bills->where('status', 'paid')->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-warning text-white">
                                    <div class="card-body text-center">
                                        <h5>Pending</h5>
                                        <h3>{{ $bills->where('status', 'pending')->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-danger text-white">
                                    <div class="card-body text-center">
                                        <h5>Belum Bayar</h5>
                                        <h3>{{ $bills->where('status', 'unpaid')->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
                            $totalAmount = $bills->sum('amount');
                            $paidAmount = $bills->where('status', 'paid')->sum('amount');
                            $unpaidAmount = $bills->where('status', 'unpaid')->sum('amount');
                        @endphp

                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">Ringkasan Keuangan</h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <h6 class="text-muted">Total Tagihan</h6>
                                        <h4 class="text-primary">Rp {{ number_format($totalAmount, 0, ',', '.') }}</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="text-muted">Sudah Dibayar</h6>
                                        <h4 class="text-success">Rp {{ number_format($paidAmount, 0, ',', '.') }}</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="text-muted">Belum Dibayar</h6>
                                        <h4 class="text-danger">Rp {{ number_format($unpaidAmount, 0, ',', '.') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-file-invoice fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">Belum Ada Tagihan</h4>
                            <p class="text-muted">Anda belum memiliki tagihan SPP. Hubungi admin jika ada pertanyaan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

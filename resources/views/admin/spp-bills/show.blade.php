<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Tagihan SPP') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Informasi Tagihan</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="200"><strong>ID Tagihan:</strong></td>
                                            <td>{{ $sppBill->id }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Siswa:</strong></td>
                                            <td>{{ $sppBill->student->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>NIS:</strong></td>
                                            <td>{{ $sppBill->student->nis }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kelas:</strong></td>
                                            <td>{{ $sppBill->student->class }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Periode:</strong></td>
                                            <td>{{ $sppBill->month }} {{ $sppBill->year }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jumlah:</strong></td>
                                            <td class="fs-5 fw-bold text-primary">{{ $sppBill->formatted_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jatuh Tempo:</strong></td>
                                            <td>
                                                {{ $sppBill->due_date->format('d F Y') }}
                                                @if($sppBill->is_overdue)
                                                    <span class="badge bg-danger ms-2">Terlambat</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                @if($sppBill->status === 'paid')
                                                    <span class="badge bg-success fs-6">Lunas</span>
                                                @elseif($sppBill->status === 'pending')
                                                    <span class="badge bg-warning fs-6">Pending</span>
                                                @else
                                                    <span class="badge bg-secondary fs-6">Belum Bayar</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Dibuat:</strong></td>
                                            <td>{{ $sppBill->created_at->format('d F Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Diupdate:</strong></td>
                                            <td>{{ $sppBill->updated_at->format('d F Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            @if($sppBill->payment)
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Informasi Pembayaran</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless table-sm">
                                            <tr>
                                                <td><strong>Order ID:</strong></td>
                                                <td>{{ $sppBill->payment->order_id }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Transaction ID:</strong></td>
                                                <td>{{ $sppBill->payment->transaction_id ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Metode:</strong></td>
                                                <td>{{ $sppBill->payment->payment_type ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status:</strong></td>
                                                <td>
                                                    <span class="badge bg-{{ $sppBill->payment->status_badge }}">
                                                        {{ ucfirst($sppBill->payment->transaction_status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Waktu Bayar:</strong></td>
                                                <td>
                                                    {{ $sppBill->payment->transaction_time ? $sppBill->payment->transaction_time->format('d/m/Y H:i') : '-' }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada pembayaran untuk tagihan ini.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('admin.spp-bills.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        
                        <div>
                            @if($sppBill->status !== 'paid')
                                <a href="{{ route('admin.spp-bills.edit', $sppBill) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

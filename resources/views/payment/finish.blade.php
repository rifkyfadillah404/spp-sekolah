<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Status Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center mb-4">
                        @if($payment->transaction_status === 'settlement')
                            <div class="mb-4">
                                <i class="fas fa-check-circle fa-5x text-success"></i>
                            </div>
                            <h3 class="text-success">Pembayaran Berhasil!</h3>
                            <p class="text-muted">Terima kasih, pembayaran SPP Anda telah berhasil diproses.</p>
                        @elseif($payment->transaction_status === 'pending')
                            <div class="mb-4">
                                <i class="fas fa-clock fa-5x text-warning"></i>
                            </div>
                            <h3 class="text-warning">Pembayaran Pending</h3>
                            <p class="text-muted">Pembayaran Anda sedang diproses. Mohon tunggu konfirmasi.</p>
                        @elseif(in_array($payment->transaction_status, ['cancel', 'deny', 'expire']))
                            <div class="mb-4">
                                <i class="fas fa-times-circle fa-5x text-danger"></i>
                            </div>
                            <h3 class="text-danger">Pembayaran Gagal</h3>
                            <p class="text-muted">Pembayaran tidak dapat diproses. Silakan coba lagi.</p>
                        @else
                            <div class="mb-4">
                                <i class="fas fa-info-circle fa-5x text-info"></i>
                            </div>
                            <h3 class="text-info">Status Pembayaran</h3>
                            <p class="text-muted">Status: {{ ucfirst($payment->transaction_status) }}</p>
                        @endif
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Detail Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="150"><strong>Order ID:</strong></td>
                                            <td>{{ $payment->order_id }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Transaction ID:</strong></td>
                                            <td>{{ $payment->transaction_id ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jumlah:</strong></td>
                                            <td class="fs-5 fw-bold text-primary">{{ $payment->formatted_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Metode Bayar:</strong></td>
                                            <td>{{ $payment->payment_type ? ucfirst($payment->payment_type) : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                <span class="badge bg-{{ $payment->status_badge }} fs-6">
                                                    {{ ucfirst($payment->transaction_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Waktu Bayar:</strong></td>
                                            <td>
                                                {{ $payment->transaction_time ? $payment->transaction_time->format('d F Y H:i:s') : '-' }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <div class="col-md-6">
                                    <h6 class="fw-bold mb-3">Tagihan yang Dibayar:</h6>
                                    @if($payment->sppBills->count() > 0)
                                        <div class="list-group">
                                            @foreach($payment->sppBills as $bill)
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ $bill->month }} {{ $bill->year }}</strong>
                                                        <br>
                                                        <small class="text-muted">{{ $bill->student->name }}</small>
                                                    </div>
                                                    <span class="badge bg-primary rounded-pill">
                                                        {{ $bill->formatted_amount }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">Tidak ada tagihan terkait.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($payment->transaction_status === 'settlement')
                        <div class="alert alert-success mt-4">
                            <h5 class="alert-heading">
                                <i class="fas fa-check-circle"></i> Pembayaran Berhasil!
                            </h5>
                            <p class="mb-0">
                                Pembayaran SPP Anda telah berhasil diproses dan tagihan telah lunas. 
                                Anda dapat melihat riwayat pembayaran di dashboard atau halaman tagihan.
                            </p>
                        </div>
                    @elseif($payment->transaction_status === 'pending')
                        <div class="alert alert-warning mt-4">
                            <h5 class="alert-heading">
                                <i class="fas fa-clock"></i> Pembayaran Sedang Diproses
                            </h5>
                            <p class="mb-0">
                                Pembayaran Anda sedang dalam proses verifikasi. Status akan diperbarui secara otomatis 
                                setelah pembayaran dikonfirmasi. Anda akan menerima notifikasi melalui email.
                            </p>
                        </div>
                    @elseif(in_array($payment->transaction_status, ['cancel', 'deny', 'expire']))
                        <div class="alert alert-danger mt-4">
                            <h5 class="alert-heading">
                                <i class="fas fa-times-circle"></i> Pembayaran Tidak Berhasil
                            </h5>
                            <p class="mb-0">
                                Pembayaran tidak dapat diproses. Silakan coba lagi atau hubungi admin jika masalah berlanjut.
                                Tagihan masih dalam status belum dibayar.
                            </p>
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary me-2">
                            <i class="fas fa-home"></i> Kembali ke Dashboard
                        </a>
                        <a href="{{ route('user.bills') }}" class="btn btn-outline-primary">
                            <i class="fas fa-file-invoice"></i> Lihat Semua Tagihan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

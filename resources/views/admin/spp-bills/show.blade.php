<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1 fw-bold text-dark">
                    <i class="fas fa-file-invoice-dollar me-2 text-primary"></i>
                    Detail Tagihan SPP
                </h2>
                <p class="text-muted mb-0">Informasi lengkap tagihan SPP siswa</p>
            </div>
        </div>
    </x-slot>

    <style>
        .detail-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .page-header {
            background: linear-gradient(120deg, #e0f7fa, #bbdefb);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .info-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.03);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .card-header {
            background: #f8fafc;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .card-header h5 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 0.25rem;
            font-weight: 500;
        }

        .detail-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0f172a;
        }

        .detail-value.amount {
            font-size: 1.5rem;
            color: #10b981;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .badge-paid {
            background: #dcfce7;
            color: #166534;
        }

        .badge-pending {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-unpaid {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-overdue {
            background: #fee2e2;
            color: #991b1b;
        }

        .action-buttons {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .btn-modern {
            padding: 0.85rem 1.75rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .btn-back {
            background: #f8fafc;
            color: #475569;
            border: 2px solid #e2e8f0;
        }

        .btn-back:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .btn-edit {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            border: none;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
        }

        .payment-info {
            background: linear-gradient(120deg, #dbeafe, #d1fae5);
            border-radius: 14px;
            padding: 1.5rem;
            border: 1px solid #93c5fd;
        }

        .payment-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .no-payment {
            text-align: center;
            padding: 2rem;
            color: #64748b;
        }

        .no-payment i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #cbd5e1;
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-modern {
                width: 100%;
                justify-content: center;
            }
            
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="detail-container">
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h3 class="mb-2">{{ $sppBill->student->name }}</h3>
                    <p class="text-muted mb-0">
                        <i class="fas fa-id-card me-2"></i>
                        {{ $sppBill->student->nis }} • {{ $sppBill->student->class }}
                    </p>
                </div>
                <div>
                    <span class="status-badge 
                        @if ($sppBill->status === 'paid') badge-paid
                        @elseif($sppBill->status === 'pending') badge-pending
                        @elseif($sppBill->status === 'unpaid') badge-unpaid
                        @endif">
                        @if ($sppBill->status === 'paid')
                            <i class="fas fa-check-circle"></i> Lunas
                        @elseif($sppBill->status === 'pending')
                            <i class="fas fa-clock"></i> Pending
                        @else
                            <i class="fas fa-hourglass-half"></i> Belum Bayar
                        @endif
                    </span>
                    @if ($sppBill->is_overdue && $sppBill->status !== 'paid')
                        <span class="status-badge badge-overdue ms-2">
                            <i class="fas fa-exclamation-triangle"></i> Terlambat
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="info-card">
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-file-invoice text-primary"></i>
                            Informasi Tagihan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="detail-grid">
                            <div class="detail-item">
                                <span class="detail-label">ID Tagihan</span>
                                <span class="detail-value">{{ $sppBill->id }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Periode</span>
                                <span class="detail-value">{{ $sppBill->month }} {{ $sppBill->year }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Jumlah Tagihan</span>
                                <span class="detail-value amount">{{ $sppBill->formatted_amount }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Tanggal Jatuh Tempo</span>
                                <span class="detail-value">
                                    @if ($sppBill->due_date)
                                        {{ $sppBill->due_date->format('d F Y') }}
                                    @else
                                        <span class="text-muted">Belum diset</span>
                                    @endif
                                </span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Tanggal Dibuat</span>
                                <span class="detail-value">{{ $sppBill->created_at->format('d F Y H:i') }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Terakhir Diupdate</span>
                                <span class="detail-value">{{ $sppBill->updated_at->format('d F Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                @if ($sppBill->payment)
                    <div class="info-card">
                        <div class="card-header">
                            <h5>
                                <i class="fas fa-credit-card text-success"></i>
                                Informasi Pembayaran
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="payment-info">
                                <h6 class="payment-title">
                                    <i class="fas fa-receipt"></i>
                                    Detail Pembayaran
                                </h6>
                                <div class="detail-grid">
                                    <div class="detail-item">
                                        <span class="detail-label">Order ID</span>
                                        <span class="detail-value">{{ $sppBill->payment->order_id }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Transaction ID</span>
                                        <span class="detail-value">{{ $sppBill->payment->transaction_id ?? '-' }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Metode Pembayaran</span>
                                        <span class="detail-value">{{ $sppBill->payment->payment_type ?? '-' }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Status</span>
                                        <span class="detail-value">
                                            <span class="status-badge badge-{{ $sppBill->payment->status_badge }}">
                                                {{ ucfirst($sppBill->payment->transaction_status) }}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Waktu Pembayaran</span>
                                        <span class="detail-value">
                                            {{ $sppBill->payment->transaction_time ? $sppBill->payment->transaction_time->format('d/m/Y H:i') : '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="info-card">
                        <div class="card-body">
                            <div class="no-payment">
                                <i class="fas fa-info-circle"></i>
                                <h5>Belum Ada Pembayaran</h5>
                                <p class="mb-0">Tagihan ini belum dibayar oleh siswa.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('admin.spp-bills.index') }}" class="btn-modern btn-back">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar
            </a>

            <div>
                @if ($sppBill->status !== 'paid')
                    <a href="{{ route('admin.spp-bills.edit', $sppBill) }}" class="btn-modern btn-edit">
                        <i class="fas fa-edit"></i>
                        Edit Tagihan
                    </a>
                @else
                    <button class="btn-modern btn-back" disabled>
                        <i class="fas fa-lock"></i>
                        Tagihan Sudah Lunas
                    </button>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>

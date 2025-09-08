<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1 fw-bold text-dark">
                    <i class="fas fa-edit me-2 text-primary"></i>
                    Edit Tagihan SPP
                </h2>
                <p class="text-muted mb-0">Ubah detail tagihan SPP untuk siswa</p>
            </div>
        </div>
    </x-slot>

    <style>
        .edit-form-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .form-section {
            background: white;
            border-radius: 16px;
            padding: 1.75rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1.25rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .section-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .section-icon.student {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .section-icon.billing {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .section-icon.schedule {
            background: linear-gradient(135deg, #f093fb, #f5576c);
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            color: #0f172a;
        }

        .section-subtitle {
            color: #64748b;
            margin: 0.3rem 0 0 0;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.6rem;
            font-size: 0.95rem;
        }

        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.85rem 1.1rem;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            background: #fafafa;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        .form-control:focus, .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            background: white;
            outline: none;
        }

        .form-control:disabled, .form-select:disabled {
            background: #f1f5f9;
            color: #94a3b8;
            cursor: not-allowed;
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #ef4444;
            background: #fee2e2;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.9rem;
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .alert-modern {
            background: linear-gradient(120deg, #dbeafe, #d1fae5);
            border: 1px solid #93c5fd;
            color: #1e40af;
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }

        .alert-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(30, 64, 175, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 0.1rem;
        }

        .action-buttons {
            background: white;
            border-radius: 16px;
            padding: 1.75rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
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

        .btn-submit {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.3px;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s ease;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }

        .required {
            color: #ef4444;
        }

        .form-hint {
            font-size: 0.875rem;
            color: #64748b;
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .bill-info-card {
            background: linear-gradient(120deg, #f0f9ff, #e0f2fe);
            border-radius: 14px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #bae6fd;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }

        .bill-info-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0369a1;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .bill-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .bill-info-item {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }

        .bill-info-label {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 0.25rem;
        }

        .bill-info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0f172a;
        }

        @media (max-width: 992px) {
            .form-section {
                padding: 1.5rem;
            }
            
            .section-header {
                gap: 1rem;
            }
            
            .section-icon {
                width: 48px;
                height: 48px;
                font-size: 1.1rem;
            }
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-modern {
                width: 100%;
                justify-content: center;
                padding: 1rem;
            }
            
            .bill-info-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 576px) {
            .section-header {
                flex-direction: column;
                text-align: center;
                gap: 0.75rem;
            }
            
            .form-section {
                padding: 1.25rem;
            }
        }
    </style>

    <div class="edit-form-container">
        <!-- Bill Information Summary -->
        <div class="bill-info-card">
            <h5 class="bill-info-title">
                <i class="fas fa-info-circle"></i>
                Informasi Tagihan
            </h5>
            <div class="bill-info-grid">
                <div class="bill-info-item">
                    <div class="bill-info-label">Siswa</div>
                    <div class="bill-info-value">{{ $sppBill->student->name }}</div>
                </div>
                <div class="bill-info-item">
                    <div class="bill-info-label">NIS</div>
                    <div class="bill-info-value">{{ $sppBill->student->nis }}</div>
                </div>
                <div class="bill-info-item">
                    <div class="bill-info-label">Kelas</div>
                    <div class="bill-info-value">{{ $sppBill->student->class }}</div>
                </div>
                <div class="bill-info-item">
                    <div class="bill-info-label">Status Saat Ini</div>
                    <div class="bill-info-value">
                        @if ($sppBill->status === 'paid')
                            <span class="text-success">Lunas</span>
                        @elseif($sppBill->status === 'pending')
                            <span class="text-warning">Pending</span>
                        @else
                            <span class="text-secondary">Belum Bayar</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.spp-bills.update', $sppBill) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Student Selection Section -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon student">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div>
                        <h3 class="section-title">Informasi Siswa</h3>
                        <p class="section-subtitle">Data siswa terkait tagihan</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="student_id" class="form-label">
                                <i class="fas fa-user text-primary"></i>
                                Pilih Siswa <span class="required">*</span>
                            </label>
                            <select class="form-select @error('student_id') is-invalid @enderror" 
                                    id="student_id" name="student_id" required {{ $sppBill->status === 'paid' ? 'disabled' : '' }}>
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" 
                                        {{ (old('student_id', $sppBill->student_id) == $student->id) ? 'selected' : '' }}>
                                        {{ $student->nis }} - {{ $student->name }} ({{ $student->class }})
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            @if($sppBill->status === 'paid')
                                <div class="form-hint">
                                    <i class="fas fa-lock"></i>
                                    Tidak dapat mengubah siswa untuk tagihan yang sudah lunas
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Billing Information Section -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon billing">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div>
                        <h3 class="section-title">Informasi Tagihan</h3>
                        <p class="section-subtitle">Detail jumlah tagihan SPP</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount" class="form-label">
                                <i class="fas fa-rupiah-sign text-success"></i>
                                Jumlah Tagihan <span class="required">*</span>
                            </label>
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" 
                                   id="amount" name="amount" value="{{ old('amount', $sppBill->amount) }}" 
                                   min="0" step="1000" required {{ $sppBill->status === 'paid' ? 'disabled' : '' }}>
                            @error('amount')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            @if($sppBill->status === 'paid')
                                <div class="form-hint">
                                    <i class="fas fa-lock"></i>
                                    Tidak dapat mengubah jumlah untuk tagihan yang sudah lunas
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description" class="form-label">
                                <i class="fas fa-sticky-note text-info"></i>
                                Deskripsi (Opsional)
                            </label>
                            <input type="text" class="form-control" id="description" name="description" 
                                   value="{{ old('description', $sppBill->description) }}" 
                                   placeholder="Contoh: Tagihan SPP Bulanan" {{ $sppBill->status === 'paid' ? 'disabled' : '' }}>
                            <div class="form-hint">
                                <i class="fas fa-pen"></i>
                                Tambahkan keterangan tambahan untuk tagihan ini
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schedule Section -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon schedule">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div>
                        <h3 class="section-title">Jadwal Pembayaran</h3>
                        <p class="section-subtitle">Periode dan batas waktu pembayaran</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="month" class="form-label">
                                <i class="fas fa-calendar text-info"></i>
                                Bulan <span class="required">*</span>
                            </label>
                            <select class="form-select @error('month') is-invalid @enderror" 
                                    id="month" name="month" required {{ $sppBill->status === 'paid' ? 'disabled' : '' }}>
                                <option value="">-- Pilih Bulan --</option>
                                @php
                                    $months = [
                                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                    ];
                                @endphp
                                @foreach($months as $month)
                                    <option value="{{ $month }}" 
                                        {{ old('month', $sppBill->month) == $month ? 'selected' : '' }}>
                                        {{ $month }}
                                    </option>
                                @endforeach
                            </select>
                            @error('month')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            @if($sppBill->status === 'paid')
                                <div class="form-hint">
                                    <i class="fas fa-lock"></i>
                                    Tidak dapat mengubah bulan untuk tagihan yang sudah lunas
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="year" class="form-label">
                                <i class="fas fa-calendar-week text-primary"></i>
                                Tahun <span class="required">*</span>
                            </label>
                            <select class="form-select @error('year') is-invalid @enderror" 
                                    id="year" name="year" required {{ $sppBill->status === 'paid' ? 'disabled' : '' }}>
                                <option value="">-- Pilih Tahun --</option>
                                @for($year = date('Y') - 1; $year <= date('Y') + 1; $year++)
                                    <option value="{{ $year }}" 
                                        {{ old('year', $sppBill->year) == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            @error('year')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            @if($sppBill->status === 'paid')
                                <div class="form-hint">
                                    <i class="fas fa-lock"></i>
                                    Tidak dapat mengubah tahun untuk tagihan yang sudah lunas
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="due_date" class="form-label">
                                <i class="fas fa-clock text-danger"></i>
                                Tanggal Jatuh Tempo <span class="required">*</span>
                            </label>
                            <input type="date" class="form-control @error('due_date') is-invalid @enderror" 
                                   id="due_date" name="due_date" 
                                   value="{{ old('due_date', $sppBill->due_date->format('Y-m-d')) }}" required>
                            @error('due_date')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status" class="form-label">
                                <i class="fas fa-info-circle text-warning"></i>
                                Status <span class="required">*</span>
                            </label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="unpaid" {{ old('status', $sppBill->status) == 'unpaid' ? 'selected' : '' }}>
                                    Belum Bayar
                                </option>
                                <option value="pending" {{ old('status', $sppBill->status) == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="paid" {{ old('status', $sppBill->status) == 'paid' ? 'selected' : '' }}>
                                    Lunas
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="fas fa-exclamation-triangle"></i>
                                Hati-hati dalam mengubah status
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            @if($sppBill->payment)
                <div class="alert-modern">
                    <div class="alert-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div>
                        <strong>Informasi Pembayaran:</strong> Tagihan ini terkait dengan pembayaran 
                        <strong>{{ $sppBill->payment->order_id }}</strong> 
                        dengan status <strong>{{ $sppBill->payment->transaction_status }}</strong>.
                        @if($sppBill->payment->transaction_time)
                            Dibayar pada {{ $sppBill->payment->transaction_time->format('d/m/Y H:i') }}.
                        @endif
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('admin.spp-bills.index') }}" class="btn-modern btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>

                <button type="submit" class="btn-modern btn-submit" {{ $sppBill->status === 'paid' ? 'disabled' : '' }}>
                    <i class="fas fa-save"></i>
                    @if($sppBill->status === 'paid')
                        Tagihan Sudah Lunas
                    @else
                        Update Tagihan
                    @endif
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

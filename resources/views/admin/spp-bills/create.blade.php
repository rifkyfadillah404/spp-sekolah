<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1 fw-bold text-dark">
                    <i class="fas fa-file-invoice-dollar me-2 text-primary"></i>
                    Buat Tagihan SPP Baru
                </h2>
                <p class="text-muted mb-0">Buat tagihan SPP untuk siswa dengan mudah dan cepat</p>
            </div>
        </div>
    </x-slot>

    <style>
        .modern-form-container {
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
            transform: translateY(-3px);
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
            background: linear-gradient(135deg, #3b82f6, #6366f1);
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
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        .loading-spinner {
            display: none;
            width: 22px;
            height: 22px;
            border: 3px solid #dbeafe;
            border-top: 3px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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

        .card-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 1.25rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.02);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
        }

        .stat-title {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 0.25rem;
            font-weight: 500;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
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

            .card-stats {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 576px) {
            .card-stats {
                grid-template-columns: 1fr;
            }

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

    <div class="modern-form-container">

        <form action="{{ route('admin.spp-bills.store') }}" method="POST" id="billForm">
            @csrf

            <!-- Student Selection Section -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon student">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <h3 class="section-title">Pilih Siswa</h3>
                        <p class="section-subtitle">Tentukan siswa yang akan dibuatkan tagihan SPP</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="class" class="form-label">
                                <i class="fas fa-layer-group text-primary"></i>
                                Kelas <span class="required">*</span>
                            </label>
                            <select class="form-select" id="class" name="class" required>
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class }}" {{ old('class') == $class ? 'selected' : '' }}>
                                        {{ $class }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-hint">
                                <i class="fas fa-info-circle"></i>
                                Pilih kelas terlebih dahulu untuk memuat daftar siswa
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="student_id" class="form-label">
                                <i class="fas fa-user-graduate text-success"></i>
                                Siswa <span class="required">*</span>
                            </label>
                            <select class="form-select @error('student_id') is-invalid @enderror"
                                    id="student_id" name="student_id" required disabled>
                                <option value="">-- Pilih Siswa --</option>
                            </select>
                            @error('student_id')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="fas fa-user-check"></i>
                                Siswa akan muncul setelah memilih kelas
                            </div>
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
                        <p class="section-subtitle">Detail jumlah dan periode tagihan SPP</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount" class="form-label">
                                <i class="fas fa-rupiah-sign text-warning"></i>
                                Jumlah Tagihan <span class="required">*</span>
                            </label>
                            <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                   id="amount" name="amount" value="{{ old('amount', 600000) }}"
                                   min="0" step="1000" required>
                            @error('amount')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="fas fa-calculator"></i>
                                Masukkan jumlah dalam Rupiah (kelipatan 1000)
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description" class="form-label">
                                <i class="fas fa-sticky-note text-info"></i>
                                Deskripsi (Opsional)
                            </label>
                            <input type="text" class="form-control" id="description" name="description"
                                   value="{{ old('description') }}" placeholder="Contoh: Tagihan SPP Bulanan">
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
                        <p class="section-subtitle">Tentukan periode dan batas waktu pembayaran</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="month" class="form-label">
                                <i class="fas fa-calendar text-info"></i>
                                Bulan <span class="required">*</span>
                            </label>
                            <select class="form-select @error('month') is-invalid @enderror"
                                    id="month" name="month" required>
                                <option value="">-- Pilih Bulan --</option>
                                @php
                                    $months = [
                                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                    ];
                                    $currentMonth = date('n');
                                @endphp
                                @foreach($months as $index => $month)
                                    <option value="{{ $month }}" {{ old('month') == $month || ($index+1) == $currentMonth ? 'selected' : '' }}>
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
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="year" class="form-label">
                                <i class="fas fa-calendar-week text-primary"></i>
                                Tahun <span class="required">*</span>
                            </label>
                            <select class="form-select @error('year') is-invalid @enderror"
                                    id="year" name="year" required>
                                <option value="">-- Pilih Tahun --</option>
                                @for($year = date('Y') - 1; $year <= date('Y') + 1; $year++)
                                    <option value="{{ $year }}" {{ old('year', date('Y')) == $year ? 'selected' : '' }}>
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
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="due_date" class="form-label">
                                <i class="fas fa-clock text-danger"></i>
                                Tanggal Jatuh Tempo <span class="required">*</span>
                            </label>
                            <input type="date" class="form-control @error('due_date') is-invalid @enderror"
                                   id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                            @error('due_date')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="fas fa-exclamation-triangle"></i>
                                Batas waktu pembayaran tagihan
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Alert -->
            <div class="alert-modern">
                <div class="alert-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div>
                    <strong>Perhatian:</strong> Pastikan kombinasi siswa, bulan, dan tahun belum pernah dibuat sebelumnya untuk menghindari duplikasi tagihan. Tagihan yang sudah dibuat tidak dapat dihapus jika sudah dibayar.
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('admin.spp-bills.index') }}" class="btn-modern btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>

                <button type="submit" class="btn-modern btn-submit" id="submitBtn">
                    <div class="loading-spinner" id="loadingSpinner"></div>
                    <i class="fas fa-plus-circle" id="submitIcon"></i>
                    <span id="submitText">Buat Tagihan Baru</span>
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const classSelect = document.getElementById('class');
            const studentSelect = document.getElementById('student_id');
            const studentIdOld = '{{ old('student_id') }}';
            const submitBtn = document.getElementById('submitBtn');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const submitIcon = document.getElementById('submitIcon');
            const submitText = document.getElementById('submitText');

            // Auto set due date to end of selected month
            document.getElementById('month').addEventListener('change', updateDueDate);
            document.getElementById('year').addEventListener('change', updateDueDate);

            function updateDueDate() {
                const month = document.getElementById('month').value;
                const year = document.getElementById('year').value;

                if (month && year) {
                    const monthIndex = [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ].indexOf(month);

                    if (monthIndex !== -1) {
                        const lastDay = new Date(year, monthIndex + 1, 0).getDate();
                        const dueDate = new Date(year, monthIndex, lastDay);

                        const formattedDate = dueDate.toISOString().split('T')[0];
                        document.getElementById('due_date').value = formattedDate;
                    }
                }
            }

            // Auto set due date on page load if month and year are pre-selected
            if (document.getElementById('month').value && document.getElementById('year').value) {
                updateDueDate();
            }

            // Handle class selection
            classSelect.addEventListener('change', function() {
                const selectedClass = this.value;
                studentSelect.innerHTML = '<option value="">-- Memuat Siswa --</option>';
                studentSelect.disabled = true;

                if (selectedClass) {
                    // Add loading animation
                    studentSelect.style.background = 'linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%)';
                    studentSelect.style.backgroundSize = '200% 100%';
                    studentSelect.style.animation = 'loading 1.5s infinite';

                    fetch(`{{ route('admin.spp-bills.getStudentsByClass') }}?class=${selectedClass}`)
                        .then(response => response.json())
                        .then(data => {
                            studentSelect.innerHTML = '<option value="">-- Pilih Siswa --</option>';
                            data.forEach(student => {
                                const option = document.createElement('option');
                                option.value = student.id;
                                option.textContent = `${student.nis} - ${student.name}`;
                                if (student.id == studentIdOld) {
                                    option.selected = true;
                                }
                                studentSelect.appendChild(option);
                            });
                            studentSelect.disabled = false;
                            studentSelect.style.background = '#fafafa';
                            studentSelect.style.animation = '';
                        })
                        .catch(error => {
                            console.error('Error fetching students:', error);
                            studentSelect.innerHTML = '<option value="">-- Gagal memuat siswa --</option>';
                            studentSelect.style.background = '#fee2e2';
                            studentSelect.style.animation = '';
                        });
                } else {
                    studentSelect.innerHTML = '<option value="">-- Pilih Siswa --</option>';
                    studentSelect.disabled = true;
                    studentSelect.style.background = '#f1f5f9';
                    studentSelect.style.animation = '';
                }
            });

            // Form submission with loading state
            document.getElementById('billForm').addEventListener('submit', function(e) {
                submitBtn.disabled = true;
                loadingSpinner.style.display = 'block';
                submitIcon.style.display = 'none';
                submitText.textContent = 'Membuat Tagihan...';

                // Re-enable after 10 seconds as fallback
                setTimeout(() => {
                    submitBtn.disabled = false;
                    loadingSpinner.style.display = 'none';
                    submitIcon.style.display = 'block';
                    submitText.textContent = 'Buat Tagihan Baru';
                }, 10000);
            });

            // Trigger change on page load if a class is already selected
            if (classSelect.value) {
                classSelect.dispatchEvent(new Event('change'));
            }

            // Add loading animation CSS
            const style = document.createElement('style');
            style.textContent = `
                @keyframes loading {
                    0% { background-position: 200% 0; }
                    100% { background-position: -200% 0; }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
    @endpush
</x-admin-layout>

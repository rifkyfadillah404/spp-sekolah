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
            max-width: 1000px;
            margin: 0 auto;
        }

        .form-section {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f8fafc;
        }

        .section-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: white;
        }

        .section-icon.student {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .section-icon.billing {
            background: linear-gradient(135deg, #f093fb, #f5576c);
        }

        .section-icon.schedule {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
            color: #1a202c;
        }

        .section-subtitle {
            color: #718096;
            margin: 0.25rem 0 0 0;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: white;
            outline: none;
        }

        .form-control:disabled, .form-select:disabled {
            background: #f1f5f9;
            color: #94a3b8;
            cursor: not-allowed;
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #e53e3e;
            background: #fed7d7;
        }

        .invalid-feedback {
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .alert-modern {
            background: linear-gradient(135deg, #e6f3ff, #cce7ff);
            border: 1px solid #99d6ff;
            color: #0066cc;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: rgba(0, 102, 204, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .action-buttons {
            background: white;
            border-radius: 16px;
            padding: 1.5rem 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .btn-modern {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-back {
            background: #f7fafc;
            color: #4a5568;
            border: 2px solid #e2e8f0;
        }

        .btn-back:hover {
            background: #edf2f7;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .required {
            color: #e53e3e;
        }

        .form-hint {
            font-size: 0.85rem;
            color: #718096;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        @media (max-width: 768px) {
            .form-section {
                padding: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-modern {
                width: 100%;
                justify-content: center;
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
                                <i class="fas fa-user text-success"></i>
                                Siswa <span class="required">*</span>
                            </label>
                            <select class="form-select @error('student_id') is-invalid @enderror"
                                    id="student_id" name="student_id" required disabled>
                                <option value="">-- Pilih Siswa --</option>
                            </select>
                            @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
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
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-hint">
                                <i class="fas fa-calculator"></i>
                                Masukkan jumlah dalam Rupiah (kelipatan 1000)
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
                                @endphp
                                @foreach($months as $month)
                                    <option value="{{ $month }}" {{ old('month') == $month ? 'selected' : '' }}>
                                        {{ $month }}
                                    </option>
                                @endforeach
                            </select>
                            @error('month')
                                <div class="invalid-feedback">{{ $message }}</div>
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
                                <div class="invalid-feedback">{{ $message }}</div>
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
                                <div class="invalid-feedback">{{ $message }}</div>
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
                    <strong>Perhatian:</strong> Pastikan kombinasi siswa, bulan, dan tahun belum pernah dibuat sebelumnya untuk menghindari duplikasi tagihan.
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
                    <span id="submitText">Buat Tagihan</span>
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
                            studentSelect.style.background = '#fed7d7';
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

                // Re-enable after 5 seconds as fallback
                setTimeout(() => {
                    submitBtn.disabled = false;
                    loadingSpinner.style.display = 'none';
                    submitIcon.style.display = 'block';
                    submitText.textContent = 'Buat Tagihan';
                }, 5000);
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

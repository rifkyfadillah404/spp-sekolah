<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1 fw-bold text-dark">
                    <i class="fas fa-user-plus me-2 text-primary"></i>
                    Tambah Siswa Baru
                </h2>
                <p class="text-muted mb-0">Buat akun siswa baru dengan informasi lengkap dan aman</p>
            </div>
        </div>
    </x-slot>

    <style>

        .modern-form-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .form-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f8fafc;
        }

        .section-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .section-icon.personal {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .section-icon.account {
            background: linear-gradient(135deg, #f093fb, #f5576c);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            color: #1a202c;
        }

        .section-subtitle {
            color: #718096;
            margin: 0.25rem 0 0 0;
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

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.875rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: white;
            outline: none;
        }

        .form-control.is-invalid {
            border-color: #e53e3e;
            background: #fed7d7;
        }

        .invalid-feedback {
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .input-group {
            position: relative;
        }

        .input-group .form-control {
            padding-right: 3rem;
        }

        .input-group-append {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .btn-toggle-password {
            background: none;
            border: none;
            padding: 0 1rem;
            color: #718096;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .btn-toggle-password:hover {
            color: #667eea;
        }

        .form-text {
            color: #718096;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .action-buttons {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .btn-modern {
            padding: 0.875rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
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

        .btn-reset {
            background: #fed7d7;
            color: #c53030;
            border: 2px solid #feb2b2;
        }

        .btn-reset:hover {
            background: #fbb6ce;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(197,48,48,0.2);
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

        .required {
            color: #e53e3e;
        }

        @media (max-width: 768px) {
            .modern-header {
                padding: 1.5rem;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .header-title {
                font-size: 2rem;
            }

            .progress-indicator {
                justify-content: center;
            }

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
        <form action="{{ route('admin.students.store') }}" method="POST" id="studentForm">
            @csrf

            <!-- Personal Information Section -->
            <div class="form-section" id="personalSection">
                <div class="section-header">
                    <div class="section-icon personal">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h3 class="section-title">Informasi Pribadi</h3>
                        <p class="section-subtitle">Data identitas dan kontak siswa</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-user text-primary"></i>
                                Nama Lengkap <span class="required">*</span>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}"
                                   placeholder="Masukkan nama lengkap siswa" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nis" class="form-label">
                                <i class="fas fa-id-card text-info"></i>
                                NIS <span class="required">*</span>
                            </label>
                            <input type="text" class="form-control @error('nis') is-invalid @enderror"
                                   id="nis" name="nis" value="{{ old('nis') }}"
                                   placeholder="Contoh: 2024001" required>
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="class" class="form-label">
                                <i class="fas fa-graduation-cap text-success"></i>
                                Kelas <span class="required">*</span>
                            </label>
                            <input type="text" class="form-control @error('class') is-invalid @enderror"
                                   id="class" name="class" value="{{ old('class') }}"
                                   placeholder="Contoh: X IPA 1" required>
                            @error('class')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone" class="form-label">
                                <i class="fas fa-phone text-warning"></i>
                                Nomor Telepon
                            </label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone" name="phone" value="{{ old('phone') }}"
                                   placeholder="Contoh: 081234567890">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">
                        <i class="fas fa-map-marker-alt text-danger"></i>
                        Alamat Lengkap
                    </label>
                    <textarea class="form-control @error('address') is-invalid @enderror"
                              id="address" name="address" rows="3"
                              placeholder="Masukkan alamat lengkap siswa">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Account Information Section -->
            <div class="form-section" id="accountSection">
                <div class="section-header">
                    <div class="section-icon account">
                        <i class="fas fa-key"></i>
                    </div>
                    <div>
                        <h3 class="section-title">Informasi Akun Login</h3>
                        <p class="section-subtitle">Kredensial untuk mengakses sistem</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope text-primary"></i>
                                Email <span class="required">*</span>
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}"
                                   placeholder="contoh@email.com" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle"></i>
                                Email akan digunakan untuk login ke sistem
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock text-success"></i>
                                Password <span class="required">*</span>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password"
                                       placeholder="Minimal 8 karakter" required>
                                <div class="input-group-append">
                                    <button class="btn-toggle-password" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-shield-alt"></i>
                                Password minimal 8 karakter untuk keamanan
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('admin.students.index') }}" class="btn-modern btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>

                <div class="d-flex gap-3">
                    <button type="reset" class="btn-modern btn-reset">
                        <i class="fas fa-undo"></i>
                        Reset Form
                    </button>
                    <button type="submit" class="btn-modern btn-submit">
                        <i class="fas fa-save"></i>
                        Simpan Siswa
                    </button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Auto-generate email from name
        document.getElementById('name').addEventListener('input', function() {
            const name = this.value.toLowerCase()
                .replace(/\s+/g, '')
                .replace(/[^a-z0-9]/g, '');
            const email = document.getElementById('email');

            if (name && !email.value) {
                email.value = name + '@student.spp.com';
            }
        });

        // Form validation with modern styling
        document.getElementById('studentForm').addEventListener('submit', function(e) {
            const requiredFields = ['name', 'nis', 'class', 'email', 'password'];
            let isValid = true;

            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                const formGroup = input.closest('.form-group');

                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;

                    // Add shake animation
                    formGroup.style.animation = 'shake 0.5s ease-in-out';
                    setTimeout(() => {
                        formGroup.style.animation = '';
                    }, 500);
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();

                // Show notification
                const notification = document.createElement('div');
                notification.className = 'alert alert-danger';
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    border-radius: 12px;
                    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
                `;
                notification.innerHTML = `
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Mohon lengkapi semua field yang wajib diisi!
                `;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }
        });

        // Add shake animation CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
        `;
        document.head.appendChild(style);

        // Progress indicator animation
        const personalInputs = document.querySelectorAll('#personalSection input, #personalSection textarea');
        const accountInputs = document.querySelectorAll('#accountSection input');
        const steps = document.querySelectorAll('.step');

        function updateProgress() {
            const personalFilled = Array.from(personalInputs).some(input => input.value.trim());
            const accountFilled = Array.from(accountInputs).some(input => input.value.trim());

            if (personalFilled) {
                steps[0].classList.add('active');
            }

            if (accountFilled) {
                steps[1].classList.add('active');
            }
        }

        [...personalInputs, ...accountInputs].forEach(input => {
            input.addEventListener('input', updateProgress);
        });
    </script>
    @endpush
</x-admin-layout>

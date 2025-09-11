<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <style>
        .auth-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 2.5rem;
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .auth-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 15px 10px -6px rgba(0, 0, 0, 0.04);
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            font-size: 0.9rem;
            color: #64748b;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #334155;
            margin-bottom: 0.5rem;
        }

        .form-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            background-color: #f8fafc;
            font-size: 0.95rem;
            color: #1e293b;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
        }

        .form-input:focus {
            outline: none;
            border-color: #6366f1;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-input::placeholder {
            color: #94a3b8;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
        }

        .form-checkbox {
            width: 1rem;
            height: 1rem;
            color: #6366f1;
            border: 1px solid #cbd5e1;
            border-radius: 0.25rem;
            margin-right: 0.75rem;
            cursor: pointer;
        }

        .form-checkbox:checked {
            background-color: #6366f1;
            border-color: #6366f1;
        }

        .checkbox-label {
            font-size: 0.875rem;
            color: #64748b;
            cursor: pointer;
        }

        .forgot-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: #6366f1;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .forgot-link:hover {
            color: #4338ca;
            text-decoration: underline;
        }

        .auth-button {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0.875rem 1rem;
            border: none;
            border-radius: 0.5rem;
            background: linear-gradient(to right, #6366f1, #8b5cf6);
            color: white;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.2), 0 2px 4px -2px rgba(99, 102, 241, 0.1);
        }

        .auth-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 8px -1px rgba(99, 102, 241, 0.3), 0 4px 6px -2px rgba(99, 102, 241, 0.1);
        }

        .auth-button:active {
            transform: translateY(0);
        }

        .auth-link-container {
            text-align: center;
            padding-top: 1.25rem;
            margin-top: 1.25rem;
            border-top: 1px solid #e2e8f0;
        }

        .auth-text {
            font-size: 0.875rem;
            color: #64748b;
        }

        .auth-link {
            font-weight: 600;
            color: #6366f1;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .auth-link:hover {
            color: #4338ca;
            text-decoration: underline;
        }

        .error-message {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: #dc2626;
            display: flex;
            align-items: center;
        }

        .error-icon {
            width: 0.875rem;
            height: 0.875rem;
            margin-right: 0.5rem;
        }
    </style>

    <div class="auth-container">
        <h2 class="form-title">Selamat Datang</h2>
        <p class="form-subtitle">Silakan masuk ke akun Anda</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">
                    Email
                </label>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       autocomplete="username"
                       class="form-input"
                       placeholder="Masukkan email Anda">
                
                @if($errors->get('email'))
                    <div class="error-message">
                        <svg class="error-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        @foreach($errors->get('email') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">
                    Password
                </label>
                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       class="form-input"
                       placeholder="Masukkan password Anda">
                
                @if($errors->get('password'))
                    <div class="error-message">
                        <svg class="error-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        @foreach($errors->get('password') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="checkbox-container">
                <div class="checkbox-group">
                    <input id="remember_me"
                           type="checkbox"
                           name="remember"
                           class="form-checkbox">
                    <label for="remember_me" class="checkbox-label">
                        Ingat saya
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <button type="submit" class="auth-button">
                Masuk ke Akun
            </button>
        </form>

        <!-- Register Link -->
        @if (Route::has('register'))
            <div class="auth-link-container">
                <p class="auth-text">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="auth-link">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        @endif
    </div>
</x-guest-layout>
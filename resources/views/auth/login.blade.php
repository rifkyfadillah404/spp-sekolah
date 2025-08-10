<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <style>
        .form-container {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .input-container {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            width: 1.25rem;
            height: 1.25rem;
            color: #9ca3af;
            pointer-events: none;
        }

        .form-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            background-color: rgba(249, 250, 251, 0.5);
            font-size: 0.875rem;
            color: #1f2937;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background-color: white;
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 0.5rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
        }

        .form-checkbox {
            width: 1rem;
            height: 1rem;
            color: #3b82f6;
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;
            margin-right: 0.75rem;
        }

        .checkbox-label {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .forgot-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: #3b82f6;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: #1d4ed8;
        }

        .login-button {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem 1rem;
            margin-top: 1rem;
            border: none;
            border-radius: 0.75rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px 0 rgba(102, 126, 234, 0.4);
            overflow: hidden;
        }

        .login-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px 0 rgba(102, 126, 234, 0.6);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .button-icon {
            position: absolute;
            left: 1rem;
            width: 1.25rem;
            height: 1.25rem;
        }

        .register-link-container {
            text-align: center;
            padding-top: 1rem;
        }

        .register-text {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .register-link {
            font-weight: 600;
            color: #3b82f6;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .register-link:hover {
            color: #1d4ed8;
        }

        .error-message {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #dc2626;
        }
    </style>

    <form method="POST" action="{{ route('login') }}" class="form-container space-y-5">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">
                Email
            </label>
            <div class="input-container">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                </svg>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       autocomplete="username"
                       class="form-input"
                       placeholder="Masukkan email Anda">
            </div>
            @if($errors->get('email'))
                <div class="error-message">
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
            <div class="input-container">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       class="form-input"
                       placeholder="Masukkan password Anda">
            </div>
            @if($errors->get('password'))
                <div class="error-message">
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
        <button type="submit" class="login-button">
            <svg class="button-icon" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
            Masuk ke Akun
        </button>

        <!-- Register Link -->
        @if (Route::has('register'))
            <div class="register-link-container">
                <p class="register-text">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="register-link">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        @endif
    </form>
</x-guest-layout>

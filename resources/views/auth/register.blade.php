<x-guest-layout>
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
        <h2 class="form-title">Buat Akun Baru</h2>
        <p class="form-subtitle">Silakan isi form di bawah ini</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input id="name" 
                       type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus 
                       autocomplete="name" 
                       class="form-input" 
                       placeholder="Masukkan nama lengkap Anda">
                
                <x-input-error :messages="$errors->get('name')" class="error-message mt-2" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autocomplete="username" 
                       class="form-input" 
                       placeholder="Masukkan email Anda">
                
                <x-input-error :messages="$errors->get('email')" class="error-message mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="new-password" 
                       class="form-input" 
                       placeholder="Masukkan password Anda">
                
                <x-input-error :messages="$errors->get('password')" class="error-message mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input id="password_confirmation" 
                       type="password" 
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password" 
                       class="form-input" 
                       placeholder="Konfirmasi password Anda">
                
                <x-input-error :messages="$errors->get('password_confirmation')" class="error-message mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="auth-link" href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>

                <button type="submit" class="auth-button ms-4">
                    {{ __('Daftar') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
@extends('layouts.app')

@section('content')
<div class="login-register-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="register-wrapper">
                    <!-- Logo & Header -->
                    <div class="auth-header text-center">
                        <div class="app-logo">
                            <i class="fas fa-cash-register"></i>
                        </div>
                        <h1 class="auth-title">{{ config('app.name', 'E-Kasir') }}</h1>
                        <p class="auth-subtitle">Create a new account to get started</p>
                    </div>

                    <!-- Register Form -->
                    <div class="auth-card">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">
                                    <i class="fas fa-user"></i> {{ __('Full Name') }}
                                </label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">
                                    <i class="fas fa-envelope"></i> {{ __('Email Address') }}
                                </label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">
                                            <i class="fas fa-lock"></i> {{ __('Password') }}
                                        </label>
                                        <div class="password-input-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            <div class="password-toggle" onclick="togglePassword('password', 'password-toggle-icon')">
                                                <i class="fas fa-eye" id="password-toggle-icon"></i>
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password-confirm">
                                            <i class="fas fa-lock"></i> {{ __('Confirm Password') }}
                                        </label>
                                        <div class="password-input-group">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            <div class="password-toggle" onclick="togglePassword('password-confirm', 'confirm-toggle-icon')">
                                                <i class="fas fa-eye" id="confirm-toggle-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role">
                                    <i class="fas fa-user-tag"></i> {{ __('Role') }}
                                </label>
                                <select id="role" class="form-select @error('role') is-invalid @enderror" name="role" required>
                                    <option value="Kasir">Kasir</option>
                                    <!-- Add other roles if needed -->
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary register-btn w-100">
                                    <i class="fas fa-user-plus me-2"></i>{{ __('Create Account') }}
                                </button>
                            </div>
                            
                            <div class="login-link text-center mt-3">
                                <span>Already have an account?</span>
                                <a href="{{ route('login') }}">
                                    {{ __('Login here') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .login-register-container {
        min-height: calc(100vh - 76px);
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4eaf1 100%);
        padding: 2rem 0;
    }
    
    .register-wrapper {
        animation: fadeIn 0.8s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .auth-header {
        margin-bottom: 2rem;
    }
    
    .app-logo {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: var(--primary-color);
        height: 80px;
        width: 80px;
        background-color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.2);
    }
    
    .auth-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--primary-color);
    }
    
    .auth-subtitle {
        color: #6c757d;
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .auth-card {
        background-color: white;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        margin-bottom: 1.5rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
        color: #495057;
    }
    
    .form-control, .form-select {
        height: 50px;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
        font-size: 1rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
    
    .password-input-group {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
        transition: color 0.3s ease;
    }
    
    .password-toggle:hover {
        color: var(--primary-color);
    }
    
    .register-btn {
        height: 50px;
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
        transition: all 0.3s ease;
    }
    
    .register-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
    }
    
    .login-link a {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .login-link a:hover {
        text-decoration: underline;
    }
    
    .login-link span {
        color: #6c757d;
    }
    
    @media (max-width: 768px) {
        .auth-card {
            padding: 1.5rem;
        }
        
        .auth-title {
            font-size: 1.8rem;
        }
    }
</style>

<script>
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const passwordToggleIcon = document.getElementById(iconId);
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggleIcon.classList.remove('fa-eye');
            passwordToggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordToggleIcon.classList.remove('fa-eye-slash');
            passwordToggleIcon.classList.add('fa-eye');
        }
    }
</script>
@endsection
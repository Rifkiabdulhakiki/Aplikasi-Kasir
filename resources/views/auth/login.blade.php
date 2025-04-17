@extends('layouts.app')

@section('content')
<div class="login-register-container">
    <div class="background-pattern"></div>
    <div class="accent-shape-1"></div>
    <div class="accent-shape-2"></div>
    <div class="floating-icons">
        <div class="icon icon-1"><i class="fas fa-receipt"></i></div>
        <div class="icon icon-2"><i class="fas fa-calculator"></i></div>
        <div class="icon icon-3"><i class="fas fa-money-bill-wave"></i></div>
        <div class="icon icon-4"><i class="fas fa-shopping-cart"></i></div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="login-wrapper">
                    <!-- Logo & Header -->
                    <div class="auth-header text-center">
                        <div class="app-logo">
                            <i class="fas fa-cash-register"></i>
                        </div>
                        <h1 class="auth-title">{{ config('app.name', 'E-Kasir') }}</h1>
                        <p class="auth-subtitle">Welcome back! Please login to your account</p>
                    </div>

                    <!-- Error Message -->
                    @if(session('error'))
                        <div class="alert alert-danger text-center custom-alert">
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <div class="auth-card">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">
                                    <i class="fas fa-envelope"></i> {{ __('Email Address') }}
                                </label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">
                                    <i class="fas fa-lock"></i> {{ __('Password') }}
                                </label>
                                <div class="password-input-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <div class="password-toggle" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="password-toggle-icon"></i>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group remember-me">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary login-btn w-100">
                                    <i class="fas fa-sign-in-alt me-2"></i>{{ __('Login') }}
                                </button>
                            </div>

                            <!-- @if (Route::has('password.request'))
                                <div class="forgot-password text-center mt-3">
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            @endif -->
                            
                            @if (Route::has('register'))
                                <div class="register-link text-center mt-3">
                                    <span>Don't have an account?</span>
                                    <a href="{{ route('register') }}">
                                        {{ __('Register now') }}
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .login-register-container {
        position: relative;
        min-height: calc(100vh - 76px);
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #f8faff 0%, #d4ddf5 100%);
        padding: 2rem 0;
        overflow: hidden;
    }
    
    /* New background elements */
    .background-pattern {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 25px 25px, rgba(67, 97, 238, 0.05) 2px, transparent 0),
            radial-gradient(circle at 75px 75px, rgba(67, 97, 238, 0.05) 2px, transparent 0);
        background-size: 100px 100px;
        z-index: 0;
    }
    
    .accent-shape-1 {
        position: absolute;
        top: -150px;
        right: -100px;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, rgba(94, 114, 228, 0.1) 100%);
        z-index: 0;
    }
    
    .accent-shape-2 {
        position: absolute;
        bottom: -200px;
        left: -100px;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.08) 0%, rgba(94, 114, 228, 0.08) 100%);
        z-index: 0;
    }
    
    .floating-icons {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 0;
        opacity: 0.05;
    }
    
    .icon {
        position: absolute;
        font-size: 24px;
        color: #4361ee;
    }
    
    .icon-1 { top: 15%; left: 10%; }
    .icon-2 { top: 30%; left: 85%; }
    .icon-3 { top: 70%; left: 20%; }
    .icon-4 { top: 60%; left: 80%; }
    
    /* Original styles */
    .login-wrapper {
        animation: fadeIn 0.8s ease-in-out;
        position: relative;
        z-index: 1;
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
    
    .custom-alert {
        border-radius: 10px;
        border-left: 5px solid #dc3545;
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        padding: 1rem;
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
    
    .form-control {
        height: 50px;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
        font-size: 1rem;
    }
    
    .form-control:focus {
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
    
    .remember-me {
        display: flex;
        align-items: center;
    }
    
    .form-check-input {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        cursor: pointer;
    }
    
    .form-check-label {
        font-weight: 500;
        cursor: pointer;
    }
    
    .login-btn {
        height: 50px;
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
        transition: all 0.3s ease;
    }
    
    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
    }
    
    .forgot-password a, .register-link a {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .forgot-password a:hover, .register-link a:hover {
        text-decoration: underline;
    }
    
    .register-link span {
        color: #6c757d;
    }
    
    @media (max-width: 768px) {
        .auth-card {
            padding: 1.5rem;
        }
        
        .auth-title {
            font-size: 1.8rem;
        }
        
        .accent-shape-1, 
        .accent-shape-2 {
            opacity: 0.5;
            transform: scale(0.8);
        }
    }
</style>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const passwordToggleIcon = document.getElementById('password-toggle-icon');
        
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
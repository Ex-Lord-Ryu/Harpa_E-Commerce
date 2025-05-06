@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <div class="animated-bg"></div>
    <div class="animated-bg bg2"></div>
    <div class="animated-bg bg3"></div>

    <div class="container position-relative">
        <div class="row justify-content-center align-items-center min-vh-100 py-5">
            <div class="col-lg-10">
                <div class="login-card">
                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-block login-left">
                            <div class="h-100 d-flex flex-column justify-content-center align-items-center position-relative p-4">
                                <div class="floating-shape shape1"></div>
                                <div class="floating-shape shape2"></div>
                                <div class="floating-shape shape3"></div>
                                <div class="floating-shape shape4"></div>

                                <div class="login-image-container">
                                    <img src="{{ asset('img/img/login.jpg') }}"
                                        alt="Music Illustration"
                                        class="img-fluid login-illustration">
                                </div>
                                <h3 class="text-white text-center mt-4 welcome-text">Harpa Music</h3>
                                <p class="text-white-50 text-center">Experience the rhythm of innovation</p>
                            </div>
                        </div>
                        <div class="col-lg-6 login-right">
                            <div class="card-body p-4 p-lg-5">
                                <div class="text-center mb-4">
                                    <div class="logo-container mb-3 d-lg-none">
                                        <img src="{{ asset('img/img/login.jpg') }}" alt="Logo" class="small-logo">
                                    </div>
                                    <h2 class="welcome-heading">{{ __('Welcome Back!') }}</h2>
                                    <p class="login-subtitle">Please login to your account</p>
                                </div>

                                @if (session('status'))
                                    <div class="alert custom-alert alert-dismissible fade show mb-4" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    {{-- <div class="mb-4">
                                        <label for="email" class="form-label text-muted">{{ __('Email Address') }}</label>
                                        <input id="email" type="email"
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            name="email"
                                            value="{{ old('email') }}"4
                                            required
                                            autocomplete="email"
                                            autofocus
                                            style="border-radius: 10px; border: 1px solid #e2e8f0;">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="password" class="form-label text-muted">{{ __('Password') }}</label>
                                        <input id="password"
                                            type="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            name="password"
                                            required
                                            autocomplete="current-password"
                                            style="border-radius: 10px; border: 1px solid #e2e8f0;">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label text-muted" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-lg w-100" style="border-radius: 10px; background: linear-gradient(to right, #e9c46a, #f4a261); color: #2a3541; border: none; font-weight: 600; height: 48px;">
                                            {{ __('Login') }}
                                        </button>
                                    </div> --}}

                                    <div class="login-options">
                                        <!-- Google button - preserved exactly as is -->
                                        <div class="mb-3">
                                            <a href="{{ route('auth.google') }}" class="google-btn">
                                                <span class="google-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                                                        <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                                                    </svg>
                                                </span>
                                                {{ __('Login with Google') }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        {{-- @if (Route::has('password.request'))
                                            <a class="text-decoration-none" href="{{ route('password.request') }}" style="color: #2a9d8f;">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif

                                        <div class="mt-3">
                                            <span class="text-muted">Don't have an account?</span>
                                            <a class="text-decoration-none ms-1 fw-bold" href="{{ route('register') }}" style="color: #2a9d8f;">
                                                {{ __('Register') }}
                                            </a>
                                        </div> --}}
                                        <div class="mt-3">
                                            <a href="{{ url('/') }}" class="back-btn">
                                                <span>← Kembali ke Halaman Utama</span>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary: #2a9d8f;
    --primary-dark: #218579;
    --secondary: #e9c46a;
    --secondary-light: #f4a261;
    --dark: #2a3541;
    --light: #f8f9fa;
    --card-border-radius: 24px;
    --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

body {
    overflow-x: hidden;
    background-color: var(--light);
}

.login-container {
    position: relative;
    min-height: 100vh;
    width: 100%;
    background-color: #f0f2f5;
    overflow: hidden;
}

.animated-bg {
    position: fixed;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at center, rgba(238, 246, 252, 0.8) 0%, rgba(219, 226, 237, 0.6) 100%);
    z-index: -1;
    animation: rotate 30s linear infinite;
}

.animated-bg.bg2 {
    top: -30%;
    left: -80%;
    width: 180%;
    height: 180%;
    background: radial-gradient(circle at center, rgba(42, 157, 143, 0.05) 0%, rgba(42, 157, 143, 0.02) 70%);
    animation: rotate 25s linear infinite reverse;
}

.animated-bg.bg3 {
    top: 40%;
    left: 60%;
    width: 160%;
    height: 160%;
    background: radial-gradient(circle at center, rgba(233, 196, 106, 0.05) 0%, rgba(244, 162, 97, 0.03) 60%);
    animation: rotate 20s linear infinite;
}

@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.login-card {
    border-radius: var(--card-border-radius);
    overflow: hidden;
    background-color: white;
    box-shadow: 0 10px 50px rgba(0, 0, 0, 0.1);
    position: relative;
    transform: translateY(0);
    transition: transform 0.5s ease;
    animation: card-appear 1s forwards;
}

@keyframes card-appear {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-left {
    background: linear-gradient(135deg, #2a9d8f, #43aa8b);
    position: relative;
    overflow: hidden;
}

.login-right {
    background-color: white;
    position: relative;
}

.floating-shape {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
}

.shape1 {
    width: 150px;
    height: 150px;
    top: 10%;
    left: 3%;
    animation: float 10s ease-in-out infinite 0.5s;
}

.shape2 {
    width: 150px;
    height: 150px;
    bottom: 20%;
    right: -2%;
    animation: float 12s ease-in-out infinite 1s;
}

.shape3 {
    width: 70px;
    height: 70px;
    top: 50%;
    left: 8%;
    animation: float 8s ease-in-out infinite 0.5s;
}

.shape4 {
    width: 80px;
    height: 80px;
    top: 15%;
    right: 1%;
    animation: float 10s ease-in-out infinite 1s;
}

.login-image-container {
    position: relative;
    width: 75%;
    max-width: 300px;
    animation: pulse 6s ease-in-out infinite;
}

.login-illustration {
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    transform-style: preserve-3d;
    animation: float 6s ease-in-out infinite;
    transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
    transition: var(--transition);
}

.welcome-text {
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    font-weight: 700;
    letter-spacing: 1px;
}

.small-logo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    object-fit: cover;
}

.logo-container {
    animation: bounce 1s ease-in-out;
}

.text-gradient {
    font-size: 2.2rem;
    font-weight: 800;
    background: linear-gradient(to right, var(--primary), var(--primary-dark));
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    text-fill-color: transparent;
    letter-spacing: -0.5px;
    margin-bottom: 0.5rem;
}

.subtitle {
    font-size: 1rem;
    opacity: 0.8;
    margin-top: -5px;
}

.custom-alert {
    background-color: #e7f0d3;
    border-color: transparent;
    color: #5a6851;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(90, 104, 81, 0.1);
}

.login-options {
    position: relative;
    z-index: 1;
}

/* Google button preserved - no changes */

.btn-back {
    display: inline-block;
    background: linear-gradient(to right, var(--secondary), var(--secondary-light));
    color: var(--dark);
    font-weight: 600;
    padding: 12px 30px;
    border-radius: 50px;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(233, 196, 106, 0.3);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.btn-back:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(233, 196, 106, 0.4);
    color: var(--dark);
}

.btn-back::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, var(--secondary-light), var(--secondary));
    opacity: 0;
    transition: all 0.3s ease;
    z-index: -1;
}

.btn-back:hover::before {
    opacity: 1;
}

@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
    100% {
        transform: translateY(0px);
    }
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes bounce {
    0% {
        transform: translateY(-20px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

@media (max-width: 992px) {
    .login-card {
        margin: 2rem 0;
    }

    .text-gradient {
        font-size: 1.8rem;
    }

    .login-right {
        padding: 2rem 1rem;
    }
}

@media (max-width: 576px) {
    .login-card {
        box-shadow: none;
        background: transparent;
    }

    .login-right {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: var(--card-border-radius);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .btn-back {
        width: 100%;
        text-align: center;
    }
}

.welcome-heading {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 0.5rem;
    text-align: center;
}

.login-subtitle {
    font-size: 1.1rem;
    color: #8a94a6;
    margin-bottom: 2rem;
    text-align: center;
}

.google-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 50px;
    background-color: #e74c3c;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: none;
    padding: 0.5rem 1.5rem;
    width: 100%;
    box-shadow: 0 4px 6px rgba(231, 76, 60, 0.2);
}

.google-btn:hover {
    background-color: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 7px 14px rgba(231, 76, 60, 0.25);
    color: white;
}

.google-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
}

.back-btn {
    display: inline-block;
    width: 100%;
    padding: 12px 24px;
    text-align: center;
    font-weight: 500;
    background-color: #f9ca7b;
    color: #2c3e50;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    margin-top: 1rem;
    border: none;
    box-shadow: 0 4px 6px rgba(249, 202, 123, 0.2);
}

.back-btn:hover {
    background-color: #f0b45f;
    transform: translateY(-2px);
    box-shadow: 0 7px 14px rgba(249, 202, 123, 0.25);
    color: #2c3e50;
}
</style>
@endsection

@extends('layouts.app')

@section('title', 'Login - Travelkartika Mas')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-header" style="background: linear-gradient(135deg, #2c5aa0 0%, #1a3a5c 100%); color: white;">
                            <h3 class="mb-0 text-center">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </h3>
                        </div>
                        <div class="card-body p-5">
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <i class="fas fa-exclamation-circle"></i> Login gagal
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    @foreach($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif

                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label class="form-label"><strong>Email</strong></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                           placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label"><strong>Password</strong></label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                           placeholder="Masukkan password Anda" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Ingat saya
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 btn-lg mb-3">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </button>
                            </form>

                            <hr>

                            <p class="text-center text-muted">
                                Belum punya akun? 
                                <a href="{{ route('register') }}" style="color: #2c5aa0; font-weight: bold;">
                                    Daftar di sini
                                </a>
                            </p>

                            <div class="alert alert-info mt-4">
                                <h6><i class="fas fa-info-circle"></i> Demo Akun</h6>
                                <small>
                                    <strong>Email:</strong> test@example.com<br>
                                    <strong>Password:</strong> password
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

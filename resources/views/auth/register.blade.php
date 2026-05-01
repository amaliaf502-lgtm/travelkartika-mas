@extends('layouts.app')

@section('title', 'Daftar - Travelkartika Mas')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-header" style="background: linear-gradient(135deg, #2c5aa0 0%, #1a3a5c 100%); color: white;">
                            <h3 class="mb-0 text-center">
                                <i class="fas fa-user-plus"></i> Daftar Akun
                            </h3>
                        </div>
                        <div class="card-body p-5">
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <i class="fas fa-exclamation-circle"></i> Registrasi gagal
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    @foreach($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif

                            <form action="{{ route('register.post') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label class="form-label"><strong>Nama Lengkap</strong></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                           placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

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
                                           placeholder="Minimal 8 karakter" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label"><strong>Konfirmasi Password</strong></label>
                                    <input type="password" name="password_confirmation" class="form-control" 
                                           placeholder="Masukkan ulang password" required>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="agree" required>
                                        <label class="form-check-label" for="agree">
                                            Saya setuju dengan <a href="#" style="color: #2c5aa0;">Syarat & Ketentuan</a>
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 btn-lg mb-3">
                                    <i class="fas fa-user-plus"></i> Daftar
                                </button>
                            </form>

                            <hr>

                            <p class="text-center text-muted">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}" style="color: #2c5aa0; font-weight: bold;">
                                    Login di sini
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

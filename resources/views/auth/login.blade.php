@extends('layouts.app')

@section('title', 'Masuk - Kartika Mas Tour & Travel')

@section('content')
<style>
    :root {
        --maroon: #8B0000;
        --gold: #DAA520;
        --gold-light: #FFD700;
    }

    .auth-wrapper {
        min-height: calc(100vh - 120px);
        background: linear-gradient(135deg, #fdf6ec 0%, #fff8f0 50%, #fdf0e0 100%);
        display: flex;
        align-items: center;
        padding: 24px 0;
    }

    .auth-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(139,0,0,0.15);
        border: 2px solid rgba(139,0,0,0.12);
        display: flex;
        max-width: 720px;
        margin: 0 auto;
        width: 100%;
    }

    /* ── Left Panel ── */
    .auth-panel-left {
        background: var(--maroon);
        flex: 0 0 38%;
        padding: 32px 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .auth-panel-left::before {
        content: '';
        position: absolute; inset: 0;
        background-image:
            repeating-linear-gradient(45deg, transparent, transparent 30px, rgba(255,255,255,0.03) 30px, rgba(255,255,255,0.03) 60px);
        pointer-events: none;
    }
    .auth-panel-left .kaaba-icon {
        font-size: 3.5rem;
        color: var(--gold-light);
        margin-bottom: 12px;
        filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
        animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-8px); }
    }
    .auth-panel-left h2 {
        color: var(--gold-light);
        font-weight: 900;
        font-size: 1.3rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
    }
    .auth-panel-left p {
        color: rgba(255,255,255,0.8);
        font-size: 0.8rem;
        line-height: 1.6;
        margin-bottom: 16px;
    }
    .auth-panel-left .gold-divider {
        width: 40px; height: 2px;
        background: var(--gold);
        border-radius: 2px;
        margin: 8px auto 12px;
    }
    .auth-panel-left .trust-badges {
        display: flex;
        flex-direction: column;
        gap: 7px;
        width: 100%;
    }
    .trust-badge {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(218,165,32,0.4);
        border-radius: 8px;
        padding: 6px 10px;
        color: white;
        font-size: 0.72rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .trust-badge i { color: var(--gold); width: 14px; }

    /* ── Right Panel (Form) ── */
    .auth-panel-right {
        flex: 1;
        padding: 30px 32px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .auth-panel-right .auth-title {
        font-size: 1.35rem;
        font-weight: 900;
        color: var(--maroon);
        margin-bottom: 2px;
    }
    .auth-panel-right .auth-subtitle {
        font-size: 0.82rem;
        color: #888;
        margin-bottom: 18px;
    }

    /* ── Form Inputs ── */
    .auth-input-group {
        margin-bottom: 13px;
    }
    .input-wrapper {
        position: relative;
    }
    .auth-input-group label {
        display: block;
        font-size: 0.72rem;
        font-weight: 700;
        color: var(--maroon);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .auth-input-group .input-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #bbb;
        font-size: 0.82rem;
        transition: color 0.2s;
    }
    .auth-input-group input {
        width: 100%;
        padding: 9px 12px 9px 36px;
        border: 2px solid #e8d5b0;
        border-radius: 10px;
        font-size: 0.88rem;
        background: #fffdf8;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
    }
    .auth-input-group input:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(218,165,32,0.15);
        background: #fff;
    }
    .auth-input-group input:focus + .input-icon,
    .auth-input-group input:focus ~ .input-icon {
        color: var(--gold);
    }
    .auth-input-group input.is-invalid { border-color: #e74c3c; }
    .invalid-feedback { font-size: 0.78rem; color: #e74c3c; margin-top: 4px; }

    /* ── Remember & Link ── */
    .auth-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
        font-size: 0.82rem;
    }
    .auth-remember { display: flex; align-items: center; gap: 6px; color: #666; }
    .auth-remember input[type="checkbox"] { accent-color: var(--maroon); }

    /* ── Submit Button ── */
    .btn-auth {
        width: 100%;
        background: var(--maroon);
        color: white;
        padding: 10px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.92rem;
        border: 2px solid var(--gold);
        cursor: pointer;
        transition: all 0.3s;
        letter-spacing: 0.5px;
        margin-bottom: 14px;
    }
    .btn-auth:hover {
        background: #a40000;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139,0,0,0.3);
    }
    .btn-auth:active { transform: translateY(0); }

    /* ── Divider & Register Link ── */
    .auth-or {
        text-align: center;
        position: relative;
        margin-bottom: 18px;
        color: #bbb;
        font-size: 0.82rem;
    }
    .auth-or::before, .auth-or::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 38%;
        height: 1px;
        background: #eee;
    }
    .auth-or::before { left: 0; }
    .auth-or::after  { right: 0; }

    .auth-redirect {
        text-align: center;
        font-size: 0.82rem;
        color: #888;
    }
    .auth-redirect a {
        color: var(--maroon);
        font-weight: 700;
        text-decoration: none;
        transition: color 0.2s;
    }
    .auth-redirect a:hover { color: var(--gold); }

    /* ── Demo Box ── */
    .demo-box {
        background: linear-gradient(135deg, #fdf6ec, #fff8f0);
        border: 1px dashed var(--gold);
        border-radius: 10px;
        padding: 8px 12px;
        margin-top: 12px;
        font-size: 0.76rem;
        color: #666;
    }
    .demo-box strong { color: var(--maroon); }
    .demo-box .demo-title { font-weight: 700; color: var(--gold); margin-bottom: 4px; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px; }

    /* ── Error Alert ── */
    .auth-alert {
        background: #fdf0f0;
        border: 1px solid #f5c6c6;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 0.82rem;
        color: #c0392b;
        margin-bottom: 18px;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    @media (max-width: 768px) {
        .auth-card { flex-direction: column; }
        .auth-panel-left { flex: none; padding: 24px 20px; }
        .auth-panel-left .kaaba-icon { font-size: 2.5rem; }
        .auth-panel-right { padding: 24px 20px; }
        .trust-badges { display: none; }
    }
</style>

<div class="auth-wrapper">
    <div class="container">
        <div class="auth-card">

            {{-- Left Decorative Panel --}}
            <div class="auth-panel-left">
                <img src="{{ asset('images/kartikamas.png') }}" alt="Logo Kartika Mas" style="width:110px; height:auto; object-fit:contain; margin-bottom:12px; filter: brightness(0) invert(1) drop-shadow(0 4px 12px rgba(0,0,0,0.3)); animation: float 3s ease-in-out infinite;">
                <h2>Kartika Mas Tour & Travel</h2>
                <div class="gold-divider"></div>
                <p>Perjalanan suci menuju Baitullah bersama kami. Aman, nyaman, dan terpercaya sejak lama.</p>
                <div class="trust-badges">
                    <div class="trust-badge"><i class="fas fa-shield-alt"></i> Terdaftar & Berizin Resmi</div>
                    <div class="trust-badge"><i class="fas fa-star"></i> Layanan Umroh Terpercaya</div>
                    <div class="trust-badge"><i class="fas fa-headset"></i> Support 24/7</div>
                </div>
            </div>

            {{-- Right Form Panel --}}
            <div class="auth-panel-right">
                <div class="auth-title">Selamat Datang</div>
                <div class="auth-subtitle">Masuk ke akun Anda untuk melanjutkan</div>

                @if($errors->any())
                    <div class="auth-alert">
                        <i class="fas fa-exclamation-circle" style="margin-top:2px;"></i>
                        <div>
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="auth-input-group">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email"
                                   class="@error('email') is-invalid @enderror"
                                   placeholder="nama@email.com"
                                   value="{{ old('email') }}" required autocomplete="email">
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="auth-input-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password"
                                   class="@error('password') is-invalid @enderror"
                                   placeholder="Masukkan password" required autocomplete="current-password">
                            <i class="fas fa-lock input-icon"></i>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="auth-row">
                        <label class="auth-remember">
                            <input type="checkbox" name="remember"> Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="btn-auth">
                        <i class="fas fa-sign-in-alt" style="margin-right:6px;"></i> Masuk
                    </button>
                </form>

                <div class="auth-or">atau</div>

                <div class="auth-redirect">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>


            </div>

        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Cara Pendaftaran - Kartika Mas Tour & Travel')

@section('content')
<style>
    .page-header-timeline {
        background: linear-gradient(135deg, var(--primary) 0%, #6b1010 100%);
        color: white;
        padding: 70px 0 60px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .timeline-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    .timeline-item-lg {
        display: flex;
        align-items: flex-start;
        margin-bottom: 40px;
        position: relative;
    }
    .timeline-item-lg::before {
        content: '';
        position: absolute;
        left: 32px;
        top: 60px;
        bottom: -40px;
        width: 3px;
        background: rgba(139,45,45,0.15);
        border-radius: 3px;
    }
    .timeline-item-lg:last-child::before {
        display: none;
    }
    .timeline-icon-lg {
        width: 65px;
        height: 65px;
        background: white;
        border: 4px solid var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--primary);
        position: relative;
        z-index: 2;
        flex-shrink: 0;
        box-shadow: 0 5px 15px rgba(139,45,45,0.2);
    }
    .timeline-content-lg {
        background: white;
        border-radius: 20px;
        padding: 25px 30px;
        margin-left: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        border: 1px solid rgba(139,45,45,0.08);
        flex: 1;
        transition: transform 0.3s;
    }
    .timeline-item-lg:hover .timeline-content-lg {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(139,45,45,0.12);
        border-color: var(--gold);
    }
    .timeline-item-lg:hover .timeline-icon-lg {
        background: var(--primary);
        color: white;
        border-color: var(--gold);
    }
    .timeline-content-lg h4 {
        color: var(--primary);
        font-weight: 800;
        margin-bottom: 10px;
    }
    .timeline-content-lg p {
        color: #555;
        margin-bottom: 0;
        line-height: 1.7;
    }
    .promo-box {
        background: linear-gradient(135deg, var(--primary) 0%, #a40000 100%);
        color: white;
        border-radius: 20px;
        padding: 40px;
        text-align: center;
        margin-top: 20px;
        box-shadow: 0 10px 30px rgba(139,45,45,0.3);
    }
    .btn-start {
        background: var(--gold);
        color: white;
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        transition: all 0.3s;
    }
    .btn-start:hover {
        background: #FFD700;
        color: #8B0000;
        transform: scale(1.05);
    }
    body { background: #f8f9fa; }
</style>

<div class="page-header-timeline">
    <div class="container">
        <h1 class="display-5 fw-bold">Cara Pendaftaran</h1>
        <p class="lead mb-0" style="color:rgba(255,255,255,0.85);">Langkah mudah mendaftar Umroh bersama Kartika Mas Tour & Travel</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-2 col-md-4 mb-4 text-center">
            <div style="width: 70px; height: 70px; background: var(--secondary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 15px; font-weight: bold;">1</div>
            <h5 style="color: var(--primary); font-weight: 600;">Pilih Paket Umroh</h5>
            <p class="text-muted" style="font-size: 0.9rem;">Jelajahi berbagai pilihan paket Umroh yang tersedia di katalog. Anda bisa membandingkan harga, jadwal, dan fasilitas.</p>
        </div>
        <div class="col-lg-2 col-md-4 mb-4 text-center">
            <div style="width: 70px; height: 70px; background: var(--secondary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 15px; font-weight: bold;">2</div>
            <h5 style="color: var(--primary); font-weight: 600;">Login / Buat Akun</h5>
            <p class="text-muted" style="font-size: 0.9rem;">Silakan Login jika sudah memiliki akun, atau Daftar terlebih dahulu dengan memasukkan nama, email, dan password Anda.</p>
        </div>
        <div class="col-lg-2 col-md-4 mb-4 text-center">
            <div style="width: 70px; height: 70px; background: var(--secondary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 15px; font-weight: bold;">3</div>
            <h5 style="color: var(--primary); font-weight: 600;">Isi Formulir</h5>
            <p class="text-muted" style="font-size: 0.9rem;">Klik tombol Pesan Sekarang pada paket pilihan Anda. Lengkapi data jamaah sesuai dengan identitas asli.</p>
        </div>
        <div class="col-lg-2 col-md-4 mb-4 text-center">
            <div style="width: 70px; height: 70px; background: var(--secondary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 15px; font-weight: bold;">4</div>
            <h5 style="color: var(--primary); font-weight: 600;">Pembayaran</h5>
            <p class="text-muted" style="font-size: 0.9rem;">Pilih metode pembayaran instan via Midtrans. Sistem akan memverifikasi pelunasan Anda secara otomatis.</p>
        </div>
        <div class="col-lg-2 col-md-4 mb-4 text-center">
            <div style="width: 70px; height: 70px; background: var(--secondary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 15px; font-weight: bold;">5</div>
            <h5 style="color: var(--primary); font-weight: 600;">Konfirmasi</h5>
            <p class="text-muted" style="font-size: 0.9rem;">Status pesanan akan diperbarui. Kami akan menghubungi Anda untuk penyerahan paspor dan jadwal manasik.</p>
        </div>
    </div>

    <div class="promo-box max-w-800 mx-auto mt-4" style="max-width: 800px;">
        <h3>Siap Menuju Baitullah?</h3>
        <p>Ribuan jamaah telah mempercayakan perjalanan ibadah mereka kepada kami. Kini giliran Anda.</p>
        <a href="{{ route('pakets.index') }}" class="btn-start">
            <i class="fas fa-paper-plane"></i> Lihat Paket Umroh Sekarang
        </a>
    </div>
</div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Tentang Kami - Kartika Mas Tour & Travel')

@section('content')
<style>
    .page-header {
        background: var(--primary);
        color: white;
        padding: 80px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .page-header::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 50px;
        background: white;
        clip-path: polygon(0 100%, 100% 0%, 100% 100%, 0 100%);
    }
    .about-img-wrapper {
        position: relative;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(139,45,45,0.15);
    }
    .vision-mision {
        background: #fdf6ec;
        border-radius: 30px;
        padding: 40px;
        border: 1px solid rgba(218,165,32,0.2);
    }
    .section-title {
        color: var(--primary);
        font-weight: 800;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 15px;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 60px;
        height: 4px;
        background: var(--secondary);
        border-radius: 2px;
    }
    .feature-item {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }
    .feature-icon {
        width: 45px;
        height: 45px;
        background: var(--primary);
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold">Tentang Kami</h1>
        <p class="lead">Mengenal Lebih Dekat Kartika Mas Tour & Travel</p>
    </div>
</div>

<div class="container py-4">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="about-img-wrapper">
                @if(file_exists(public_path('images/background.JPG')))
                    <img src="{{ asset('images/background.JPG') }}" alt="Kantor Kartika Mas Tour & Travel" class="img-fluid">
                @else
                    <div style="height: 400px; background: #ddd; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-building fa-4x text-muted"></i>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-6 ps-lg-5">
            <h2 class="section-title">Kartika Mas Tour & Travel</h2>
            <p class="lead" style="color: var(--primary); font-weight: 600;">Mitra Terpercaya Menuju Baitullah</p>
            <p>Kartika Mas Tour & Travel didirikan pada tahun 2024 dengan satu tujuan mulia: memfasilitasi perjalanan ibadah jamaah ke Tanah Suci dengan cara yang lebih mudah, transparan, dan terpercaya. Meskipun tergolong baru, kami dikelola oleh tenaga profesional yang berdedikasi tinggi di bidang layanan Umroh dan Haji.</p>
            <p>Kami memahami bahwa ibadah Umroh adalah perjalanan spiritual sekali seumur hidup bagi banyak orang. Oleh karena itu, kami berkomitmen untuk memberikan pelayanan yang ramah, jelas, dan responsif melalui sistem informasi berbasis teknologi yang kami kembangkan.</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="vision-mision h-100">
                <h3 class="section-title">Visi Kami</h3>
                <p>Menjadi travel umroh terkemuka yang dipercaya oleh jamaah karena komitmen pada nilai-nilai amanah, profesionalisme, dan kemudahan akses informasi berbasis digital.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="vision-mision h-100">
                <h3 class="section-title">Misi Kami</h3>
                <ul class="list-unstyled">
                    <li class="feature-item">
                        <div class="feature-icon"><i class="fas fa-heart"></i></div>
                        <div>Memberikan bimbingan ibadah yang sesuai sunnah dan kenyamanan maksimal bagi jamaah.</div>
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon"><i class="fas fa-laptop"></i></div>
                        <div>Mengembangkan sistem pendaftaran dan pemesanan yang mudah diakses dari mana saja secara otomatis.</div>
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon"><i class="fas fa-handshake"></i></div>
                        <div>Membangun kemitraan yang solid dengan penyedia akomodasi dan transportasi terbaik di Arab Saudi.</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="text-center py-4">
        <h3 class="mb-4" style="color: var(--primary); font-weight: 800;">Legalitas & Kepercayaan</h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="p-4 border rounded-4 bg-white shadow-sm">
                    <p class="mb-0">Kartika Mas Tour & Travel beroperasi dengan standar operasional yang ketat dan transparan. Setiap transaksi dan data jamaah dilindungi oleh sistem keamanan yang terintegrasi, memberikan Anda ketenangan dalam merencanakan ibadah suci.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Beranda - Travel Umroh Kartika Mas Tour & Travel')

@section('content')
@section('header-class', 'hero-header')
    @section('css')
        <style>
            /* Hapus padding-top main agar hero memanjang ke atas, di bawah header transparan */
            body > main {
                padding-top: 0 !important;
            }

            .home-hero {
                background:
                    linear-gradient(180deg, 
                        rgba(10,24,50,0.65) 0%, 
                        rgba(6,18,38,0.55) 100%
                    ),
                    url("{{ asset('images/background.JPG') }}");
                background-size: cover;
                background-position: center center;
                color: white;
                /* padding-top menutupi header (topbar + navbar) */
                padding: calc(var(--header-offset) + 70px) 20px 90px;
                text-align: center;
                min-height: 580px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .home-hero .container {
                max-width: 720px;
            }

            .section-keunggulan {
                background: var(--primary);
                color: #fff;
            }

            .section-keunggulan h2,
            .section-keunggulan h5 {
                color: #fff !important;
            }

            .section-keunggulan p {
                color: rgba(255,255,255,0.9) !important;
            }

            .home-hero h1 {
                font-size: clamp(2.2rem, 5vw, 3.2rem);
                font-weight: 800;
                margin-bottom: 20px;
                text-shadow: 0 4px 12px rgba(0,0,0,0.3);
                line-height: 1.15;
            }

            .home-hero p {
                font-size: clamp(1rem, 2.5vw, 1.1rem);
                margin-bottom: 38px;
                color: rgba(255,255,255,0.95);
                line-height: 1.7;
            }

            .home-hero .btn-cta {
                background: var(--secondary);
                border: none;
                color: #fff;
                font-weight: 700;
                padding: 12px 26px;
                box-shadow: 0 10px 30px rgba(243,156,18,0.18);
                transition: transform 0.15s ease, box-shadow 0.15s ease;
            }

            .home-hero .btn-cta:hover { transform: translateY(-3px); box-shadow: 0 18px 40px rgba(243,156,18,0.22); }

            .about-section {
                background: linear-gradient(180deg, rgba(139,45,45,0.04) 0%, rgba(255,255,255,1) 45%);
            }

            .about-logo {
                max-width: 240px;
                width: 100%;
                height: auto;
                display: block;
                margin: 0 auto 18px;
            }

            .about-card {
                background: #fff;
                border-radius: 18px;
                padding: 26px;
                box-shadow: 0 12px 30px rgba(16, 41, 93, 0.06);
                border: 1px solid rgba(16, 41, 93, 0.06);
            }

            .about-kicker {
                color: var(--secondary);
                font-weight: 700;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                font-size: 0.82rem;
                margin-bottom: 10px;
            }

            .about-title {
                color: #0f2a63;
                font-weight: 900;
                font-size: clamp(1.8rem, 3vw, 2.6rem);
                line-height: 1.12;
                margin: 0 0 16px;
            }

            .about-copy {
                color: #526a84;
                font-size: 1rem;
                line-height: 1.9;
                margin: 0;
            }

            .about-summary {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 14px;
                margin-top: 18px;
            }

            .about-summary-item {
                background: rgba(139,45,45,0.04);
                border-radius: 14px;
                padding: 16px;
                text-align: center;
            }

            .about-summary-item h5 {
                color: var(--primary);
                font-weight: 800;
                margin-bottom: 6px;
            }

            .about-summary-item p {
                color: #6b7280;
                margin: 0;
            }

            .paket-section {
                background: linear-gradient(180deg, rgba(139,45,45,0.03) 0%, rgba(255,255,255,1) 25%);
            }

            .paket-section-header {
                max-width: 760px;
                margin: 0 auto 26px;
            }

            .paket-section-kicker {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 7px 14px;
                border-radius: 999px;
                background: rgba(139,45,45,0.08);
                color: var(--primary);
                font-weight: 700;
                font-size: 0.84rem;
                letter-spacing: 0.04em;
                text-transform: uppercase;
            }

            .paket-title {
                color: var(--primary);
                font-weight: 900;
                font-size: clamp(1.8rem, 3vw, 2.6rem);
                margin: 14px 0 10px;
            }

            .paket-subtitle {
                color: #667085;
                line-height: 1.8;
                margin: 0;
            }

            .paket-card {
                border: 1px solid rgba(139,45,45,0.08);
                border-radius: 22px;
                box-shadow: 0 16px 34px rgba(16,24,40,0.08);
                overflow: hidden;
                height: 100%;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
                background: #fff;
            }

            .paket-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 22px 46px rgba(16,24,40,0.12);
            }

            .paket-visual {
                position: relative;
                min-height: 230px;
                background: linear-gradient(135deg, #8B2D2D 0%, #b23a3a 55%, #DAA520 100%);
            }

            .paket-visual img {
                width: 100%;
                height: 230px;
                object-fit: cover;
                display: block;
            }

            .paket-visual-placeholder {
                width: 100%;
                height: 230px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 3.2rem;
                opacity: 0.92;
            }

            .paket-duration {
                position: absolute;
                top: 14px;
                right: 14px;
                background: rgba(139,45,45,0.95);
                color: #fff;
                padding: 8px 14px;
                border-radius: 999px;
                font-size: 0.88rem;
                font-weight: 700;
                box-shadow: 0 8px 16px rgba(139,45,45,0.22);
            }

            .paket-card-body {
                padding: 22px 22px 20px;
            }

            .paket-card h5 {
                color: var(--primary);
                font-weight: 900;
                font-size: 1.28rem;
                line-height: 1.3;
                margin-bottom: 12px;
            }

            .paket-desc {
                color: #4b5563;
                line-height: 1.75;
                min-height: 76px;
                margin-bottom: 14px;
            }

            .paket-meta {
                color: #6b7280;
                font-size: 0.95rem;
                margin-bottom: 12px;
            }

            .paket-quota {
                color: #6b7280;
                font-size: 0.95rem;
                margin-bottom: 18px;
            }

            .paket-price {
                color: var(--secondary);
                font-size: 1.8rem;
                font-weight: 900;
                letter-spacing: -0.03em;
                line-height: 1;
            }

            .paket-price-label {
                display: block;
                color: #8a8f98;
                font-size: 0.75rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                margin-bottom: 6px;
            }

            .btn-paket {
                background: var(--primary);
                border: none;
                color: #fff;
                border-radius: 12px;
                padding: 11px 18px;
                font-weight: 700;
                box-shadow: 0 10px 20px rgba(139,45,45,0.18);
            }

            .btn-paket:hover {
                background: #6f2424;
                color: #fff;
            }

            /* Brochure Style Redesign */
            .paket-card {
                border-radius: 16px;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                background: white;
            }
            .paket-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
            }
            .paket-img-wrapper {
                height: 220px;
                overflow: hidden;
                position: relative;
                background-color: #fcfcfc;
                display: flex;
                align-items: center;
                justify-content: center;
                border-bottom: 1px solid rgba(0,0,0,0.05);
            }
            .paket-img-wrapper img {
                width: 100%;
                height: 100%;
                object-fit: contain;
                transition: transform 0.5s ease;
                padding: 10px;
            }
            .lightbox-overlay {
                position: absolute;
                inset: 0;
                background: rgba(0,0,0,0.5);
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                color: white;
                font-weight: bold;
                font-size: 1.1rem;
                opacity: 0;
                transition: opacity 0.3s ease;
                z-index: 10;
                border-radius: 16px 16px 0 0;
            }
            .lightbox-overlay i {
                font-size: 2.2rem;
                margin-bottom: 8px;
                transform: scale(0.8);
                transition: transform 0.3s ease;
            }
            .paket-img-wrapper:hover .lightbox-overlay {
                opacity: 1;
            }
            .paket-img-wrapper:hover .lightbox-overlay i {
                transform: scale(1);
            }
            .paket-card:hover .paket-img-wrapper img {
                transform: scale(1.05);
            }
            .paket-badge {
                position: absolute;
                top: 15px;
                right: 15px;
                background: var(--primary);
                color: white;
                padding: 6px 15px;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: bold;
                box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            }
            .paket-price {
                font-size: 1.4rem;
                font-weight: 900;
                color: var(--primary);
            }
            .btn-pesan {
                background: var(--primary);
                color: white;
                border-radius: 25px;
                font-weight: bold;
                padding: 8px 24px;
                transition: all 0.3s ease;
            }
            .btn-pesan:hover {
                background: #6b1010;
                color: white;
            }

            @media (max-width: 767px) {
                .home-hero {
                    padding: calc(var(--header-offset) + 30px) 16px 60px;
                    min-height: unset;
                    max-height: unset;
                    min-height: 90vh;
                }
                .home-hero h1 { font-size: 1.8rem; }
                .home-hero p { margin-bottom: 28px; }
                .about-summary { grid-template-columns: 1fr; }
            }
        </style>
    @endsection

    <!-- Hero Section -->
    <section class="home-hero">
        <div class="container">
            <h1>Kartika Mas Tour & Travel</h1>
            <p>Kartika Mas Tour & Travel adalah mitra terpercaya dalam memfasilitasi perjalanan ibadah ke kota suci Mekkah dan Madinah. Dengan komitmen yang kuat terhadap keunggulan, kami mengkhususkan diri untuk menciptakan pengalaman yang tak terlupakan bagi para jamaah yang melakukan perjalanan ibadah umroh dan haji bersama kami.</p>
            <a href="{{ route('pakets.index') }}" class="btn btn-cta me-3">
                <i class="fas fa-search"></i> Cari Paket Umroh
            </a>
            <a href="{{ route('pages.contact') }}" class="btn btn-outline-light">
                <i class="fas fa-headset"></i> Konsultasi Gratis
            </a>
        </div>
    </section>



    {{--
    <!-- Tentang Kami -->
    <section id="about" class="about-section py-4">
        <div class="container">
            <div class="text-center mb-4">
                @if(file_exists(public_path('images/kartikamas.png')))
                    <img src="{{ asset('images/kartikamas.png') }}" alt="Kartika Mas Tour & Travel" class="about-logo">
                @endif
            </div>

            <div class="about-card">
                <div class="about-kicker">Tentang Kami</div>
                <h2 class="about-title">Kartika Mas Tour & Travel</h2>
                <p class="about-copy">
                    Kartika Mas Tour & Travel didirikan pada tahun 2024 dan telah melayani ibadah umroh selama 2 tahun. Meskipun tergolong baru, kami terus berkomitmen untuk memberikan pelayanan terbaik dengan standar kualitas tinggi serta harga yang terjangkau bagi seluruh jamaah. Dengan dedikasi dan profesionalisme, kami siap menjadi mitra terpercaya dalam mewujudkan perjalanan ibadah yang nyaman dan berkesan.
                </p>

                <div class="about-summary">
                    <div class="about-summary-item">
                        <h5>Pelayanan</h5>
                        <p>Ramah, jelas, dan responsif.</p>
                    </div>
                    <div class="about-summary-item">
                        <h5>Fokus Ibadah</h5>
                        <p>Pendampingan yang nyaman dan terarah.</p>
                    </div>
                </div>
            </div>
    </section>
    --}}

    <!-- Paket Terbaru -->
    <section class="paket-section py-4">
        <div class="container">
            <div class="paket-section-header text-center">
                <span class="paket-section-kicker"><i class="fas fa-kaaba"></i> Paket Umroh Unggulan</span>
                <h2 class="paket-title">Paket Kartika Mas Tour & Travel</h2>
                <p class="paket-subtitle">
                    Pilihan paket yang disajikan dengan tampilan jelas, harga menonjol, dan detail singkat agar jamaah mudah membandingkan setiap opsi.
                </p>
            </div>
            <div class="row justify-content-center gx-3">
                @forelse($pakets_terbaru as $paket)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0 paket-card">
                            <!-- Image Banner -->
                            @if($paket->gambar)
                                @php
                                    $imgUrl = Str::startsWith($paket->gambar, 'images/') ? asset($paket->gambar) : Storage::url($paket->gambar);
                                @endphp
                                <div class="paket-img-wrapper" style="cursor: zoom-in;" onclick="openLightbox('{{ $imgUrl }}')" data-bs-toggle="modal" data-bs-target="#imageLightboxModal">
                                    <img src="{{ $imgUrl }}" alt="{{ $paket->nama_paket }}">
                                    <div class="paket-badge"><i class="fas fa-clock me-1"></i> {{ $paket->durasi_hari }} Hari</div>
                                    <div class="lightbox-overlay">
                                        <i class="fas fa-search-plus"></i> Lihat Brosur
                                    </div>
                                </div>
                            @endif

                            <div class="card-body p-4 d-flex flex-column">
                                <h4 class="card-title fw-bold mb-3">{{ $paket->nama_paket }}</h4>
                                
                                <div class="mb-3 text-muted">
                                    <div class="mb-2"><i class="fas fa-calendar-alt me-2 text-primary"></i> Berangkat: <strong>{{ $paket->tanggal_berangkat->format('d M Y') }}</strong></div>
                                    <div class="mb-2"><i class="fas fa-plane-departure me-2 text-primary"></i> Maskapai: <strong>{{ $paket->maskapai ?? 'Saudi Airlines' }}</strong></div>
                                    <div><i class="fas fa-users me-2 text-primary"></i> Sisa Kuota: <strong>{{ $paket->tersedia }}/{{ $paket->kuota }}</strong></div>
                                </div>
                                
                                <div class="mt-auto pt-3 border-top">
                                    <span class="d-block text-muted" style="font-size: 0.85rem;">Mulai dari</span>
                                    <div class="paket-price mb-3">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                                    
                                    <a href="{{ route('pakets.show', $paket) }}" class="btn btn-pesan w-100 text-center">
                                        Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i> Belum ada paket umroh tersedia saat ini.
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('pakets.index') }}" class="btn btn-primary">
                    Lihat Semua Paket <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    {{--
    <!-- Keunggulan -->
    <section class="py-4 bg-light">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary); font-weight: bold;">
                <i class="fas fa-check-double"></i> Mengapa Memilih Kami?
            </h2>
            <div class="row">
                <div class="col-md-3 mb-4 text-center">
                    <i class="fas fa-medal" style="font-size: 3rem; color: var(--secondary); margin-bottom: 20px;"></i>
                    <h5>Berpengalaman</h5>
                    <p class="text-muted">Berpengalaman dalam melayani perjalanan ibadah umroh dengan pelayanan yang profesional dan amanah.</p>
                </div>
                <div class="col-md-3 mb-4 text-center">
                    <i class="fas fa-hand-holding-heart" style="font-size: 3rem; color: var(--secondary); margin-bottom: 20px;"></i>
                    <h5>Terpercaya</h5>
                    <p class="text-muted">Dipercaya oleh jamaah dengan pelayanan yang transparan dan didukung sistem yang terintegrasi.</p>
                </div>
                <div class="col-md-3 mb-4 text-center">
                    <i class="fas fa-money-bill-wave" style="font-size: 3rem; color: var(--secondary); margin-bottom: 20px;"></i>
                    <h5>Harga Kompetitif</h5>
                    <p class="text-muted">Menawarkan paket umroh dengan harga terjangkau tanpa mengurangi kualitas layanan.</p>
                </div>
                <div class="col-md-3 mb-4 text-center">
                    <i class="fas fa-laptop-code" style="font-size: 3rem; color: var(--secondary); margin-bottom: 20px;"></i>
                    <h5>Dukungan Sistem</h5>
                    <p class="text-muted">Didukung sistem informasi berbasis website yang memudahkan pendaftaran, pemesanan, dan pengelolaan data jamaah.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Jamaah -->
    <section class="py-4">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary); font-weight: bold;">
                <i class="fas fa-quote-left"></i> Testimoni Jamaah Kami
            </h2>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card testimoni-card" style="border: none; border-left: 5px solid var(--secondary); box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                            </div>
                            <p class="card-text" style="font-style: italic; color: #666;">"Pelayanan Kartika Mas sangat profesional dan memuaskan. Dari awal pendaftaran hingga kembali ke Indonesia, semuanya teratur dengan baik."</p>
                            <p class="mb-0" style="font-weight: 600; color: var(--primary);">Bapak Ahmad Suryanto</p>
                            <small class="text-muted">Jakarta</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card testimoni-card" style="border: none; border-left: 5px solid var(--secondary); box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                            </div>
                            <p class="card-text" style="font-style: italic; color: #666;">"Impian umroh saya terwujud berkat Kartika Mas. Tim mereka sangat membantu dan memberikan informasi yang jelas setiap tahapnya."</p>
                            <p class="mb-0" style="font-weight: 600; color: var(--primary);">Ibu Siti Nurjanah</p>
                            <small class="text-muted">Surabaya</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card testimoni-card" style="border: none; border-left: 5px solid var(--secondary); box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                            </div>
                            <p class="card-text" style="font-style: italic; color: #666;">"Harga paket sangat kompetitif dan fasilitasnya lengkap. Saya merasa dihargai sebagai jamaah selama perjalanan ibadah."</p>
                            <p class="mb-0" style="font-weight: 600; color: var(--primary);">Pak Hendra Wijaya</p>
                            <small class="text-muted">Bandung</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    --}}

    <!-- Proses Umroh -->
    <section id="cara-daftar" class="py-4" style="background: linear-gradient(135deg, rgba(139,45,45,0.08) 0%, rgba(218,165,32,0.06) 100%);">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary); font-weight: bold;">
                <i class="fas fa-laptop-code" style="margin-right:8px"></i> Cara Pendaftaran Otomatis
            </h2>
            <div class="row justify-content-center">
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
        </div>
    </section>

    {{--
    <!-- FAQ -->
<section class="py-4">
    <div class="container">
        <h2 class="text-center mb-5" style="color: var(--primary); font-weight: bold;">
            <i class="fas fa-circle-question"></i> Pertanyaan yang Sering Diajukan
        </h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">

                    <div class="accordion-item" style="border-color: var(--secondary);">
                        <h2 class="accordion-header">
                            <button class="accordion-button" 
                                    style="background: rgba(139,45,45,0.05); color: var(--primary); font-weight: 600;" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#faq1">
                                Berapa lama proses visa umroh?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Proses visa umroh biasanya memakan waktu 2–3 minggu tergantung kelengkapan dokumen jamaah. Informasi lebih lanjut akan disampaikan setelah proses konsultasi dan pendaftaran dilakukan.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border-color: var(--secondary);">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" 
                                    style="background: rgba(139,45,45,0.05); color: var(--primary); font-weight: 600;" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#faq2">
                                Apa saja yang sudah termasuk dalam paket?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Paket umroh mencakup tiket pesawat pulang-pergi, akomodasi hotel, konsumsi selama perjalanan, transportasi lokal, serta layanan pendampingan ibadah. Detail fasilitas setiap paket dapat dilihat pada halaman paket umroh.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border-color: var(--secondary);">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" 
                                    style="background: rgba(139,45,45,0.05); color: var(--primary); font-weight: 600;" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#faq3">
                                Apakah ada jaminan pengembalian dana?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Pengembalian dana dapat dilakukan sesuai dengan ketentuan dan kebijakan perusahaan. Jamaah dapat menghubungi pihak admin untuk memperoleh informasi lebih lanjut terkait proses pembatalan dan pengembalian dana.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border-color: var(--secondary);">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" 
                                    style="background: rgba(139,45,45,0.05); color: var(--primary); font-weight: 600;" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#faq4">
                                Bagaimana cara membayar paket umroh?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Pembayaran dapat dilakukan dengan mudah secara online. Jamaah cukup mengeklik tombol <strong>'Bayar Sekarang'</strong> di halaman pemesanan, pilih metode pembayaran instan yang diinginkan via Midtrans (Virtual Account, Kartu Kredit, atau E-Wallet), lalu ikuti instruksinya. Sistem akan memverifikasi pembayaran Anda otomatis tanpa perlu mengunggah struk fisik.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
--}}
@endsection

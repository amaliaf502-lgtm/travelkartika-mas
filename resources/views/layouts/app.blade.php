<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Travel Umroh - Kartika Mas Tour & Travel')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #8B2D2D;
            --secondary: #DAA520;
            --header-offset: 140px;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Scroll offset hanya untuk anchor navigasi beranda */
        #about, #cara-daftar {
            scroll-margin-top: 155px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* ── TOPBAR KONTAK ── */
        .topbar-contact {
            background: rgba(0,0,0,0.20);
            color: #fff;
            font-size: 0.88rem;
            padding: 7px 0;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .topbar-contact a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .topbar-contact a:hover {
            color: var(--secondary);
        }

        .topbar-contact i {
            color: rgba(255,255,255,0.80);
        }

        /* ── NAVBAR ── */
        .navbar {
            background: #ffffff !important;
            border-bottom: none;
            transition: background 0.35s ease, box-shadow 0.35s ease;
        }

        .site-header.hero-header .navbar {
            background: transparent !important;
        }

        .site-header.site-header--compact .navbar {
            background: #ffffff !important;
            box-shadow: 0 3px 16px rgba(0,0,0,0.1);
        }

        /* Nav links - Default gelap (hitam/abu-abu tua) */
        .navbar-nav .nav-link {
            color: #333 !important;
            font-weight: 600;
            letter-spacing: 0.01em;
            transition: color 0.2s ease, opacity 0.2s ease;
            opacity: 0.92;
        }

        /* Di Homepage, kalau transparan, text-nya putih agar terbaca */
        .site-header.hero-header:not(.site-header--compact) .navbar-nav .nav-link {
            color: #fff !important;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--secondary) !important;
            opacity: 1;
        }

        /* Brand/Logo - Default gelap */
        .navbar-brand {
            color: #333 !important;
            font-weight: bold;
            font-size: 1.5rem;
            transition: opacity 0.35s ease;
        }

        /* Logo img - normal (tidak di-invert ke putih) */
        .navbar-brand img {
            transition: filter 0.35s ease;
            filter: none;
        }

        .site-header.hero-header:not(.site-header--compact) .navbar-brand {
            color: #fff !important;
        }
        .site-header.hero-header:not(.site-header--compact) .navbar-brand img {
            filter: brightness(0) invert(1);
        }

        /* Toggler - Default gelap */
        .navbar-toggler {
            border-color: rgba(0,0,0,0.1) !important;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280%2C0%2C0%2C0.5%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        .site-header.hero-header:not(.site-header--compact) .navbar-toggler {
            border-color: rgba(255,255,255,0.4) !important;
        }
        .site-header.hero-header:not(.site-header--compact) .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255%2C255%2C255%2C0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        .navbar-brand i {
            color: var(--secondary);
            margin-right: 8px;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, #1a3a5c 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
            margin-bottom: 50px;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        /* Cards */
        .paket-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            height: 100%;
        }

        .paket-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .paket-card img {
            height: 250px;
            object-fit: cover;
        }

        .badge-durasi {
            background: var(--primary);
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.9rem;
        }

        .badge-harga {
            background: var(--secondary);
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 0.9rem;
        }

        .paket-card-body {
            padding: 20px;
            position: relative;
        }

        .paket-card h5 {
            color: var(--primary);
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Button */
        .btn-primary {
            background: var(--primary);
            border: none;
            padding: 10px 25px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #1a3a5c;
            color: var(--secondary);
        }

        .btn-secondary {
            background: var(--secondary);
            border: none;
            color: white;
        }

        .btn-secondary:hover {
            background: #e67e22;
            color: white;
        }

        /* ===== DROPDOWN INFO LAINNYA ===== */
        .dropdown-menu {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .dropdown-menu .dropdown-item {
            color: #333 !important;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: var(--primary);
            color: #ffffff !important;
        }

        .paket-terbaru {
            background: #ffffff;
            padding: 60px 0;
        }

      /* ===== FOOTER ===== */
        footer {
            background: #8B2D2D;
            color: #ffffff;
            padding: 40px 0 20px;
            margin-top: 50px;
            border-top: 1px solid #ffffff;
        }

        footer h5 {
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 15px;
        }

        footer p,
        footer ul li {
            color: #fffcfc;
        }

        /* Ensure footer links are readable on dark background */
        footer a {
            color: #ffffff;
            text-decoration: none;
        }

        footer a:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        footer hr {
            border-color: #e0e0e0;
        }

        footer .text-center p {
            color: #ffffff;
            font-size: 0.9rem;
        }

        /* Alert */
        .alert {
            border-radius: 10px;
            border: none;
        }

        /* Status Badge */
        .badge-pending {
            background: #f39c12;
        }

        .badge-confirmed {
            background: #27ae60;
        }

        .badge-dibatalkan {
            background: #8B2D2D;
        }

        .badge-completed {
            background: #2980b9;
        }

        /* Pricing */
        .harga-display {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--secondary);
        }

        .kuota-display {
            font-size: 0.9rem;
            color: #666;
        }

        /* ── SITE HEADER ── */
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            background: var(--primary);
            transition: box-shadow 0.35s ease, background 0.35s ease;
            will-change: transform;
        }

        /* Hero mode (halaman home saat di atas) - transparan */
        .site-header.hero-header {
            background: transparent;
        }

        /* Setelah scroll - merah dengan shadow */
        .site-header.site-header--compact {
            background: var(--primary);
            box-shadow: 0 3px 20px rgba(100,20,20,0.30);
        }

        .site-header__extras {
            max-height: 96px;
            overflow: hidden;
            transition: max-height 0.32s ease, opacity 0.32s ease, transform 0.32s ease;
            will-change: max-height, opacity, transform;
        }

        /* Topbar tersembunyi saat scroll ke bawah MAUPUN ke atas (konsisten) */
        .site-header.site-header--compact .site-header__extras {
            max-height: 0 !important;
            opacity: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
            transform: translateY(-8px);
        }

        /* ── Beautiful Toast Notifications ── */
        .custom-toast {
            position: fixed;
            top: 100px;
            right: -400px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 99999;
            transition: right 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            max-width: 350px;
            border-left: 6px solid #28a745;
        }
        .custom-toast.error {
            border-left-color: #dc3545;
        }
        .custom-toast.show {
            right: 20px;
        }
        .custom-toast .toast-icon {
            font-size: 1.5rem;
            color: #28a745;
        }
        .custom-toast.error .toast-icon {
            color: #dc3545;
        }
        .custom-toast .toast-body {
            font-weight: 600;
            color: #333;
            font-size: 0.9rem;
            flex: 1;
        }
        .custom-toast .toast-close {
            cursor: pointer;
            color: #aaa;
            transition: color 0.2s;
            background: transparent;
            border: none;
            font-size: 1.1rem;
        }
        .custom-toast .toast-close:hover {
            color: #333;
        }

        /* ── Image Lightbox Modal ── */
        .lightbox-modal {
            background-color: rgba(0, 0, 0, 0.9);
        }
        .lightbox-modal .modal-content {
            background: transparent;
            border: none;
        }
        .lightbox-modal .modal-header {
            border: none;
            padding: 10px 20px;
            position: absolute;
            top: 0;
            right: 0;
            z-index: 1055;
        }
        .lightbox-modal .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
            opacity: 0.8;
            background-size: 1.5rem;
        }
        .lightbox-modal .btn-close:hover {
            opacity: 1;
        }
        .lightbox-modal .modal-body {
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            cursor: zoom-out;
        }
        .lightbox-modal img {
            max-height: 90vh;
            max-width: 100%;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        }
    </style>
    @yield('css')
</head>
<body>
    <header class="site-header @yield('header-class')">
        <div class="site-header__extras">
        <!-- Topbar Contact (Transparan - overlay di atas hero) -->
        <div class="topbar-contact">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-phone-alt"></i>
                    <a href="tel:0812600055" dir="ltr">
                        0812-6000-55 / 0819-3377-7763
                    </a>
                    &nbsp; | &nbsp;
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:customer@kartika-mas.id">
                        customer@kartika-mas.id
                    </a>
                </div>
                <div>

                    <a href="{{ config('services.social.instagram') }}" class="me-2" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="{{ config('services.social.tiktok') }}" class="me-2" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <a href="{{ config('services.social.youtube') }}" class="me-2" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                @if(file_exists(public_path('images/kartikamas.png')))
                    <img src="{{ asset('images/kartikamas.png') }}" alt="Kartika Mas Tour & Travel"
                        style="height:60px; object-fit:contain;">
                @else
                    <i class="fas fa-plane"></i> Kartika Mas Tour & Travel
                @endif
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pakets.index') }}">Paket Umroh</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pages.cara-daftar') }}">Cara Pendaftaran</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pages.about') }}">Tentang Kami</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pages.contact') }}">Kontak</a>
                    </li>

                    @auth
                        @if(auth()->user()->is_admin)
                            <li class="nav-item ms-lg-3" style="border-left: 1px solid #e0e0e0; padding-left: 10px;">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-cog"></i> Admin
                                </a>
                            </li>
                        @endif

                        <li class="nav-item dropdown ms-lg-2" @if(!auth()->user()->is_admin) style="border-left: 1px solid #e0e0e0; padding-left: 10px;" @endif>
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                Hai, {{ explode(' ', Auth::user()->name)[0] }} 
                                <i class="fas fa-user-circle ms-2 text-secondary" style="font-size: 1.4rem;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('pemesanans.index') }}"><i class="fas fa-clipboard-list me-2"></i> Status Pemesanan</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-lg-3" style="border-left: 1px solid #e0e0e0; padding-left: 10px;">
                            <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
        </nav>
    </header>


    <!-- Main Content -->
    <main style="padding-top:var(--header-offset);">


        @yield('content')
    </main>

    <!-- Footer -->
    <!-- Footer -->
    <footer style="background-color: var(--primary); padding: 60px 0 30px; color: white;">
        <div class="container">
            <div class="row g-4 mb-4">
                {{-- Kolom 1: Logo & Sosial Media --}}
                <div class="col-lg-3 col-md-6 text-center text-md-start">
                    <img src="{{ asset('images/kartikamas.png') }}" alt="Kartika Mas Tour & Travel" style="height: 120px; object-fit: contain; margin-bottom: 20px; filter: brightness(0) invert(1);">
                    <div class="d-flex justify-content-center justify-content-md-start gap-4 mt-3">
                        <a href="{{ config('services.social.instagram') }}" class="text-white text-decoration-none" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="{{ config('services.social.tiktok') }}" class="text-white text-decoration-none" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="fab fa-tiktok fa-lg"></i></a>
                        <a href="{{ config('services.social.youtube') }}" class="text-white text-decoration-none" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>

                {{-- Kolom 2: Informasi Pembayaran --}}
                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold mb-4" style="border-left: 3px solid rgba(255,255,255,0.5); padding-left: 10px; text-transform: uppercase; font-size: 1rem;">Informasi Pembayaran</h5>
                    <div class="text-white" style="font-size: 0.95rem;">
                        <p class="mb-2 fw-bold text-decoration-underline">PT KARTIKA MAS JAYA AGUNG</p>
                        <p class="mb-1">BRI: <strong>0420-01-100100-568</strong></p>
                        <p class="mb-1">BCA: <strong>5660-5828-61</strong></p>
                        <p class="mb-0">DKI SYARIAH : <strong>703-21-535361</strong></p>
                    </div>
                </div>

                {{-- Kolom 3: Kontak Informasi --}}
                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold mb-4" style="border-left: 3px solid rgba(255,255,255,0.5); padding-left: 10px; text-transform: uppercase; font-size: 1rem;">Kontak Informasi</h5>
                    <ul class="list-unstyled text-white" style="font-size: 0.95rem;">
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="fas fa-phone mt-1" style="color: rgba(255,255,255,0.6);"></i> 
                            <span>0812-6000-55 / 0819-3377-7763</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="fas fa-envelope mt-1" style="color: rgba(255,255,255,0.6);"></i> 
                            <span>customer@kartika-mas.id</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="fas fa-map-marker-alt mt-1" style="color: rgba(255,255,255,0.6);"></i> 
                            <span>Jl. Barito II No.47 2, RT.2/RW.7, Kramat Pela, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12130</span>
                        </li>
                    </ul>
                </div>

                {{-- Kolom 4: Tautan Cepat --}}
                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold mb-4" style="border-left: 3px solid rgba(255,255,255,0.5); padding-left: 10px; text-transform: uppercase; font-size: 1rem;">Menu</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 pb-1">
                            <a href="{{ route('home') }}" class="text-white text-decoration-none" style="font-size: 0.95rem;">Beranda</a>
                        </li>
                        <li class="mb-2 pb-1">
                            <a href="{{ route('pakets.index') }}" class="text-white text-decoration-none" style="font-size: 0.95rem;">Paket Umroh</a>
                        </li>
                        <li class="mb-2 pb-1">
                            <a href="{{ route('pages.cara-daftar') }}" class="text-white text-decoration-none" style="font-size: 0.95rem;">Cara Pendaftaran</a>
                        </li>
                        <li class="mb-2 pb-1">
                            <a href="{{ route('pages.about') }}" class="text-white text-decoration-none" style="font-size: 0.95rem;">Tentang Kami</a>
                        </li>
                        <li class="mb-2 pb-1">
                            <a href="{{ route('pages.contact') }}" class="text-white text-decoration-none" style="font-size: 0.95rem;">Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </footer>

    <!-- Lightbox Modal -->
    <div class="modal fade lightbox-modal" id="imageLightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" onclick="document.querySelector('#imageLightboxModal .btn-close').click()">
                    <img src="" id="lightboxImage" alt="Brosur Paket">
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Alerts -->
    @if(session('success'))
        <div id="toast-success" class="custom-toast show">
            <i class="fas fa-check-circle toast-icon"></i>
            <div class="toast-body">{{ session('success') }}</div>
            <button class="toast-close" onclick="closeToast('toast-success')">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div id="toast-error" class="custom-toast error show">
            <i class="fas fa-exclamation-circle toast-icon"></i>
            <div class="toast-body">{{ session('error') }}</div>
            <button class="toast-close" onclick="closeToast('toast-error')">&times;</button>
        </div>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function closeToast(id) {
            const toast = document.getElementById(id);
            if (toast) {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 500);
            }
        }

        function openLightbox(imageUrl) {
            const lightboxImage = document.getElementById('lightboxImage');
            if(lightboxImage) {
                lightboxImage.src = imageUrl;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const successToast = document.getElementById('toast-success');
            const errorToast = document.getElementById('toast-error');
            if (successToast) {
                setTimeout(() => closeToast('toast-success'), 4000);
            }
            if (errorToast) {
                setTimeout(() => closeToast('toast-error'), 4000);
            }
        });

        (function(){
            const header = document.querySelector('.site-header');
            const main   = document.querySelector('main');
            const navbarCollapse = document.getElementById('navbarNav');
            if (!header || !main) return;

            // Hitung dan set padding-top konten sesuai tinggi header
            function updateOffset() {
                const h = header.offsetHeight;
                document.documentElement.style.setProperty('--header-offset', h + 'px');
                main.style.paddingTop = h + 'px';
            }

            // Jalankan saat pertama load
            updateOffset();
            // Jalankan lagi setelah semua asset selesai dimuat
            window.addEventListener('load', updateOffset);

            // Re-calc saat resize (debounced)
            let rtid;
            window.addEventListener('resize', function () {
                clearTimeout(rtid);
                rtid = setTimeout(updateOffset, 120);
            });

            // ── Compact mode: topbar disembunyikan setelah user scroll melebihi topbar ──
            // TIDAK dibuka kembali saat scroll ke atas — ini yang mencegah konten melompat
            const extras = document.querySelector('.site-header__extras');
            const extrasHeight = extras ? extras.scrollHeight : 0;
            let isCompact = false;

            function setCompact(next) {
                if (isCompact === next) return;
                isCompact = next;
                header.classList.toggle('site-header--compact', next);
                // Sedikit delay agar transisi CSS selesai dulu baru hitung ulang offset
                setTimeout(updateOffset, 350);
            }

            let ticking = false;
            window.addEventListener('scroll', function () {
                if (ticking) return;
                ticking = true;
                requestAnimationFrame(function () {
                    const scrollY = window.scrollY || 0;
                    // Compact hanya berubah: OFF saat di paling atas, ON saat melebihi topbar
                    if (scrollY <= 0) {
                        setCompact(false);
                    } else if (scrollY > extrasHeight) {
                        setCompact(true);  // sembunyikan topbar
                    }
                    // Tidak ada perubahan saat scroll ke atas di tengah halaman → tidak ada lompatan
                    ticking = false;
                });
            }, { passive: true });

            if (navbarCollapse) {
                navbarCollapse.addEventListener('shown.bs.collapse', function () {
                    setCompact(false);
                    updateOffset();
                });
                navbarCollapse.addEventListener('hidden.bs.collapse', updateOffset);
            }
        })();
    </script>
    @yield('js')
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Travel Umroh - Travelkartika Mas')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #8B2D2D;
            --secondary: #DAA520;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background: var(--primary) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .topbar-top {
            background: var(--primary);
            color: #fff;
            font-size: 0.85rem;
            padding: 8px 0;
        }

        .topbar-top a,
        .topbar-top i {
            color: #fff;
        }

        .topbar-contact {
            background: #ffffff;
            color: #333;
            font-size: 0.9rem;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .topbar-contact a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .topbar-contact i {
            color: var(--primary);
        }

        .navbar {
            background: #ffffff !important;
            border-bottom: 1px solid #e0e0e0;
        }

        .navbar-nav .nav-link {
            color: #333 !important;
            font-weight: 600;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary) !important;
        }

        .navbar-brand {
            color: var(--primary) !important;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar-brand i {
            color: var(--secondary);
            margin-right: 8px;
        }


        .nav-link {
            color: rgba(255,255,255,0.85) !important;
            font-weight: 500;
            transition: color 0.3s;
        }


        .nav-link:hover {
            color: var(--secondary) !important;
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
            background: #be2626c4;
            color: #ffffff;
            padding: 40px 0 20px;
            margin-top: 50px;
            border-top: 1px solid #ffffff;
        }

        footer h5 {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 15px;
        }

        footer p,
        footer ul li {
            color: #fffcfc;
        }

        footer a {
            color: var(--primary);
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
            background: #be2626c4;
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
    </style>
    @yield('css')
</head>
<body>
    <!-- Topbar Top (Merah) -->
    <div class="topbar-top">
        <div class="container">
            <strong>Selamat Datang di Kartika Mas - Partner Terpercaya Umroh Anda</strong>
        </div>
    </div>

    <!-- Topbar Contact (Putih) -->
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
                <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="me-2"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                @if(file_exists(public_path('images/kartikamas.png')))
                    <img src="{{ asset('images/kartikamas.png') }}" alt="Travelkartika Mas"
                        style="height:60px; object-fit:contain;">
                @else
                    <i class="fas fa-plane"></i> Travelkartika Mas
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

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="infoDropdown"
                        role="button" data-bs-toggle="dropdown">
                            INFO LAINNYA
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Tentang Kami</a></li>
                            <li><a class="dropdown-item" href="#">Syarat & Ketentuan</a></li>
                            <li><a class="dropdown-item" href="#">Kontak</a></li>
                        </ul>
                    </li>

                    @auth
                                        @if(auth()->user()->is_admin)
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                                    Admin
                                                </a>
                                            </li>
                                        @endif

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('pemesanans.index') }}">
                                                Pemesanan Saya
                                            </a>
                                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>


    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                <h5 class="d-flex align-items-center gap-2">
                    <img src="{{ asset('images/kartikamas.png') }}" alt="Travelkartika Mas" style="height:48px;">
                    Travelkartika Mas
                </h5>
                    <p>Membantu Anda mewujudkan impian beribadah Umroh dengan nyaman dan terjangkau.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Menu Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('pakets.index') }}">Paket Umroh</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone"></i> 0812-6000-55 / 0819-3377-7763</li>
                        <li><i class="fas fa-envelope"></i> customer@kartika-mas.id</li>
                        <li><i class="fas fa-map-marker-alt"></i>  Jl. Barito II No.47 2, RT.2/RW.7, Kramat Pela, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12130</li>
                    </ul>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center">
                <p>&copy; 2026 Travelkartika Mas. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>
</html>

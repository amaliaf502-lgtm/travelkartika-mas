<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Travelkartika Mas')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #8B2D2D;
            --secondary: #DAA520;
            --sidebar-bg: #8B2D2D;
            --sidebar-hover: #6a2121;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ecf0f1;
        }

        /* ===== ADMIN LAYOUT ===== */
        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .admin-sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            color: #fff;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .sidebar-header {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .logo-container {
            background: white;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 15px;
            display: inline-block;
            width: 90%;
        }

        .sidebar-header img {
            max-width: 100%;
            height: auto;
            max-height: 65px;
            object-fit: contain;
        }

        .sidebar-header h4 {
            font-size: 1.1rem;
            margin: 0;
            color: var(--secondary);
            font-weight: bold;
        }

        .sidebar-menu {
            padding: 20px 0;
            list-style: none;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            color: #ecf0f1;
            text-decoration: none;
            padding: 14px 20px;
            transition: all 0.3s;
            border-left: 3px solid transparent;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.95rem;
            font-weight: 500;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #5a1f1f;
            border-left-color: var(--secondary);
            color: var(--secondary);
        }

        .sidebar-menu i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .sidebar-divider {
            margin: 15px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* ===== MAIN CONTENT ===== */
        .admin-main {
            margin-left: 250px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* Top Bar */
        .admin-topbar {
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e0e0e0;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .admin-topbar h5 {
            margin: 0;
            color: var(--primary);
            font-weight: bold;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .logout-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        /* ===== CONTENT AREA ===== */
        .admin-content {
            padding: 30px;
            flex: 1;
            min-width: 0;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background: var(--primary);
            color: white;
            border-radius: 8px 8px 0 0 !important;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 600;
        }

        /* Stats Card */
        .stat-card {
            background: white;
            border-left: 4px solid var(--primary);
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card.secondary {
            border-left-color: var(--secondary);
        }

        .stat-card.warning {
            border-left-color: #f39c12;
        }

        .stat-card.success {
            border-left-color: #27ae60;
        }

        .stat-card .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 10px 0;
        }

        .stat-card .stat-label {
            color: #666;
            font-size: 0.95rem;
        }

        .stat-card i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--primary);
        }

        .stat-card.secondary i {
            color: var(--secondary);
        }

        .stat-card.warning i {
            color: #f39c12;
        }

        .stat-card.success i {
            color: #27ae60;
        }

        /* Tables */
        .table {
            background: white;
        }

        .table thead th {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: var(--primary);
            font-weight: 600;
        }

        .table tbody tr:hover {
            background: #f5f5f5;
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary);
            border: none;
        }

        .btn-primary:hover {
            background: #6b1f1f;
        }

        .btn-secondary {
            background: var(--secondary);
            border: none;
            color: white;
        }

        .btn-secondary:hover {
            background: #b8860b;
            color: white;
        }

        /* Badge */
        .badge {
            padding: 6px 12px;
            font-weight: 600;
        }

        .badge-pending {
            background: #f39c12;
            color: white;
        }

        .badge-confirmed {
            background: #27ae60;
            color: white;
        }

        .badge-dibatalkan {
            background: #e74c3c;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                height: auto;
                position: relative;
                box-shadow: none;
                border-bottom: 1px solid #ddd;
            }

            .admin-main {
                margin-left: 0;
            }

            .sidebar-menu {
                display: flex;
                flex-wrap: wrap;
                padding: 10px 0;
            }

            .sidebar-menu li {
                flex: 1 0 auto;
            }

            .sidebar-menu a {
                padding: 10px 15px;
                font-size: 0.9rem;
                justify-content: center;
                flex-direction: column;
                text-align: center;
            }

            .sidebar-menu i {
                margin-right: 0;
                margin-bottom: 5px;
            }

            .admin-content {
                padding: 15px;
            }
        }

        /* Alert */
        .alert {
            border: none;
            border-radius: 8px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
        }

        /* Page Title */
        .page-title {
            color: var(--primary);
            font-weight: bold;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-title i {
            color: var(--secondary);
        }

        table.table th, table.table td {
            font-size: 0.95rem;
        }
        .badge-pill {
            border-radius: 50rem;
            padding: 0.4em 0.85em;
            font-weight: 600;
            font-size: 0.8rem;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .btn-premium {
            border-radius: 6px;
            font-weight: 600;
            padding: 0.4rem 0.8rem;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
    @yield('css')
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <div class="logo-container">
                    @if(file_exists(public_path('images/kartikamas.png')))
                        <img src="{{ asset('images/kartikamas.png') }}" alt="Travelkartika Mas">
                    @else
                        <i class="fas fa-plane" style="font-size: 2rem; color: var(--secondary);"></i>
                    @endif
                </div>
                <h4>Admin Panel</h4>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="@if(request()->routeIs('admin.dashboard')) active @endif">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.jamaah.index') }}" class="@if(request()->routeIs('admin.jamaah.*')) active @endif">
                        <i class="fas fa-users"></i>
                        <span>Kelola Data Jamaah</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.pakets.index') }}" class="@if(request()->routeIs('admin.pakets.*')) active @endif">
                        <i class="fas fa-plane"></i>
                        <span>Kelola Paket Umroh</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.pemesanans.index') }}" class="@if(request()->routeIs('admin.pemesanans.*')) active @endif d-flex align-items-center">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="me-2">Kelola Pemesanan</span>
                        @php
                            $pendingNavCount = \App\Models\Pemesanan::where('status', 'pending')->count();
                        @endphp
                        @if($pendingNavCount > 0)
                            <span class="badge d-flex align-items-center justify-content-center" style="background-color: var(--secondary); color: white; font-size: 0.75rem; width: 22px; height: 22px; border-radius: 50%; padding: 0;">{{ $pendingNavCount }}</span>
                        @endif
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.verifikasi-pembayaran') }}" class="@if(request()->routeIs('admin.verifikasi-pembayaran')) active @endif">
                        <i class="fas fa-check-circle"></i>
                        <span>Verifikasi Pembayaran</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.kelola-kuota') }}" class="@if(request()->routeIs('admin.kelola-kuota')) active @endif">
                        <i class="fas fa-users-cog"></i>
                        <span>Kelola Kuota</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.departure-info.index') }}" class="@if(request()->routeIs('admin.departure-info.*')) active @endif">
                        <i class="fas fa-info-circle"></i>
                        <span>Kelola Informasi Keberangkatan</span>
                    </a>
                </li>

                <div class="sidebar-divider"></div>

                <li>
                    <a href="{{ route('home') }}" style="color: #ecf0f1;">
                        <i class="fas fa-home"></i>
                        <span>Kembali ke Website</span>
                    </a>
                </li>


            </ul>
        </aside>

        <!-- Main Content -->
        <div class="admin-main">
            <!-- Top Bar -->
            <header class="admin-topbar">
                <h5 class="mb-0 fw-bold" style="color: #8B2D2D;">
                    Kartika Mas Admin
                </h5>
                <div class="admin-user d-flex align-items-center gap-3">
                    <span class="text-secondary" style="font-size: 0.9rem;">Administrator</span>
                    <div class="admin-user-avatar d-flex align-items-center justify-content-center fw-bold" style="width: 35px; height: 35px; border-radius: 50%; background-color: #8B2D2D; color: white; font-size: 1rem;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="logout-btn btn btn-sm px-3" style="background-color: #e74c3c; color: white; border-radius: 6px; font-weight: 500;">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Content -->
            <main class="admin-content">
                @if($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($message = Session::get('error'))
                    <div class="alert alert-error alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>
</html>

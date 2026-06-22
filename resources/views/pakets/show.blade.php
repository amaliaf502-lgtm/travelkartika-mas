@extends('layouts.app')

@section('title', $paket->nama_paket . ' - Kartika Mas Tour & Travel')

@section('content')
<style>
    :root {
        --maroon: #8B2D2D;
        --gold: #DAA520;
        --gold-light: #FFD700;
    }

    /* ── Main Layout ── */
    .detail-wrapper {
        background: #f8f9fa;
        padding: 20px 0 60px;
    }

    .breadcrumb-nav {
        margin-bottom: 20px;
        font-size: 0.9rem;
    }
    .breadcrumb-nav a {
        color: var(--maroon);
        text-decoration: none;
        font-weight: 600;
    }
    .breadcrumb-nav span {
        color: #888;
        margin: 0 8px;
    }

    /* ── Brochure Card ── */
    .brochure-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(139,0,0,0.15);
        border: 2px solid var(--maroon);
        margin-bottom: 24px;
    }
    .brochure-card-header {
        background: var(--maroon);
        color: white;
        padding: 14px 20px;
        border-bottom: 3px solid var(--gold);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .brochure-card-header h5 {
        margin: 0;
        font-weight: 800;
        font-size: 1rem;
        letter-spacing: 0.5px;
        color: var(--gold-light);
    }
    .brochure-card-header i { color: var(--gold); font-size: 1rem; }
    .brochure-card-body { padding: 20px; }

    /* ── Harga Grid Modern ── */
    .harga-grid-3 {
        display: grid;
        grid-template-columns: 1.2fr 1fr 1fr;
        gap: 12px;
        margin-bottom: 20px;
    }
    .harga-box {
        background: #fffcf8;
        border-radius: 14px;
        padding: 0;
        text-align: center;
        border: 1px solid #f0e6c8;
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: hidden;
    }
    .harga-box:hover {
        border-color: var(--gold);
        background: white;
        box-shadow: 0 4px 15px rgba(218,165,32,0.15);
        transform: translateY(-2px);
    }
    .harga-box-header {
        background: var(--maroon);
        color: white;
        font-weight: 800;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 8px;
        border-bottom: 2px solid var(--gold);
    }
    .harga-box-body {
        display: flex;
        align-items: baseline;
        justify-content: center;
        color: var(--maroon);
        gap: 2px;
        padding: 16px 10px;
    }
    .val-currency { font-size: 0.85rem; font-weight: bold; position: relative; top: -10px; }
    .val-amount   { font-size: 2.2rem; font-weight: 900; line-height: 0.9; letter-spacing: -1px; }
    .val-dec      { font-size: 1rem; font-weight: bold; position: relative; top: -10px; }
    .val-unit     { font-size: 0.7rem; line-height: 1.2; margin-left: 4px; font-weight: 600; text-align: left; color: #64748b; }
    
    .harga-box:first-child .val-amount { font-size: 1.5rem; }
    .harga-box:first-child .val-currency { top: 0px; font-size: 1rem; }

    /* ── Hotel Grid Modern ── */
    .hotel-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    .hotel-box {
        background: white;
        border-radius: 14px;
        padding: 16px;
        text-align: left;
        border: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.3s;
    }
    .hotel-box:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }
    .hotel-loc   { font-size: 0.7rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; display: flex; justify-content: space-between; align-items: center;}
    .hotel-stars { color: var(--gold); font-size: 0.75rem; }
    .hotel-name  { font-size: 1.1rem; font-weight: 900; color: #1e293b; margin-bottom: 12px; line-height: 1.2; }
    .hotel-dist  {
        color: #475569;
        font-size: 0.75rem;
        background: #f1f5f9;
        padding: 6px 10px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
        width: max-content;
    }
    .hotel-dist i { color: var(--maroon); }

    /* ── Info Grid ── */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    .info-item { display: flex; flex-direction: column; gap: 3px; }
    .info-label { font-size: 0.75rem; font-weight: 700; color: var(--maroon); text-transform: uppercase; letter-spacing: 0.5px; }
    .info-value { font-size: 0.95rem; font-weight: 600; color: #333; }

    /* ── Fasilitas Modern ── */
    .fasilitas-section { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
    .fasilitas-col-title {
        color: #1e293b;
        padding-bottom: 8px;
        border-bottom: 2px solid #f1f5f9;
        font-size: 0.85rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .fasilitas-col-title i { font-size: 1rem; }
    .fasilitas-col-title.includes i { color: #10b981; }
    .fasilitas-col-title.excludes i { color: #ef4444; }
    .fasilitas-item {
        font-size: 0.85rem;
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 8px;
        line-height: 1.4;
        color: #475569;
    }
    .fasilitas-item i.fa-check { color: #10b981; margin-top: 3px; font-size: 0.8rem; }
    .fasilitas-item i.fa-times { color: #ef4444; margin-top: 3px; font-size: 0.8rem; }

    /* ── Beautiful Timeline Itinerari ── */
    .itinerary-timeline {
        position: relative;
        padding-left: 30px;
        margin-top: 15px;
    }
    .itinerary-timeline::before {
        content: '';
        position: absolute;
        left: 9px;
        top: 10px;
        bottom: 10px;
        width: 3px;
        background: linear-gradient(to bottom, var(--maroon) 0%, var(--gold) 100%);
        border-radius: 2px;
    }
    .timeline-item {
        position: relative;
        margin-bottom: 24px;
    }
    .timeline-item:last-child {
        margin-bottom: 0;
    }
    .timeline-badge {
        position: absolute;
        left: -30px;
        top: 0;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: var(--maroon);
        border: 3px solid #fff;
        box-shadow: 0 0 0 3px var(--maroon);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        transition: all 0.3s ease;
    }
    .timeline-item:hover .timeline-badge {
        background: var(--gold);
        box-shadow: 0 0 0 5px var(--gold);
        transform: scale(1.1);
    }
    .timeline-content {
        background: #fdfaf6;
        border-radius: 12px;
        padding: 16px 20px;
        border-left: 4px solid var(--maroon);
        box-shadow: 0 3px 10px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
    }
    .timeline-item:hover .timeline-content {
        transform: translateX(8px);
        background: #fff;
        box-shadow: 0 8px 20px rgba(139,0,0,0.08);
        border-left-color: var(--gold);
    }
    .timeline-day-title {
        font-weight: 700;
        color: var(--maroon);
        font-size: 1.05rem;
        margin-bottom: 6px;
        transition: color 0.3s;
    }
    .timeline-item:hover .timeline-day-title {
        color: var(--gold);
    }
    .timeline-day-desc {
        margin: 0;
        font-size: 0.93rem;
        line-height: 1.6;
        color: #555;
    }

    /* ── Sticky Sidebar Modern ── */
    .sidebar-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
    }
    @media (min-width: 992px) {
        .sticky-col {
            position: -webkit-sticky;
            position: sticky;
            top: calc(var(--header-offset, 140px) + 24px);
            align-self: flex-start;
            z-index: 10;
        }
    }
    .sidebar-header {
        background: linear-gradient(135deg, var(--maroon), #6b1d1d);
        color: white;
        padding: 18px 24px;
        border-bottom: 3px solid var(--gold);
        font-weight: 800;
        font-size: 1.05rem;
    }
    .sidebar-body { padding: 24px; }
    .sidebar-price-label { font-size: 0.75rem; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
    .sidebar-price-main { font-size: 2.2rem; font-weight: 900; color: var(--maroon); line-height: 1; margin-bottom: 4px; letter-spacing: -0.5px; }
    .sidebar-price-sub  { font-size: 0.85rem; color: #64748b; margin-bottom: 20px; font-weight: 500; }
    .sidebar-divider { border-color: #e2e8f0; margin: 18px 0; border-width: 2px; border-style: dashed; opacity: 1; }
    .sidebar-meta-label { font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 2px; }
    .sidebar-meta-value { font-size: 0.95rem; color: #1e293b; margin-bottom: 14px; font-weight: 700; }
    .kuota-bar { height: 8px; border-radius: 10px; overflow: hidden; background: #e2e8f0; margin-bottom: 6px; }
    .kuota-bar-fill { height: 100%; background: linear-gradient(90deg, var(--maroon), #d34a4a); border-radius: 10px; transition: width 0.4s; }
    .kuota-text { font-size: 0.8rem; color: #64748b; font-weight: 600; }

    .btn-pesan-main {
        background: linear-gradient(135deg, var(--maroon), #6b1d1d);
        color: white;
        padding: 12px 10px;
        border-radius: 14px;
        font-weight: 800;
        border: none;
        flex: 1;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(139,45,45,0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
    }
    .btn-pesan-main::after {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 50%; height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
        transform: skewX(-25deg);
        transition: left 0.5s ease;
    }
    .btn-pesan-main:hover::after {
        left: 150%;
    }
    .btn-pesan-main:hover { 
        background: linear-gradient(135deg, #a83232, var(--maroon));
        color: white; 
        transform: translateY(-3px); 
        box-shadow: 0 8px 25px rgba(139,45,45,0.5); 
    }
    .btn-pesan-main:disabled, .btn-pesan-main.disabled {
        background: #ccc; box-shadow: none; cursor: not-allowed; transform: none; color: #666;
    }
    .btn-back {
        border: 2px solid #e2e8f0;
        color: #475569;
        padding: 12px 10px;
        border-radius: 14px;
        font-weight: bold;
        flex: 1;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }
    .btn-back:hover { background: #f8fafc; border-color: #cbd5e1; color: #0f172a; }

    /* ── Custom Tabs ── */
    .custom-tabs .nav-link {
        color: rgba(255, 255, 255, 0.7);
        border: none;
        border-radius: 12px 12px 0 0;
        font-weight: 800;
        padding: 14px 24px;
        transition: all 0.3s;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }
    .custom-tabs .nav-link:hover {
        color: white;
        background: rgba(255, 255, 255, 0.1);
    }
    .custom-tabs .nav-link.active {
        color: var(--maroon);
        background: white;
        border-bottom: none;
    }
    .custom-tabs .nav-link i {
        margin-right: 8px;
    }
    @media (max-width: 576px) {
        .custom-tabs .nav-link { padding: 10px 12px; font-size: 0.85rem; }
    }

    /* ── Glass Zoom Button ── */
    .detail-brochure-img { transition: transform 0.5s ease; }
    .brochure-card:hover .detail-brochure-img { transform: scale(1.02); }
    
    .glass-zoom-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -40%);
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        border: 2px solid rgba(255, 255, 255, 0.8);
        padding: 12px 24px;
        border-radius: 30px;
        color: #fff;
        font-weight: bold;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 10;
        pointer-events: none;
    }
    .glass-zoom-btn i {
        font-size: 1.2rem;
    }
    .brochure-card-body.position-relative:hover .glass-zoom-btn {
        opacity: 1;
        transform: translate(-50%, -50%);
    }
    .glass-zoom-btn:hover {
        background: rgba(0, 0, 0, 0.7);
    }

    @media (max-width: 991px) {
        .harga-grid-3 { grid-template-columns: 1fr 1fr 1fr; }
        .detail-hero h1 { font-size: 2rem; }
        .sidebar-card { position: static; margin-top: 30px; }
    }
    @media (max-width: 576px) {
        .harga-grid-3 { grid-template-columns: 1fr; }
        .fasilitas-section { grid-template-columns: 1fr; }
        .info-grid { grid-template-columns: 1fr 1fr; }
        .hotel-grid-2 { grid-template-columns: 1fr; }
    }
</style>

@php
    $bulanIndo = ['January'=>'JANUARI','February'=>'FEBRUARI','March'=>'MARET','April'=>'APRIL','May'=>'MEI','June'=>'JUNI','July'=>'JULI','August'=>'AGUSTUS','September'=>'SEPTEMBER','October'=>'OKTOBER','November'=>'NOVEMBER','December'=>'DESEMBER'];
    $namaBulan = $bulanIndo[$paket->tanggal_berangkat->format('F')] ?? strtoupper($paket->tanggal_berangkat->format('F'));
    $persenTerisi = $paket->kuota > 0 ? (($paket->kuota - $paket->tersedia) / $paket->kuota) * 100 : 0;
@endphp

<section class="detail-wrapper">
    <div class="container">
        <div class="breadcrumb-nav">
            <a href="{{ route('pakets.index') }}">Paket Umroh</a>
            <span>/</span>
            <strong>{{ $paket->nama_paket }}</strong>
        </div>

        <div class="row g-4">
            
            {{-- Kolom Kiri: Gambar Brosur --}}
            <div class="col-lg-4">
                @if($paket->gambar)
                @php
                    $imgUrl = Str::startsWith($paket->gambar, 'images/') ? asset($paket->gambar) : Storage::url($paket->gambar);
                @endphp
                <div class="brochure-card border-0 mb-4" style="box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
                    <div class="brochure-card-header" style="background: linear-gradient(135deg, var(--maroon), #6b1d1d); border-bottom: 3px solid var(--gold); padding: 18px 24px; border-radius: 16px 16px 0 0;">
                        <i class="fas fa-image" style="color: var(--gold-light); margin-right: 8px;"></i>
                        <h5 style="color: white; font-weight: 800; display: inline;">Brosur Paket</h5>
                    </div>
                    <div class="brochure-card-body p-0 position-relative" style="cursor: zoom-in; overflow: hidden; border-radius: 0 0 16px 16px;" onclick="openLightbox('{{ $imgUrl }}')" data-bs-toggle="modal" data-bs-target="#imageLightboxModal">
                        <img src="{{ $imgUrl }}" alt="Brosur {{ $paket->nama_paket }}" class="detail-brochure-img" style="width: 100%; height: auto; display: block;">
                        <div class="glass-zoom-btn">
                            <i class="fas fa-search-plus"></i> Perbesar
                        </div>
                    </div>
                </div>
                @else
                <div class="brochure-card p-0" style="border: none; background: linear-gradient(135deg, #fdf6ec, #f8f9fa); box-shadow: 0 15px 35px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: center; height: 400px; border-radius: 20px;">
                    <i class="fas fa-image fa-4x text-muted" style="opacity: 0.3;"></i>
                </div>
                @endif

                {{-- Ringkasan Pesanan (Dikembalikan ke bawah poster agar tidak memanjang) --}}
                <div class="sidebar-card mb-4 mt-4" style="border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border-radius: 12px; overflow: hidden; background: white;">
                    <div class="sidebar-header" style="background: var(--maroon); color: white; padding: 15px 20px; font-weight: bold; border-bottom: 3px solid var(--gold); font-size: 1rem;">
                        <i class="fas fa-shopping-cart" style="color: var(--gold); margin-right: 8px;"></i> Ringkasan & Pemesanan
                    </div>
                    <div class="sidebar-body" style="padding: 24px;">
                        {{-- Harga --}}
                        <div style="font-size: 0.75rem; color: #64748b; font-weight: 700; text-transform: uppercase;">Mulai Dari (Quad)</div>
                        <div style="font-size: 2.2rem; font-weight: 900; color: var(--maroon); line-height: 1.2; margin-top: 4px;">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                        <div style="font-size: 0.85rem; color: #64748b; margin-top: 4px;">/pax &bull; 4 dalam 1 kamar</div>
                        
                        <hr style="border-top: 2px dashed #cbd5e1; margin: 20px 0;">

                        {{-- Durasi & Tanggal --}}
                        <div class="mb-3">
                            <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; margin-bottom: 4px;">Durasi</div>
                            <div style="font-size: 0.95rem; font-weight: 700; color: #1e293b;">{{ $paket->durasi_hari }} Hari</div>
                        </div>

                        <div class="mb-3">
                            <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; margin-bottom: 4px;">Tanggal</div>
                            <div style="font-size: 0.95rem; font-weight: 700; color: #1e293b;">{{ $paket->tanggal_berangkat->format('d M Y') }} &ndash; {{ $paket->tanggal_kembali->format('d M Y') }}</div>
                        </div>

                        {{-- Ketersediaan Kursi --}}
                        <div class="mb-4">
                            <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; margin-bottom: 8px;">Ketersediaan Kursi</div>
                            @php
                                $terisi = $paket->kuota - $paket->tersedia;
                                $persentase = ($paket->kuota > 0) ? ($terisi / $paket->kuota) * 100 : 0;
                            @endphp
                            <div class="progress" style="height: 8px; border-radius: 4px; background-color: #e2e8f0; margin-bottom: 8px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $persentase }}%; background-color: var(--maroon);" aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div style="font-size: 0.85rem; color: #64748b; font-weight: 600;">{{ $paket->tersedia }} / {{ $paket->kuota }} kursi tersedia</div>
                        </div>

                        <hr style="border-top: 2px dashed #cbd5e1; margin: 20px 0;">

                        {{-- Tombol Aksi --}}
                        <div class="d-flex gap-3 mt-2">
                            <a href="{{ route('home') }}" class="btn btn-light" style="flex: 1; border: 1px solid #cbd5e1; font-weight: 700; color: #475569; border-radius: 8px; padding: 10px 0; font-size: 0.95rem;">&larr; Kembali</a>
                            
                            @auth
                                @if($paket->tersedia > 0)
                                    <a href="{{ route('pemesanans.create', $paket) }}" class="btn" style="flex: 1; background: var(--maroon); color: white; font-weight: 700; border-radius: 8px; padding: 10px 0; font-size: 0.95rem;">Pesan</a>
                                @else
                                    <span class="btn btn-secondary disabled" style="flex: 1; font-weight: 700; border-radius: 8px; padding: 10px 0; font-size: 0.95rem;">Penuh</span>
                                @endif
                            @else
                                <a href="{{ route('login') }}?redirect={{ urlencode(route('pemesanans.create', $paket)) }}" class="btn" style="flex: 1; background: var(--maroon); color: white; font-weight: 700; border-radius: 8px; padding: 10px 0; font-size: 0.95rem;">Login Pesan</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Detail & Pemesanan --}}
            <div class="col-lg-8">

                {{-- Ringkasan Pesanan dipindah ke bawah Tab --}}

                {{-- Tabs Container --}}
                <div class="brochure-card border-0 mb-4" style="box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
                    <div class="brochure-card-header" style="background: linear-gradient(135deg, var(--maroon), #6b1d1d); padding: 0; border-radius: 16px 16px 0 0; border-bottom: 3px solid var(--gold);">
                        <ul class="nav nav-tabs custom-tabs" id="paketTabs" role="tablist" style="border-bottom: none; padding: 12px 12px 0 12px; gap: 4px;">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="harga-tab" data-bs-toggle="tab" data-bs-target="#harga-tab-pane" type="button" role="tab" aria-controls="harga-tab-pane" aria-selected="true">
                                    <i class="fas fa-tags"></i> Harga & Hotel
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="fasilitas-tab" data-bs-toggle="tab" data-bs-target="#fasilitas-tab-pane" type="button" role="tab" aria-controls="fasilitas-tab-pane" aria-selected="false">
                                    <i class="fas fa-gift"></i> Fasilitas
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="deskripsi-tab" data-bs-toggle="tab" data-bs-target="#deskripsi-tab-pane" type="button" role="tab" aria-controls="deskripsi-tab-pane" aria-selected="false">
                                    <i class="fas fa-file-alt"></i> Deskripsi
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="brochure-card-body p-0">
                        <div class="tab-content" id="paketTabsContent">
                            
                            {{-- Tab Harga --}}
                            <div class="tab-pane fade show active p-4" id="harga-tab-pane" role="tabpanel" aria-labelledby="harga-tab" tabindex="0">
                                {{-- Harga Grid --}}
                                <div class="harga-grid-3">
                                    <div class="harga-box">
                                        <div class="harga-box-header">Quad</div>
                                        <div class="harga-box-body" style="padding: 16px 5px;">
                                            <span class="val-currency" style="top: 0;">Rp</span>
                                            <span class="val-amount" style="font-size: 1.3rem; letter-spacing: 0;">{{ number_format($paket->harga, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    <div class="harga-box">
                                        <div class="harga-box-header">Triple</div>
                                        <div class="harga-box-body" style="padding: 16px 5px;">
                                            <span class="val-currency" style="top: 0;">Rp</span>
                                            <span class="val-amount" style="font-size: 1.3rem; letter-spacing: 0;">{{ number_format($paket->harga_triple, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    <div class="harga-box">
                                        <div class="harga-box-header">Double</div>
                                        <div class="harga-box-body" style="padding: 16px 5px;">
                                            <span class="val-currency" style="top: 0;">Rp</span>
                                            <span class="val-amount" style="font-size: 1.3rem; letter-spacing: 0;">{{ number_format($paket->harga_double, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Hotel Grid --}}
                                <div class="hotel-grid-2 mt-4">
                                    <div class="hotel-box">
                                        <div class="hotel-loc">
                                            Makkah
                                            <div class="hotel-stars">
                                                @for($i = 0; $i < ($paket->hotel_makkah_bintang ?? 5); $i++)★@endfor
                                            </div>
                                        </div>
                                        <div class="hotel-name">{{ $paket->hotel_makkah_nama ?? 'Le Meridien Ajyad' }}</div>
                                        <div class="hotel-dist"><i class="fas fa-map-marker-alt"></i> {{ $paket->hotel_makkah_jarak ?? '± 100m dari Pelataran' }}</div>
                                    </div>
                                    <div class="hotel-box">
                                        <div class="hotel-loc">
                                            Madinah
                                            <div class="hotel-stars">
                                                @for($i = 0; $i < ($paket->hotel_madinah_bintang ?? 5); $i++)★@endfor
                                            </div>
                                        </div>
                                        <div class="hotel-name">{{ $paket->hotel_madinah_nama ?? 'Taiba Front' }}</div>
                                        <div class="hotel-dist"><i class="fas fa-map-marker-alt"></i> {{ $paket->hotel_madinah_jarak ?? '± 100m dari Pelataran' }}</div>
                                    </div>
                                </div>

                                {{-- Info Grid --}}
                                <div class="info-grid mt-4 pt-4" style="border-top: 1px dashed #e2e8f0;">
                                    <div class="info-item">
                                        <span class="info-label" style="color: #64748b;"><i class="fas fa-calendar-days"></i> Durasi</span>
                                        <span class="info-value" style="color: #1e293b;">{{ $paket->durasi_hari }} Hari</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label" style="color: #64748b;"><i class="fas fa-users"></i> Kuota</span>
                                        <span class="info-value" style="color: #1e293b;">{{ $paket->tersedia }} / {{ $paket->kuota }} Tersedia</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label" style="color: #64748b;"><i class="fas fa-plane-departure"></i> Keberangkatan</span>
                                        <span class="info-value" style="color: #1e293b;">{{ $paket->tanggal_berangkat->format('d M Y') }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label" style="color: #64748b;"><i class="fas fa-plane-arrival"></i> Kepulangan</span>
                                        <span class="info-value" style="color: #1e293b;">{{ $paket->tanggal_kembali->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Tab Fasilitas --}}
                            <div class="tab-pane fade p-4" id="fasilitas-tab-pane" role="tabpanel" aria-labelledby="fasilitas-tab" tabindex="0">
                                <div class="fasilitas-section">
                                    <div>
                                        <div class="fasilitas-col-title includes">
                                            <i class="fas fa-check-circle"></i> Fasilitas (Includes)
                                        </div>
                                        @foreach(explode("\n", $paket->fasilitas) as $f)
                                            @if(trim($f))
                                                <div class="fasilitas-item"><i class="fas fa-check"></i><span>{{ trim($f) }}</span></div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div>
                                        <div class="fasilitas-col-title excludes">
                                            <i class="fas fa-times-circle"></i> Price Excludes
                                        </div>
                                        <div class="fasilitas-item"><i class="fas fa-times"></i><span>Kelebihan Bagasi</span></div>
                                        <div class="fasilitas-item"><i class="fas fa-times"></i><span>Pembuatan Paspor</span></div>
                                        <div class="fasilitas-item"><i class="fas fa-times"></i><span>Pengeluaran Pribadi</span></div>
                                        <div class="fasilitas-item"><i class="fas fa-times"></i><span>Vaksin Meningitis &amp; Polio</span></div>
                                    </div>
                                </div>
                            </div>

                            {{-- Tab Deskripsi --}}
                            <div class="tab-pane fade p-4" id="deskripsi-tab-pane" role="tabpanel" aria-labelledby="deskripsi-tab" tabindex="0">
                                <p style="color:#475569; line-height: 1.8; margin: 0; font-size: 0.95rem;">{{ $paket->deskripsi }}</p>
                            </div>

                        </div>
                    </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
@endsection

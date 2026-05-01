@extends('layouts.app')

@section('title', $paket->nama_paket . ' - Travelkartika Mas')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Image -->
                <div class="col-md-6 mb-4">
                    @if($paket->gambar)
                        <img src="{{ $paket->gambar }}" 
                        class="img-fluid rounded" 
                        alt="{{ $paket->nama_paket }}" 
                        style="height: 220px; width: 100%; object-fit: cover;">
                    @else
                        <div style="height: 220px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 6rem; border-radius: 10px;">
                            <i class="fas fa-kaaba"></i>
                        </div>
                    @endif
                </div>

                <!-- Detail Paket -->
                <div class="col-md-6">
                    <h1 style="color: var(--primary); font-weight: bold;">{{ $paket->nama_paket }}</h1>
                    
                    <div class="mb-4">
                        <h4 class="harga-display">Rp {{ number_format($paket->harga, 0, ',', '.') }}</h4>
                        <p class="text-muted">per orang</p>
                    </div>

                    <!-- Informasi Dasar -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <h6 style="color: var(--primary); font-weight: bold;">
                                        <i class="fas fa-calendar-days"></i> Durasi
                                    </h6>
                                    <p>{{ $paket->durasi_hari }} Hari</p>
                                </div>
                                <div class="col-6">
                                    <h6 style="color: var(--primary); font-weight: bold;">
                                        <i class="fas fa-plane-departure"></i> Keberangkatan
                                    </h6>
                                    <p>{{ $paket->tanggal_berangkat->format('d F Y') }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <h6 style="color: var(--primary); font-weight: bold;">
                                        <i class="fas fa-plane-arrival"></i> Kepulangan
                                    </h6>
                                    <p>{{ $paket->tanggal_kembali->format('d F Y') }}</p>
                                </div>
                                <div class="col-6">
                                    <h6 style="color: var(--primary); font-weight: bold;">
                                        <i class="fas fa-chair"></i> Kuota
                                    </h6>
                                    <p>{{ $paket->tersedia }} / {{ $paket->kuota }} tersedia</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Ketersediaan -->
                    @if($paket->tersedia == 0)
                        <div class="alert alert-danger mb-4">
                            <i class="fas fa-exclamation-triangle"></i> Paket ini sudah penuh. Silakan pilih paket lain atau hubungi kami untuk waiting list.
                        </div>
                    @endif

                    <!-- Button Pesan -->
                    @auth
                        @if($paket->tersedia > 0)
                            <a href="{{ route('pemesanans.create', $paket) }}" class="btn btn-secondary btn-lg w-100 mb-2">
                                <i class="fas fa-check-circle"></i> Pesan Sekarang
                            </a>
                        @else
                            <button class="btn btn-secondary btn-lg w-100 mb-2" disabled>
                                <i class="fas fa-check-circle"></i> Paket Penuh
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-secondary btn-lg w-100 mb-2">
                            <i class="fas fa-sign-in-alt"></i> Login untuk Pesan
                        </a>
                    @endauth

                    <a href="{{ route('pakets.index') }}" class="btn btn-outline-primary btn-lg w-100">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>

            <!-- Deskripsi Lengkap -->
            <div class="row mt-5">
                <div class="col-lg-8">
                    <!-- Deskripsi -->
                    <div class="card mb-4">
                        <div class="card-header" style="background: var(--primary); color: white;">
                            <h5 class="mb-0"><i class="fas fa-file-alt"></i> Deskripsi Paket</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $paket->deskripsi }}</p>
                        </div>
                    </div>

                    <!-- Fasilitas -->
                    <div class="card mb-4">
                        <div class="card-header" style="background: var(--primary); color: white;">
                            <h5 class="mb-0"><i class="fas fa-gift"></i> Fasilitas</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                @foreach(explode("\n", $paket->fasilitas) as $fasilitas)
                                    @if(trim($fasilitas))
                                        <li class="mb-2">
                                            <i class="fas fa-check-circle" style="color: var(--secondary);"></i>
                                            {{ trim($fasilitas) }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Itinerari -->
                    <div class="card mb-4">
                        <div class="card-header" style="background: var(--primary); color: white;">
                            <h5 class="mb-0"><i class="fas fa-map"></i> Itinerari</h5>
                        </div>
                        <div class="card-body">
                            <p style="white-space: pre-wrap;">{{ $paket->itinerari }}</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="col-lg-4">
                    <div class="card sticky-top" style="top: 20px;">
                        <div class="card-header" style="background: var(--primary); color: white;">
                            <h5 class="mb-0"><i class="fas fa-star"></i> Ringkasan</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h6 style="color: var(--primary); font-weight: bold;">Harga Per Orang</h6>
                                <h4 class="harga-display">Rp {{ number_format($paket->harga, 0, ',', '.') }}</h4>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h6 style="color: var(--primary); font-weight: bold;">Durasi</h6>
                                <p>{{ $paket->durasi_hari }} Hari</p>
                            </div>
                            <div class="mb-3">
                                <h6 style="color: var(--primary); font-weight: bold;">Tanggal</h6>
                                <p>{{ $paket->tanggal_berangkat->format('d M Y') }} - {{ $paket->tanggal_kembali->format('d M Y') }}</p>
                            </div>
                            <div class="mb-3">
                                <h6 style="color: var(--primary); font-weight: bold;">Ketersediaan</h6>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ (($paket->kuota - $paket->tersedia) / $paket->kuota) * 100 }}%; background: var(--secondary);" aria-valuenow="{{ $paket->kuota - $paket->tersedia }}" aria-valuemin="0" aria-valuemax="{{ $paket->kuota }}">
                                        {{ $paket->kuota - $paket->tersedia }} / {{ $paket->kuota }}
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

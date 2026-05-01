@extends('layouts.app')

@section('title', 'Detail Pemesanan - Travelkartika Mas')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <a href="{{ route('pemesanans.index') }}" class="btn btn-outline-primary mb-4">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Nomor Pemesanan -->
                    <div class="card mb-4">
                        <div class="card-header" style="background: var(--primary); color: white;">
                            <h5 class="mb-0">Pemesanan #{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>Tanggal Pemesanan:</strong><br>
                                    {{ $pemesanan->created_at->format('d F Y, H:i') }}
                                </div>
                                <div class="col-6">
                                    <strong>Status:</strong><br>
                                    @if($pemesanan->status === 'pending')
                                        <span class="badge badge-pending" style="font-size: 1rem;">Menunggu Konfirmasi</span>
                                    @elseif($pemesanan->status === 'confirmed')
                                        <span class="badge badge-confirmed" style="font-size: 1rem;">Terkonfirmasi</span>
                                    @elseif($pemesanan->status === 'dibatalkan')
                                        <span class="badge badge-dibatalkan" style="font-size: 1rem;">Dibatalkan</span>
                                    @elseif($pemesanan->status === 'completed')
                                        <span class="badge badge-completed" style="font-size: 1rem;">Selesai</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Paket -->
                    <div class="card mb-4">
                        <div class="card-header" style="background: var(--primary); color: white;">
                            <h5 class="mb-0">Detail Paket</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    @if($pemesanan->paket->gambar)
                                        <img src="{{ $pemesanan->paket->gambar }}" class="img-fluid rounded" alt="{{ $pemesanan->paket->nama_paket }}">
                                    @else
                                        <div style="height: 150px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; border-radius: 10px;">
                                            <i class="fas fa-kaaba"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <h5 style="color: var(--primary); font-weight: bold;">{{ $pemesanan->paket->nama_paket }}</h5>
                                    <p class="text-muted">{{ $pemesanan->paket->deskripsi }}</p>
                                    
                                    <div class="row">
                                        <div class="col-6">
                                            <strong>Durasi:</strong> {{ $pemesanan->paket->durasi_hari }} Hari
                                        </div>
                                        <div class="col-6">
                                            <strong>Harga/Orang:</strong> Rp {{ number_format($pemesanan->paket->harga, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <strong>Berangkat:</strong> {{ $pemesanan->paket->tanggal_berangkat->format('d F Y') }}
                                        </div>
                                        <div class="col-6">
                                            <strong>Kembali:</strong> {{ $pemesanan->paket->tanggal_kembali->format('d F Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Pemesanan -->
                    <div class="card mb-4">
                        <div class="card-header" style="background: var(--primary); color: white;">
                            <h5 class="mb-0">Detail Pemesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>Jumlah Peserta:</strong><br>
                                    {{ $pemesanan->jumlah_peserta }} orang
                                </div>
                                <div class="col-6">
                                    <strong>Total Harga:</strong><br>
                                    <h5 class="harga-display">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</h5>
                                </div>
                            </div>

                            @if($pemesanan->catatan)
                                <hr>
                                <div>
                                    <strong>Catatan:</strong><br>
                                    <p>{{ $pemesanan->catatan }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Data Pemesan -->
                    <div class="card mb-4">
                        <div class="card-header" style="background: var(--primary); color: white;">
                            <h5 class="mb-0">Data Pemesan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>Nama:</strong><br>
                                    {{ $pemesanan->user->name }}
                                </div>
                                <div class="col-6">
                                    <strong>Email:</strong><br>
                                    {{ $pemesanan->user->email }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Aksi -->
                    @if($pemesanan->status === 'pending')
                        <form action="{{ route('pemesanans.cancel', $pemesanan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pemesanan ini?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger btn-lg w-100">
                                <i class="fas fa-trash"></i> Batalkan Pemesanan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.admin')

@section('title', 'Detail Pemesanan - Admin')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.pemesanans.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Nomor Pemesanan -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Pemesanan #{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <strong>Status:</strong><br>
                    @if($pemesanan->status === 'pending')
                        <span class="badge badge-pending" style="font-size: 1rem;">Menunggu Konfirmasi</span>
                    @elseif($pemesanan->status === 'confirmed')
                        <span class="badge badge-confirmed" style="font-size: 1rem;">Dikonfirmasi</span>
                    @elseif($pemesanan->status === 'dibatalkan')
                        <span class="badge badge-dibatalkan" style="font-size: 1rem;">Dibatalkan</span>
                    @endif
                </div>
                <div class="col-6">
                    <strong>Tanggal Pemesanan:</strong><br>
                    {{ $pemesanan->created_at->format('d F Y, H:i') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Data Jamaah -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Data Jamaah</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <strong>Nama:</strong> {{ $pemesanan->user->name }}<br>
                    <strong>Email:</strong> {{ $pemesanan->user->email }}
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Paket -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Detail Paket</h5>
        </div>
        <div class="card-body">
            <h6 style="color: var(--primary); font-weight: bold;">{{ $pemesanan->paket->nama_paket }}</h6>
            <div class="row mb-3">
                <div class="col-6">
                    <strong>Durasi:</strong> {{ $pemesanan->paket->durasi_hari }} Hari<br>
                    <strong>Harga/Orang:</strong> Rp {{ number_format($pemesanan->paket->harga, 0, ',', '.') }}
                </div>
                <div class="col-6">
                    <strong>Berangkat:</strong> {{ $pemesanan->paket->tanggal_berangkat->format('d F Y') }}<br>
                    <strong>Kembali:</strong> {{ $pemesanan->paket->tanggal_kembali->format('d F Y') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Pemesanan -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Detail Pemesanan</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <strong>Jumlah Peserta:</strong> {{ $pemesanan->jumlah_peserta }} orang
                </div>
                <div class="col-6">
                    <strong>Total Harga:</strong><br>
                    <h5 style="color: var(--secondary);">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</h5>
                </div>
            </div>

            @if($pemesanan->catatan)
                <hr>
                <div>
                    <strong>Catatan:</strong><br>
                    {{ $pemesanan->catatan }}
                </div>
            @endif
        </div>
    </div>

    <!-- Departure Info -->
    @if($pemesanan->departureInfo)
        <div class="card mb-4">
            <div class="card-header" style="background: var(--secondary); color: white;">
                <h5 class="mb-0">Informasi Keberangkatan</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <strong>Tanggal Berkumpul:</strong> {{ $pemesanan->departureInfo->tanggal_berkumpul->format('d F Y') }}<br>
                        <strong>Waktu:</strong> {{ $pemesanan->departureInfo->waktu_berkumpul }}
                    </div>
                    <div class="col-6">
                        <strong>Lokasi:</strong> {{ $pemesanan->departureInfo->lokasi_berkumpul }}<br>
                        <strong>Contact:</strong> {{ $pemesanan->departureInfo->no_hp_contact }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Actions -->
    <div class="d-grid gap-2">
        @if($pemesanan->status === 'pending')
            <a href="{{ route('admin.pemesanans.confirm', $pemesanan) }}" class="btn btn-success btn-lg">
                <i class="fas fa-check"></i> Konfirmasi & Masukkan Info Keberangkatan
            </a>
        @endif

        @if($pemesanan->status !== 'dibatalkan')
            <form action="{{ route('admin.pemesanans.cancel', $pemesanan) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-danger btn-lg w-100" onclick="return confirm('Batalkan pemesanan ini?')">
                    <i class="fas fa-times"></i> Batalkan Pemesanan
                </button>
            </form>
        @endif
    </div>
@endsection

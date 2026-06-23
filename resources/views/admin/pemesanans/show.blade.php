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
                        <span class="badge" style="background-color: #8B2D2D; color: white; font-size: 1rem;">Dibatalkan</span>
                    @endif
                </div>
                <div class="col-6">
                    <strong>Tanggal Pemesanan:</strong><br>
                    {{ $pemesanan->created_at->format('d F Y, H:i') }}
                </div>
            
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
    <div class="d-flex justify-content-end align-items-stretch gap-2 mt-4">
        @if($pemesanan->status === 'pending')
            <a href="{{ route('admin.pemesanans.confirm', $pemesanan) }}" class="btn btn-success d-flex align-items-center">
                <i class="fas fa-check-circle me-1"></i> Konfirmasi & Masukkan Info
            </a>
        @endif

        @if(in_array($pemesanan->status, ['confirmed', 'completed']))
            <a href="{{ route('admin.pemesanans.cetak', $pemesanan) }}" target="_blank" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-print me-1"></i> Cetak Kuitansi
            </a>
        @endif

        @if($pemesanan->status !== 'dibatalkan')
            <form action="{{ route('admin.pemesanans.cancel', $pemesanan) }}" method="POST" class="m-0">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-outline-danger d-flex align-items-center h-100" style="border-color: #8B2D2D; color: #8B2D2D;" onclick="return confirm('Batalkan pemesanan ini?')">
                    <i class="fas fa-times me-1"></i> Batalkan
                </button>
            </form>
        @endif
    </div>
@endsection


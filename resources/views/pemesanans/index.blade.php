@extends('layouts.app')

@section('title', 'Pemesanan Saya - Travelkartika Mas')

@section('content')
    <section class="py-5" style="background-color: #f8f9fa; min-height: 80vh;">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-end align-items-center mb-3 gap-3">
                <a href="{{ route('pakets.index') }}" class="btn btn-outline-primary fw-bold rounded-pill">
                    <i class="fas fa-plus me-1"></i> Pesan Paket Lain
                </a>
            </div>

            @if($pemesanans->count() > 0)
                <div class="card mb-4" style="border: none; border-top: 3px solid var(--primary); border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                    <div class="card-header" style="background: white; color: #333; border-bottom: 1px solid #eee; padding: 15px 20px; border-radius: 8px 8px 0 0;">
                        <h5 class="mb-0" style="font-weight: bold; color: #333;">Riwayat Pemesanan</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle" style="background: white;">
                            <thead>
                                <tr style="color: var(--primary);">
                                    <th class="text-center py-3" style="color: var(--primary) !important;">ID Pesanan</th>
                                    <th class="py-3" style="color: var(--primary) !important;">Tanggal Pesan</th>
                                    <th class="py-3" style="color: var(--primary) !important;">Nama Paket</th>
                                    <th class="py-3" style="color: var(--primary) !important;">Total Tagihan</th>
                                    <th class="py-3" style="color: var(--primary) !important;">Status</th>
                                    <th class="text-center py-3" style="color: var(--primary) !important;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pemesanans as $pemesanan)
                                    <tr>
                                        <td class="text-center fw-bold">{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $pemesanan->created_at->format('d M Y') }}<br><small class="text-muted">{{ $pemesanan->created_at->format('H:i') }} WIB</small></td>
                                        <td>
                                            <span class="fw-bold" style="color: var(--primary);">{{ $pemesanan->paket->nama_paket }}</span><br>
                                            <small class="text-muted"><i class="fas fa-users me-1"></i> {{ $pemesanan->jumlah_peserta }} Orang &bull; {{ $pemesanan->tipe_kamar ?? 'QUAD' }}</small>
                                        </td>
                                        <td class="fw-bold">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($pemesanans->count() > 0)
                                            @endif
                                            @if($pemesanan->status === 'pending')
                                                <span class="badge bg-warning text-dark"><i class="fas fa-clock"></i> Menunggu Pembayaran</span>
                                            @elseif($pemesanan->status === 'confirmed')
                                                <span class="badge bg-success"><i class="fas fa-check-circle"></i> Terkonfirmasi</span>
                                            @elseif($pemesanan->status === 'dibatalkan')
                                                <span class="badge bg-danger"><i class="fas fa-times-circle"></i> Dibatalkan</span>
                                            @elseif($pemesanan->status === 'completed')
                                                <span class="badge bg-primary"><i class="fas fa-flag-checkered"></i> Selesai</span>
                                            @endif
                                            
                                            <div class="mt-1">
                                                @php
                                                    $isLengkap = $pemesanan->data_completed_at && $pemesanan->file_foto && $pemesanan->file_ktp && $pemesanan->file_kk && $pemesanan->file_paspor;
                                                @endphp
                                                @if($isLengkap)
                                                    <span class="badge bg-success bg-opacity-10 text-success border border-success" style="font-size: 0.65rem;">Biodata Lengkap</span>
                                                @else
                                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning" style="font-size: 0.65rem;">Biodata Belum Lengkap</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('pemesanans.show', $pemesanan) }}" class="btn btn-sm text-white" style="background-color: var(--primary);" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if(in_array($pemesanan->status, ['confirmed', 'completed']))
                                                    <a href="{{ route('pemesanans.cetak', $pemesanan) }}" class="btn btn-sm text-white bg-success" title="Cetak Invoice">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                @endif
                                                @if($pemesanan->status !== 'dibatalkan')
                                                    <a href="{{ route('pemesanans.complete-data', $pemesanan) }}" class="btn btn-sm text-white" style="background-color: #DAA520;" title="Edit Data">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $pemesanans->links() }}
                </div>
            @else
                <div class="card border-0 shadow-sm rounded-4 text-center py-5">
                    <div class="card-body py-5">
                        <i class="fas fa-box-open fa-4x text-muted mb-4" style="opacity: 0.4;"></i>
                        <h3 class="fw-bold text-dark">Belum Ada Pemesanan</h3>
                        <p class="text-muted mb-4" style="font-size: 1.1rem;">Anda belum memiliki riwayat pemesanan paket umroh. Yuk, wujudkan niat suci Anda sekarang!</p>
                        <a href="{{ route('pakets.index') }}" class="btn btn-primary btn-lg rounded-pill fw-bold px-5 shadow-sm">
                            <i class="fas fa-search me-2"></i> Cari Paket Umroh
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

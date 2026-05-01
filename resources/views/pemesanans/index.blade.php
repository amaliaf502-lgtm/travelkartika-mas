@extends('layouts.app')

@section('title', 'Pemesanan Saya - Travelkartika Mas')

@section('content')
    <section class="py-5">
        <div class="container">
            <h2 style="color: var(--primary); font-weight: bold; margin-bottom: 30px;">
                <i class="fas fa-list"></i> Pemesanan Saya
            </h2>

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

            @if($pemesanans->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="background: var(--primary); color: white;">
                            <tr>
                                <th>Paket</th>
                                <th>Tanggal Pesan</th>
                                <th>Peserta</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanans as $pemesanan)
                                <tr>
                                    <td>
                                        <strong>{{ $pemesanan->paket->nama_paket }}</strong><br>
                                        <small class="text-muted">{{ $pemesanan->paket->tanggal_berangkat->format('d M Y') }} - {{ $pemesanan->paket->tanggal_kembali->format('d M Y') }}</small>
                                    </td>
                                    <td>{{ $pemesanan->created_at->format('d M Y H:i') }}</td>
                                    <td>{{ $pemesanan->jumlah_peserta }} orang</td>
                                    <td><strong>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</strong></td>
                                    <td>
                                        @if($pemesanan->status === 'pending')
                                            <span class="badge badge-pending">Menunggu Konfirmasi</span>
                                        @elseif($pemesanan->status === 'confirmed')
                                            <span class="badge badge-confirmed">Terkonfirmasi</span>
                                        @elseif($pemesanan->status === 'dibatalkan')
                                            <span class="badge badge-dibatalkan">Dibatalkan</span>
                                        @elseif($pemesanan->status === 'completed')
                                            <span class="badge badge-completed">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('pemesanans.show', $pemesanan) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $pemesanans->links() }}
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Anda belum memiliki pemesanan.</strong><br>
                    <a href="{{ route('pakets.index') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-search"></i> Lihat Paket Umroh
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection

@extends('layouts.admin')

@section('title', 'Admin Dashboard - Travelkartika Mas')

@section('content')
    <div class="page-title">
        <i class="fas fa-tachometer-alt"></i>
        <h2>Admin Dashboard</h2>
    </div>

    <!-- Statistics -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <div class="stat-number">{{ $total_jamaah }}</div>
                <div class="stat-label">Total Jamaah</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card secondary">
                <i class="fas fa-shopping-cart"></i>
                <div class="stat-number">{{ $total_pemesanan }}</div>
                <div class="stat-label">Total Pemesanan</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card warning">
                <i class="fas fa-clock"></i>
                <div class="stat-number">{{ $pemesanan_pending }}</div>
                <div class="stat-label">Menunggu Konfirmasi</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card success">
                <i class="fas fa-money-bill-wave"></i>
                <div class="stat-number">Rp {{ number_format($total_revenue, 0, ',', '.') }}</div>
                <div class="stat-label">Revenue (Confirmed)</div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Pemesanan Terbaru</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Jamaah</th>
                                <th>Paket</th>
                                <th>Peserta</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pemesanan_terbaru as $pemesanan)
                                <tr>
                                    <td><strong>{{ $pemesanan->user->name }}</strong></td>
                                    <td>{{ $pemesanan->paket->nama_paket }}</td>
                                    <td>{{ $pemesanan->jumlah_peserta }} orang</td>
                                    <td>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @if($pemesanan->status === 'pending')
                                            <span class="badge badge-pending">Pending</span>
                                        @elseif($pemesanan->status === 'confirmed')
                                            <span class="badge badge-confirmed">Confirmed</span>
                                        @elseif($pemesanan->status === 'dibatalkan')
                                            <span class="badge badge-dibatalkan">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td>{{ $pemesanan->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.pemesanans.show', $pemesanan) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox"></i> Belum ada pemesanan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

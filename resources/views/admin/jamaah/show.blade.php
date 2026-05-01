@extends('layouts.admin')

@section('title', 'Detail Jamaah - Admin')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.jamaah.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Data Jamaah -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Data Jamaah</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h4 style="color: var(--primary);">{{ $jamaah->name }}</h4>
                    <p class="text-muted">{{ $jamaah->email }}</p>
                    <hr>
                    <p>
                        <strong>Terdaftar:</strong> {{ $jamaah->created_at->format('d F Y H:i') }}<br>
                        <strong>Total Pemesanan:</strong> {{ $pemesanans->count() }} paket
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pemesanan Jamaah -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Riwayat Pemesanan</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Paket</th>
                        <th>Peserta</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemesanans as $pemesanan)
                        <tr>
                            <td><strong>{{ $pemesanan->paket->nama_paket }}</strong></td>
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
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-inbox"></i> Belum ada pemesanan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

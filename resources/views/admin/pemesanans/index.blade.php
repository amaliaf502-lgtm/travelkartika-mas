@extends('layouts.admin')

@section('title', 'Kelola Pemesanan - Admin')

@section('content')
    <div class="page-title">
        <i class="fas fa-list"></i>
        <h2>Kelola Pemesanan</h2>
    </div>
    <p class="text-muted mb-4">Total: {{ $pemesanans->total() }} pemesanan</p>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                            <tr>
                                <th>No</th>
                                <th>Jamaah</th>
                                <th>Paket</th>
                                <th>Peserta</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Tanggal Pesan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pemesanans as $index => $pemesanan)
                                <tr>
                                    <td>{{ ($pemesanans->currentPage() - 1) * $pemesanans->perPage() + $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $pemesanan->user->name }}</strong><br>
                                        <small class="text-muted">{{ $pemesanan->user->email }}</small>
                                    </td>
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
                                    <td>{{ $pemesanan->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.pemesanans.show', $pemesanan) }}" class="btn btn-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($pemesanan->status === 'pending')
                                                <a href="{{ route('admin.pemesanans.confirm', $pemesanan) }}" class="btn btn-success" title="Konfirmasi">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox"></i> Tidak ada pemesanan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $pemesanans->links() }}
            </div>
@endsection

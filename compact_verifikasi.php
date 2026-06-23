<?php
$content = <<<EOF
@extends("layouts.admin")

@section("title", "Verifikasi Pembayaran - Admin")

@section("content")

    <div class="page-title d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Verifikasi Pembayaran</h2>
            <p class="text-muted mb-0" style="font-weight: normal; font-size: 0.9rem;">Seluruh riwayat transaksi pembayaran dari jamaah</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="badge shadow-sm text-dark" style="background-color: #f8f9fa; font-size: 0.85rem; padding: 6px 10px; border: 1px solid #ddd;">MODE: SANDBOX (TESTING)</span>
            @if(\$pending_count > 0)
                <span class="badge bg-warning text-dark px-3 py-2" style="font-size:0.9rem;">
                    {{ \$pending_count }} Menunggu
                </span>
            @else
                <span class="badge bg-success px-3 py-2" style="font-size:0.9rem;">
                    <i class="fas fa-check-circle"></i> Selesai
                </span>
            @endif
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route("admin.verifikasi-pembayaran") }}" class="row g-3 align-items-end">
                <div class="col-md-8">
                    <label class="form-label">Cari Jamaah / Nomor Pesanan</label>
                    <input type="text" name="search" class="form-control" placeholder="Ketik nama jamaah, email, atau ID pesanan..." value="{{ request("search") }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>Pemesan</th>
                        <th>Paket Umroh</th>
                        <th>Total Tagihan</th>
                        <th>Manifest</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\$pemesanans as \$pemesanan)
                        <tr>
                            <td>#{{ str_pad(\$pemesanan->id, 5, "0", STR_PAD_LEFT) }}</td>
                            <td>
                                <div><strong>{{ \$pemesanan->user->name }}</strong></div>
                                <div class="text-muted" style="font-size: 0.85rem;">{{ \$pemesanan->user->email }}</div>
                            </td>
                            <td>
                                <div><strong>{{ \$pemesanan->paket->nama_paket }}</strong></div>
                                <div class="text-muted" style="font-size: 0.85rem;">
                                    <i class="fas fa-users me-1"></i>{{ \$pemesanan->jumlah_peserta }} Orang ({{ strtoupper(\$pemesanan->tipe_kamar ?? "QUAD") }})
                                </div>
                            </td>
                            <td><strong>Rp {{ number_format(\$pemesanan->total_harga, 0, ",", ".") }}</strong></td>
                            <td>
                                @if(\$pemesanan->data_completed_at)
                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Lengkap</span>
                                @else
                                    <span class="badge bg-warning text-dark"><i class="fas fa-exclamation-circle me-1"></i>Belum Lengkap</span>
                                @endif
                            </td>
                            <td><small>{{ \$pemesanan->created_at->format("d M Y H:i") }}</small></td>
                            <td>
                                <a href="{{ route("admin.pemesanans.show", \$pemesanan) }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Tidak ada pembayaran yang menunggu verifikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(\$pemesanans->hasPages())
            <div class="card-footer">
                {{ \$pemesanans->links() }}
            </div>
        @endif
    </div>
@endsection
EOF;
file_put_contents("resources/views/admin/pemesanans/verifikasi.blade.php", $content);
echo "Verifikasi reverted to compact layout\n";


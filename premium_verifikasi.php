<?php
$content = <<<EOF
@extends("layouts.admin")

@section("title", "Verifikasi Pembayaran - Admin")

@section("content")

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="mb-0" style="color: #8B2D2D; font-weight: 600;">Verifikasi Pembayaran</h2>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Pemesanan yang menunggu verifikasi pembayaran dari jamaah</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="badge rounded-pill" style="background-color: #f8f9fa; color: #333; border: 1px solid #ddd; padding: 6px 12px; font-weight: 500;">MODE: SANDBOX (TESTING)</span>
            @if(\$pending_count > 0)
                <span class="badge rounded-pill" style="background-color: #f39c12; padding: 8px 16px; font-weight: 600; font-size: 0.9rem;">
                    {{ \$pending_count }} Menunggu
                </span>
            @else
                <span class="badge rounded-pill bg-success" style="padding: 8px 16px; font-weight: 600; font-size: 0.9rem;">
                    <i class="fas fa-check-circle"></i> Selesai
                </span>
            @endif
        </div>
    </div>

    <div class="card mb-4 border-0 shadow-sm rounded-3">
        <div class="card-body p-3">
            <form method="GET" action="{{ route("admin.verifikasi-pembayaran") }}" class="row g-3 align-items-end">
                <div class="col-md-9">
                    <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;"><i class="fas fa-search me-1"></i> Cari Jamaah / Nomor Pesanan</label>
                    <input type="text" name="search" class="form-control" placeholder="Ketik nama jamaah, email, atau ID pesanan..." value="{{ request("search") }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn w-100" style="background-color: #8B2D2D; color: white;">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header border-0 py-3" style="background-color: #8B2D2D; color: white;">
            <h5 class="mb-0 fs-6 fw-normal">Daftar Menunggu Verifikasi</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="border-bottom: 2px solid #eee;">
                    <tr>
                        <th class="py-3 px-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.85rem;">#ID</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.85rem;">PEMESAN</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.85rem;">PAKET UMROH</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.85rem;">TOTAL TAGIHAN</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.85rem;">STATUS PEMBAYARAN</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.85rem;">MANIFEST</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.85rem;">WAKTU</th>
                        <th class="py-3 px-3 border-0 text-center" style="color: #8B2D2D; font-weight: 600; font-size: 0.85rem;">AKSI</th>
                    </tr>
                </thead>
                <tbody style="border-top: none;">
                    @forelse(\$pemesanans as \$pemesanan)
                        <tr>
                            <td class="px-3 text-muted" style="font-size: 0.85rem;">
                                <strong>#{{ str_pad(\$pemesanan->id, 5, "0", STR_PAD_LEFT) }}</strong>
                            </td>
                            <td>
                                <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ \$pemesanan->user->name }}</div>
                                <div class="text-muted" style="font-size: 0.8rem;">{{ \$pemesanan->user->email }}</div>
                            </td>
                            <td>
                                <div class="fw-bold" style="color: #2980b9; font-size: 0.9rem;">{{ \$pemesanan->paket->nama_paket }}</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-users me-1"></i>{{ \$pemesanan->jumlah_peserta }} Orang ({{ strtoupper(\$pemesanan->tipe_kamar ?? "QUAD") }})</div>
                            </td>
                            <td>
                                <span class="fw-bold text-dark" style="font-size: 0.9rem;">Rp {{ number_format(\$pemesanan->total_harga, 0, ",", ".") }}</span>
                            </td>
                            <td>
                                <span class="badge rounded-pill" style="background-color: #e3f2fd; color: #1e88e5; border: 1px solid #90caf9; padding: 6px 12px; font-weight: 600;">
                                    Menunggu Payment
                                </span>
                            </td>
                            <td>
                                @if(\$pemesanan->data_completed_at)
                                    <span class="badge rounded-pill" style="background-color: #2ecc71; padding: 5px 10px; font-weight: 500;"><i class="fas fa-check-circle me-1"></i>Lengkap</span>
                                @else
                                    <span class="badge rounded-pill" style="background-color: #f1c40f; color: #000; padding: 5px 10px; font-weight: 500;"><i class="fas fa-exclamation-circle me-1"></i>Belum Lengkap</span>
                                @endif
                            </td>
                            <td class="text-muted" style="font-size: 0.85rem;">
                                {{ \$pemesanan->created_at->format("d M Y H:i") }}
                            </td>
                            <td class="px-3 text-center">
                                <a href="{{ route("admin.pemesanans.show", \$pemesanan) }}" class="btn btn-sm" style="background-color: #8B2D2D; color: white;" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-check-circle mb-3" style="font-size: 3rem; color: #2ecc71; opacity: 0.5;"></i>
                                <p class="mb-0">Tidak ada pembayaran yang menunggu verifikasi</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(\$pemesanans->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ \$pemesanans->links() }}
            </div>
        @endif
    </div>
@endsection
EOF;
file_put_contents("resources/views/admin/pemesanans/verifikasi.blade.php", $content);
echo "Verifikasi premium layout implemented\n";


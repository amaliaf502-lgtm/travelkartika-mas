@extends("layouts.admin")

@section("title", "Verifikasi Pembayaran - Admin")

@section("content")

    <div class="d-flex align-items-center mb-4 gap-3">
        <h2 class="mb-0" style="color: #8B2D2D; font-weight: 600;">Verifikasi Pembayaran</h2>
    </div>

    <div class="card mb-4 border-0 shadow-sm rounded-3">
        <div class="card-body p-3">
            <form method="GET" action="{{ route("admin.verifikasi-pembayaran") }}" class="row g-3 align-items-end">
                <div class="col-md-9">
                    <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Cari Jamaah / Nomor Pesanan</label>
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
                        <th class="py-3 px-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">No</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Data Jamaah</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Paket Umroh</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Total Tagihan</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Status Pembayaran</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Kelengkapan Dokumen</th>
                        <th class="py-3 px-3 border-0 text-center" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="border-top: none;">
                    @forelse($pemesanans as $index => $pemesanan)
                        <tr>
                            <td class="px-3" style="font-size: 0.9rem;">
                                {{ $pemesanans->firstItem() + $index }}
                            </td>
                            <td>
                                <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $pemesanan->user->name }}</div>
                                <div class="text-muted" style="font-size: 0.8rem;">{{ $pemesanan->user->email }}</div>
                                <div class="text-muted" style="font-size: 0.8rem;">{{ $pemesanan->user->no_hp ?? "-" }}</div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $pemesanan->paket->nama_paket }}</div>
                                <div class="text-muted" style="font-size: 0.8rem;">{{ $pemesanan->jumlah_peserta }} orang • {{ strtoupper($pemesanan->tipe_kamar ?? "QUAD") }}</div>
                            </td>
                            <td>
                                <div class="fw-bold" style="color: #8B2D2D; font-size: 0.9rem;">Rp {{ number_format($pemesanan->total_harga, 0, ",", ".") }}</div>
                            </td>
                            <td>
                                @if(in_array($pemesanan->status, ['paid', 'confirmed', 'completed']))
                                    <span class="badge rounded-pill" style="background-color: #e6f4ea; color: #1e8e3e; padding: 6px 12px; font-weight: 500;">
                                        Lunas (Otomatis)
                                    </span>
                                @else
                                    <span class="badge rounded-pill" style="background-color: #e6f2ff; color: #0066cc; padding: 6px 12px; font-weight: 500;">
                                        Menunggu Payment
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($pemesanan->data_completed_at)
                                    <span class="badge rounded-pill" style="background-color: #e6f4ea; color: #1e8e3e; padding: 6px 12px; font-weight: 500;">Lengkap</span>
                                @else
                                    <span class="badge rounded-pill" style="background-color: #fdecec; color: #c5221f; padding: 6px 12px; font-weight: 500;">Belum Lengkap</span>
                                @endif
                            </td>
                            <td class="px-3 text-center">
                                <a href="{{ route("admin.pemesanans.show", $pemesanan) }}" class="btn btn-sm" style="background-color: #8B2D2D; color: white;">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Tidak ada data pembayaran yang menunggu verifikasi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pemesanans->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $pemesanans->links() }}
            </div>
        @endif
    </div>
@endsection
@extends("layouts.admin")

@section("title", "Kelola Pemesanan - Admin")

@section("content")

    <div class="d-flex align-items-center mb-4 gap-3">
        <h2 class="mb-0" style="color: #8B2D2D; font-weight: 600;">Kelola Pemesanan</h2>
        @php
            $pending_count = $pemesanans->where("status", "pending")->count();
        @endphp
        @if($pending_count > 0)
            <span class="badge rounded-pill" style="background-color: #f39c12; padding: 6px 12px; font-weight: 500;">{{ $pending_count }} Pending</span>
        @endif
    </div>

    <div class="card mb-4 border-0 shadow-sm rounded-3">
        <div class="card-body p-3">
            <form method="GET" action="{{ route("admin.pemesanans.index") }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Cari Jamaah / Paket</label>
                    <input type="text" name="search" class="form-control" placeholder="Nama, email, atau nama paket..." value="{{ request("search") }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request("status") == "pending" ? "selected" : "" }}>Pending</option>
                        <option value="paid" {{ request("status") == "paid" ? "selected" : "" }}>Lunas</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Bukti Bayar</label>
                    <select name="bukti" class="form-select">
                        <option value="">Semua</option>
                        <option value="sudah" {{ request("bukti") == "sudah" ? "selected" : "" }}>Lunas Upload</option>
                        <option value="belum" {{ request("bukti") == "belum" ? "selected" : "" }}>Belum Upload</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn w-100" style="background-color: #8B2D2D; color: white;">
                        <i class="fas fa-search me-1"></i> Filter
                    </button>
                    <a href="{{ route("admin.pemesanans.index") }}" class="btn btn-light border">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-2">
        <span class="text-muted" style="font-size: 0.9rem;">Total: {{ $pemesanans->total() }} pemesanan</span>
    </div>

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header border-0 py-3" style="background-color: #8B2D2D; color: white;">
            <h5 class="mb-0 fs-6 fw-normal">Daftar Pemesanan</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="border-bottom: 2px solid #eee;">
                    <tr>
                        <th class="py-3 px-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">No</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Jamaah</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Paket</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Peserta</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Total Harga</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Bukti Bayar</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Status</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Tanggal Pesan</th>
                        <th class="py-3 px-3 border-0 text-center" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="border-top: none;">
                    @forelse($pemesanans as $index => $pemesanan)
                        <tr>
                            <td class="px-3 text-muted" style="font-size: 0.9rem;">{{ $pemesanans->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $pemesanan->user->name }}</div>
                                <div class="text-muted" style="font-size: 0.8rem;">{{ $pemesanan->user->email }}</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-phone-alt" style="font-size: 0.7rem;"></i> {{ $pemesanan->user->no_hp ?? "-" }}</div>
                                @if(!$pemesanan->data_completed_at)
                                    <div class="mt-1"><span class="badge rounded-pill" style="background-color: #fdecec; color: #c5221f; font-weight: 500; font-size: 0.75rem;">Biodata Kosong</span></div>
                                @else
                                    <div class="mt-1"><span class="badge rounded-pill" style="background-color: #e6f4ea; color: #1e8e3e; font-weight: 500; font-size: 0.75rem;">Biodata Lengkap</span></div>
                                @endif
                            </td>
                            <td>
                                <div class="text-dark" style="font-size: 0.9rem;">{{ $pemesanan->paket->nama_paket }}</div>
                            </td>
                            <td>
                                <div class="text-dark" style="font-size: 0.9rem;">{{ $pemesanan->jumlah_peserta }} orang</div>
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-bed"></i> {{ strtoupper($pemesanan->tipe_kamar ?? "QUAD") }}</div>
                            </td>
                            <td>
                                <div class="text-dark" style="font-size: 0.9rem;">Rp {{ number_format($pemesanan->total_harga, 0, ",", ".") }}</div>
                            </td>
                            <td>
                                @if($pemesanan->bukti_pembayaran || in_array($pemesanan->status, ['paid', 'confirmed', 'completed']))
                                    <span class="badge rounded-pill" style="background-color: #e6f4ea; color: #1e8e3e; padding: 6px 12px; font-weight: 500;">Lunas</span>
                                @else
                                    <span class="badge rounded-pill" style="background-color: #fdecec; color: #c5221f; padding: 6px 12px; font-weight: 500;">Belum</span>
                                @endif
                            </td>
                            <td>
                                @if($pemesanan->status == "pending")
                                    <span class="badge rounded-pill" style="background-color: #e6f2ff; color: #0066cc; padding: 6px 12px; font-weight: 500;">Menunggu</span>
                                @elseif(in_array($pemesanan->status, ["paid", "confirmed", "completed"]))
                                    <span class="badge rounded-pill" style="background-color: #e6f4ea; color: #1e8e3e; padding: 6px 12px; font-weight: 500;">Dikonfirmasi</span>
                                @elseif(in_array($pemesanan->status, ["failed", "dibatalkan"]))
                                    <span class="badge rounded-pill" style="background-color: #fdecec; color: #c5221f; padding: 6px 12px; font-weight: 500;">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="text-muted" style="font-size: 0.9rem;">
                                {{ $pemesanan->created_at->format("d M Y H:i") }}
                            </td>
                            <td class="px-3 text-center">
                                <a href="{{ route("admin.pemesanans.show", $pemesanan) }}" class="btn btn-sm" style="background-color: #8B2D2D; color: white;">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                Tidak ada data pemesanan.
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

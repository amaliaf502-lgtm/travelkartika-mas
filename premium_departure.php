<?php
$content = <<<EOF
@extends("layouts.admin")

@section("title", "Informasi Keberangkatan - Admin")

@section("content")

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="mb-0" style="color: #8B2D2D; font-weight: 600;">Informasi Keberangkatan</h2>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Kelola dokumen manifest, visa, dan tiket penerbangan jamaah</p>
        </div>
    </div>

    <div class="card mb-4 border-0 shadow-sm rounded-3">
        <div class="card-body p-3">
            <form method="GET" action="{{ route("admin.departure-info.index") }}" class="row g-3 align-items-end">
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
            <h5 class="mb-0 fs-6 fw-normal">Daftar Informasi Keberangkatan</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="border-bottom: 2px solid #eee;">
                    <tr>
                        <th class="py-3 px-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.85rem;">#ID</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.85rem;">PEMESAN</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.85rem;">PAKET UMROH</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.85rem;">STATUS MANIFEST</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.85rem;">DOKUMEN KEBERANGKATAN</th>
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
                                <div class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-users me-1"></i>{{ \$pemesanan->jumlah_peserta }} Orang</div>
                            </td>
                            <td>
                                @if(\$pemesanan->data_completed_at)
                                    <span class="badge rounded-pill" style="background-color: #2ecc71; padding: 5px 10px; font-weight: 500;"><i class="fas fa-check-circle me-1"></i>Lengkap</span>
                                @else
                                    <span class="badge rounded-pill" style="background-color: #f1c40f; color: #000; padding: 5px 10px; font-weight: 500;"><i class="fas fa-exclamation-triangle me-1"></i>Belum Lengkap</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    \$hasVisa = \$pemesanan->jamaahs->where("visa_file", "!=", null)->count() > 0;
                                    \$hasTicket = \$pemesanan->jamaahs->where("ticket_file", "!=", null)->count() > 0;
                                @endphp
                                
                                <div class="d-flex flex-column gap-1">
                                    @if(\$hasVisa)
                                        <span class="badge rounded-pill" style="background-color: #e3f2fd; color: #1e88e5; border: 1px solid #90caf9; padding: 4px 10px;"><i class="fas fa-passport me-1"></i>Visa Tersedia</span>
                                    @else
                                        <span class="badge rounded-pill bg-light text-secondary border" style="padding: 4px 10px;"><i class="fas fa-times me-1"></i>Visa Belum Ada</span>
                                    @endif
                                    
                                    @if(\$hasTicket)
                                        <span class="badge rounded-pill" style="background-color: #e3f2fd; color: #1e88e5; border: 1px solid #90caf9; padding: 4px 10px;"><i class="fas fa-ticket-alt me-1"></i>Tiket Tersedia</span>
                                    @else
                                        <span class="badge rounded-pill bg-light text-secondary border" style="padding: 4px 10px;"><i class="fas fa-times me-1"></i>Tiket Belum Ada</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-3 text-center">
                                <a href="{{ route("admin.pemesanans.show", \$pemesanan) }}#jamaah-section" class="btn btn-sm" style="background-color: #8B2D2D; color: white;" title="Lihat Detail">
                                    <i class="fas fa-eye me-1"></i> Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <p class="mb-0">Tidak ada data keberangkatan.</p>
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
file_put_contents("resources/views/admin/departure-info/index.blade.php", $content);
echo "Departure info premium layout implemented\n";


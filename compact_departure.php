<?php
$content = <<<EOF
@extends("layouts.admin")

@section("title", "Informasi Keberangkatan - Admin")

@section("content")

    <div class="page-title d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Informasi Keberangkatan</h2>
            <p class="text-muted mb-0" style="font-weight: normal; font-size: 0.9rem;">Kelola dokumen manifest, visa, dan tiket penerbangan jamaah</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route("admin.departure-info.index") }}" class="row g-3 align-items-end">
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
                        <th>Status Manifest</th>
                        <th>Dokumen Keberangkatan</th>
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
                                    <i class="fas fa-users me-1"></i>{{ \$pemesanan->jumlah_peserta }} Orang
                                </div>
                            </td>
                            <td>
                                @if(\$pemesanan->data_completed_at)
                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Lengkap</span>
                                @else
                                    <span class="badge bg-warning text-dark"><i class="fas fa-exclamation-triangle me-1"></i>Belum Lengkap</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    \$hasVisa = \$pemesanan->jamaahs->where("visa_file", "!=", null)->count() > 0;
                                    \$hasTicket = \$pemesanan->jamaahs->where("ticket_file", "!=", null)->count() > 0;
                                @endphp
                                
                                <div class="d-flex flex-column gap-1">
                                    @if(\$hasVisa)
                                        <span class="badge bg-info text-dark"><i class="fas fa-passport me-1"></i>Visa Tersedia</span>
                                    @else
                                        <span class="badge bg-secondary"><i class="fas fa-times me-1"></i>Visa Belum Ada</span>
                                    @endif
                                    
                                    @if(\$hasTicket)
                                        <span class="badge bg-info text-dark"><i class="fas fa-ticket-alt me-1"></i>Tiket Tersedia</span>
                                    @else
                                        <span class="badge bg-secondary"><i class="fas fa-times me-1"></i>Tiket Belum Ada</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <a href="{{ route("admin.pemesanans.show", \$pemesanan) }}#jamaah-section" class="btn btn-sm btn-primary">
                                    <i class="fas fa-file-upload"></i> Upload / Kelola
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Tidak ada data keberangkatan.
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
file_put_contents("resources/views/admin/departure-info/index.blade.php", $content);
echo "Departure info reverted to compact layout\n";


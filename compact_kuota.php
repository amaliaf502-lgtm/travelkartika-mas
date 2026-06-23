<?php
$content = <<<EOF
@extends("layouts.admin")

@section("title", "Kelola Kuota Paket - Admin")

@section("content")

    <div class="page-title d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Kelola Kuota Paket</h2>
            <p class="text-muted mb-0" style="font-weight: normal; font-size: 0.9rem;">Pantau dan kelola kapasitas kursi setiap paket umroh secara real-time</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            @php
                \$totalKuota = \$pakets->sum("kuota");
                \$totalTersedia = \$pakets->sum("tersedia");
                \$totalTerisi = \$totalKuota - \$totalTersedia;
            @endphp
            <div class="text-end">
                <div class="fw-bold fs-5">{{ \$totalKuota }}</div>
                <small class="text-muted">Total Kuota</small>
            </div>
            <div class="text-end" style="border-left: 1px solid #ddd; padding-left: 15px;">
                <div class="fw-bold fs-5 text-danger">{{ \$totalTerisi }}</div>
                <small class="text-muted">Terisi</small>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route("admin.kelola-kuota") }}" class="row g-3 align-items-end">
                <div class="col-md-8">
                    <label class="form-label">Cari Paket Umroh</label>
                    <input type="text" name="search" class="form-control" placeholder="Ketik nama paket..." value="{{ request("search") }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-3">
        @forelse(\$pakets as \$paket)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ \$paket->nama_paket }}</h5>
                        
                        <div class="row text-center mt-4 mb-3">
                            <div class="col-4">
                                <div><strong class="fs-5">{{ \$paket->kuota }}</strong></div>
                                <small class="text-muted">Kuota</small>
                            </div>
                            <div class="col-4">
                                <div><strong class="fs-5 text-danger">{{ \$paket->kuota - \$paket->tersedia }}</strong></div>
                                <small class="text-muted">Terisi</small>
                            </div>
                            <div class="col-4">
                                <div><strong class="fs-5 text-success">{{ \$paket->tersedia }}</strong></div>
                                <small class="text-muted">Tersedia</small>
                            </div>
                        </div>

                        <a href="{{ route("admin.pakets.edit", \$paket) }}" class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-edit"></i> Update Kuota
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5 text-muted">
                        <i class="fas fa-box-open" style="font-size:3rem; opacity:0.3; margin-bottom:15px;"></i>
                        <p>Belum ada data paket umroh.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    
    <div class="mt-4">
        {{ \$pakets->links() }}
    </div>
@endsection
EOF;
file_put_contents("resources/views/admin/pakets/kuota.blade.php", $content);
echo "Kuota reverted to compact layout\n";


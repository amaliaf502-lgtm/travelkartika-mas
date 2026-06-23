@extends("layouts.admin")

@section("title", "Kelola Kuota Paket - Admin")

@section("content")

    <div class="d-flex align-items-center mb-4 gap-3">
        <h2 class="mb-0" style="color: #8B2D2D; font-weight: 600;">Kelola Kuota Paket</h2>
    </div>

    @php
        $totalKuota = $pakets->sum("kuota");
        $totalTersedia = $pakets->sum("tersedia");
        $totalTerisi = $totalKuota - $totalTersedia;
    @endphp

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body text-center p-3">
                    <div class="fw-bold fs-3 text-dark">{{ $totalKuota }}</div>
                    <div class="text-muted" style="font-size: 0.9rem;">Total Kuota</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body text-center p-3">
                    <div class="fw-bold fs-3 text-danger">{{ $totalTerisi }}</div>
                    <div class="text-muted" style="font-size: 0.9rem;">Terisi</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body text-center p-3">
                    <div class="fw-bold fs-3 text-success">{{ $totalTersedia }}</div>
                    <div class="text-muted" style="font-size: 0.9rem;">Tersedia</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header border-0 py-3" style="background-color: #8B2D2D; color: white;">
            <h5 class="mb-0 fs-6 fw-normal">Daftar Paket Umroh</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="border-bottom: 2px solid #eee;">
                    <tr>
                        <th class="py-3 px-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Nama Paket</th>
                        <th class="py-3 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Tanggal Berangkat</th>
                        <th class="py-3 border-0 text-center" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Total Kuota</th>
                        <th class="py-3 border-0 text-center" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Terisi</th>
                        <th class="py-3 border-0 text-center" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Tersedia</th>
                        <th class="py-3 border-0 text-center" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Persentase</th>
                        <th class="py-3 px-3 border-0 text-center" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="border-top: none;">
                    @forelse($pakets as $paket)
                        @php
                            $terisi = $paket->kuota - $paket->tersedia;
                            $persentase = $paket->kuota > 0 ? round(($terisi / $paket->kuota) * 100) : 0;
                        @endphp
                        <tr>
                            <td class="px-3">
                                <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $paket->nama_paket }}</div>
                                <span class="badge" style="background-color: #2ecc71; font-size: 0.7rem;">Aktif</span>
                            </td>
                            <td>
                                <div class="text-dark" style="font-size: 0.9rem;">{{ \Carbon\Carbon::parse($paket->tanggal_berangkat)->format('d M Y') }}</div>
                            </td>
                            <td class="text-center">
                                <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $paket->kuota }}</div>
                            </td>
                            <td class="text-center">
                                <div class="fw-bold text-danger" style="font-size: 0.95rem;">{{ $terisi }}</div>
                            </td>
                            <td class="text-center">
                                <div class="fw-bold text-success" style="font-size: 0.95rem;">{{ $paket->tersedia }}</div>
                            </td>
                            <td class="text-center">
                                <div class="progress mt-2" style="height: 6px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $persentase }}%; background-color: #2ecc71;" aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="text-muted mt-1" style="font-size: 0.75rem;">{{ $persentase }}% Terisi</div>
                            </td>
                            <td class="px-3 text-center">
                                <a href="{{ route("admin.pakets.edit", $paket) }}" class="btn btn-sm" style="background-color: #8B2D2D; color: white;">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Tidak ada data paket umroh.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pakets->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $pakets->links() }}
            </div>
        @endif
    </div>
@endsection
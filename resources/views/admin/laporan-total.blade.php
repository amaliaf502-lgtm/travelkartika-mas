@extends("layouts.admin")

@section("title", "Laporan Total Jamaah - Admin")

@section("css")
<style>
    /* CSS khusus untuk mode download PDF (html2pdf) */
    .pdf-mode .hide-on-print,
    .pdf-mode .no-print,
    .pdf-mode .admin-sidebar,
    .pdf-mode .admin-topbar,
    .pdf-mode footer {
        display: none !important;
    }
    .pdf-mode .print-only {
        display: block !important;
    }
    .pdf-mode .admin-main, .pdf-mode .admin-content {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
    }
    .pdf-mode body {
        background-color: white !important;
    }
    .pdf-mode .card {
        border: none !important;
        box-shadow: none !important;
    }
    .pdf-mode .table th {
        background-color: #f8f9fa !important;
        color: black !important;
    }
    .pdf-mode .table th, .pdf-mode .table td {
        font-size: 0.85rem !important;
        padding: 0.5rem !important;
    }
</style>
@endsection
@section("content")

    <!-- Header Halaman -->
    <div class="d-flex justify-content-between align-items-center mb-4 gap-3 hide-on-print">
        <div>
            <h2 class="mb-0" style="color: #8B2D2D; font-weight: 600;">Rekapitulasi Total Data Jamaah</h2>
            <p class="text-muted mb-0 mt-1">Laporan rekap data seluruh jamaah yang telah melakukan pemesanan.</p>
        </div>
        <div class="d-flex gap-2">
            <!-- Tombol Cetak PDF -->
            <a href="{{ route('admin.laporan.total.download') }}" class="btn btn-primary no-print shadow-sm" style="background-color: #8B2D2D; border: none; padding: 10px 20px; border-radius: 8px;">
                <i class="fas fa-file-pdf me-2"></i> Export PDF
            </a>
        </div>
    </div>

    <!-- Statistik Cards (Hide on Print to save ink/space) -->
    <div class="row g-4 mb-4 hide-on-print">
        <div class="col-md-3">
            <div class="card shadow-sm rounded-4" style="border: none !important; border-left: 4px solid var(--primary) !important;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 600;">Total Jamaah</p>
                            <h3 class="mb-0" style="font-weight: 800; color: #1e293b;">{{ $pemesanans->count() }}</h3>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(139, 45, 45, 0.1); color: var(--maroon);">
                            <i class="fas fa-users fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm rounded-4" style="border: none !important; border-left: 4px solid #3b82f6 !important;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 600;">Laki-Laki</p>
                            <h3 class="mb-0" style="font-weight: 800; color: #1e293b;">{{ $pemesanans->where('jenis_kelamin', 'Laki-Laki')->count() }}</h3>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                            <i class="fas fa-male fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm rounded-4" style="border: none !important; border-left: 4px solid #ec4899 !important;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 600;">Perempuan</p>
                            <h3 class="mb-0" style="font-weight: 800; color: #1e293b;">{{ $pemesanans->where('jenis_kelamin', 'Perempuan')->count() }}</h3>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(236, 72, 153, 0.1); color: #ec4899;">
                            <i class="fas fa-female fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm rounded-4" style="border: none !important; border-left: 4px solid #10b981 !important;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 600;">Paket Umroh Aktif</p>
                            <h3 class="mb-0" style="font-weight: 800; color: #1e293b;">{{ $pemesanans->pluck('paket_id')->unique()->count() }}</h3>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(16, 185, 129, 0.1); color: #10b981;">
                            <i class="fas fa-kaaba fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="mb-0 fs-6 fw-bold" style="color: #1e293b;">Daftar Seluruh Jamaah</h5>
            <span class="badge bg-light text-dark border">Total: {{ $pemesanans->count() }} Data</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-top mb-0" style="white-space: nowrap;">
                <thead style="border-bottom: 2px solid #eee;">
                    <tr>
                        <th class="py-3 px-4 text-center border-0" width="5%" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">No</th>
                        <th class="py-3 px-4 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Identitas Jamaah</th>
                        <th class="py-3 px-4 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Biodata Lengkap</th>
                        <th class="py-3 px-4 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Pesanan Paket</th>
                        <th class="py-3 px-4 border-0" style="color: #8B2D2D; font-weight: 600; font-size: 0.9rem;">Status</th>
                    </tr>
                </thead>
                <tbody style="border-top: none;">
                    @forelse($pemesanans as $index => $pemesanan)
                    <tr style="transition: all 0.2s;">
                        <td class="px-4 py-3 text-center text-muted fw-bold" style="font-size: 0.9rem;">{{ $index + 1 }}</td>
                        
                        <td class="px-4 py-3">
                            <div class="d-flex flex-column gap-1">
                                <div class="text-dark fw-bold text-capitalize" style="font-size: 0.95rem;">{{ $pemesanan->user->name ?? '-' }}</div>
                                <div class="text-muted" style="font-size: 0.85rem;">
                                    @if($pemesanan->user && $pemesanan->user->no_hp)
                                        {{ $pemesanan->user->no_hp }}
                                    @else
                                        Belum Diisi
                                    @endif
                                </div>
                                <div class="mt-1">
                                    @if(($pemesanan->jenis_kelamin ?? '') == 'Laki-Laki')
                                        <span class="badge rounded-pill" style="background-color: #e6f2ff; color: #0066cc; font-size: 0.75rem; padding: 4px 10px; font-weight: 500;">Laki-Laki</span>
                                    @elseif(($pemesanan->jenis_kelamin ?? '') == 'Perempuan')
                                        <span class="badge rounded-pill" style="background-color: #fce4ec; color: #c2185b; font-size: 0.75rem; padding: 4px 10px; font-weight: 500;">Perempuan</span>
                                    @else
                                        <span class="badge rounded-pill" style="background-color: #f1f5f9; color: #64748b; font-size: 0.75rem; padding: 4px 10px; font-weight: 500;">Gender Belum Diisi</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-3">
                            <div class="d-flex flex-column" style="font-size: 0.85rem; line-height: 1.4;">
                                <div class="text-dark"><strong>TTL:</strong> {{ ucwords($pemesanan->tempat_lahir ?? '-') }}, {{ $pemesanan->tanggal_lahir ? \Carbon\Carbon::parse($pemesanan->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</div>
                                <div class="text-muted"><strong>Ayah:</strong> {{ ucwords($pemesanan->nama_ayah ?? '-') }} &bull; <strong>Ibu:</strong> {{ ucwords($pemesanan->nama_ibu ?? '-') }}</div>
                                <div class="text-muted"><strong>Pekerjaan:</strong> {{ ucwords($pemesanan->pekerjaan ?? '-') }}</div>
                                <div class="text-muted"><strong>Status Nikah:</strong> {{ ucwords($pemesanan->status_nikah ?? '-') }}</div>
                                <div class="mt-2 pt-2 border-top" style="border-color: #e2e8f0 !important;">
                                    <div class="d-flex flex-wrap gap-1">
                                        @php
                                            $docs = [
                                                'Foto' => $pemesanan->file_foto,
                                                'KTP' => $pemesanan->file_ktp,
                                                'KK' => $pemesanan->file_kk,
                                                'Paspor' => $pemesanan->file_paspor,
                                                'Nikah' => $pemesanan->file_surat_nikah,
                                            ];
                                        @endphp
                                        @foreach($docs as $name => $file)
                                            @if($file)
                                                <a href="{{ asset($file) }}" target="_blank" class="badge rounded-pill text-decoration-none" style="background-color: #e6f4ea; color: #1e8e3e; border: 1px solid #bce8cb; font-size: 0.7rem; font-weight: normal;" title="Lihat {{ $name }}">
                                                    {{ $name }}
                                                </a>
                                            @else
                                                <span class="badge rounded-pill" style="background-color: #f8f9fa; color: #94a3b8; border: 1px solid #e2e8f0; font-size: 0.7rem; font-weight: normal;" title="{{ $name }} Belum Ada">
                                                    {{ $name }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-3">
                            <div class="text-dark fw-bold text-capitalize mb-1" style="font-size: 0.9rem;">{{ $pemesanan->paket->nama_paket ?? '-' }}</div>
                            <div class="d-flex gap-2 align-items-center">
                                <span class="badge" style="background: rgba(139, 45, 45, 0.1); color: var(--maroon); font-size: 0.75rem; border: 1px solid rgba(139, 45, 45, 0.2);">
                                    Kamar: {{ strtoupper($pemesanan->tipe_kamar ?? '-') }}
                                </span>
                                <span class="badge" style="background: #f1f5f9; color: #475569; font-size: 0.75rem; border: 1px solid #cbd5e1;">
                                    <i class="fas fa-users me-1"></i> {{ $pemesanan->jumlah_peserta ?? 1 }} Orang
                                </span>
                            </div>
                        </td>

                        <td class="px-4 py-3">
                            @if($pemesanan->status === 'paid')
                                <span class="badge rounded-pill" style="background-color: #e6f2ff; color: #0066cc; padding: 6px 12px; font-weight: 500;">Menunggu Konfirmasi</span>
                            @elseif($pemesanan->status === 'confirmed')
                                <span class="badge rounded-pill" style="background-color: #e6f4ea; color: #1e8e3e; padding: 6px 12px; font-weight: 500;">Dikonfirmasi</span>
                            @elseif($pemesanan->status === 'completed')
                                <span class="badge rounded-pill" style="background-color: #e6f4ea; color: #1e8e3e; padding: 6px 12px; font-weight: 500;">Selesai</span>
                            @else
                                <span class="badge rounded-pill" style="background-color: #f8f9fa; color: #475569; padding: 6px 12px; font-weight: 500;">{{ $pemesanan->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open fs-1 mb-3" style="color: #cbd5e1;"></i>
                            <p class="mb-0 fs-5">Data jamaah belum tersedia.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<!-- PDF Export is now handled by the backend -->
@endpush

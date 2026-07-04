@extends("layouts.admin")

@section("title", "Informasi Keberangkatan - Admin")

@section("content")

    <div class="d-flex align-items-center mb-4 gap-3">
        <h2 class="mb-0" style="color: #8B2D2D; font-weight: 600;">Informasi Keberangkatan</h2>
    </div>

    <div class="d-flex justify-content-end mb-2">
        <span class="text-muted" style="font-size: 0.9rem;">Total: {{ $departure_infos->total() }} data</span>
    </div>

    <div class="card overflow-hidden">
        <div class="card-header py-3">
            <h5 class="mb-0 fs-6">Daftar Informasi Keberangkatan</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="py-3 px-3">Jamaah</th>
                        <th class="py-3">Paket</th>
                        <th class="py-3">Tanggal Berkumpul</th>
                        <th class="py-3">Lokasi</th>
                        <th class="py-3">Contact Person</th>
                        <th class="py-3">No. HP</th>
                        <th class="py-3 px-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody style="border-top: none;">
                    @forelse($departure_infos as $di)
                        @php
                            $pemesanan = $di->pemesanan;
                        @endphp
                        <tr>
                            <td class="px-3">
                                <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ ucwords($pemesanan->user->name ?? "User Dihapus") }}</div>
                            </td>
                            <td>
                                <div class="text-dark" style="font-size: 0.9rem;">{{ $pemesanan->paket->nama_paket ?? "Paket Dihapus" }}</div>
                            </td>
                            <td>
                                @if($di->tanggal_berkumpul)
                                    <div class="text-dark" style="font-size: 0.9rem;">{{ \Carbon\Carbon::parse($di->tanggal_berkumpul)->format('d M Y') }}</div>
                                    <div class="text-muted" style="font-size: 0.85rem;">{{ \Carbon\Carbon::parse($di->waktu_berkumpul)->format('H:i') }}</div>
                                @else
                                    <span class="text-muted fst-italic" style="font-size: 0.85rem;">Belum diset</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-dark" style="font-size: 0.9rem;">{{ ucwords($di->lokasi_berkumpul ?? '-') }}</div>
                            </td>
                            <td>
                                <div class="text-dark" style="font-size: 0.9rem;">{{ ucwords($di->contact_person ?? '-') }}</div>
                            </td>
                            <td>
                                <div class="text-dark" style="font-size: 0.9rem;">{{ $di->no_hp_contact ?? '-' }}</div>
                            </td>
                            <td class="px-3 text-center">
                                <a href="{{ route('admin.pemesanans.confirm', ['pemesanan' => $pemesanan->id, 'from' => 'departure']) }}" class="btn btn-sm" style="background-color: #8B2D2D; color: white;" title="Kelola Info Keberangkatan">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Tidak ada data keberangkatan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($departure_infos->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $departure_infos->links() }}
            </div>
        @endif
    </div>

@endsection
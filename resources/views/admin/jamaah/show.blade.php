@extends('layouts.admin')

@section('title', 'Detail Jamaah - Admin')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.jamaah.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Data Jamaah -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-user"></i> Data Jamaah</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h4 style="color: var(--primary);">{{ $jamaah->name }}</h4>
                    <table class="table table-borderless mb-0" style="background:transparent;">
                        <tr>
                            <td class="text-muted ps-0" style="width:150px;"><i class="fas fa-envelope"></i> Email</td>
                            <td><strong>{{ $jamaah->email }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0"><i class="fas fa-phone"></i> No. HP</td>
                            <td>
                                @if($jamaah->no_hp)
                                    <strong>{{ $jamaah->no_hp }}</strong>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $jamaah->no_hp) }}" target="_blank" class="btn btn-sm ms-2" style="background:#25D366; color:white; font-size:0.75rem;">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>
                                @else
                                    <span class="text-muted">Belum diisi</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0"><i class="fas fa-calendar"></i> Terdaftar</td>
                            <td>{{ $jamaah->created_at->format('d F Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0"><i class="fas fa-list"></i> Total Pemesanan</td>
                            <td><strong>{{ $pemesanans->count() }} paket</strong></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4 text-center">
                    <div style="width:100px; height:100px; background: var(--primary); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto; font-size:2.5rem; color:white; font-weight:bold;">
                        {{ strtoupper(substr($jamaah->name, 0, 1)) }}
                    </div>
                    <p class="text-muted mt-2 mb-0">Jamaah</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pemesanan Jamaah -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Riwayat Pemesanan</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Paket</th>
                        <th>Peserta</th>
                        <th>Total</th>
                        <th>Bukti Bayar</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemesanans as $pemesanan)
                        <tr>
                            <td><strong>{{ $pemesanan->paket->nama_paket }}</strong></td>
                            <td>{{ $pemesanan->jumlah_peserta }} orang<br>
                                <small class="text-muted text-uppercase">{{ $pemesanan->tipe_kamar ?? 'quad' }}</small>
                            </td>
                            <td>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if($pemesanan->bukti_pembayaran)
                                    <span class="badge" style="background-color:#e6f4ea; color:#1e8e3e; font-size:0.75rem;">Ada</span>
                                @else
                                    <span class="badge" style="background-color:#fdecec; color:#c5221f; font-size:0.75rem;">Belum</span>
                                @endif
                            </td>
                            <td>
                                @if($pemesanan->status === 'pending')
                                    <span class="badge badge-pending">Pending</span>
                                @elseif($pemesanan->status === 'confirmed')
                                    <span class="badge badge-confirmed">Confirmed</span>
                                @elseif($pemesanan->status === 'dibatalkan')
                                    <span class="badge badge-dibatalkan">Dibatalkan</span>
                                @endif
                            </td>
                            <td>{{ $pemesanan->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.pemesanans.show', $pemesanan) }}" class="btn btn-sm btn-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada pemesanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

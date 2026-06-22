@extends('layouts.admin')

@section('title', $paket->nama_paket . ' - Admin Dashboard')

@section('content')
    <div class="page-title">
        <h2>{{ $paket->nama_paket }}</h2>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Detail Paket</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Nama Paket</label>
                            <p>{{ $paket->nama_paket }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Status</label>
                            <p>
                                @if($paket->status === 'aktif')
                                    <span class="badge badge-confirmed">Aktif</span>
                                @else
                                    <span class="badge badge-dibatalkan">Nonaktif</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Durasi</label>
                            <p>{{ $paket->durasi_hari }} Hari</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Harga Quad (4 Pax)</label>
                            <p>Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Harga Triple (3 Pax)</label>
                            <p>Rp {{ number_format($paket->harga_triple ?? ($paket->harga * 1.05), 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Harga Double (2 Pax)</label>
                            <p>Rp {{ number_format($paket->harga_double ?? ($paket->harga * 1.1), 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Kuota</label>
                            <p>{{ $paket->kuota }} orang</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Tersedia</label>
                            <p>
                                <span class="badge @if($paket->tersedia > 0) badge-success @else badge-danger @endif">
                                    {{ $paket->tersedia }} orang
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Tanggal Berangkat</label>
                            <p>{{ \Carbon\Carbon::parse($paket->tanggal_berangkat)->format('d M Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Tanggal Kembali</label>
                            <p>{{ \Carbon\Carbon::parse($paket->tanggal_kembali)->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="mb-4 mt-4">
                        <h6 class="font-weight-bold" style="border-bottom: 1px solid #eee; padding-bottom: 8px;"><i class="fas fa-hotel"></i> Akomodasi Hotel</h6>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted">Hotel Makkah</label>
                                <p><strong>{{ $paket->hotel_makkah_nama ?? 'Le Meridien Ajyad' }}</strong><br>
                                   Bintang: {{ $paket->hotel_makkah_bintang ?? 5 }} <i class="fas fa-star text-warning"></i><br>
                                   Jarak: {{ $paket->hotel_makkah_jarak ?? 'Jarak ± 100m' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Hotel Madinah</label>
                                <p><strong>{{ $paket->hotel_madinah_nama ?? 'Taiba Front' }}</strong><br>
                                   Bintang: {{ $paket->hotel_madinah_bintang ?? 5 }} <i class="fas fa-star text-warning"></i><br>
                                   Jarak: {{ $paket->hotel_madinah_jarak ?? 'Jarak ± 100m' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Deskripsi</label>
                        <p>{{ $paket->deskripsi }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Fasilitas</label>
                        <p>{{ $paket->fasilitas }}</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Aksi</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.pakets.edit', $paket) }}" class="btn btn-secondary mb-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.pakets.destroy', $paket) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus paket ini?');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>

            <a href="{{ route('admin.pakets.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('title', $paket->nama_paket . ' - Admin Dashboard')

@section('content')
    <div class="page-title">
        <i class="fas fa-plane"></i>
        <h2>{{ $paket->nama_paket }}</h2>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Detail Paket</h5>
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
                            <label class="form-label text-muted">Harga</label>
                            <p>Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
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

                    <div class="mb-3">
                        <label class="form-label text-muted">Deskripsi</label>
                        <p>{{ $paket->deskripsi }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Fasilitas</label>
                        <p>{{ $paket->fasilitas }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Itinerari</label>
                        <p>{{ $paket->itinerari }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-cogs"></i> Aksi</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.pakets.edit', $paket) }}" class="btn btn-secondary btn-block mb-2" style="width: 100%; display: block;">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.pakets.destroy', $paket) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus paket ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width: 100%;">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>

            <a href="{{ route('admin.pakets.index') }}" class="btn btn-secondary" style="width: 100%;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('title', 'Paket Umroh - Admin Dashboard')

@section('content')
    <div class="page-title">
        <h2>Paket Umroh</h2>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('admin.pakets.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Paket
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Paket Umroh</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Durasi</th>
                                <th>Harga</th>
                                <th>Kuota</th>
                                <th>Tersedia</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pakets as $paket)
                                <tr>
                                    <td><strong>{{ $paket->nama_paket }}</strong></td>
                                    <td>{{ $paket->durasi_hari }} Hari</td>
                                    <td>Rp {{ number_format($paket->harga, 0, ',', '.') }}</td>
                                    <td>{{ $paket->kuota }}</td>
                                    <td>
                                        <strong style="color: #333;">
                                            {{ $paket->tersedia }}
                                        </strong>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($paket->tanggal_berangkat)->format('d M Y') }} - {{ \Carbon\Carbon::parse($paket->tanggal_kembali)->format('d M Y') }}</td>
                                    <td>
                                        @if($paket->status === 'aktif')
                                            <span class="badge badge-confirmed">Aktif</span>
                                        @else
                                            <span class="badge badge-dibatalkan">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.pakets.show', $paket) }}" class="btn btn-sm btn-primary" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.pakets.edit', $paket) }}" class="btn btn-sm btn-secondary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.pakets.destroy', $paket) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus paket ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox"></i> Belum ada paket umroh
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $pakets->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

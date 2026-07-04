@extends('layouts.admin')

@section('title', 'Kelola Jamaah - Admin')

@section('content')
    <div class="page-title">
        <h2>Kelola Jamaah</h2>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted mb-0">Total: {{ $jamaah->count() }} jamaah terdaftar</p>
        <a href="{{ route('admin.jamaah.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jamaah
        </a>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Daftar Jamaah</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Total Pemesanan</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jamaah as $index => $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->no_hp)
                                    {{ $user->no_hp }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-primary" style="background: var(--primary) !important;">
                                    {{ $user->pemesanans_count }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.jamaah.show', $user) }}" class="btn btn-sm btn-primary" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.jamaah.edit', $user) }}" class="btn btn-sm btn-secondary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.jamaah.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data jamaah ini?');" style="display: inline;">
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
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-users-slash"></i> Tidak ada jamaah
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

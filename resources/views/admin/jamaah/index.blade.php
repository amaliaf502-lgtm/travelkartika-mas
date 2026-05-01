@extends('layouts.admin')

@section('title', 'Kelola Jamaah - Admin')

@section('content')
    <div class="page-title">
        <i class="fas fa-users"></i>
        <h2>Kelola Jamaah</h2>
    </div>
    <p class="text-muted mb-4">Total: {{ $jamaah->total() }} jamaah</p>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Total Pemesanan</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jamaah as $index => $user)
                        <tr>
                            <td>{{ ($jamaah->currentPage() - 1) * $jamaah->perPage() + $index + 1 }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge badge-primary" style="background: var(--primary) !important;">
                                    {{ $user->pemesanans()->count() }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.jamaah.show', $user) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-users-slash"></i> Tidak ada jamaah
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $jamaah->links() }}
    </div>
@endsection

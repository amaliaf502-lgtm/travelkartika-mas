@extends('layouts.admin')

@section('title', 'Informasi Keberangkatan - Admin Dashboard')

@section('content')
    <div class="page-title">
        <i class="fas fa-info-circle"></i>
        <h2>Informasi Keberangkatan</h2>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Informasi Keberangkatan</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Jamaah</th>
                                <th>Paket</th>
                                <th>Tanggal Berkumpul</th>
                                <th>Lokasi</th>
                                <th>Contact Person</th>
                                <th>No. HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($departure_infos as $info)
                                <tr>
                                    <td><strong>{{ $info->pemesanan->user->name }}</strong></td>
                                    <td>{{ $info->pemesanan->paket->nama_paket }}</td>
                                    <td>{{ \Carbon\Carbon::parse($info->tanggal_berkumpul)->format('d M Y H:i') }}</td>
                                    <td>{{ $info->lokasi_berkumpul }}</td>
                                    <td>{{ $info->contact_person }}</td>
                                    <td>{{ $info->no_hp_contact }}</td>
                                    <td>
                                        <a href="{{ route('admin.pemesanans.show', $info->pemesanan) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox"></i> Belum ada informasi keberangkatan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $departure_infos->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

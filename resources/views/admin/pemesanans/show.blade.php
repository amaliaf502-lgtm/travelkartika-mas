@extends('layouts.admin')

@section('title', 'Detail Pemesanan - Admin')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.pemesanans.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Nomor Pemesanan -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Pemesanan #{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <strong>Status:</strong><br>
                    @if($pemesanan->status === 'pending')
                        <span class="badge badge-pending" style="font-size: 1rem;">Menunggu Konfirmasi</span>
                    @elseif($pemesanan->status === 'confirmed')
                        <span class="badge badge-confirmed" style="font-size: 1rem;">Dikonfirmasi</span>
                    @elseif($pemesanan->status === 'dibatalkan')
                        <span class="badge" style="background-color: #8B2D2D; color: white; font-size: 1rem;">Dibatalkan</span>
                    @endif
                </div>
                <div class="col-6">
                    <strong>Tanggal Pemesanan:</strong><br>
                    {{ $pemesanan->created_at->format('d F Y, H:i') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Data Akun Pemesan -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Data Akun Pemesan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <strong>Nama Akun:</strong> {{ $pemesanan->user->name }}<br>
                    <strong>Email:</strong> {{ $pemesanan->user->email }}
                </div>
            </div>
        </div>
    </div>

    <!-- Manifest Biodata & Dokumen -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center" style="background: #8B2D2D; color: white;">
            <h5 class="mb-0">Biodata & Dokumen Jamaah</h5>
            @if($pemesanan->data_completed_at)
                <span class="badge bg-success">Sudah Dilengkapi</span>
            @else
                <span class="badge bg-warning text-dark">Belum Lengkap</span>
            @endif
        </div>
        <div class="card-body">
            @if($pemesanan->data_completed_at)
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Nama Ayah</small>
                        <h6 class="mb-0">{{ $pemesanan->nama_ayah }}</h6>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Nama Ibu</small>
                        <h6 class="mb-0">{{ $pemesanan->nama_ibu }}</h6>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Pekerjaan</small>
                        <h6 class="mb-0">{{ $pemesanan->pekerjaan }}</h6>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Tempat, Tgl Lahir</small>
                        <h6 class="mb-0">{{ $pemesanan->tempat_lahir ?: '-' }}, {{ $pemesanan->tanggal_lahir ? $pemesanan->tanggal_lahir->format('d M Y') : '-' }}</h6>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">J. Kelamin / Status</small>
                        <h6 class="mb-0">{{ $pemesanan->jenis_kelamin ?: '-' }} / {{ $pemesanan->status_nikah ?: '-' }}</h6>
                    </div>
                </div>

                <h6 class="fw-bold mb-3 border-bottom pb-2">Dokumen Digital</h6>
                <div class="row g-3">
                    @php $docs = ['Pas Foto' => 'file_foto', 'KTP' => 'file_ktp', 'KK' => 'file_kk', 'Paspor' => 'file_paspor', 'Surat Nikah' => 'file_surat_nikah']; @endphp
                    @foreach($docs as $label => $field)
                        <div class="col-md-4 col-lg-2" style="flex: 1 1 18%;">
                            <div class="text-center border rounded p-2 h-100 bg-white shadow-sm">
                                <small class="d-block fw-bold mb-2 text-dark">{{ $label }}</small>
                                @if($pemesanan->$field)
                                    <a href="{{ asset($pemesanan->$field) }}" target="_blank" class="d-block bg-light rounded p-1">
                                        <img src="{{ asset($pemesanan->$field) }}" class="img-fluid rounded" style="height: 110px; width: 100%; object-fit: contain;">
                                    </a>
                                @else
                                    <div class="py-4 text-muted small bg-light rounded border"><i class="fas fa-times-circle text-danger mb-1"></i><br>Tidak Ada</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-user-clock fa-3x text-muted mb-3"></i>
                    <p class="mb-0">Jamaah belum melengkapi data manifest dan dokumen.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Detail Paket -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Detail Paket</h5>
        </div>
        <div class="card-body">
            <h6 style="color: var(--primary); font-weight: bold;">{{ $pemesanan->paket->nama_paket }}</h6>
            <div class="row mb-3">
                <div class="col-6">
                    <strong>Durasi:</strong> {{ $pemesanan->paket->durasi_hari }} Hari<br>
                    @php
                        $hargaPerOrang = match($pemesanan->tipe_kamar ?? 'quad') {
                            'triple' => $pemesanan->paket->harga_triple ?? $pemesanan->paket->harga,
                            'double' => $pemesanan->paket->harga_double ?? $pemesanan->paket->harga,
                            default  => $pemesanan->paket->harga,
                        };
                    @endphp
                    <strong>Harga/Orang:</strong> Rp {{ number_format($hargaPerOrang, 0, ',', '.') }}
                </div>
                <div class="col-6">
                    <strong>Berangkat:</strong> {{ $pemesanan->paket->tanggal_berangkat->format('d F Y') }}<br>
                    <strong>Kembali:</strong> {{ $pemesanan->paket->tanggal_kembali->format('d F Y') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Pemesanan -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Detail Pemesanan</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <strong>Jumlah Peserta:</strong> {{ $pemesanan->jumlah_peserta }} orang
                </div>
                <div class="col-6">
                    <strong>Tipe Kamar:</strong><br>
                    <span class="badge" style="background:#8B0000; font-size:0.9rem; text-transform:uppercase;">
                        {{ $pemesanan->tipe_kamar ?? 'quad' }}
                    </span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <strong>Total Harga:</strong><br>
                    <h5 style="color: #8B2D2D;">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</h5>
                </div>
            </div>

            @if($pemesanan->catatan)
                <hr>
                <div>
                    <strong>Catatan:</strong><br>
                    {{ $pemesanan->catatan }}
                </div>
            @endif
        </div>
    </div>

    <!-- Bukti Pembayaran -->
    <div class="card mb-4">
        <div class="card-header" style="background: #8B2D2D; color: white;">
            <h5 class="mb-0">Bukti Pembayaran</h5>
        </div>
        <div class="card-body">
            @if($pemesanan->bukti_pembayaran)
                <div class="text-center">
                    <p class="text-success"><i class="fas fa-check-circle"></i> Jamaah telah mengunggah bukti pembayaran.</p>
                    <a href="{{ asset($pemesanan->bukti_pembayaran) }}" target="_blank">
                        <img src="{{ asset($pemesanan->bukti_pembayaran) }}" class="img-thumbnail" style="max-height: 400px;" alt="Bukti Pembayaran">
                    </a>
                    <div class="mt-2">
                        <small class="text-muted">Klik gambar untuk melihat ukuran penuh</small>
                    </div>
                </div>
            @else
                <div class="alert alert-info mb-0 text-center" style="background-color: #e8f4f8; border-color: #b6e0ed; color: #31708f;">
                    @if(in_array($pemesanan->status, ['confirmed', 'completed']))
                        <strong>Otomatis Midtrans</strong> (Pembayaran Berhasil)
                    @else
                        <strong>Menunggu Payment</strong> via Midtrans
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Departure Info -->
    <div class="card mb-4">
        <div class="card-header" style="background: #8B2D2D; color: white;">
            <h5 class="mb-0">Informasi Keberangkatan</h5>
        </div>
        <div class="card-body">
            @if($pemesanan->departureInfo)
                <div class="row mb-3">
                    <div class="col-6">
                        <strong>Tanggal Berkumpul:</strong> {{ $pemesanan->departureInfo->tanggal_berkumpul->format('d F Y') }}<br>
                        <strong>Waktu:</strong> {{ \Carbon\Carbon::parse($pemesanan->departureInfo->waktu_berkumpul)->format('H:i') }}
                    </div>
                    <div class="col-6">
                        <strong>Lokasi:</strong> {{ $pemesanan->departureInfo->lokasi_berkumpul }}<br>
                        <strong>Contact:</strong> {{ $pemesanan->departureInfo->no_hp_contact }}
                    </div>
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.pemesanans.confirm', $pemesanan) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-edit me-1"></i> Atur Ulang Info Keberangkatan
                    </a>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-plane-slash fa-3x text-muted mb-3"></i>
                    <p class="mb-2">Informasi keberangkatan untuk pemesanan ini belum diatur.</p>
                    <a href="{{ route('admin.pemesanans.confirm', $pemesanan) }}" class="btn btn-sm btn-outline-primary mt-2">
                        <i class="fas fa-cog me-1"></i> Atur Informasi Keberangkatan
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Actions -->
    <div class="d-flex justify-content-end align-items-stretch gap-2 mt-4">
        @if($pemesanan->status === 'pending')
            <a href="{{ route('admin.pemesanans.confirm', $pemesanan) }}" class="btn btn-success d-flex align-items-center">
                <i class="fas fa-check-circle me-1"></i> Konfirmasi & Masukkan Info
            </a>
        @endif

        @if(in_array($pemesanan->status, ['confirmed', 'completed']))
            <a href="{{ route('admin.pemesanans.cetak', $pemesanan) }}" target="_blank" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-print me-1"></i> Cetak Kuitansi
            </a>
        @endif

        @if($pemesanan->status !== 'dibatalkan')
            <form action="{{ route('admin.pemesanans.cancel', $pemesanan) }}" method="POST" class="m-0">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-outline-danger d-flex align-items-center h-100" style="border-color: #8B2D2D; color: #8B2D2D;" onclick="return confirm('Batalkan pemesanan ini?')">
                    <i class="fas fa-times me-1"></i> Batalkan
                </button>
            </form>
        @endif
    </div>
@endsection


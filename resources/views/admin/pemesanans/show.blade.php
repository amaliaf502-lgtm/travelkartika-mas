@extends('layouts.admin')

@section('title', 'Detail Pemesanan - Admin')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.pemesanans.index') }}" class="btn btn-outline-primary">
            Kembali
        </a>
    </div>

    <!-- Nomor Pemesanan -->
    <div class="card mb-4" style="border: none; box-shadow: none; border-top: 3px solid #8B2D2D !important; border-radius: 8px; overflow: hidden; background: white;">
        <div class="card-header bg-white" style="border-bottom: 1px solid #e2e8f0; padding: 16px 20px;">
            <h5 class="mb-0" style="font-weight: 700; font-size: 1.15rem; color: #1e293b;">Pemesanan #{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <strong>Status:</strong><br>
                    @if($pemesanan->status === 'pending')
                        <span class="badge rounded-pill" style="background-color: #e6f2ff; color: #0066cc; font-size: 0.95rem; padding: 6px 14px; font-weight: 500;">Menunggu Konfirmasi</span>
                    @elseif($pemesanan->status === 'confirmed')
                        <span class="badge rounded-pill" style="background-color: #e6f4ea; color: #1e8e3e; font-size: 0.95rem; padding: 6px 14px; font-weight: 500;">Dikonfirmasi</span>
                    @elseif($pemesanan->status === 'dibatalkan')
                        <span class="badge rounded-pill" style="background-color: #fdecec; color: #c5221f; font-size: 0.95rem; padding: 6px 14px; font-weight: 500;">Dibatalkan</span>
                    @endif
                </div>
                <div class="col-6">
                    <strong>Tanggal Pemesanan:</strong><br>
                    {{ $pemesanan->created_at->format('d F Y, H:i') }}
                </div>
            </div>
        </div>

        <!-- Data Akun Pemesan -->
        <div class="card-header" style="background-color: #f8f9fa; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 12px 20px;">
            <h5 class="mb-0" style="font-weight: 700; font-size: 1.05rem; color: #1e293b;">Data Akun Pemesan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <strong>Nama Akun:</strong> {{ $pemesanan->user->name }}<br>
                    <strong>Email:</strong> {{ $pemesanan->user->email }}
                </div>
            </div>
        </div>

        <!-- Manifest Biodata & Dokumen -->
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f8f9fa; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 12px 20px;">
            <h5 class="mb-0" style="font-weight: 700; font-size: 1.05rem; color: #1e293b;">Biodata & Dokumen Jamaah</h5>
            @if($pemesanan->data_completed_at)
                <span class="badge rounded-pill" style="background-color: #e6f4ea; color: #1e8e3e; padding: 6px 12px; font-weight: 500;">Sudah Dilengkapi</span>
            @else
                <span class="badge rounded-pill" style="background-color: #fdecec; color: #c5221f; padding: 6px 12px; font-weight: 500;">Belum Lengkap</span>
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
                                    <div class="py-4 text-muted small bg-light rounded border">Belum Diunggah</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <p class="mb-0 text-muted">Jamaah belum melengkapi data manifest dan dokumen.</p>
                </div>
            @endif
        </div>

        <!-- Detail Paket -->
        <div class="card-header" style="background-color: #f8f9fa; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 12px 20px;">
            <h5 class="mb-0" style="font-weight: 700; font-size: 1.05rem; color: #1e293b;">Detail Paket</h5>
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

        <!-- Detail Pemesanan -->
        <div class="card-header" style="background-color: #f8f9fa; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 12px 20px;">
            <h5 class="mb-0" style="font-weight: 700; font-size: 1.05rem; color: #1e293b;">Detail Pemesanan</h5>
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

        <!-- Bukti Pembayaran -->
        <div class="card-header" style="background-color: #f8f9fa; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 12px 20px;">
            <h5 class="mb-0" style="font-weight: 700; font-size: 1.05rem; color: #1e293b;">Bukti Pembayaran</h5>
        </div>
        <div class="card-body">
            @if($pemesanan->bukti_pembayaran)
                <div class="text-center">
                    <p class="text-success">Jamaah telah mengunggah bukti pembayaran.</p>
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

        <!-- Departure Info -->
        <div class="card-header" style="background-color: #f8f9fa; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 12px 20px;">
            <h5 class="mb-0" style="font-weight: 700; font-size: 1.05rem; color: #1e293b;">Informasi Keberangkatan</h5>
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
                        Atur Ulang Info Keberangkatan
                    </a>
                </div>
            @else
                <div class="text-center py-4">
                    <p class="mb-2">Informasi keberangkatan untuk pemesanan ini belum diatur.</p>
                    <a href="{{ route('admin.pemesanans.confirm', $pemesanan) }}" class="btn btn-sm btn-outline-primary mt-2">
                        Atur Informasi Keberangkatan
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Actions -->
    <div class="d-flex justify-content-end align-items-stretch gap-2 mt-4">
        @if($pemesanan->status === 'pending')
            <a href="{{ route('admin.pemesanans.confirm', $pemesanan) }}" class="btn btn-success d-flex align-items-center">
                Konfirmasi & Masukkan Info
            </a>
        @endif

        @if(in_array($pemesanan->status, ['confirmed', 'completed']))
            <a href="{{ route('admin.pemesanans.cetak', $pemesanan) }}" class="btn btn-primary d-flex align-items-center">
                Cetak Kuitansi
            </a>
        @endif

        @if($pemesanan->status !== 'dibatalkan')
            <form action="{{ route('admin.pemesanans.cancel', $pemesanan) }}" method="POST" class="m-0">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-outline-danger d-flex align-items-center h-100" style="border-color: #8B2D2D; color: #8B2D2D;" onclick="return confirm('Batalkan pemesanan ini?')">
                    Batalkan
                </button>
            </form>
        @endif
    </div>
@endsection


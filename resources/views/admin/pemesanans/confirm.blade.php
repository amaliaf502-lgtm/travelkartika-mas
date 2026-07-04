@extends('layouts.admin')

@section('title', 'Konfirmasi Pemesanan - Admin')

@section('content')
    <div class="mb-4">
        <a href="{{ request('from') === 'departure' ? route('admin.departure-info.index') : route('admin.pemesanans.show', $pemesanan) }}" class="btn btn-outline-primary">
            Kembali
        </a>
    </div>

    <h2 style="color: var(--primary); font-weight: bold; margin-bottom: 30px;">
        {{ $pemesanan->status === 'pending' ? 'Konfirmasi &' : 'Atur' }} Info Keberangkatan
    </h2>

    <!-- Form Konfirmasi & Data Keberangkatan -->
    <form action="{{ route('admin.pemesanans.confirm.store', ['pemesanan' => $pemesanan->id, 'from' => request('from')]) }}" method="POST">
        @csrf

        <div class="card mb-4" style="border: none; box-shadow: none; border-top: 3px solid #8B2D2D !important; border-radius: 8px; overflow: hidden; background: white;">
        <div class="card-header bg-white" style="border-bottom: 1px solid #e2e8f0; padding: 16px 20px;">
            <h5 class="mb-0" style="font-weight: 700; font-size: 1.15rem; color: #1e293b;">Info Pemesanan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>Jamaah:</strong> {{ $pemesanan->user->name }}<br>
                    <strong>Email:</strong> {{ $pemesanan->user->email }}<br>
                    @if($pemesanan->user->no_hp)
                        <strong>No. HP:</strong> {{ $pemesanan->user->no_hp }}<br>
                    @endif
                    <strong>Peserta:</strong> {{ $pemesanan->jumlah_peserta }} orang
                </div>
                <div class="col-md-6">
                    <strong>Paket:</strong> {{ $pemesanan->paket->nama_paket }}<br>
                    <strong>Total Harga:</strong> Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}<br>
                    <strong>Durasi:</strong> {{ $pemesanan->paket->durasi_hari }} Hari
                </div>
            </div>
        </div>

        <!-- Bukti Pembayaran Preview -->
        <div class="card-header" style="background-color: #f8f9fa; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 12px 20px;">
            <h5 class="mb-0" style="font-weight: 700; font-size: 1.05rem; color: #1e293b;">Bukti Pembayaran Jamaah</h5>
        </div>
        <div class="card-body">
            @if($pemesanan->status === 'confirmed' || $pemesanan->status === 'completed')
                <div class="alert alert-success mb-0">
                    <i class="fas fa-check-circle"></i>
                    <strong>Pembayaran Lunas</strong> &mdash; Transaksi telah terverifikasi secara otomatis oleh sistem (Midtrans).
                </div>
            @elseif($pemesanan->bukti_pembayaran)
                <div class="text-center">
                    <p class="text-success mb-2"><i class="fas fa-check-circle"></i> Jamaah telah mengunggah bukti pembayaran manual. Silakan verifikasi.</p>
                    <a href="{{ asset($pemesanan->bukti_pembayaran) }}" target="_blank">
                        <img src="{{ asset($pemesanan->bukti_pembayaran) }}" class="img-thumbnail" style="max-height: 350px;" alt="Bukti Pembayaran">
                    </a>
                    <div class="mt-2"><small class="text-muted">Klik gambar untuk melihat ukuran penuh</small></div>
                </div>
            @else
                <div class="alert alert-info mb-0">
                    <i class="fas fa-clock"></i>
                    <strong>Menunggu Pembayaran:</strong> Jamaah belum menyelesaikan pembayaran secara online melalui sistem Midtrans.
                </div>
            @endif
        </div>

        <!-- Data Keberangkatan -->
        <div class="card-header" style="background-color: #f8f9fa; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 12px 20px;">
            <h5 class="mb-0" style="font-weight: 700; font-size: 1.05rem; color: #1e293b;">Data Keberangkatan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label"><strong>Tanggal Berkumpul <span class="text-danger">*</span></strong></label>
                        <input type="date" name="tanggal_berkumpul" class="form-control @error('tanggal_berkumpul') is-invalid @enderror" value="{{ old('tanggal_berkumpul', $pemesanan->departureInfo?->tanggal_berkumpul?->format('Y-m-d')) }}" required>
                        @error('tanggal_berkumpul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label"><strong>Waktu Berkumpul <span class="text-danger">*</span></strong></label>
                        <input type="time" name="waktu_berkumpul" class="form-control @error('waktu_berkumpul') is-invalid @enderror" value="{{ old('waktu_berkumpul', $pemesanan->departureInfo ? \Carbon\Carbon::parse($pemesanan->departureInfo->waktu_berkumpul)->format('H:i') : '') }}" required>
                        @error('waktu_berkumpul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label"><strong>Lokasi Berkumpul <span class="text-danger">*</span></strong></label>
                    <input type="text" name="lokasi_berkumpul" class="form-control @error('lokasi_berkumpul') is-invalid @enderror" 
                           value="{{ old('lokasi_berkumpul', $pemesanan->departureInfo?->lokasi_berkumpul) }}" required>
                    @error('lokasi_berkumpul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label"><strong>Alamat Lengkap <span class="text-danger">*</span></strong></label>
                    <textarea name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" 
                              rows="3" required>{{ old('alamat_lengkap', $pemesanan->departureInfo?->alamat_lengkap) }}</textarea>
                    @error('alamat_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label"><strong>Nama Contact Person <span class="text-danger">*</span></strong></label>
                        <input type="text" name="contact_person" class="form-control @error('contact_person') is-invalid @enderror" 
                               value="{{ old('contact_person', $pemesanan->departureInfo?->contact_person) }}" required>
                        @error('contact_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label"><strong>No. HP Contact <span class="text-danger">*</span></strong></label>
                        <input type="text" name="no_hp_contact" class="form-control @error('no_hp_contact') is-invalid @enderror" 
                               value="{{ old('no_hp_contact', $pemesanan->departureInfo?->no_hp_contact) }}" required>
                        @error('no_hp_contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label"><strong>Instruksi Persiapan</strong></label>
                    <textarea name="instruksi_persiapan" class="form-control @error('instruksi_persiapan') is-invalid @enderror" 
                              rows="4">{{ old('instruksi_persiapan', $pemesanan->departureInfo?->instruksi_persiapan) }}</textarea>
                    @error('instruksi_persiapan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label"><strong>Catatan Khusus</strong></label>
                    <textarea name="catatan_khusus" class="form-control @error('catatan_khusus') is-invalid @enderror" 
                              rows="3">{{ old('catatan_khusus', $pemesanan->departureInfo?->catatan_khusus) }}</textarea>
                    @error('catatan_khusus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ request('from') === 'departure' ? route('admin.departure-info.index') : route('admin.pemesanans.show', $pemesanan) }}" class="btn btn-outline-secondary">
                Batalkan
            </a>
            <button type="submit" class="btn btn-success">
                {{ $pemesanan->status === 'pending' ? 'Konfirmasi & Simpan' : 'Simpan Perubahan' }} Info Keberangkatan
            </button>
        </div>
    </form>
@endsection

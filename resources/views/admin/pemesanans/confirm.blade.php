@extends('layouts.admin')

@section('title', 'Konfirmasi Pemesanan - Admin')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.pemesanans.show', $pemesanan) }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <h2 style="color: var(--primary); font-weight: bold; margin-bottom: 30px;">
        {{ $pemesanan->status === 'pending' ? 'Konfirmasi &' : 'Atur' }} Info Keberangkatan
    </h2>

    <!-- Info Jamaah & Paket -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Info Pemesanan</h5>
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
    </div>

    <!-- Bukti Pembayaran Preview -->
    <div class="card mb-4">
        <div class="card-header" style="background: #8B2D2D; color: white;">
            <h5 class="mb-0">Bukti Pembayaran Jamaah</h5>
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
    </div>

    <!-- Form Konfirmasi -->
    <form action="{{ route('admin.pemesanans.confirm.store', $pemesanan) }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header" style="background: #8B2D2D; color: white;">
                <h5 class="mb-0">Data Keberangkatan</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label class="form-label"><strong>Tanggal Berkumpul <span class="text-danger">*</span></strong></label>
                    <input type="date" name="tanggal_berkumpul" class="form-control @error('tanggal_berkumpul') is-invalid @enderror" value="{{ old('tanggal_berkumpul', $pemesanan->departureInfo?->tanggal_berkumpul?->format('Y-m-d')) }}" required>
                    <small class="text-muted">Minimal besok dari hari ini</small>
                    @error('tanggal_berkumpul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label"><strong>Waktu Berkumpul <span class="text-danger">*</span></strong></label>
                    <input type="time" name="waktu_berkumpul" class="form-control @error('waktu_berkumpul') is-invalid @enderror" value="{{ old('waktu_berkumpul', $pemesanan->departureInfo ? \Carbon\Carbon::parse($pemesanan->departureInfo->waktu_berkumpul)->format('H:i') : '') }}" required>
                    <small class="text-muted">Contoh: 07:00</small>
                    @error('waktu_berkumpul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label"><strong>Lokasi Berkumpul <span class="text-danger">*</span></strong></label>
                    <input type="text" name="lokasi_berkumpul" class="form-control @error('lokasi_berkumpul') is-invalid @enderror" 
                           placeholder="Contoh: Bandara Soekarno-Hatta Terminal 3" value="{{ old('lokasi_berkumpul', $pemesanan->departureInfo?->lokasi_berkumpul) }}" required>
                    @error('lokasi_berkumpul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label"><strong>Alamat Lengkap <span class="text-danger">*</span></strong></label>
                    <textarea name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" 
                              rows="3" placeholder="Alamat lengkap lokasi berkumpul" required>{{ old('alamat_lengkap', $pemesanan->departureInfo?->alamat_lengkap) }}</textarea>
                    @error('alamat_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label"><strong>Nama Contact Person <span class="text-danger">*</span></strong></label>
                        <input type="text" name="contact_person" class="form-control @error('contact_person') is-invalid @enderror" 
                               placeholder="Nama guide/organizer" value="{{ old('contact_person', $pemesanan->departureInfo?->contact_person) }}" required>
                        @error('contact_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label"><strong>No. HP Contact <span class="text-danger">*</span></strong></label>
                        <input type="text" name="no_hp_contact" class="form-control @error('no_hp_contact') is-invalid @enderror" 
                               placeholder="08xx-xxxx-xxxx" value="{{ old('no_hp_contact', $pemesanan->departureInfo?->no_hp_contact) }}" required>
                        @error('no_hp_contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label"><strong>Instruksi Persiapan</strong></label>
                    <textarea name="instruksi_persiapan" class="form-control @error('instruksi_persiapan') is-invalid @enderror" 
                              rows="4" placeholder="Instruksi persiapan untuk jamaah, dokumen yg diperlukan, dll">{{ old('instruksi_persiapan', $pemesanan->departureInfo?->instruksi_persiapan) }}</textarea>
                    @error('instruksi_persiapan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label"><strong>Catatan Khusus</strong></label>
                    <textarea name="catatan_khusus" class="form-control @error('catatan_khusus') is-invalid @enderror" 
                              rows="3" placeholder="Catatan atau info tambahan lainnya">{{ old('catatan_khusus', $pemesanan->departureInfo?->catatan_khusus) }}</textarea>
                    @error('catatan_khusus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('admin.pemesanans.show', $pemesanan) }}" class="btn btn-outline-secondary">
                <i class="fas fa-times"></i> Batalkan
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> {{ $pemesanan->status === 'pending' ? 'Konfirmasi & Simpan' : 'Simpan Perubahan' }} Info Keberangkatan
            </button>
        </div>
    </form>
@endsection

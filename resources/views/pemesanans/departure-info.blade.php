@extends('layouts.app')

@section('title', 'Informasi Keberangkatan - Travelkartika Mas')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <a href="{{ route('pemesanans.show', $pemesanan) }}" class="btn btn-outline-primary mb-4">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>

                    <h2 style="color: var(--primary); font-weight: bold; margin-bottom: 30px;">
                        <i class="fas fa-plane-departure"></i> Informasi Keberangkatan
                    </h2>

                    @if(!$pemesanan->departureInfo)
                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle"></i> Informasi keberangkatan belum diatur oleh admin.
                        </div>
                        <a href="{{ route('pemesanans.index') }}" class="btn btn-primary">
                            Kembali ke Pemesanan Saya
                        </a>
                    @else
                        <!-- Ringkasan Pemesanan -->
                        <div class="card mb-4">
                            <div class="card-header" style="background: var(--primary); color: white;">
                                <h5 class="mb-0">Ringkasan Pemesanan</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Paket:</strong> {{ $pemesanan->paket->nama_paket }}<br>
                                        <strong>Jumlah Peserta:</strong> {{ $pemesanan->jumlah_peserta }} orang<br>
                                        <strong>Total Harga:</strong> Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Tanggal Paket:</strong> {{ $pemesanan->paket->tanggal_berangkat->format('d F Y') }} - {{ $pemesanan->paket->tanggal_kembali->format('d F Y') }}<br>
                                        <strong>Durasi:</strong> {{ $pemesanan->paket->durasi_hari }} Hari<br>
                                        <strong>Status:</strong> <span class="badge" style="background: #27ae60; color: white;">Dikonfirmasi</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Keberangkatan -->
                        <div class="card mb-4">
                            <div class="card-header" style="background: var(--secondary); color: white;">
                                <h5 class="mb-0"><i class="fas fa-calendar"></i> Waktu & Lokasi Berkumpul</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <h6 style="color: var(--primary); font-weight: bold;">📅 Tanggal Berkumpul</h6>
                                        <h4>{{ $pemesanan->departureInfo->tanggal_berkumpul->format('d F Y') }}</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 style="color: var(--primary); font-weight: bold;">🕐 Waktu Berkumpul</h6>
                                        <h4>{{ $pemesanan->departureInfo->waktu_berkumpul }}</h4>
                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <h6 style="color: var(--primary); font-weight: bold;">📍 Lokasi Berkumpul</h6>
                                    <h5>{{ $pemesanan->departureInfo->lokasi_berkumpul }}</h5>
                                    <p class="text-muted" style="white-space: pre-wrap;">{{ $pemesanan->departureInfo->alamat_lengkap }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Kontak & Guide -->
                        <div class="card mb-4">
                            <div class="card-header" style="background: var(--primary); color: white;">
                                <h5 class="mb-0"><i class="fas fa-phone-alt"></i> Kontak Guide/Organizer</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 style="color: var(--primary); font-weight: bold;">Nama</h6>
                                        <p>{{ $pemesanan->departureInfo->contact_person }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 style="color: var(--primary); font-weight: bold;">No. HP</h6>
                                        <p>
                                            {{ $pemesanan->departureInfo->no_hp_contact }}<br>
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pemesanan->departureInfo->no_hp_contact) }}" target="_blank" class="btn btn-sm btn-success">
                                                <i class="fab fa-whatsapp"></i> Chat WhatsApp
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Instruksi Persiapan -->
                        @if($pemesanan->departureInfo->instruksi_persiapan)
                            <div class="card mb-4">
                                <div class="card-header" style="background: var(--primary); color: white;">
                                    <h5 class="mb-0"><i class="fas fa-checklist"></i> Instruksi Persiapan</h5>
                                </div>
                                <div class="card-body">
                                    <p style="white-space: pre-wrap;">{{ $pemesanan->departureInfo->instruksi_persiapan }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Catatan Khusus -->
                        @if($pemesanan->departureInfo->catatan_khusus)
                            <div class="card mb-4">
                                <div class="card-header" style="background: #f39c12; color: white;">
                                    <h5 class="mb-0"><i class="fas fa-sticky-note"></i> Catatan Khusus</h5>
                                </div>
                                <div class="card-body">
                                    <p style="white-space: pre-wrap;">{{ $pemesanan->departureInfo->catatan_khusus }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Checklist Persiapan -->
                        <div class="card mb-4">
                            <div class="card-header" style="background: var(--primary); color: white;">
                                <h5 class="mb-0"><i class="fas fa-check-double"></i> Checklist Persiapan</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="check1">
                                    <label class="form-check-label" for="check1">
                                        Passport masih berlaku minimal 6 bulan
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="check2">
                                    <label class="form-check-label" for="check2">
                                        Visa atau approval sudah diterima
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="check3">
                                    <label class="form-check-label" for="check3">
                                        Asuransi perjalanan sudah dibeli
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="check4">
                                    <label class="form-check-label" for="check4">
                                        Obat-obatan pribadi siap
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="check5">
                                    <label class="form-check-label" for="check5">
                                        Pakaian dan perlengkapan sudah disiapkan
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="check6">
                                    <label class="form-check-label" for="check6">
                                        Uang & kartu kredit/atm disiapkan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check7">
                                    <label class="form-check-label" for="check7">
                                        Screenshot atau print e-ticket & booking confirmation
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Alert Penting -->
                        <div class="alert alert-info" role="alert">
                            <h5><i class="fas fa-exclamation-circle"></i> Penting!</h5>
                            <ul class="mb-0">
                                <li><strong>Jangan terlambat</strong> - Harap tiba 30 menit lebih awal dari waktu berkumpul</li>
                                <li><strong>Bawa dokumen penting</strong> - Passport, visa, booking confirmation</li>
                                <li><strong>Hubungi guide</strong> jika ada kendala atau pertanyaan</li>
                                <li><strong>Follow instruksi</strong> yang diberikan oleh guide/organizer</li>
                            </ul>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('pemesanans.show', $pemesanan) }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-arrow-left"></i> Kembali ke Detail Pemesanan
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

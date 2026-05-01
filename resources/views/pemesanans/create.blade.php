@extends('layouts.app')

@section('title', 'Pesan ' . $paket->nama_paket . ' - Travelkartika Mas')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 style="color: var(--primary); font-weight: bold; margin-bottom: 30px;">
                        <i class="fas fa-credit-card"></i> Form Pemesanan
                    </h2>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <h6>Terjadi Kesalahan:</h6>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-header" style="background: var(--primary); color: white;">
                            <h5 class="mb-0">Detail Paket</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    @if($paket->gambar)
                                        <img src="{{ $paket->gambar }}" class="img-fluid rounded" alt="{{ $paket->nama_paket }}">
                                    @else
                                        <div style="height: 150px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; border-radius: 10px;">
                                            <i class="fas fa-kaaba"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <h5 style="color: var(--primary); font-weight: bold;">{{ $paket->nama_paket }}</h5>
                                    <p class="text-muted mb-2">{{ Str::limit($paket->deskripsi, 150) }}</p>
                                    
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <small><strong>Durasi:</strong> {{ $paket->durasi_hari }} Hari</small>
                                        </div>
                                        <div class="col-6">
                                            <small><strong>Tanggal:</strong> {{ $paket->tanggal_berangkat->format('d M Y') }}</small>
                                        </div>
                                    </div>

                                    <h5 class="harga-display">Rp {{ number_format($paket->harga, 0, ',', '.') }} / orang</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Pemesanan -->
                    <form action="{{ route('pemesanans.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="paket_id" value="{{ $paket->id }}">

                        <div class="card mb-4">
                            <div class="card-header" style="background: var(--primary); color: white;">
                                <h5 class="mb-0">Data Pemesanan</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <label class="form-label"><strong>Jumlah Peserta <span class="text-danger">*</span></strong></label>
                                    <input type="number" name="jumlah_peserta" class="form-control @error('jumlah_peserta') is-invalid @enderror" min="1" max="{{ $paket->tersedia }}" value="{{ old('jumlah_peserta') }}" required>
                                    <small class="text-muted">Maksimal {{ $paket->tersedia }} peserta (kuota yang tersedia)</small>
                                    @error('jumlah_peserta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label"><strong>Catatan Khusus</strong></label>
                                    <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="4" placeholder="Contoh: Kebutuhan diet khusus, kondisi kesehatan, dll">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Ringkasan Pembayaran -->
                        <div class="card mb-4">
                            <div class="card-header" style="background: var(--secondary); color: white;">
                                <h5 class="mb-0">Ringkasan Pembayaran</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-6">Harga per orang</div>
                                    <div class="col-6 text-end">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">Jumlah peserta</div>
                                    <div class="col-6 text-end"><span id="jumlah-peserta">0</span> orang</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6"><h5 style="font-weight: bold;">Total Harga</h5></div>
                                    <div class="col-6 text-end"><h5 class="harga-display" id="total-harga">Rp 0</h5></div>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-secondary btn-lg">
                                <i class="fas fa-check-circle"></i> Lanjutkan Pemesanan
                            </button>
                            <a href="{{ route('pakets.show', $paket) }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @section('js')
        <script>
            const hargaPaket = {{ $paket->harga }};
            const inputJumlah = document.querySelector('input[name="jumlah_peserta"]');
            const displayJumlah = document.getElementById('jumlah-peserta');
            const displayTotal = document.getElementById('total-harga');

            function updateTotal() {
                const jumlah = parseInt(inputJumlah.value) || 0;
                displayJumlah.textContent = jumlah;
                const total = hargaPaket * jumlah;
                displayTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
            }

            inputJumlah.addEventListener('input', updateTotal);
            updateTotal();
        </script>
    @endsection
@endsection

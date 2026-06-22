@extends('layouts.app')

@section('title', 'Pesan ' . $paket->nama_paket . ' - Travelkartika Mas')

@section('content')
    <section class="py-4" style="background: #f8f9fa;">
        <div class="container">
            <!-- Breadcrumb -->
            <div class="mb-4" style="font-size: 0.95rem;">
                <a href="{{ route('home') }}#paket" style="color: var(--primary); text-decoration: none; font-weight: 600;">Paket Umroh</a>
                <span style="color: #cbd5e1; margin: 0 10px;">/</span>
                <strong style="color: #1e293b;">{{ $paket->nama_paket }}</strong>
            </div>

            <h2 style="color: var(--primary); font-weight: bold; margin-bottom: 30px; text-align: center;">
                <i class="fas fa-credit-card"></i> Form Pemesanan
            </h2>

            <div class="row g-4">
                <!-- Kolom Kiri: Detail Paket -->
                <div class="col-lg-4">

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

                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-header" style="background: var(--primary); color: white; border-bottom: 3px solid #d4af37;">
                            <h5 class="mb-0">Detail Paket</h5>
                        </div>
                        <div class="card-body p-4">
                            <h4 style="color: var(--primary); font-weight: bold; text-align: center; margin-bottom: 20px;">{{ $paket->nama_paket }}</h4>
                            <div class="text-center">
                                @if($paket->gambar)
                                    @php
                                        $imgUrl = Str::startsWith($paket->gambar, 'images/') ? asset($paket->gambar) : Storage::url($paket->gambar);
                                    @endphp
                                    <img src="{{ $imgUrl }}" class="img-fluid rounded shadow-sm" alt="{{ $paket->nama_paket }}" style="width:100%; object-fit:cover; border-radius: 12px;">
                                @else
                                    <div style="height: 150px; background: linear-gradient(135deg, #8B0000 0%, #b23a3a 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; border-radius: 10px;">
                                        <i class="fas fa-kaaba"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Form Pemesanan -->
                <div class="col-lg-8">

                    <!-- Form Pemesanan -->
                    <form action="{{ route('pemesanans.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="paket_id" value="{{ $paket->id }}">

                        <div class="card mb-4 shadow-sm border-0">
                            <div class="card-header" style="background: var(--primary); color: white; border-bottom: 3px solid #d4af37;">
                                <h5 class="mb-0">Data Pemesanan</h5>
                            </div>
                            <div class="card-body">
                                <!-- Tipe Kamar -->
                                <div class="mb-4">
                                    <label class="form-label"><strong>Tipe Kamar <span class="text-danger">*</span></strong></label>
                                    <div class="row g-2" id="tipe-kamar-group">
                                        @php
                                            $hargaQuad   = $paket->harga;
                                            $hargaTriple = $paket->harga_triple ?? $paket->harga;
                                            $hargaDouble = $paket->harga_double ?? $paket->harga;
                                        @endphp
                                        <div class="col-md-4">
                                            <label class="kamar-option w-100" style="cursor:pointer;">
                                                <input type="radio" name="tipe_kamar" value="quad" class="d-none tipe-kamar-radio" {{ old('tipe_kamar','quad') === 'quad' ? 'checked' : '' }}>
                                                <div class="kamar-card text-center rounded border" style="transition:all 0.2s; overflow:hidden;">
                                                    <div style="background: var(--primary); color: white; border-bottom: 3px solid #d4af37; padding: 10px; font-weight: 800; font-size: 1.1rem; letter-spacing: 0.5px; text-shadow: 1px 1px 3px rgba(0,0,0,0.4);">
                                                        QUAD
                                                    </div>
                                                    <div class="p-3">
                                                        <div style="font-size:0.85rem;color:#64748b;font-weight:600;">4 orang / kamar</div>
                                                        <div class="fw-bold mt-2" style="font-size: 1.3rem; color: #1e293b;">Rp {{ number_format($hargaQuad, 0, ',', '.') }}</div>
                                                        <div style="font-size:0.75rem;color:#94a3b8;font-weight:600;">/pax</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="kamar-option w-100" style="cursor:pointer;">
                                                <input type="radio" name="tipe_kamar" value="triple" class="d-none tipe-kamar-radio" {{ old('tipe_kamar') === 'triple' ? 'checked' : '' }}>
                                                <div class="kamar-card text-center rounded border" style="transition:all 0.2s; overflow:hidden;">
                                                    <div style="background: var(--primary); color: white; border-bottom: 3px solid #d4af37; padding: 10px; font-weight: 800; font-size: 1.1rem; letter-spacing: 0.5px; text-shadow: 1px 1px 3px rgba(0,0,0,0.4);">
                                                        TRIPLE
                                                    </div>
                                                    <div class="p-3">
                                                        <div style="font-size:0.85rem;color:#64748b;font-weight:600;">3 orang / kamar</div>
                                                        <div class="fw-bold mt-2" style="font-size: 1.3rem; color: #1e293b;">Rp {{ number_format($hargaTriple, 0, ',', '.') }}</div>
                                                        <div style="font-size:0.75rem;color:#94a3b8;font-weight:600;">/pax</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="kamar-option w-100" style="cursor:pointer;">
                                                <input type="radio" name="tipe_kamar" value="double" class="d-none tipe-kamar-radio" {{ old('tipe_kamar') === 'double' ? 'checked' : '' }}>
                                                <div class="kamar-card text-center rounded border" style="transition:all 0.2s; overflow:hidden;">
                                                    <div style="background: var(--primary); color: white; border-bottom: 3px solid #d4af37; padding: 10px; font-weight: 800; font-size: 1.1rem; letter-spacing: 0.5px; text-shadow: 1px 1px 3px rgba(0,0,0,0.4);">
                                                        DOUBLE
                                                    </div>
                                                    <div class="p-3">
                                                        <div style="font-size:0.85rem;color:#64748b;font-weight:600;">2 orang / kamar</div>
                                                        <div class="fw-bold mt-2" style="font-size: 1.3rem; color: #1e293b;">Rp {{ number_format($hargaDouble, 0, ',', '.') }}</div>
                                                        <div style="font-size:0.75rem;color:#94a3b8;font-weight:600;">/pax</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    @error('tipe_kamar')
                                        <div class="text-danger mt-1" style="font-size:0.85rem;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label"><strong>Jumlah Peserta <span class="text-danger">*</span></strong></label>
                                    <input type="number" name="jumlah_peserta" class="form-control @error('jumlah_peserta') is-invalid @enderror" min="1" max="{{ $paket->tersedia }}" value="{{ old('jumlah_peserta') }}" required>
                                    <small class="text-muted">Maksimal {{ $paket->tersedia }} peserta (kuota yang tersedia)</small>
                                    <br>
                                    <small class="text-muted">Kuota akan otomatis dikunci saat pemesanan dibuat.</small>
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
                        <div class="card mb-4 shadow-sm border-0">
                            <div class="card-header" style="background: var(--primary); color: white; border-bottom: 3px solid #d4af37;">
                                <h5 class="mb-0">Ringkasan Total</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-6">Tipe Kamar</div>
                                    <div class="col-6 text-end fw-bold" id="display-tipe-kamar" style="text-transform:uppercase; color:#8B0000;">QUAD</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">Harga per orang</div>
                                    <div class="col-6 text-end" id="display-harga">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">Jumlah peserta</div>
                                    <div class="col-6 text-end"><span id="jumlah-peserta">0</span> orang</div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-6"><div style="font-size: 0.9rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Total Harga</div></div>
                                    <div class="col-6 text-end"><div class="harga-display m-0" id="total-harga" style="font-size: 1.8rem; font-weight: 900; color: var(--maroon); line-height: 1.1;">Rp 0</div></div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('pakets.show', $paket) }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary" style="font-weight: bold; padding: 10px 24px;">
                                Lanjutkan Pemesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @section('js')
        <style>
            .kamar-card {
                border-color: #dee2e6 !important;
                background: #fff;
            }
            .tipe-kamar-radio:checked + .kamar-card {
                border-color: #8B0000 !important;
                background: rgba(139,0,0,0.06) !important;
                box-shadow: 0 0 0 2px rgba(139,0,0,0.3);
            }
        </style>
        <script>
            const hargaMap = {
                quad:   {{ $paket->harga }},
                triple: {{ $paket->harga_triple ?? $paket->harga }},
                double: {{ $paket->harga_double ?? $paket->harga }},
            };

            const inputJumlah   = document.querySelector('input[name="jumlah_peserta"]');
            const radioKamars   = document.querySelectorAll('.tipe-kamar-radio');
            const displayJumlah = document.getElementById('jumlah-peserta');
            const displayTotal  = document.getElementById('total-harga');
            const displayHarga  = document.getElementById('display-harga');
            const displayTipe   = document.getElementById('display-tipe-kamar');

            function getSelectedTipe() {
                const checked = document.querySelector('.tipe-kamar-radio:checked');
                return checked ? checked.value : 'quad';
            }

            function formatRp(number) {
                return 'Rp ' + number.toLocaleString('id-ID');
            }

            function updateTotal() {
                const tipe   = getSelectedTipe();
                const harga  = hargaMap[tipe] || hargaMap.quad;
                const jumlah = parseInt(inputJumlah.value) || 0;

                displayTipe.textContent  = tipe.toUpperCase();
                displayHarga.textContent = formatRp(harga);
                displayJumlah.textContent = jumlah;
                displayTotal.textContent  = formatRp(harga * jumlah);
            }

            radioKamars.forEach(r => r.addEventListener('change', updateTotal));
            inputJumlah.addEventListener('input', updateTotal);
            updateTotal();
        </script>
    @endsection
@endsection

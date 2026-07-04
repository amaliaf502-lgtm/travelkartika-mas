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

            <!-- Form Pemesanan Membungkus Seluruh Layout -->
            <form action="{{ route('pemesanans.store') }}" method="POST">
                @csrf
                <input type="hidden" name="paket_id" value="{{ $paket->id }}">

                <div class="row g-4">
                    
                    <!-- Kolom Kiri: Detail Paket -->
                    <div class="col-lg-4">
                        @if($errors->any())
                            <div class="alert alert-danger mb-4">
                                <h6>Terjadi Kesalahan:</h6>
                                <ul class="mb-0 ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Detail Paket Mini -->
                        <div class="card mb-4" style="border: none; border-top: 3px solid var(--maroon) !important; border-radius: 8px; overflow: hidden; background: white; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                            <div class="card-header bg-white" style="border-bottom: 1px solid #e2e8f0; padding: 12px 20px;">
                                <h5 class="mb-0" style="font-weight: 700; font-size: 1.05rem; color: #1e293b;">Detail Paket</h5>
                            </div>
                            <div class="card-body p-3 text-center">
                                @if($paket->gambar)
                                    @php
                                        $imgUrl = Str::startsWith($paket->gambar, 'images/') ? asset($paket->gambar) : Storage::url($paket->gambar);
                                    @endphp
                                    <img src="{{ $imgUrl }}" class="img-fluid rounded" alt="{{ $paket->nama_paket }}" style="width:100%; object-fit:cover; border-radius: 8px;">
                                @else
                                    <div style="height: 150px; background: linear-gradient(135deg, #8B0000 0%, #b23a3a 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; border-radius: 8px;">
                                        <i class="fas fa-kaaba"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Form Data Pemesanan & Ringkasan -->
                    <div class="col-lg-8">
                        <div class="card mb-4 shadow-sm" style="border: 1px solid #e2e8f0; border-top: 3px solid var(--maroon) !important; border-radius: 8px; overflow: hidden; background: white;">
                            <div class="card-header bg-white" style="border-bottom: 1px solid #e2e8f0; padding: 16px 20px;">
                                <h5 class="mb-0" style="font-weight: 700; font-size: 1.15rem; color: #1e293b;">Data Pemesanan</h5>
                            </div>
                            <div class="card-body p-4">
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
                                                <div class="kamar-card text-center border" style="border-top: 3px solid var(--maroon) !important; border-radius: 12px; transition:all 0.2s; background: white;">
                                                    <div class="p-3">
                                                        <div style="font-size: 0.85rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">QUAD</div>
                                                        <div style="font-size:0.75rem;color:#64748b;font-weight:600; margin-bottom: 12px;">4 orang / kamar</div>
                                                        <div class="fw-bold mt-2" style="font-size: 1.3rem; color: var(--maroon);">Rp {{ number_format($hargaQuad, 0, ',', '.') }}</div>
                                                        <div style="font-size:0.75rem;color:#94a3b8;font-weight:600;">/pax</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="kamar-option w-100" style="cursor:pointer;">
                                                <input type="radio" name="tipe_kamar" value="triple" class="d-none tipe-kamar-radio" {{ old('tipe_kamar') === 'triple' ? 'checked' : '' }}>
                                                <div class="kamar-card text-center border" style="border-top: 3px solid var(--maroon) !important; border-radius: 12px; transition:all 0.2s; background: white;">
                                                    <div class="p-3">
                                                        <div style="font-size: 0.85rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">TRIPLE</div>
                                                        <div style="font-size:0.75rem;color:#64748b;font-weight:600; margin-bottom: 12px;">3 orang / kamar</div>
                                                        <div class="fw-bold mt-2" style="font-size: 1.3rem; color: var(--maroon);">Rp {{ number_format($hargaTriple, 0, ',', '.') }}</div>
                                                        <div style="font-size:0.75rem;color:#94a3b8;font-weight:600;">/pax</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="kamar-option w-100" style="cursor:pointer;">
                                                <input type="radio" name="tipe_kamar" value="double" class="d-none tipe-kamar-radio" {{ old('tipe_kamar') === 'double' ? 'checked' : '' }}>
                                                <div class="kamar-card text-center border" style="border-top: 3px solid var(--maroon) !important; border-radius: 12px; transition:all 0.2s; background: white;">
                                                    <div class="p-3">
                                                        <div style="font-size: 0.85rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">DOUBLE</div>
                                                        <div style="font-size:0.75rem;color:#64748b;font-weight:600; margin-bottom: 12px;">2 orang / kamar</div>
                                                        <div class="fw-bold mt-2" style="font-size: 1.3rem; color: var(--maroon);">Rp {{ number_format($hargaDouble, 0, ',', '.') }}</div>
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

                            <!-- Ringkasan Pembayaran -->
                            <div class="card-header" style="background-color: #f8f9fa; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 12px 20px;">
                                <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.05rem;">Ringkasan Total</h5>
                            </div>
                            <div class="card-body p-4">
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
                                <div class="row align-items-center mb-4">
                                    <div class="col-6"><div style="font-size: 0.9rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Total Harga</div></div>
                                    <div class="col-6 text-end"><div class="harga-display m-0" id="total-harga" style="font-size: 1.8rem; font-weight: 900; color: var(--maroon); line-height: 1.1;">Rp 0</div></div>
                                </div>

                                <div class="d-flex justify-content-end gap-3">
                                    <a href="{{ route('pakets.show', $paket) }}" class="btn" style="border: 1px solid #cbd5e1; color: #475569; font-weight: 600; padding: 10px 24px; border-radius: 8px; transition: all 0.2s;">
                                        Kembali
                                    </a>
                                    <button type="submit" class="btn" style="background: var(--maroon); color: white; font-weight: 600; padding: 10px 24px; border-radius: 8px; border: none; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(139, 45, 45, 0.2);">
                                        Lanjutkan Pemesanan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @section('js')
        <style>
            :root {
                --maroon: #8B2D2D;
            }
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

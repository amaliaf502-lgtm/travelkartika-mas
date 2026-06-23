@extends("layouts.app")

@section("title", "Detail Pemesanan - Travelkartika Mas")

@section("content")
    <section class="py-5 bg-light" style="background-color: #f8f9fa !important;">
        <div class="container">
            <div class="mb-4">
                <a href="{{ route("pemesanans.index") }}" class="btn btn-outline-secondary px-3 py-2 bg-white text-dark shadow-sm" style="border: 1px solid #ddd;">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Pemesanan
                </a>
            </div>

            @if(session("success"))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-4">
                    <i class="fas fa-check-circle me-2"></i> {{ session("success") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session("error"))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-4">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session("error") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4">
                <!-- KIRI: Data Pemesan, Biodata, Tagihan, Transaksi -->
                <div class="col-lg-8">
                    
                    <!-- Data Pemesan Akun -->
                    <div class="card mb-4 shadow-sm border-0 rounded-4">
                        <div class="card-header py-3 border-0" style="background: #8B2D2D; color: white; border-radius: 15px 15px 0 0;">
                            <h5 class="mb-0 fw-bold">Data Pemesan Akun</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong class="d-block text-dark mb-1">Nama:</strong>
                                    <span class="text-dark">{{ $pemesanan->user->name }}</span>
                                </div>
                                <div class="col-md-6">
                                    <strong class="d-block text-dark mb-1">Email:</strong>
                                    <span class="text-dark">{{ $pemesanan->user->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biodata & Dokumen Jamaah -->
                    <div class="card mb-4 shadow-sm border-0 rounded-4">
                        <div class="card-header py-3 border-0 d-flex justify-content-between align-items-center" style="background: #8B2D2D; color: white; border-radius: 15px 15px 0 0;">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-id-card me-2"></i> Biodata & Dokumen Jamaah</h5>
                            @if($pemesanan->data_completed_at)
                                <span class="badge bg-success py-2 px-3" style="font-size: 0.9rem;">Sudah Dilengkapi</span>
                            @else
                                <a href="{{ route("pemesanans.complete-data", $pemesanan) }}" class="btn btn-sm btn-warning text-dark fw-bold">
                                    <i class="fas fa-edit"></i> Edit Data
                                </a>
                            @endif
                        </div>
                        <div class="card-body p-4">
                            @if($pemesanan->data_completed_at)
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <div class="p-3 border-0 rounded-3 h-100 bg-light">
                                            <small class="text-muted d-block text-uppercase mb-1" style="font-size: 0.75rem; font-weight: 700;">NAMA AYAH</small>
                                            <strong class="text-dark">{{ $pemesanan->nama_ayah ?? "-" }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="p-3 border-0 rounded-3 h-100 bg-light">
                                            <small class="text-muted d-block text-uppercase mb-1" style="font-size: 0.75rem; font-weight: 700;">NAMA IBU</small>
                                            <strong class="text-dark">{{ $pemesanan->nama_ibu ?? "-" }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="p-3 border-0 rounded-3 h-100 bg-light">
                                            <small class="text-muted d-block text-uppercase mb-1" style="font-size: 0.75rem; font-weight: 700;">PEKERJAAN</small>
                                            <strong class="text-dark">{{ $pemesanan->pekerjaan ?? "-" }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="p-3 border-0 rounded-3 h-100 bg-light">
                                            <small class="text-muted d-block text-uppercase mb-1" style="font-size: 0.75rem; font-weight: 700;">TEMPAT, TGL LAHIR</small>
                                            <strong class="text-dark">{{ $pemesanan->tempat_lahir ?? "-" }}, {{ $pemesanan->tanggal_lahir ? \Carbon\Carbon::parse($pemesanan->tanggal_lahir)->format("d M Y") : "-" }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="p-3 border-0 rounded-3 h-100 bg-light">
                                            <small class="text-muted d-block text-uppercase mb-1" style="font-size: 0.75rem; font-weight: 700;">J. KELAMIN / STATUS</small>
                                            <strong class="text-dark">{{ ucfirst($pemesanan->jenis_kelamin ?? "-") }} / {{ ucfirst($pemesanan->status_nikah ?? "-") }}</strong>
                                        </div>
                                    </div>
                                </div>
                                
                                <h6 class="fw-bold mb-3">Dokumen Digital</h6>
                                <hr>
                                <div class="row g-3">
                                    @php
                                        $docs = [
                                            "Pas Foto" => $pemesanan->pas_foto,
                                            "KTP" => $pemesanan->ktp,
                                            "KK" => $pemesanan->kk,
                                            "Paspor" => $pemesanan->paspor,
                                            "Surat Nikah" => $pemesanan->surat_nikah,
                                        ];
                                    @endphp
                                    @foreach($docs as $label => $file)
                                        <div class="col-md-2 col-6">
                                            <div class="border rounded text-center p-2 h-100 d-flex flex-column justify-content-between bg-white shadow-sm">
                                                <div class="fw-bold mb-2" style="font-size: 0.85rem;">{{ $label }}</div>
                                                @if($file)
                                                    <a href="{{ asset($file) }}" target="_blank" class="d-block mb-2">
                                                        <img src="{{ asset($file) }}" class="img-fluid rounded" style="height: 90px; width: 100%; object-fit: contain;">
                                                    </a>
                                                    <span class="badge bg-success rounded-pill px-3">Terunggah</span>
                                                @else
                                                    <div class="py-3 text-muted small"><i class="fas fa-times-circle text-danger mb-1"></i><br>Tidak Ada</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                                    <p class="mb-3 text-muted">Biodata dan dokumen jamaah belum dilengkapi. Silakan lengkapi data jamaah terlebih dahulu.</p>
                                    @if($pemesanan->status !== "dibatalkan")
                                        <a href="{{ route("pemesanans.complete-data", $pemesanan) }}" class="btn btn-primary fw-bold px-4">
                                            Lengkapi Data Sekarang
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Tagihan & Peserta -->
                    <div class="card mb-4 shadow-sm border-0 rounded-4">
                        <div class="card-header py-3 border-0" style="background: #8B2D2D; color: white; border-radius: 15px 15px 0 0;">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-info-circle me-2"></i> Informasi Tagihan & Peserta</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <strong class="d-block text-dark mb-1">Jumlah Peserta:</strong>
                                    <span class="text-dark">{{ $pemesanan->jumlah_peserta }} orang</span>
                                </div>
                                <div class="col-md-6">
                                    <strong class="d-block text-dark mb-1">Tipe Kamar:</strong>
                                    <span class="badge" style="background: #8B2D2D; font-size: 0.9rem;">{{ strtoupper($pemesanan->tipe_kamar ?? "QUAD") }}</span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <strong class="d-block text-dark mb-1">Total Harga:</strong>
                                <h2 style="color: #0d47a1; font-weight: 800;">Rp {{ number_format($pemesanan->total_harga, 0, ",", ".") }}</h2>
                            </div>

                            <div class="p-3 rounded-3 mb-4" style="background-color: #f8f9fa; border: 1px solid #e9ecef;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="fw-bold text-muted d-block mb-1">SUDAH DIBAYAR:</small>
                                        <h5 class="text-success fw-bold mb-0">Rp {{ number_format($pemesanan->nominal_dibayar ?? (in_array($pemesanan->status, ["paid", "confirmed"]) ? $pemesanan->total_harga : 0), 0, ",", ".") }}</h5>
                                        @if(in_array($pemesanan->status, ["paid", "confirmed"]))
                                            <small class="text-success fw-bold"><i class="fas fa-check-circle me-1 mt-2"></i> Status: Pembayaran Lunas</small>
                                        @else
                                            <small class="text-warning fw-bold"><i class="fas fa-clock me-1 mt-2"></i> Status: Belum Lunas</small>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <small class="fw-bold text-muted d-block mb-1">SISA TAGIHAN:</small>
                                        @php
                                            $dibayar = $pemesanan->nominal_dibayar ?? (in_array($pemesanan->status, ["paid", "confirmed"]) ? $pemesanan->total_harga : 0);
                                            $sisa = $pemesanan->total_harga - $dibayar;
                                        @endphp
                                        <h5 class="text-danger fw-bold mb-0">Rp {{ number_format($sisa, 0, ",", ".") }}</h5>
                                    </div>
                                </div>
                            </div>

                            @if($pemesanan->catatan)
                                <div class="p-3 rounded-3" style="background-color: #e0f7fa; border: 1px solid #b2ebf2;">
                                    <strong class="d-block text-dark mb-1"><i class="fas fa-sticky-note me-2"></i> Catatan:</strong>
                                    <p class="mb-0 text-dark" style="white-space: pre-line;">{{ $pemesanan->catatan }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Transaksi Pembayaran -->
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header py-3 border-0" style="background: #8B2D2D; color: white; border-radius: 15px 15px 0 0;">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-money-bill-wave me-2"></i> Transaksi Pembayaran</h5>
                        </div>
                        <div class="card-body p-4">
                            @if($pemesanan->midtrans_transaction_id)
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="text-muted" style="width: 40%;">ID Transaksi Midtrans</td>
                                                <td class="fw-bold text-dark">: {{ $pemesanan->midtrans_transaction_id }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Metode Pembayaran</td>
                                                <td class="fw-bold text-dark">: {{ strtoupper(str_replace("_", " ", $pemesanan->midtrans_payment_type ?? "-")) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Waktu Transaksi</td>
                                                <td class="fw-bold text-dark">: {{ $pemesanan->midtrans_transaction_time ?? "-" }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-receipt fa-3x text-muted mb-3" style="opacity: 0.5;"></i>
                                    <p class="text-muted mb-0">Belum ada riwayat transaksi pembayaran online (Midtrans).</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- KANAN: Paket Info, Status, Ringkasan -->
                <div class="col-lg-4">
                    <!-- Paket Info -->
                    <div class="card mb-4 shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="card-header border-0 py-3" style="background: #8B2D2D; color: white;">
                            <h6 class="mb-0 fw-bold"><i class="fas fa-calendar-alt me-2"></i> {{ $pemesanan->paket->nama_paket }}</h6>
                        </div>
                        <div class="card-body p-4">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 d-flex justify-content-between align-items-center">
                                    <span class="text-dark"><i class="fas fa-plane-departure text-danger me-2"></i> Berangkat:</span>
                                    <strong class="text-dark">{{ $pemesanan->paket->tanggal_berangkat->format("d M Y") }}</strong>
                                </li>
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark"><i class="fas fa-plane-arrival text-danger me-2"></i> Pulang:</span>
                                    <strong class="text-dark">{{ $pemesanan->paket->tanggal_kembali->format("d M Y") }}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Status Pemesanan -->
                    <div class="card mb-4 shadow-sm border-0 rounded-4 text-center">
                        <div class="card-body p-4">
                            @if($pemesanan->status === "pending")
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-warning text-dark rounded-circle shadow-sm" style="width: 80px; height: 80px;">
                                        <i class="fas fa-clock fa-3x"></i>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark">Menunggu Pembayaran</h4>
                                <p class="text-muted small">Silakan selesaikan pembayaran Anda agar kursi tidak hangus.</p>
                                <div class="d-grid gap-2 mt-4">
                                    <button class="btn btn-primary fw-bold shadow-sm py-2" style="border-radius: 8px;" id="pay-button">
                                        <i class="fas fa-credit-card me-2"></i> Bayar Sekarang
                                    </button>
                                </div>
                            @elseif(in_array($pemesanan->status, ["paid", "confirmed"]))
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle shadow-sm" style="width: 80px; height: 80px;">
                                        <i class="fas fa-check fa-3x"></i>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark">Pemesanan Dikonfirmasi</h4>
                                <p class="text-muted small">Pembayaran telah diterima dan pemesanan dikonfirmasi.</p>
                                <div class="d-grid gap-2 mt-4">
                                    <a href="{{ route("pemesanans.departure-info", $pemesanan) }}" class="btn btn-success fw-bold shadow-sm py-2" style="border-radius: 8px; background-color: #198754; border-color: #198754;">
                                        <i class="fas fa-plane-departure me-2"></i> Lihat Info Keberangkatan
                                    </a>
                                    <a href="{{ route("pemesanans.cetak", $pemesanan) }}" target="_blank" class="btn fw-bold shadow-sm py-2" style="border-radius: 8px; background-color: #8B2D2D; color: white; border-color: #8B2D2D;">
                                        <i class="fas fa-print me-2"></i> Cetak Bukti Pemesanan
                                    </a>
                                </div>
                            @elseif($pemesanan->status === "completed")
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow-sm" style="width: 80px; height: 80px;">
                                        <i class="fas fa-flag-checkered fa-3x"></i>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark">Selesai</h4>
                                <p class="text-muted small">Ibadah Umroh telah selesai dilaksanakan.</p>
                                <div class="d-grid gap-2 mt-4">
                                    <a href="{{ route("pemesanans.cetak", $pemesanan) }}" target="_blank" class="btn btn-outline-primary fw-bold shadow-sm py-2" style="border-radius: 8px;">
                                        <i class="fas fa-print me-2"></i> Cetak Bukti Pemesanan
                                    </a>
                                </div>
                            @elseif(in_array($pemesanan->status, ["failed", "dibatalkan"]))
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-danger text-white rounded-circle shadow-sm" style="width: 80px; height: 80px;">
                                        <i class="fas fa-times fa-3x"></i>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark">Dibatalkan</h4>
                                <p class="text-muted small">Pemesanan ini telah dibatalkan atau gagal.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Ringkasan Tagihan -->
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body p-4 bg-white rounded-4">
                            <h6 class="fw-bold text-secondary text-uppercase mb-4"><i class="fas fa-receipt me-2"></i> Ringkasan Tagihan</h6>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Subtotal</span>
                                <strong class="text-dark">Rp {{ number_format($pemesanan->total_harga, 0, ",", ".") }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-4 pb-3 border-bottom">
                                <span class="text-muted">Biaya Admin</span>
                                <strong class="text-success">FREE</strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <strong class="text-dark" style="font-size: 0.9rem;">TOTAL BAYAR</strong>
                                <h5 class="text-danger fw-bold mb-0">Rp {{ number_format($sisa, 0, ",", ".") }}</h5>
                            </div>

                            @if($sisa == 0)
                                <button class="btn btn-success w-100 fw-bold py-2 rounded-pill" disabled style="background-color: #5cb85c; border-color: #4cae4c; opacity: 1;">
                                    <i class="fas fa-check-circle me-1"></i> LUNAS
                                </button>
                            @else
                                <button class="btn btn-warning w-100 fw-bold py-2 rounded-pill text-dark" disabled>
                                    BELUM LUNAS
                                </button>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@if($pemesanan->status === "pending" && $pemesanan->midtrans_snap_token)
@push("scripts")
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config("midtrans.client_key") }}"></script>
<script>
    document.getElementById("pay-button").onclick = function () {
        snap.pay("{{ $pemesanan->midtrans_snap_token }}", {
            onSuccess: function(result) {
                window.location.href = "{{ route("pemesanans.show", $pemesanan) }}";
            },
            onPending: function(result) {
                alert("Menunggu pembayaran!");
            },
            onError: function(result) {
                alert("Pembayaran gagal!");
            },
            onClose: function () {
                alert("Anda menutup popup sebelum menyelesaikan pembayaran");
            }
        });
    };
</script>
@endpush
@endif
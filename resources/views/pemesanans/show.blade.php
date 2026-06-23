@extends("layouts.app")

@section("title", "Detail Pemesanan - Travelkartika Mas")

@section("content")
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route("pemesanans.index") }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Riwayat
                </a>
                <h4 class="mb-0 fw-bold" style="color: #8B2D2D;">Detail Pemesanan</h4>
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
                <!-- KIRI: Status & Paket Info -->
                <div class="col-lg-4">
                    <!-- Status Pemesanan -->
                    <div class="card mb-4 shadow-sm border-0 rounded-4 text-center">
                        <div class="card-body p-4">
                            @if($pemesanan->status === "pending")
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-warning text-dark rounded-circle" style="width: 80px; height: 80px;">
                                        <i class="fas fa-clock fa-3x"></i>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark">Menunggu Pembayaran</h4>
                                <p class="text-muted small">Silakan selesaikan pembayaran Anda agar kursi tidak hangus.</p>
                                <div class="d-grid gap-2 mt-3">
                                    <button class="btn btn-primary fw-bold shadow-sm" style="border-radius: 8px;" id="pay-button">
                                        <i class="fas fa-credit-card me-2"></i> Bayar Sekarang
                                    </button>
                                </div>
                            @elseif(in_array($pemesanan->status, ["paid", "confirmed"]))
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle" style="width: 80px; height: 80px;">
                                        <i class="fas fa-check fa-3x"></i>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark">Pemesanan Dikonfirmasi</h4>
                                <p class="text-muted small">Pembayaran telah diterima dan pemesanan dikonfirmasi.</p>
                                <div class="d-grid gap-2 mt-3">
                                    <a href="{{ route("pemesanans.departure-info", $pemesanan) }}" class="btn btn-success fw-bold shadow-sm" style="border-radius: 8px;">
                                        <i class="fas fa-plane-departure me-2"></i> Lihat Info Keberangkatan
                                    </a>
                                    <a href="{{ route("pemesanans.cetak", $pemesanan) }}" target="_blank" class="btn btn-outline-primary fw-bold shadow-sm" style="border-radius: 8px;">
                                        <i class="fas fa-print me-2"></i> Cetak Bukti Pemesanan
                                    </a>
                                </div>
                            @elseif($pemesanan->status === "completed")
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle" style="width: 80px; height: 80px;">
                                        <i class="fas fa-flag-checkered fa-3x"></i>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark">Selesai</h4>
                                <p class="text-muted small">Ibadah Umroh telah selesai dilaksanakan.</p>
                                <div class="d-grid gap-2 mt-3">
                                    <a href="{{ route("pemesanans.cetak", $pemesanan) }}" target="_blank" class="btn btn-outline-primary fw-bold shadow-sm" style="border-radius: 8px;">
                                        <i class="fas fa-print me-2"></i> Cetak Bukti Pemesanan
                                    </a>
                                </div>
                            @elseif(in_array($pemesanan->status, ["failed", "dibatalkan"]))
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-danger text-white rounded-circle" style="width: 80px; height: 80px;">
                                        <i class="fas fa-times fa-3x"></i>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark">Dibatalkan</h4>
                                <p class="text-muted small">Pemesanan ini telah dibatalkan atau gagal.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Paket Info -->
                    <div class="card mb-4 shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="card-header border-0 py-3" style="background: #8B2D2D; color: white;">
                            <h6 class="mb-0 fw-bold"><i class="fas fa-kaaba me-2"></i> {{ $pemesanan->paket->nama_paket }}</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2 d-flex justify-content-between">
                                    <span class="text-muted"><i class="fas fa-plane-departure me-2"></i> Berangkat:</span>
                                    <strong>{{ $pemesanan->paket->tanggal_berangkat->format("d M Y") }}</strong>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span class="text-muted"><i class="fas fa-plane-arrival me-2"></i> Pulang:</span>
                                    <strong>{{ $pemesanan->paket->tanggal_kembali->format("d M Y") }}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- KANAN: Tagihan & Pembayaran -->
                <div class="col-lg-8">
                    
                    <!-- Data Pemesan Akun -->
                    <div class="card mb-4 shadow-sm border-0 rounded-4">
                        <div class="card-header py-3 border-0" style="background: #8B2D2D; color: white; border-radius: 15px 15px 0 0;">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-user-circle me-2"></i> Data Akun Pemesan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <small class="text-muted d-block mb-1">Nama Lengkap</small>
                                    <p class="fw-bold mb-0">{{ $pemesanan->user->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted d-block mb-1">Email</small>
                                    <p class="fw-bold mb-0">{{ $pemesanan->user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Tagihan -->
                    <div class="card mb-4 shadow-sm border-0 rounded-4">
                        <div class="card-header py-3 border-0" style="background: #8B2D2D; color: white; border-radius: 15px 15px 0 0;">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-info-circle me-2"></i> Informasi Tagihan & Peserta</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <strong class="d-block mb-1">Jumlah Peserta:</strong>
                                    <span>{{ $pemesanan->jumlah_peserta }} orang</span>
                                </div>
                                <div class="col-md-6">
                                    <strong class="d-block mb-1">Tipe Kamar:</strong>
                                    <span class="badge" style="background: #8B2D2D; font-size: 0.9rem;">{{ strtoupper($pemesanan->tipe_kamar ?? "QUAD") }}</span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <strong class="d-block mb-1">Total Harga:</strong>
                                <h2 style="color: #0d47a1; font-weight: 800;">Rp {{ number_format($pemesanan->total_harga, 0, ",", ".") }}</h2>
                            </div>

                            <div class="p-3 rounded-3" style="background-color: #f8f9fa; border: 1px solid #e9ecef;">
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
                                    <div class="col-md-6 border-start">
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
                                <hr class="my-4">
                                <div>
                                    <strong class="d-block mb-2">Catatan:</strong>
                                    <p class="mb-0 text-muted">{{ $pemesanan->catatan }}</p>
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
                                                <td class="fw-bold">: {{ $pemesanan->midtrans_transaction_id }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Metode Pembayaran</td>
                                                <td class="fw-bold">: {{ strtoupper(str_replace("_", " ", $pemesanan->midtrans_payment_type ?? "-")) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Waktu Transaksi</td>
                                                <td class="fw-bold">: {{ $pemesanan->midtrans_transaction_time ?? "-" }}</td>
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
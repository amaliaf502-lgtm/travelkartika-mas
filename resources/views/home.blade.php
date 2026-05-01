@extends('layouts.app')

@section('title', 'Beranda - Travel Umroh Travelkartika Mas')

@section('content')
    @section('css')
        <style>
            .home-hero {
                background: linear-gradient(rgba(15,32,63,0.45), rgba(15,32,63,0.45)), url("{{ asset('images/background.JPG') }}");
                background-size: cover;
                background-position: center;
                color: white;
                padding: 120px 0 90px;
                text-align: center;
            }

            .section-keunggulan {
    background: var(--primary); /* biru */
    color: #fff;
}

.section-keunggulan h2,
.section-keunggulan h5 {
    color: #fff !important;
}

.section-keunggulan p {
    color: rgba(255,255,255,0.9) !important;
}

            .home-hero h1 {
                font-size: 3.5rem;
                font-weight: 800;
                margin-bottom: 20px;
                text-shadow: 0 6px 18px rgb(252, 243, 243);
            }

            .home-hero p {
                font-size: 1.25rem;
                margin-bottom: 30px;
                color: rgba(255,255,255,0.95);
            }

            .home-hero .btn-cta {
                background: var(--secondary);
                border: none;
                color: #fff;
                font-weight: 700;
                padding: 12px 26px;
                box-shadow: 0 10px 30px rgba(243,156,18,0.18);
                transition: transform 0.15s ease, box-shadow 0.15s ease;
            }

            .home-hero .btn-cta:hover { transform: translateY(-3px); box-shadow: 0 18px 40px rgba(243,156,18,0.22); }

            @media (max-width: 767px) {
                .home-hero { padding: 90px 0 60px; }
                .home-hero h1 { font-size: 2rem; }
            }
        </style>
    @endsection

    <!-- Hero Section -->
    <section class="home-hero">
        <div class="container">
            <h1>Kartika Mas Tour & Travel</h1>
            <p>Kartika Mas Tour & Travel adalah mitra terpercaya Dalam memfasilitasi perjalanan ibadah ke kota suci Mekkah dan Madinah. Dengan komitmen yang kuat terhadap keunggulan, kami mengkuhususkan dari untuk menciptakan pengalaman yang tak terlupakan bagi para jamaah yang melakukan perjalanan ibadah umroh dan haji bersama kami</p>
            <a href="{{ route('pakets.index') }}" class="btn btn-lg btn-cta me-3">
                <i class="fas fa-list"></i> Lihat Paket
            </a>
            <a href="#" class="btn btn-lg btn-outline-light">
                <i class="fas fa-phone"></i> Hubungi Kami
            </a>
        </div>
    </section>

    <!-- Statistik -->
    <section class="py-4 bg-light mb-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <h3 class="text-primary">{{ $total_paket }}</h3>
                    <p class="text-muted">Paket Umroh Aktif</p>
                </div>
                <div class="col-md-4">
                    <h3 class="text-primary">{{ $total_pemesanan }}</h3>
                    <p class="text-muted">Total Pemesanan</p>
                </div>
                <div class="col-md-4">
                    <h3 class="text-primary">{{ $paket_penuh }}</h3>
                    <p class="text-muted">Paket Penuh</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section class="py-5" style="background: linear-gradient(135deg, rgba(139,45,45,0.05) 0%, rgba(218,165,32,0.05) 100%);">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary); font-weight: bold;">
                <i class="fas fa-building"></i> Tentang Kami
            </h2>
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <p style="color:#555;">(Logo disembunyikan sesuai permintaan.)</p>
                </div>
                <div class="col-12">
                    <h3 style="color: var(--primary); font-weight: 700; margin-bottom: 20px;">
                        Kartika Mas Tour & Travel
                    </h3>
                    <p style="font-size: 1rem; line-height: 1.8; color: #555; margin-bottom: 20px;">
                        Kartika Mas Tour & Travel adalah perusahaan jasa travel yang berpengalaman lebih dari 10 tahun dalam menyediakan layanan umroh dan haji. Kami berkomitmen untuk memberikan pengalaman berkualitas tinggi dengan harga yang terjangkau bagi semua jamaah.
                    </p>
                    
                    <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid var(--secondary);">
                        <h5 style="color: var(--primary); font-weight: 600; margin-bottom: 10px;">
                            <i class="fas fa-target" style="color: var(--secondary);"></i> Visi
                        </h5>
                        <p style="margin: 0; color: #555;">
                            Menjadi perusahaan travel umroh dan haji terdepan yang terpercaya dan memberikan kepuasan maksimal kepada setiap jamaah.
                        </p>
                    </div>

                    <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid var(--secondary);">
                        <h5 style="color: var(--primary); font-weight: 600; margin-bottom: 10px;">
                            <i class="fas fa-handshake" style="color: var(--secondary);"></i> Misi
                        </h5>
                        <p style="margin: 0; color: #555;">
                            Memberikan layanan terbaik dalam memfasilitasi perjalanan ibadah dengan standar internasional, transparan, dan ramah kepada semua jamaah.
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div style="text-align: center; padding: 15px; background: white; border-radius: 8px;">
                                <h4 style="color: var(--secondary); font-weight: 700; margin-bottom: 5px;">10+</h4>
                                <p style="color: #666; margin: 0;">Tahun Berpengalaman</p>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div style="text-align: center; padding: 15px; background: white; border-radius: 8px;">
                                <h4 style="color: var(--secondary); font-weight: 700; margin-bottom: 5px;">100%</h4>
                                <p style="color: #666; margin: 0;">Tersertifikasi Kemenag</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Paket Terbaru -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary); font-weight: bold;">
                <i class="fas fa-star"></i> Paket Umroh Terbaru
            </h2>
            <div class="row">
                @forelse($pakets_terbaru as $paket)
                    <div class="col-md-4 mb-4">
                        <div class="card paket-card">
                            <div style="position: relative;">
                                @if($paket->gambar)
                                    <img src="{{ $paket->gambar }}" class="card-img-top" alt="{{ $paket->nama_paket }}" style="height:180px; object-fit:cover;">
                                @else
                                    <div style="height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                                        <i class="fas fa-kaaba"></i>
                                    </div>
                                @endif
                                <span class="badge-durasi">
                                    <i class="fas fa-calendar-days"></i> {{ $paket->durasi_hari }} Hari
                                </span>
                            </div>
                            <div class="paket-card-body">
                                <h5>{{ $paket->nama_paket }}</h5>
                                <p class="text-muted" style="font-size: 0.9rem;">{{ Str::limit($paket->deskripsi, 100) }}</p>
                                
                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i> {{ $paket->tanggal_berangkat->format('d M Y') }} - {{ $paket->tanggal_kembali->format('d M Y') }}
                                    </small>
                                </div>

                                <div class="mb-3">
                                    <small class="kuota-display">
                                        Tersedia: <strong>{{ $paket->tersedia }} / {{ $paket->kuota }}</strong> kursi
                                    </small>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="harga-display">Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
                                    <a href="{{ route('pakets.show', $paket) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i> Belum ada paket umroh tersedia saat ini.
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('pakets.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-list"></i> Lihat Semua Paket
                </a>
            </div>
        </div>
    </section>

    <!-- Keunggulan -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary); font-weight: bold;">
                <i class="fas fa-check-double"></i> Mengapa Memilih Kami?
            </h2>
            <div class="row">
                <div class="col-md-3 mb-4 text-center">
                    <i class="fas fa-medal" style="font-size: 3rem; color: var(--secondary); margin-bottom: 20px;"></i>
                    <h5>Berpengalaman</h5>
                    <p class="text-muted">Lebih dari 10 tahun melayani ibadah umroh umat muslim</p>
                </div>
                <div class="col-md-3 mb-4 text-center">
                    <i class="fas fa-hand-holding-heart" style="font-size: 3rem; color: var(--secondary); margin-bottom: 20px;"></i>
                    <h5>Terpercaya</h5>
                    <p class="text-muted">Terdaftar dan tersertifikasi di Kemenag RI</p>
                </div>
                <div class="col-md-3 mb-4 text-center">
                    <i class="fas fa-money-bill-wave" style="font-size: 3rem; color: var(--secondary); margin-bottom: 20px;"></i>
                    <h5>Harga Kompetitif</h5>
                    <p class="text-muted">Paket umroh dengan harga terjangkau tanpa mengorbankan kualitas</p>
                </div>
                <div class="col-md-3 mb-4 text-center">
                    <i class="fas fa-headset" style="font-size: 3rem; color: var(--secondary); margin-bottom: 20px;"></i>
                    <h5>Dukungan 24/7</h5>
                    <p class="text-muted">Tim customer service siap membantu Anda kapan saja</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Jamaah -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary); font-weight: bold;">
                <i class="fas fa-quote-left"></i> Testimoni Jamaah Kami
            </h2>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card testimoni-card" style="border: none; border-left: 5px solid var(--secondary); box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                            </div>
                            <p class="card-text" style="font-style: italic; color: #666;">"Pelayanan Kartika Mas sangat profesional dan memuaskan. Dari awal pendaftaran hingga kembali ke Indonesia, semuanya teratur dengan baik."</p>
                            <p class="mb-0" style="font-weight: 600; color: var(--primary);">Bapak Ahmad Suryanto</p>
                            <small class="text-muted">Jakarta</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card testimoni-card" style="border: none; border-left: 5px solid var(--secondary); box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                            </div>
                            <p class="card-text" style="font-style: italic; color: #666;">"Impian umroh saya terwujud berkat Kartika Mas. Tim mereka sangat membantu dan memberikan informasi yang jelas setiap tahapnya."</p>
                            <p class="mb-0" style="font-weight: 600; color: var(--primary);">Ibu Siti Nurjanah</p>
                            <small class="text-muted">Surabaya</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card testimoni-card" style="border: none; border-left: 5px solid var(--secondary); box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                                <i class="fas fa-star" style="color: var(--secondary);"></i>
                            </div>
                            <p class="card-text" style="font-style: italic; color: #666;">"Harga paket sangat kompetitif dan fasilitasnya lengkap. Saya merasa dihargai sebagai jamaah selama perjalanan ibadah."</p>
                            <p class="mb-0" style="font-weight: 600; color: var(--primary);">Pak Hendra Wijaya</p>
                            <small class="text-muted">Bandung</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Proses Umroh -->
    <section class="py-5" style="background: linear-gradient(135deg, rgba(139,45,45,0.08) 0%, rgba(218,165,32,0.06) 100%);">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary); font-weight: bold;">
                <i class="fas fa-directions"></i> Proses Umroh Bersama Kami
            </h2>
            <div class="row">
                <div class="col-lg-2 col-md-4 mb-4 text-center">
                    <div style="width: 70px; height: 70px; background: var(--secondary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 15px; font-weight: bold;">1</div>
                    <h5 style="color: var(--primary); font-weight: 600;">Konsultasi</h5>
                    <p class="text-muted" style="font-size: 0.9rem;">Hubungi kami dan pilih paket yang sesuai</p>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 text-center">
                    <div style="width: 70px; height: 70px; background: var(--secondary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 15px; font-weight: bold;">2</div>
                    <h5 style="color: var(--primary); font-weight: 600;">Pendaftaran</h5>
                    <p class="text-muted" style="font-size: 0.9rem;">Daftar dan lengkapi dokumen diperlukan</p>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 text-center">
                    <div style="width: 70px; height: 70px; background: var(--secondary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 15px; font-weight: bold;">3</div>
                    <h5 style="color: var(--primary); font-weight: 600;">Visa & Dokumen</h5>
                    <p class="text-muted" style="font-size: 0.9rem;">Kami urus proses visa & dokumen</p>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 text-center">
                    <div style="width: 70px; height: 70px; background: var(--secondary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 15px; font-weight: bold;">4</div>
                    <h5 style="color: var(--primary); font-weight: 600;">Briefing</h5>
                    <p class="text-muted" style="font-size: 0.9rem;">Ikuti briefing & persiapan keberangkatan</p>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 text-center">
                    <div style="width: 70px; height: 70px; background: var(--secondary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 15px; font-weight: bold;">5</div>
                    <h5 style="color: var(--primary); font-weight: 600;">Keberangkatan</h5>
                    <p class="text-muted" style="font-size: 0.9rem;">Terbang menuju Kota Suci bersama kami</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--primary); font-weight: bold;">
                <i class="fas fa-circle-question"></i> Pertanyaan yang Sering Diajukan
            </h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item" style="border-color: var(--secondary);">
                            <h2 class="accordion-header">
                                <button class="accordion-button" style="background: rgba(139,45,45,0.05); color: var(--primary); font-weight: 600;" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Berapa lama proses visa umroh?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Proses visa umroh biasanya memakan waktu 2-3 minggu tergantung kondisi dokumen Anda. Kami akan menginformasikan jadwal yang pasti setelah konsultasi awal.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" style="border-color: var(--secondary);">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" style="background: rgba(139,45,45,0.05); color: var(--primary); font-weight: 600;" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Apa saja yang sudah termasuk dalam paket?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Paket kami mencakup: tiket pesawat, akomodasi bintang 3/4, transportasi lokal, makan, umroh, dan pendampingan pemandu. Detail spesifik dapat dilihat di halaman paket.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" style="border-color: var(--secondary);">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" style="background: rgba(139,45,45,0.05); color: var(--primary); font-weight: 600;" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Apakah ada jaminan pengembalian dana?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Kami menawarkan kebijakan pengembalian dana jika pembatalan dilakukan minimal 30 hari sebelum keberangkatan. Untuk detail, silakan hubungi tim customer service kami.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" style="border-color: var(--secondary);">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" style="background: rgba(139,45,45,0.05); color: var(--primary); font-weight: 600;" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Bagaimana cara membayar paket umroh?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Pembayaran dapat dilakukan melalui transfer bank, cicilan (dengan bunga minimal), atau metode pembayaran lainnya. Hubungi kami untuk detail pembayaran yang lebih lengkap.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

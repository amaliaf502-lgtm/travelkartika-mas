@extends('layouts.app')

@section('title', 'Paket Umroh - Travelkartika Mas')

@section('content')
    <style>
        .pakets-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 16px;
            margin-bottom: 30px;
        }

        .paket-brochure {
            background: white;
            border: 3px solid #8B4513;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0,0,0,0.18);
            transition: transform 0.3s ease;
            height: 100%;
        }

        .paket-brochure:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.3);
        }

        /* Header Brochure */
        .brochure-header {
            background: linear-gradient(135deg, #8B0000 0%, #C41E3A 100%);
            padding: 15px 12px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .brochure-header h2 {
            margin: 0 0 3px;
            font-size: 1.9rem;
            font-weight: bold;
            font-style: italic;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .brochure-header .subtitle {
            font-size: 0.85rem;
            letter-spacing: 2px;
            margin: 0;
        }

        /* Info Sponsor & Penerbangan */
        .brochure-airlines {
            background: #f9f9f9;
            padding: 8px 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 0.7rem;
            color: #666;
        }

        .brochure-airlines i {
            color: #8B0000;
            margin-right: 5px;
        }

        /* Hotel Info Section */
        .hotel-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            padding: 12px;
            background: white;
            border-bottom: 2px solid #e0e0e0;
        }

        .hotel-item {
            text-align: center;
            padding: 0 8px;
        }

        .hotel-item:first-child {
            border-right: 1px solid #ddd;
        }

        .hotel-item h5 {
            font-size: 0.75rem;
            font-weight: bold;
            color: #333;
            margin: 0 0 4px;
            text-transform: uppercase;
        }

        .hotel-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 3px 0;
        }

        .hotel-rating {
            color: #FFD700;
            font-size: 0.75rem;
            margin: 2px 0;
        }

        .hotel-rating-text {
            display: block;
            font-size: 0.65rem;
            color: #666;
            margin-top: 1px;
        }

        /* Gambar Paket */
        .gambar-paket {
            position: relative;
            width: 100%;
            aspect-ratio: 1 / 1;
            max-height: 220px;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gambar-paket img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .durasi-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #be2626c4;
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 0.75rem;
            z-index: 10;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        /* Harga Section */
        .harga-section {
            background: linear-gradient(135deg, #8B0000 0%, #C41E3A  100%);
            padding: 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            gap: 2px;
        }

        .harga-item {
            flex: 1;
            text-align: center;
            padding: 10px;
            background: white;
            margin: 3px;
            border-radius: 4px;
        }

        .harga-item.active {
            background: white;
            color: #333;
        }

        .harga-item .tipe {
            font-size: 0.7rem;
            font-weight: bold;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 4px;
            display: block;
            background: #8B0000;
            color: white;
            padding: 3px;
            border-radius: 3px;
        }

        .harga-item.active .tipe {
            background: #8B0000 ;
            color: white;
        }

        .harga-nilai {
            font-size: 1.4rem;
            font-weight: bold;
            color: #8B0000;
            line-height: 1.2;
            margin: 3px 0;
        }

        .harga-item.active .harga-nilai {
            color: #8B0000;
        }

        .kapasitas {
            font-size: 0.65rem;
            color: #666;
            margin-top: 2px;
        }

        .harga-item.active .kapasitas {
            color: #333;
        }

        /* Fasilitas Section */
        .fasilitas-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            padding: 10px;
            background: white;
        }
        .fasilitas-item span {
            color: #000 !important;
        }
        .fasilitas-col {
            padding: 0 8px;
        }
        .fasilitas-item {
            font-size: 0.7rem;
        }
        
        .fasilitas-col:first-child {
            border-right: 2px solid #ddd;
        }

        .fasilitas-title {
            font-weight: bold;
            margin-bottom: 7px;
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .fasilitas-title.includes {
            color: #28a745;
        }

        .fasilitas-title.excludes {
            color: #dc3545;
        }

        .fasilitas-list {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .fasilitas-item {
            display: flex;
            align-items: flex-start;
            gap: 4px;
            font-size: 0.7rem;
            line-height: 1.3;
        }

        .fasilitas-item i {
            flex-shrink: 0;
            margin-top: 1px;
            font-size: 0.65rem;
        }

        .fasilitas-item.include i {
            color: #28a745;
        }

        .fasilitas-item.exclude i {
            color: #be2626c4;
        }

        /* Gallery */
        .gallery-section {
            display: flex;
            gap: 8px;
            padding: 10px;
            background: #f5f5f5;
            justify-content: center;
            flex-wrap: wrap;
            border-top: 2px solid #e0e0e0;
        }

        .gallery-img {
            width: 80px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            transition: transform 0.2s ease;
            border: 2px solid #ddd;
        }

        .gallery-img:hover {
            transform: scale(1.05);
            border-color: #8B0000;
        }

        .gallery-label {
            font-size: 0.6rem;
            text-align: center;
            margin-top: 2px;
            color: #666;
            max-width: 80px;
        }

        .gallery-item {
            text-align: center;
        }

        /* Footer */
        .brochure-footer {
            padding: 10px;
            background: #f9f9f9;
            border-top: 2px solid #e0e0e0;
            text-align: center;
        }

        .kuota-info {
            font-size: 0.75rem;
            color: #666;
            margin-bottom: 8px;
        }

        .btn-pesan {
            background: linear-gradient(135deg, #8B0000 0%, #C41E3A 100%);
            color: white;
            padding: 8px 18px;
            border-radius: 20px;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
            font-size: 0.8rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-pesan:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.4);
            color: white;
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, #8B0000 0%, #8B0000 100%);
            color: white;
            padding: 80px 0 120px;
            text-align: center;
            position: relative;
            overflow: hidden;
            margin-bottom: 0;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,0.03) 35px, rgba(255,255,255,0.03) 70px),
                repeating-linear-gradient(-45deg, transparent, transparent 35px, rgba(255,255,255,0.03) 35px, rgba(255,255,255,0.03) 70px);
            pointer-events: none;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 100px;
            background: white;
            clip-path: polygon(0 30%, 100% 0%, 100% 100%, 0 100%);
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero-subtitle {
            font-size: 1rem;
            letter-spacing: 1px;
            margin-bottom: 10px;
            font-weight: 500;
            opacity: 0.9;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.95;
            padding-top: 20px;
        }

        @media (max-width: 768px) {
            .hero {
                padding: 60px 0 100px;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 0.9rem;
            }

            .hero p {
                font-size: 1rem;
            }

        @media (max-width: 768px) {
            .brochure-header h2 {
                font-size: 1.6rem;
            }

            .harga-nilai {
                font-size: 1.2rem;
            }

            .gallery-img {
                width: 70px;
                height: 45px;
            }

            .pakets-grid {
                grid-template-columns: 1fr;
            }

            .hero {
                padding: 60px 0 100px;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 0.9rem;
            }

            .hero p {
                font-size: 1rem;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <p class="hero-subtitle">Paket Terkini</p>
            <h1>Paket Umroh Hemat</h1>
            <p>Pilih paket yang sesuai dengan kebutuhan dan budget Anda</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            @if($pakets->count() > 0)
                <div class="pakets-grid">
                    @foreach($pakets->take(3) as $paket)
                        <div class="paket-brochure">
                            <!-- Header -->
                            <div class="brochure-header">
                                <h2>{{ $paket->nama_paket }}</h2>
                                <p class="subtitle">JANUARI & MARET</p>
                            </div>

                            <!-- Airlines Info -->
                            <div class="brochure-airlines">
                                <i class="fas fa-plane"></i> Fly by Qatar Airways | Sponsor: Kementerian Agama
                            </div>

                            <!-- Hotel Info -->
                            <div class="hotel-section">
                                <div class="hotel-item">
                                    <h5>Hotel Makkah:</h5>
                                    <div class="hotel-name">Ramada Al Fayzen</div>
                                    <div class="hotel-rating">
                                        ★★★
                                        <span class="hotel-rating-text">Bintang 3</span>
                                    </div>
                                </div>
                                <div class="hotel-item">
                                    <h5>Hotel Madinah:</h5>
                                    <div class="hotel-name">Mokhtara</div>
                                    <div class="hotel-rating">
                                        ★★★
                                        <span class="hotel-rating-text">Bintang 3</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Gambar -->
                            <div class="gambar-paket">
                                @if($paket->gambar)
                                    <img src="{{ $paket->gambar }}" alt="{{ $paket->nama_paket }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1564507592333-c60657eea523?w=500&h=200&fit=crop" alt="Ka'bah">
                                @endif
                                <div class="durasi-badge">
                                    {{ $paket->durasi_hari }} Hari
                                </div>
                            </div>

                            <!-- Harga (3 Kolom) -->
                            <div class="harga-section">
                                <div class="harga-item active">
                                    <span class="tipe">QUAD</span>
                                    <div class="harga-nilai">Rp {{ ceil($paket->harga / 1000000) }}*</div>
                                    <div class="kapasitas">4 Orang</div>
                                </div>
                                <div class="harga-item">
                                    <span class="tipe">TRIPLE</span>
                                    <div class="harga-nilai">Rp {{ ceil($paket->harga * 1.05 / 1000000) }}*</div>
                                    <div class="kapasitas">3 Orang</div>
                                </div>
                                <div class="harga-item">
                                    <span class="tipe">DOUBLE</span>
                                    <div class="harga-nilai">Rp {{ ceil($paket->harga * 1.1 / 1000000) }}*</div>
                                    <div class="kapasitas">2 Orang</div>
                                </div>
                            </div>

                            <!-- Fasilitas Include/Exclude -->
                            <div class="fasilitas-section">
                                <div class="fasilitas-col">
                                    <div class="fasilitas-title includes">
                                        <i class="fas fa-check-circle"></i> PRICE INCLUDES
                                    </div>
                                    <div class="fasilitas-col-list">
                                        <div class="fasilitas-item include">
                                            <i class="fas fa-check"></i>
                                            <span>Tiket Pesawat</span>
                                        </div>
                                        <div class="fasilitas-item include">
                                            <i class="fas fa-check"></i>
                                            <span>Hotel Makkah & Madinah</span>
                                        </div>
                                        <div class="fasilitas-item include">
                                            <i class="fas fa-check"></i>
                                            <span>Makan 3x Sehari</span>
                                        </div>
                                        <div class="fasilitas-item include">
                                            <i class="fas fa-check"></i>
                                            <span>Tour Guide Resmi</span>
                                        </div>
                                        <div class="fasilitas-item include">
                                            <i class="fas fa-check"></i>
                                            <span>Transportasi Darat</span>
                                        </div>
                                        <div class="fasilitas-item include">
                                            <i class="fas fa-check"></i>
                                            <span>Asuransi Perjalanan</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="fasilitas-col">
                                    <div class="fasilitas-title excludes">
                                        <i class="fas fa-times-circle"></i> PRICE EXCLUDES
                                    </div>
                                    <div class="fasilitas-list">
                                        <div class="fasilitas-item exclude">
                                            <i class="fas fa-times"></i>
                                            <span>Visa & Dokumen</span>
                                        </div>
                                        <div class="fasilitas-item exclude">
                                            <i class="fas fa-times"></i>
                                            <span>Pemeriksaan Medis</span>
                                        </div>
                                        <div class="fasilitas-item exclude">
                                            <i class="fas fa-times"></i>
                                            <span>Koper & Tas</span>
                                        </div>
                                        <div class="fasilitas-item exclude">
                                            <i class="fas fa-times"></i>
                                            <span>Tour Mandiri</span>
                                        </div>
                                        <div class="fasilitas-item exclude">
                                            <i class="fas fa-times"></i>
                                            <span>Pengeluaran Pribadi</span>
                                        </div>
                                        <div class="fasilitas-item exclude">
                                            <i class="fas fa-times"></i>
                                            <span>Tambahan Optional</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gallery -->
                            <div class="gallery-section">
                                <div class="gallery-item">
                                    <img src="https://images.unsplash.com/photo-1564507592333-c60657eea523?w=80&h=50&fit=crop" alt="Kaaba" class="gallery-img" title="Masjidil Haram">
                                    <div class="gallery-label">Kaaba Hararam</div>
                                </div>
                                <div class="gallery-item">
                                    <img src="https://images.unsplash.com/photo-1499209974431-9dddcece7f88?w=80&h=50&fit=crop" alt="Masjid" class="gallery-img" title="Masjid Nabawi">
                                    <div class="gallery-label">Masjid Nabawi</div>
                                </div>
                                <div class="gallery-item">
                                    <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=80&h=50&fit=crop" alt="Ziyarah" class="gallery-img" title="Ziyarah">
                                    <div class="gallery-label">Ziyarah HL</div>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="brochure-footer">
                                <div class="kuota-info">
                                    <i class="fas fa-users"></i> Tersedia: <strong>{{ $paket->tersedia }}/{{ $paket->kuota }}</strong> kursi
                                </div>
                                <a href="{{ route('pakets.show', $paket) }}" class="btn-pesan">
                                    <i class="fas fa-arrow-right"></i> Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $pakets->links() }}
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> Belum ada paket umroh tersedia saat ini.
                </div>
            @endif
        </div>
    </section>
@endsection

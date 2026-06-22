@extends('layouts.app')

@section('title', 'Paket Umroh - Kartika Mas Tour & Travel')

@section('content')
    <style>
        .pakets-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }

        .paket-card {
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid rgba(0,0,0,0.05);
            height: 100%;
        }
        .paket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        }
        .paket-img-wrapper {
            height: 160px;
            overflow: hidden;
            position: relative;
            background-color: #fcfcfc;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .paket-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
            padding: 10px;
        }
        .lightbox-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 10;
            border-radius: 16px 16px 0 0;
        }
        .lightbox-overlay i {
            font-size: 2.2rem;
            margin-bottom: 8px;
            transform: scale(0.8);
            transition: transform 0.3s ease;
        }
        .paket-img-wrapper:hover .lightbox-overlay {
            opacity: 1;
        }
        .paket-img-wrapper:hover .lightbox-overlay i {
            transform: scale(1);
        }
        .paket-card:hover .paket-img-wrapper img {
            transform: scale(1.05);
        }
        .paket-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--primary);
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .paket-price {
            font-size: 1.4rem;
            font-weight: 900;
            color: var(--primary);
        }
        .btn-pesan {
            background: var(--primary);
            color: white;
            border-radius: 25px;
            font-weight: bold;
            padding: 8px 24px;
            transition: all 0.3s ease;
        }
        .btn-pesan:hover {
            background: #6b1010;
            color: white;
        }

        /* Hero */
        .hero {
            background: var(--primary);
            color: white;
            padding: 35px 0 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
            margin-bottom: 0;
        }

        /* Removed hero::after to make banner flat and save space */

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero-subtitle {
            font-size: 1rem;
            letter-spacing: 1px;
            margin-bottom: 8px;
            font-weight: 500;
            opacity: 0.9;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .hero p {
            font-size: 1.1rem;
            opacity: 0.95;
            padding-top: 10px;
            margin-bottom: 0;
        }

        @media (max-width: 991px) {
            .pakets-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .pakets-grid {
                grid-template-columns: 1fr;
            }

            .gambar-paket {
                height: 145px;
                max-height: 145px;
            }

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

    <section class="py-4">
        <div class="container">
            @if($pakets->count() > 0)
                <div class="pakets-grid">
                    @foreach($pakets as $paket)
                        <div class="paket-card d-flex flex-column">
                            <!-- Image Banner -->
                            @if($paket->gambar)
                                @php
                                    $imgUrl = Str::startsWith($paket->gambar, 'images/') ? asset($paket->gambar) : Storage::url($paket->gambar);
                                @endphp
                                <div class="paket-img-wrapper" style="cursor: zoom-in;" onclick="openLightbox('{{ $imgUrl }}')" data-bs-toggle="modal" data-bs-target="#imageLightboxModal">
                                    <img src="{{ $imgUrl }}" alt="{{ $paket->nama_paket }}">
                                    <div class="paket-badge"><i class="fas fa-clock me-1"></i> {{ $paket->durasi_hari }} Hari</div>
                                    <div class="lightbox-overlay">
                                        <i class="fas fa-search-plus"></i> Lihat Brosur
                                    </div>
                                </div>
                            @endif

                            <div class="card-body p-3 d-flex flex-column flex-grow-1">
                                <h5 class="card-title fw-bold mb-2">{{ $paket->nama_paket }}</h5>
                                
                                <div class="mb-2 text-muted" style="font-size: 0.9rem;">
                                    <div class="mb-1"><i class="fas fa-calendar-alt me-2 text-primary"></i> Berangkat: <strong>{{ $paket->tanggal_berangkat->format('d M Y') }}</strong></div>
                                    <div class="mb-1"><i class="fas fa-plane-departure me-2 text-primary"></i> Maskapai: <strong>{{ $paket->maskapai ?? 'Saudi Airlines' }}</strong></div>
                                    <div><i class="fas fa-users me-2 text-primary"></i> Sisa Kuota: <strong>{{ $paket->tersedia }}/{{ $paket->kuota }}</strong></div>
                                </div>
                                
                                <div class="mt-auto pt-2 border-top">
                                    <span class="d-block text-muted" style="font-size: 0.8rem;">Mulai dari</span>
                                    <div class="paket-price mb-2" style="font-size: 1.2rem;">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                                    
                                    <a href="{{ route('pakets.show', $paket) }}" class="btn btn-pesan w-100 text-center text-decoration-none py-2">
                                        Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
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

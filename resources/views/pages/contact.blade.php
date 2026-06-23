@extends('layouts.app')

@section('title', 'Kontak Kami - Kartika Mas Tour & Travel')

@section('content')
<style>
    /* Styling khusus halaman kontak TA (Mudah Dijelaskan) */
    .contact-wrapper {
        background-color: #FAF9F6;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding-bottom: 60px;
    }

    /* Hero Section */
    .contact-hero {
        background: linear-gradient(135deg, var(--primary) 0%, #520f0f 100%);
        padding: 80px 0;
        color: white;
        text-align: center;
        margin-bottom: -50px; /* Overlap effect for cards */
    }
    .contact-hero h1 {
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 15px;
    }
    .contact-hero p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto 30px;
        line-height: 1.6;
    }

    /* Info Cards (Grid 3 Kolom) */
    .info-container {
        position: relative;
        z-index: 10;
    }
    .info-card {
        background: #fff;
        border-radius: 15px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(139, 45, 45, 0.08);
        border: 1px solid rgba(139, 45, 45, 0.05);
        height: 100%;
        transition: transform 0.3s;
    }
    .info-card:hover {
        transform: translateY(-5px);
    }
    .info-card-icon {
        width: 70px;
        height: 70px;
        background-color: rgba(139, 45, 45, 0.08);
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin: 0 auto 20px;
    }
    .info-card h5 {
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 15px;
        font-size: 1.2rem;
    }
    .info-card p, .info-card a {
        color: #555;
        font-size: 1.05rem;
        text-decoration: none;
        margin-bottom: 0;
        line-height: 1.6;
    }
    .info-card a:hover {
        color: var(--primary);
        text-decoration: underline;
    }

    /* WhatsApp Button */
    .wa-section {
        text-align: center;
        padding: 60px 0 40px;
    }
    .btn-wa-huge {
        background-color: #25D366;
        color: #fff;
        padding: 16px 40px;
        border-radius: 50px;
        font-size: 1.2rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 15px;
        text-decoration: none;
        box-shadow: 0 10px 30px rgba(37, 211, 102, 0.3);
        transition: all 0.3s ease;
    }
    .btn-wa-huge:hover {
        background-color: #1ebe59;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(37, 211, 102, 0.4);
    }
    .btn-wa-huge i {
        font-size: 1.5rem;
    }

    /* Maps & Social */
    .maps-section {
        padding-top: 40px;
    }
    .maps-wrapper {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        border: 2px solid #fff;
    }
</style>

<div class="contact-wrapper">
    
    {{-- Hero Section --}}
    <div class="contact-hero">
        <div class="container">
            <h1>Kontak & Informasi Layanan</h1>
            <p>Sistem pendaftaran paket umroh kami dirancang untuk beroperasi secara otomatis. Jika Anda membutuhkan informasi lebih lanjut mengenai profil perusahaan atau bantuan teknis, Anda dapat menghubungi kami melalui informasi di bawah ini.</p>
        </div>
    </div>

    {{-- Info Cards Section --}}
    <div class="container info-container">
        <div class="row g-4">
            {{-- Telepon --}}
            <div class="col-lg-4 col-md-6">
                <div class="info-card">
                    <div class="info-card-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h5>Layanan Telepon</h5>
                    <p style="text-align: left; display: inline-block;">
                        <strong>Marketing:</strong> <a href="tel:081977488886">0819-7748-8886</a><br>
                        <strong>Admin 1:</strong> <a href="tel:0812600055">0812-6000-55</a><br>
                        <strong>Admin 2:</strong> <a href="tel:081933777763">0819-3377-7763</a>
                    </p>
                </div>
            </div>
            
            {{-- Email --}}
            <div class="col-lg-4 col-md-6">
                <div class="info-card">
                    <div class="info-card-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h5>Email Resmi</h5>
                    <p>
                        <a href="mailto:customer@kartika-mas.id">customer@kartika-mas.id</a>
                    </p>
                    <p class="text-muted" style="font-size: 0.9rem; margin-top: 5px;">(Respons 1x24 Jam Kerja)</p>
                </div>
            </div>
            
            {{-- Alamat --}}
            <div class="col-lg-4 col-md-12">
                <div class="info-card">
                    <div class="info-card-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h5>Alamat Kantor</h5>
                    <p>Jl. Barito II No.47 2, RT.2/RW.7, Kramat Pela, Kebayoran Baru, Jakarta Selatan 12130</p>
                </div>
            </div>
        </div>
    </div>

    {{-- WhatsApp Action Section --}}
    <div class="wa-section">
        <div class="container">
            <h4 class="mb-4" style="color: var(--primary); font-weight: 700;">Butuh Respons Cepat?</h4>
            <a href="https://wa.me/62812600055" target="_blank" class="btn-wa-huge">
                <i class="fab fa-whatsapp"></i> Chat WhatsApp Admin
            </a>
            <p class="text-muted mt-3">
                Senin - Jumat (09.00 - 16.00 WIB) &amp; Sabtu (09.00 - 15.00 WIB).
            </p>
        </div>
    </div>

    {{-- Google Maps Section --}}
    <div class="maps-section">
        <div class="container">
            <h4 class="fw-bold mb-4 text-center" style="color: var(--primary);"><i class="fas fa-map-marked-alt me-2"></i>Peta Lokasi Kami</h4>
            <div class="maps-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4258!2d106.7972!3d-6.2450!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1d2e3f0c1a1%3A0x0!2zSmwuIEJhcml0byBJSSBOby40NywgSmFrYXJ0YSBTZWxhdGFu!5e0!3m2!1sid!2sid!4v1"
                    width="100%" height="400" style="border:0; display:block;"
                    allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

</div>
@endsection

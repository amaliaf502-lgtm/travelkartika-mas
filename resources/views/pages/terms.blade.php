@extends('layouts.app')

@section('title', 'Syarat & Ketentuan - Kartika Mas Tour & Travel')

@section('content')
<style>
    .page-header-terms {
        background: linear-gradient(135deg, #8B0000 0%, #6b0000 100%);
        color: white;
        padding: 70px 0 60px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .terms-section-card {
        background: #fff;
        border-radius: 18px;
        padding: 30px 32px;
        margin-bottom: 24px;
        box-shadow: 0 4px 20px rgba(139,0,0,0.06);
        border-left: 5px solid #8B0000;
    }
    .terms-section-card h4 {
        color: #8B0000;
        font-weight: 700;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .terms-section-card h4 i {
        color: #DAA520;
        font-size: 1.1rem;
    }
    .terms-section-card ol li, .terms-section-card ul li {
        color: #444;
        line-height: 1.8;
        margin-bottom: 6px;
    }
    .terms-highlight {
        background: linear-gradient(135deg, #8B0000, #DAA520);
        color: white;
        border-radius: 16px;
        padding: 28px 32px;
        margin-top: 32px;
        text-align: center;
    }
    .terms-highlight p { color: rgba(255,255,255,0.9); margin: 0; }
    .terms-date {
        background: #fff3cd;
        border-radius: 12px;
        padding: 14px 20px;
        border-left: 4px solid #DAA520;
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 30px;
    }
</style>

{{-- Hero --}}
<div class="page-header-terms">
    <div class="container">
        <i class="fas fa-file-contract fa-3x mb-3" style="color:#DAA520; opacity:0.9;"></i>
        <h1 class="display-5 fw-bold">Syarat & Ketentuan</h1>
        <p class="lead mb-0" style="color:rgba(255,255,255,0.85);">Ketentuan penggunaan layanan Kartika Mas Tour & Travel</p>
    </div>
</div>

<div style="background:#f8f9fa; padding: 60px 0;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="terms-date">
                <i class="fas fa-calendar-alt me-2" style="color:#DAA520;"></i>
                Terakhir diperbarui: <strong>Mei 2026</strong>. Dengan menggunakan layanan kami, Anda dianggap telah membaca dan menyetujui seluruh syarat dan ketentuan berikut.
            </div>

            {{-- 1. Umum --}}
            <div class="terms-section-card">
                <h4><i class="fas fa-info-circle"></i> 1. Ketentuan Umum</h4>
                <ol>
                    <li>Layanan pemesanan paket Umroh Kartika Mas Tour & Travel dilakukan melalui website resmi ini.</li>
                    <li>Jamaah diwajibkan memberikan data diri yang benar, lengkap, dan valid sesuai dokumen resmi (KTP, Paspor, KK).</li>
                    <li>Seluruh informasi yang diberikan jamaah bersifat rahasia dan dilindungi sesuai kebijakan privasi kami.</li>
                    <li>Kartika Mas Tour & Travel berhak membatalkan pesanan jika ditemukan data yang tidak valid atau tidak sesuai.</li>
                </ol>
            </div>

            {{-- 2. Pemesanan --}}
            <div class="terms-section-card">
                <h4><i class="fas fa-clipboard-list"></i> 2. Pemesanan Paket</h4>
                <ol>
                    <li>Pemesanan dianggap sah setelah jamaah berhasil submit formulir pemesanan melalui website.</li>
                    <li>Status pesanan awal adalah <strong>"Menunggu Konfirmasi"</strong> (Pending) hingga pembayaran diterima dan diverifikasi oleh admin.</li>
                    <li>Kuota pada setiap paket bersifat terbatas. Pemesanan akan otomatis ditolak jika kuota telah habis.</li>
                    <li>Satu akun hanya dapat mewakili pesanan satu grup keberangkatan pada waktu yang sama.</li>
                </ol>
            </div>

            {{-- 3. Pembayaran --}}
            <div class="terms-section-card">
                <h4><i class="fas fa-credit-card"></i> 3. Pembayaran</h4>
                <ol>
                    <li>Jamaah dapat melakukan pembayaran DP minimal 10% dari total harga paket untuk mengamankan kursi (booking seat).</li>
                    <li>Pelunasan dilakukan selambat-lambatnya <strong>45 hari</strong> sebelum tanggal keberangkatan.</li>
                    <li>Bukti pembayaran wajib diunggah melalui dashboard akun jamaah untuk verifikasi.</li>
                    <li>Pembayaran yang telah dikonfirmasi tidak dapat dikembalikan (non-refundable) kecuali terdapat pembatalan dari pihak travel.</li>
                    <li>Biaya administrasi sebesar 5% akan dikenakan untuk proses refund yang disetujui.</li>
                </ol>
            </div>

            {{-- 4. Pembatalan --}}
            <div class="terms-section-card">
                <h4><i class="fas fa-times-circle"></i> 4. Pembatalan & Refund</h4>
                <ol>
                    <li>Pembatalan oleh jamaah hanya dapat dilakukan selama status pesanan masih <strong>"Menunggu Konfirmasi"</strong>.</li>
                    <li>Pembatalan setelah konfirmasi pembayaran akan dikenakan biaya sesuai kebijakan berikut:
                        <ul class="mt-2">
                            <li>Lebih dari 60 hari sebelum keberangkatan: potongan 25%</li>
                            <li>30–60 hari sebelum keberangkatan: potongan 50%</li>
                            <li>Kurang dari 30 hari sebelum keberangkatan: potongan 100% (tidak ada refund)</li>
                        </ul>
                    </li>
                    <li>Pembatalan akibat force majeure (bencana alam, wabah, larangan pemerintah) akan ditangani secara khusus.</li>
                </ol>
            </div>

            {{-- 5. Dokumen --}}
            <div class="terms-section-card">
                <h4><i class="fas fa-id-card"></i> 5. Persyaratan Dokumen Jamaah</h4>
                <ol>
                    <li>Jamaah wajib memiliki Paspor yang masih berlaku minimal <strong>7 bulan</strong> dari tanggal keberangkatan.</li>
                    <li>Dokumen yang diperlukan: KTP, KK (Kartu Keluarga), Paspor, dan Surat Nikah (bagi pasangan suami-istri).</li>
                    <li>Seluruh dokumen wajib diunggah melalui fitur "Lengkapi Data" di dashboard akun paling lambat <strong>60 hari</strong> sebelum keberangkatan.</li>
                    <li>Keterlambatan penyerahan dokumen dapat berdampak pada pengurusan visa yang tertunda.</li>
                </ol>
            </div>

            {{-- 6. Hak & Kewajiban --}}
            <div class="terms-section-card">
                <h4><i class="fas fa-handshake"></i> 6. Hak & Kewajiban Travel</h4>
                <ol>
                    <li>Kartika Mas Tour & Travel berhak mengubah jadwal, hotel, atau maskapai setara apabila terdapat kondisi di luar kendali (force majeure).</li>
                    <li>Travel berkewajiban memberikan informasi keberangkatan yang akurat dan tepat waktu kepada jamaah.</li>
                    <li>Fasilitas yang tertera di paket adalah fasilitas standar dan dapat berbeda jika ada perubahan dari pihak penyedia di Arab Saudi.</li>
                    <li>Travel tidak bertanggung jawab atas barang bawaan jamaah yang hilang atau rusak di luar tanggung jawab pihak travel.</li>
                </ol>
            </div>

            {{-- Footer --}}
            <div class="terms-highlight">
                <i class="fas fa-mosque fa-2x mb-3" style="color:rgba(255,255,255,0.8);"></i>
                <h5 class="fw-bold mb-2">Ada Pertanyaan tentang S&K Ini?</h5>
                <p>Hubungi tim kami melalui WhatsApp atau email. Kami siap membantu menjelaskan dengan detail.</p>
                <a href="{{ route('pages.contact') }}" class="btn mt-3" style="background:#DAA520; color:#fff; border-radius:30px; padding:10px 28px; font-weight:700;">
                    <i class="fas fa-headset me-2"></i> Hubungi Kami
                </a>
            </div>

        </div>
    </div>
</div>
</div>
@endsection

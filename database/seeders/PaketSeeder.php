<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paket;
use Carbon\Carbon;

class PaketSeeder extends Seeder
{
    public function run(): void
    {
        $pakets = [
            [
                'nama_paket' => 'Umroh Plus Al-Aqsa 9 Hari',
                'deskripsi' => 'Paket umroh dengan tambahan kunjungan ke Masjid Al-Aqsa di Palestina. Pengalaman spiritual yang mendalam dengan pemandu berpengalaman.',
                'durasi_hari' => 9,
                'harga' => 15000000,
                'kuota' => 40,
                'tersedia' => 40,
                'tanggal_berangkat' => Carbon::create(2026, 3, 1),
                'tanggal_kembali' => Carbon::create(2026, 3, 9),
                'fasilitas' => 'Penerbangan langsung dari Indonesia
Hotel bintang 4 di Mekkah dan Madinah
Makanan sesuai standar halal
Pemandu wisata berpengalaman
Asuransi perjalanan
Vaksinasi dan pemeriksaan kesehatan
Luggage handling untuk setiap peserta
Sims card gratis untuk komunikasi',
                'itinerari' => 'Hari 1: Keberangkatan dari Indonesia
Hari 2: Tiba di Mekkah, check-in hotel, istirahat
Hari 3: Umroh (Tawaf, Sa\'i, Tahallul)
Hari 4-5: Ibadah tambahan di Masjidil Haram, shopping di Mekkah
Hari 6: Perjalanan ke Madinah
Hari 7-8: Ibadah di Masjid Nabawi, ziarah ke Masjid Quba\'
Hari 9: Kembali ke Indonesia',
                'status' => 'aktif',
            ],
            [
                'nama_paket' => 'Umroh Reguler 8 Hari',
                'deskripsi' => 'Paket umroh standar dengan fokus pada ibadah di Mekkah dan Madinah. Cocok untuk pemula dengan harga terjangkau.',
                'durasi_hari' => 8,
                'harga' => 12000000,
                'kuota' => 50,
                'tersedia' => 50,
                'tanggal_berangkat' => Carbon::create(2026, 2, 15),
                'tanggal_kembali' => Carbon::create(2026, 2, 22),
                'fasilitas' => 'Penerbangan dari Indonesia
Hotel bintang 3 di Mekkah dan Madinah
Makanan 3x sehari
Pemandu wisata profesional
Asuransi perjalanan dasar
Vaksinasi dan pengurusan visa',
                'itinerari' => 'Hari 1: Keberangkatan dari Indonesia
Hari 2: Tiba di Mekkah
Hari 3-4: Umroh (Tawaf, Sa\'i, Tahallul)
Hari 5-6: Ibadah dan shopping di Mekkah
Hari 7: Perjalanan ke Madinah
Hari 8: Ibadah di Madinah dan kembali',
                'status' => 'aktif',
            ],
            [
                'nama_paket' => 'Umroh Premium Ramadhan 10 Hari',
                'deskripsi' => 'Paket umroh eksklusif selama bulan Ramadhan dengan fasilitas premium dan layanan VIP.',
                'durasi_hari' => 10,
                'harga' => 20000000,
                'kuota' => 25,
                'tersedia' => 10,
                'tanggal_berangkat' => Carbon::create(2026, 2, 28),
                'tanggal_kembali' => Carbon::create(2026, 3, 9),
                'fasilitas' => 'Penerbangan business class
Hotel bintang 5 di Mekkah dan Madinah
Makanan premium (chef khusus)
Pemandu wisata eksklusif
Asuransi perjalanan premium
Butler service
Ziarah tambahan ke situs bersejarah Islam
Paket transportasi pribadi',
                'itinerari' => 'Hari 1: Keberangkatan dari Indonesia
Hari 2: Tiba di Mekkah, welcome dinner
Hari 3-5: Umroh dan ibadah Ramadhan
Hari 6-7: Kegiatan sosial dan shopping eksklusif
Hari 8: Perjalanan ke Madinah
Hari 9-10: Ibadah di Madinah dan acara penutupan',
                'status' => 'aktif',
            ],
            [
                'nama_paket' => 'Umroh Keluarga 7 Hari',
                'deskripsi' => 'Paket khusus untuk keluarga dengan jadwal yang fleksibel dan akomodasi keluarga yang nyaman.',
                'durasi_hari' => 7,
                'harga' => 11000000,
                'kuota' => 30,
                'tersedia' => 5,
                'tanggal_berangkat' => Carbon::create(2026, 4, 10),
                'tanggal_kembali' => Carbon::create(2026, 4, 16),
                'fasilitas' => 'Penerbangan kelas ekonomi
Akomodasi keluarga (kamar dengan 2-3 tempat tidur)
Makanan keluarga
Pemandu wisata ramah keluarga
Asuransi perjalanan
Program khusus untuk anak-anak
Kids club dan babysitting service',
                'itinerari' => 'Hari 1: Keberangkatan dari Indonesia
Hari 2: Tiba di Mekkah
Hari 3-4: Umroh bersama keluarga
Hari 5: Kegiatan keluarga dan shopping
Hari 6: Perjalanan ke Madinah
Hari 7: Ibadah dan kembali ke Indonesia',
                'status' => 'aktif',
            ],
        ];

        foreach ($pakets as $paket) {
            Paket::create($paket);
        }
    }
}

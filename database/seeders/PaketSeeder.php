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
                'nama_paket' => 'Umroh Premium September',
                'deskripsi' => 'Nikmati perjalanan ibadah premium di bulan September dengan fasilitas bintang 5 terbaik. Penerbangan nyaman langsung menggunakan Saudia Airlines.',
                'durasi_hari' => 9,
                'harga' => 125000,
                'harga_triple' => 135000,
                'harga_double' => 145000,
                'kuota' => 25,
                'tersedia' => 25,
                'tanggal_berangkat' => Carbon::create(2026, 9, 10),
                'tanggal_kembali' => Carbon::create(2026, 9, 18),
                'fasilitas' => 'Tiket Pesawat SV Direct
Visa & Transportasi Bus VIP
Hotel Bintang 5 Dekat Masjidil Haram & Nabawi
Handling JKT & KSA
Welcome Snack & Fruit in Room
Muthawif / Muthawifah
Snack City Tour
Air Zamzam 5L
Manasik 2x
Perlengkapan Exclusive
Free: Kereta Cepat Haramain, Karak Chicken, Museum Wahyu, Museum As Safiyyah',

                'status' => 'aktif',
                'hotel_makkah_nama' => 'Marwa Rotanna',
                'hotel_makkah_bintang' => 5,
                'hotel_makkah_jarak' => '0 meter (Pelataran)',
                'hotel_madinah_nama' => 'Emaar Royal',
                'hotel_madinah_bintang' => 5,
                'hotel_madinah_jarak' => '100 meter',
                'gambar' => 'images/brosur/umroh_premium_september.jpg',
            ],
            [
                'nama_paket' => 'Umroh New Season (Jul, Ags, Sep)',
                'deskripsi' => 'Paket Umroh hemat menyambut musim baru dengan penerbangan berkelas Etihad atau Oman Air. Pilihan terbaik untuk ibadah khusyuk dengan harga terjangkau.',
                'durasi_hari' => 9,
                'harga' => 100000,
                'harga_triple' => 110000,
                'harga_double' => 120000,
                'kuota' => 25,
                'tersedia' => 25,
                'tanggal_berangkat' => Carbon::create(2026, 8, 15),
                'tanggal_kembali' => Carbon::create(2026, 8, 23),
                'fasilitas' => 'Tiket Pesawat Etihad / Oman Air
Visa & Transportasi Bus AC
Hotel Bintang 3 Setaraf
Handling JKT & KSA
Muthawif / Muthawifah
Snack City Tour
Air Zamzam 5L
Manasik 2x
Perlengkapan Exclusive
Free: Air Zamzam 5L, Karak Chicken',

                'status' => 'aktif',
                'hotel_makkah_nama' => 'Maysan Al Maqam',
                'hotel_makkah_bintang' => 3,
                'hotel_makkah_jarak' => '250 meter',
                'hotel_madinah_nama' => 'Odst',
                'hotel_madinah_bintang' => 3,
                'hotel_madinah_jarak' => '150 meter',
                'gambar' => 'images/brosur/umroh_new_season.jpg',
            ],
            [
                'nama_paket' => 'Umroh Premium (Jul & Ags)',
                'deskripsi' => 'Paket Umroh eksklusif bintang 5 di musim panas terbaik (Juli & Agustus). Pelayanan VIP kelas satu dengan maskapai terbaik Saudia Airlines.',
                'durasi_hari' => 9,
                'harga' => 150000,
                'harga_triple' => 160000,
                'harga_double' => 170000,
                'kuota' => 21,
                'tersedia' => 21,
                'tanggal_berangkat' => Carbon::create(2026, 7, 20),
                'tanggal_kembali' => Carbon::create(2026, 7, 28),
                'fasilitas' => 'Tiket Pesawat SV Direct
Visa & Transportasi Bus VIP
Hotel Bintang 5 Pelataran Masjid
Handling JKT & KSA
Welcome Snack & Fruit in Room
Muthawif / Muthawifah
Snack City Tour
Air Zamzam 5L
Manasik 2x
Perlengkapan Exclusive
Free: Kereta Cepat Haramain, Karak Chicken, Museum Wahyu, Museum As Safiyyah',

                'status' => 'aktif',
                'hotel_makkah_nama' => 'Marwa Rotanna',
                'hotel_makkah_bintang' => 5,
                'hotel_makkah_jarak' => '0 meter (Pelataran)',
                'hotel_madinah_nama' => 'Emaar Royal',
                'hotel_madinah_bintang' => 5,
                'hotel_madinah_jarak' => '100 meter',
                'gambar' => 'images/brosur/umroh_premium_july_agustus.jpg',
            ],
        ];

        foreach ($pakets as $paket) {
            Paket::create($paket);
        }
    }
}

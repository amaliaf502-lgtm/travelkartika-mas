# Travel Umroh - Travelkartika Mas

Website travel umroh modern yang dibangun dengan Laravel 11 dan Bootstrap 5.

## Fitur Utama

✅ **Daftar Paket Umroh** - Menampilkan semua paket umroh dengan detail lengkap
✅ **Sistem Pemesanan** - Customer dapat melakukan pemesanan paket umroh
✅ **Autentikasi User** - Login dan registrasi untuk pelanggan
✅ **Manajemen Pemesanan** - Customer dapat melihat dan membatalkan pemesanan mereka
✅ **Dashboard Responsif** - Design modern dan mobile-friendly
✅ **Sistem Keamanan** - Authorization policies untuk melindungi data

## Tech Stack

- **Backend:** Laravel 11
- **Frontend:** Blade Template + Bootstrap 5
- **Database:** MySQL/MariaDB
- **Server:** Laragon (Apache + PHP)

## Struktur Project

```
travelkartika-mas/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   ├── PaketController.php
│   │   └── PemesananController.php
│   ├── Models/
│   │   ├── Paket.php
│   │   └── Pemesanan.php
│   └── Policies/
│       └── PemesananPolicy.php
├── database/
│   ├── migrations/
│   │   ├── *_create_pakets_table.php
│   │   └── *_create_pemesanans_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── PaketSeeder.php
├── resources/
│   └── views/
│       ├── layouts/app.blade.php
│       ├── home.blade.php
│       ├── pakets/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       └── pemesanans/
│           ├── create.blade.php
│           ├── index.blade.php
│           └── show.blade.php
├── routes/
│   └── web.php
└── ...config files...
```

## Instalasi & Setup

### 1. Persiapan Environment

Pastikan Anda sudah memiliki:
- Laragon (atau Laravel environment lainnya)
- PHP 8.2+
- Composer
- MySQL/MariaDB

### 2. Setup Database

Buka `.env` dan sesuaikan database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travelkartika_mas
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Install Dependencies

```bash
composer install
```

### 4. Generate App Key

```bash
php artisan key:generate
```

### 5. Jalankan Migrations

```bash
php artisan migrate
```

### 6. Seed Database dengan Data Sample

```bash
php artisan db:seed
```

Ini akan membuat:
- 1 user test (email: test@example.com, password: password)
- 4 paket umroh dengan data detail

### 7. Start Laravel Development Server

```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://localhost:8000`

## Mengakses Aplikasi

### Halaman Publik

- **Beranda:** http://localhost:8000/
- **Daftar Paket:** http://localhost:8000/pakets
- **Detail Paket:** http://localhost:8000/pakets/{id}

### Area Member (Requires Login)

- **Login:** http://localhost:8000/login
- **Registrasi:** http://localhost:8000/register
- **Pemesanan Saya:** http://localhost:8000/pemesanan-saya
- **Pesan Paket:** http://localhost:8000/pemesanan/{paket_id}/create

### User Test

```
Email: test@example.com
Password: password
```

## Menu & Fungsi

### 1. Beranda (Home)
- Menampilkan paket terbaru
- Statistik website
- Keunggulan layanan
- CTA untuk melihat paket

### 2. Daftar Paket
- List semua paket yang aktif
- Paginasi (6 paket per halaman)
- Quick info harga dan ketersediaan
- Tombol untuk lihat detail

### 3. Detail Paket
- Gambar paket
- Informasi lengkap (harga, durasi, tanggal, fasilitas, itinerari)
- Progress bar ketersediaan kuota
- Tombol pesan (jika login)

### 4. Form Pemesanan
- Inputan jumlah peserta
- Catatan khusus
- Kalkulasi harga otomatis
- Validasi kuota

### 5. Pemesanan Saya
- Table list semua pemesanan user
- Filter by status
- Tombol lihat detail dan batalkan

### 6. Detail Pemesanan
- Info lengkap pemesanan
- Detail paket
- Data pemesan
- Opsi batalkan (jika status pending)

## Database Schema

### Tabel: pakets
```sql
- id (PK)
- nama_paket (string)
- deskripsi (text)
- durasi_hari (integer)
- harga (decimal 15,2)
- kuota (integer)
- tersedia (integer)
- tanggal_berangkat (date)
- tanggal_kembali (date)
- fasilitas (text)
- itinerari (text)
- status (string: aktif/nonaktif)
- gambar (string, nullable)
- timestamps
```

### Tabel: pemesanans
```sql
- id (PK)
- user_id (FK -> users)
- paket_id (FK -> pakets)
- jumlah_peserta (integer)
- total_harga (decimal 15,2)
- status (string: pending/confirmed/dibatalkan/completed)
- catatan (text, nullable)
- tanggal_pemesanan (timestamp)
- timestamps
```

## Routes

### Public Routes
```
GET  /                           -> HomeController@index (Beranda)
GET  /pakets                     -> PaketController@index (Daftar Paket)
GET  /pakets/{paket}             -> PaketController@show (Detail Paket)
```

### Protected Routes (Require Auth)
```
GET  /pemesanan/{paket}/create   -> PemesananController@create (Form Pesan)
POST /pemesanan                  -> PemesananController@store (Submit Pesan)
GET  /pemesanan-saya             -> PemesananController@index (Pemesanan Saya)
GET  /pemesanan/{pemesanan}      -> PemesananController@show (Detail Pemesanan)
PATCH /pemesanan/{pemesanan}/cancel -> PemesananController@cancel (Batalkan)
```

## Menambah Paket Baru

Anda dapat menambah paket baru melalui database langsung atau melalui interface admin. Contoh query:

```sql
INSERT INTO pakets 
(nama_paket, deskripsi, durasi_hari, harga, kuota, tersedia, tanggal_berangkat, tanggal_kembali, fasilitas, itinerari, status, created_at, updated_at)
VALUES
('Umroh Juni 2026', 'Paket umroh bulan Juni', 8, 13000000, 40, 40, '2026-06-01', '2026-06-08', 'Fasilitas...', 'Itinerari...', 'aktif', NOW(), NOW());
```

## Customization

### Mengubah Warna
Warna brand dapat diubah di `resources/views/layouts/app.blade.php`:

```css
:root {
    --primary: #2c5aa0;      /* Biru */
    --secondary: #f39c12;    /* Orange */
}
```

### Mengubah Kontak
Update kontak di footer di `resources/views/layouts/app.blade.php`

### Menambah Menu
Edit navbar di `resources/views/layouts/app.blade.php`

## Features Yang Bisa Dikembangkan

- [ ] Admin Dashboard untuk manage paket & pemesanan
- [ ] Payment Gateway Integration (Midtrans, Xendit)
- [ ] Email notification untuk confirmation
- [ ] PDF invoice generation
- [ ] Review dan rating paket
- [ ] Wishlist/saved paket
- [ ] Promo code system
- [ ] Multi-language support
- [ ] WhatsApp integration
- [ ] Blog/artikel tentang umroh
- [ ] Gallery upload
- [ ] Customer testimonial

## Support & Contact

Untuk support atau pertanyaan, hubungi:
- Email: info@travelkartika.com
- WhatsApp: +62 812-3456-7890

## License

Hak cipta © 2026 Travelkartika Mas. Semua hak dilindungi.

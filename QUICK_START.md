# Quick Start Guide - Travel Umroh Travelkartika Mas

## 🚀 Cara Cepat Memulai

### Step 1: Jalankan Migration & Seeder

Buka terminal di folder `c:\laragon\www\travelkartika-mas` dan jalankan:

```powershell
php artisan migrate:fresh --seed
```

Perintah ini akan:
✅ Reset database
✅ Membuat semua tabel
✅ Insert data sample paket dan user test

### Step 2: Start Development Server

```powershell
php artisan serve
```

Aplikasi akan berjalan di: **http://localhost:8000**

### Step 3: Buka di Browser

1. Buka http://localhost:8000/
2. Explore website
3. Login dengan:
   - Email: `test@example.com`
   - Password: `password`
4. Mulai membuat pemesanan

---

## 📂 File-File Penting

| File | Deskripsi |
|------|-----------|
| `routes/web.php` | Semua routes aplikasi |
| `app/Models/Paket.php` | Model untuk paket umroh |
| `app/Models/Pemesanan.php` | Model untuk pemesanan |
| `app/Http/Controllers/` | Controller aplikasi |
| `resources/views/` | Blade templates (UI) |
| `database/migrations/` | Struktur database |
| `database/seeders/` | Data sample |

---

## 🎨 Customize Warna & Branding

Edit file: `resources/views/layouts/app.blade.php`

Cari bagian CSS:
```css
:root {
    --primary: #2c5aa0;      /* Biru - Ubah ke warna Anda */
    --secondary: #f39c12;    /* Orange - Ubah ke warna Anda */
}
```

---

## 📝 Tambah Paket Baru

### Via Database Query
```sql
INSERT INTO pakets (nama_paket, deskripsi, durasi_hari, harga, kuota, tersedia, tanggal_berangkat, tanggal_kembali, fasilitas, itinerari, status, created_at, updated_at) 
VALUES (
    'Umroh Baru', 
    'Deskripsi paket', 
    8, 
    12000000, 
    50, 
    50, 
    '2026-05-01', 
    '2026-05-08', 
    'Fasilitas 1\nFasilitas 2\nFasilitas 3',
    'Hari 1: ...\nHari 2: ...',
    'aktif',
    NOW(),
    NOW()
);
```

---

## 🔑 Database Struktur

### Tabel: pakets
- Menyimpan semua paket umroh
- Columns: id, nama_paket, deskripsi, durasi_hari, harga, kuota, tersedia, tanggal_berangkat, tanggal_kembali, fasilitas, itinerari, status, gambar, timestamps

### Tabel: pemesanans
- Menyimpan semua pemesanan customer
- Columns: id, user_id, paket_id, jumlah_peserta, total_harga, status, catatan, tanggal_pemesanan, timestamps

### Tabel: users
- Menyimpan data customer/user
- Columns: id, name, email, email_verified_at, password, remember_token, timestamps

---

## 🐛 Troubleshooting

### Error: SQLSTATE[HY000] [2002] No such file or directory
**Solusi:** Pastikan MySQL/MariaDB sudah running di Laragon

### Error: PDOException: SQLSTATE[42S02]
**Solusi:** Jalankan `php artisan migrate` untuk membuat tabel

### Halaman blank atau error 500
**Solusi:** 
1. Cek `storage/logs/laravel.log`
2. Jalankan `php artisan config:cache`
3. Jalankan `php artisan cache:clear`

---

## 📱 Responsive Design

Aplikasi ini responsive dan mobile-friendly. Dapat diakses dari:
- Desktop
- Tablet
- Mobile Phone

---

## 🔐 Security

- ✅ CSRF Protection (form validation)
- ✅ Password encryption (bcrypt)
- ✅ Authorization policies (Pemesanan hanya bisa dilihat owner)
- ✅ Input validation di semua form
- ✅ SQL injection protection (Eloquent ORM)

---

## 📚 Dokumentasi Lengkap

Baca file `SETUP.md` untuk dokumentasi lebih lengkap dan detailed setup instructions.

---

## ✨ Feature Highlights

| Feature | Status |
|---------|--------|
| Daftar Paket | ✅ Aktif |
| Detail Paket | ✅ Aktif |
| Sistem Pemesanan | ✅ Aktif |
| Login/Register | ✅ Aktif |
| Pemesanan Saya | ✅ Aktif |
| Batalkan Pemesanan | ✅ Aktif |
| Responsive Design | ✅ Aktif |
| Admin Panel | 🔄 Optional |
| Payment Gateway | 🔄 Optional |
| Email Notification | 🔄 Optional |

---

## 📞 Support

Untuk develop lebih lanjut atau bertanya:
- Baca dokumentasi Laravel: https://laravel.com/docs
- Cek SETUP.md untuk info lebih detail
- Modify files sesuai kebutuhan

Happy Coding! 🎉

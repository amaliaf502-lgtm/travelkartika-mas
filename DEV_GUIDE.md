# Travel Umroh Website - Development Guide

## 🎯 Ringkasan Website yang Telah Dibuat

Website travel umroh **Travelkartika Mas** telah sepenuhnya dibuat dengan fitur-fitur berikut:

### ✨ Fitur Utama
1. **Sistem Katalog Paket** - Browse paket umroh dengan detail lengkap
2. **Sistem Pemesanan** - Customer dapat memesan paket umroh
3. **Autentikasi** - Login & register untuk customer
4. **Manajemen Pemesanan** - Lihat & batalkan pemesanan sendiri
5. **Design Responsif** - Mobile-friendly interface
6. **Dashboard Customer** - Lihat semua pemesanan Anda

---

## 🚀 Cara Menjalankan

### Terminal/PowerShell:

```powershell
# Navigate ke folder project
cd c:\laragon\www\travelkartika-mas

# Start development server
php artisan serve
```

### Di Browser:
- Buka: **http://localhost:8000**

---

## 🔑 User Test

```
Email: test@example.com
Password: password
```

Login dengan user ini untuk test semua fitur member-only.

---

## 📋 Halaman-Halaman Tersedia

| Halaman | URL | Akses | Deskripsi |
|---------|-----|-------|-----------|
| Beranda | `/` | Public | Showcase paket terbaru & info |
| Daftar Paket | `/pakets` | Public | List semua paket umroh |
| Detail Paket | `/pakets/{id}` | Public | Info lengkap satu paket |
| Pesan | `/pemesanan/{paket}/create` | Login | Form pemesanan paket |
| Pemesanan Saya | `/pemesanan-saya` | Login | List pemesanan saya |
| Detail Pemesanan | `/pemesanan/{id}` | Login | Detail satu pemesanan |
| Login | `/login` | Public | Login page |
| Register | `/register` | Public | Registrasi user baru |

---

## 🗄️ Database Schema

### Pakets Table
```sql
- id (int, primary key)
- nama_paket (string, 255)
- deskripsi (text)
- durasi_hari (int)
- harga (decimal 15,2)
- kuota (int)
- tersedia (int) - kuota sisa
- tanggal_berangkat (date)
- tanggal_kembali (date)
- fasilitas (text)
- itinerari (text)
- status (string: 'aktif', 'nonaktif')
- gambar (string, nullable)
- timestamps
```

### Pemesanans Table
```sql
- id (int, primary key)
- user_id (int, foreign key -> users.id)
- paket_id (int, foreign key -> pakets.id)
- jumlah_peserta (int)
- total_harga (decimal 15,2)
- status (string: 'pending', 'confirmed', 'dibatalkan', 'completed')
- catatan (text, nullable)
- tanggal_pemesanan (timestamp)
- timestamps
```

---

## 🎨 Styling & Customization

### Brand Colors (di `resources/views/layouts/app.blade.php`)
```css
--primary: #2c5aa0      /* Biru */
--secondary: #f39c12    /* Orange */
```

Ubah nilai ini untuk mengubah warna seluruh website.

### Font & Icons
- Font: Segoe UI
- Icons: Font Awesome 6.4.0
- CSS Framework: Bootstrap 5.3.0

---

## 💻 Project Structure

```
travelkartika-mas/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── HomeController.php
│   │       ├── PaketController.php
│   │       ├── PemesananController.php
│   │       └── AdminPaketController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Paket.php
│   │   └── Pemesanan.php
│   └── Policies/
│       └── PemesananPolicy.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_*.php (built-in)
│   │   ├── 2026_02_01_115336_create_pakets_table.php
│   │   └── 2026_02_01_115413_create_pemesanans_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── PaketSeeder.php
├── resources/
│   └── views/
│       ├── layouts/app.blade.php
│       ├── home.blade.php
│       ├── pakets/index.blade.php
│       ├── pakets/show.blade.php
│       ├── pemesanans/create.blade.php
│       ├── pemesanans/index.blade.php
│       └── pemesanans/show.blade.php
├── routes/
│   └── web.php
└── (other config files...)
```

---

## 🔄 Workflow User

### Visitor (Tidak Login)
1. Buka halaman beranda `/`
2. Lihat paket terbaru
3. Klik "Lihat Paket" → `/pakets`
4. Browsing paket → `/pakets/{id}`
5. Klik "Login untuk Pesan" → Redirect ke login

### Customer (Sudah Login)
1. Buka halaman beranda `/`
2. Klik "Pesan" pada paket → `/pemesanan/{paket}/create`
3. Isi form pemesanan (jumlah peserta, catatan)
4. Submit form
5. Lihat pemesanan saya → `/pemesanan-saya`
6. Bisa lihat detail atau batalkan

---

## 🔐 Security Features

✅ **CSRF Protection** - Form validation dengan CSRF tokens
✅ **Password Encryption** - bcrypt hashing
✅ **Authorization** - Policy untuk pemesanan hanya bisa diakses owner
✅ **Input Validation** - Validasi di semua form
✅ **SQL Injection Protection** - Menggunakan Eloquent ORM

---

## 📝 Contoh Database Query

### Menambah Paket Baru
```sql
INSERT INTO pakets 
(nama_paket, deskripsi, durasi_hari, harga, kuota, tersedia, tanggal_berangkat, tanggal_kembali, fasilitas, itinerari, status, created_at, updated_at)
VALUES
('Umroh Haji Plus', 'Paket umroh + haji dengan pelayanan terbaik', 15, 25000000, 30, 30, '2026-07-01', '2026-07-15', 'Penerbangan\nHotel 5 bintang\nMakanan premium\nGuide profesional', 'Hari 1: ...\nHari 2: ...', 'aktif', NOW(), NOW());
```

### Update Kuota
```sql
UPDATE pakets SET tersedia = 20, kuota = 40 WHERE id = 1;
```

### Lihat Pemesanan User
```sql
SELECT * FROM pemesanans WHERE user_id = 1;
```

### Ubah Status Pemesanan
```sql
UPDATE pemesanans SET status = 'confirmed' WHERE id = 1;
```

---

## 🛠️ Useful Artisan Commands

```powershell
# Database
php artisan migrate                    # Jalankan migrations
php artisan migrate:fresh             # Reset & migrate
php artisan migrate:fresh --seed      # Reset, migrate + seed
php artisan db:seed                   # Jalankan seeders

# Models & Controllers
php artisan make:model ModelName      # Buat model baru
php artisan make:controller CtrlName  # Buat controller baru
php artisan make:migration table_name # Buat migration baru

# Debugging
php artisan tinker                    # Interactive shell
php artisan route:list                # Lihat semua routes
php artisan config:list               # Lihat semua config

# Cache & Log
php artisan cache:clear               # Clear cache
php artisan config:cache              # Cache config
php artisan config:clear              # Clear config cache
php artisan log:clear                 # Clear log
```

---

## 🆘 Quick Troubleshooting

| Problem | Solution |
|---------|----------|
| Database connect error | Pastikan MySQL running, cek .env DB_* |
| Halaman blank/error 500 | Cek `storage/logs/laravel.log` |
| Styling tidak muncul | Clear browser cache (Ctrl+Shift+Del) |
| Migration error | Pastikan sudah `php artisan migrate:fresh --seed` |
| Login tidak bekerja | Reset password user: `php artisan tinker` |

---

## 📚 File Dokumentasi

- **WEBSITE_SIAP.md** ← Anda di sini (Overview)
- **SETUP.md** - Dokumentasi lengkap & detailed
- **QUICK_START.md** - Quick start guide

---

## 🎁 Bonus Files

Sudah disediakan untuk Anda:
- Model Paket & Pemesanan dengan relationships
- Seeder dengan 4 paket contoh
- Layout dengan Navbar & Footer responsif
- Semua halaman dengan styling modern
- Form validation di client & server
- Status management system
- Authorization policies

---

## 💡 Development Tips

1. **Buat perubahan di controller** → Implement business logic
2. **Buat perubahan di model** → Tambah methods/relationships
3. **Edit views** → Update template Blade
4. **Jalankan migration** → Ubah database schema
5. **Test di browser** → Periksa hasilnya

---

## 🚀 Langkah Selanjutnya

Untuk melanjutkan development:

1. Baca file **SETUP.md** untuk dokumentasi lengkap
2. Explore folder `/resources/views` untuk memahami struktur
3. Lihat `/routes/web.php` untuk memahami routing
4. Cek `/app/Models` untuk understand relationships
5. Cek `/app/Http/Controllers` untuk logic

---

## 📞 Contact Info

Website sudah dilengkapi dengan info kontak:
- Email: info@travelkartika.com
- WhatsApp: +62 812-3456-7890
- Lokasi: Jakarta, Indonesia

Anda bisa mengubah ini di footer: `resources/views/layouts/app.blade.php`

---

**Selamat mengembangkan website umroh Anda! 🎉**

Mulai dengan: `php artisan serve`
Buka: `http://localhost:8000`

# 📋 PANDUAN SISTEM TRAVEL UMROH - TRAVELKARTIKA MAS

## 🎯 Ringkasan Sistem

Sistem Travel Umroh Travelkartika Mas adalah platform web dengan 2 tampilan utama:

- **Tampilan Public/Jamaah**: melihat informasi dan paket umroh tanpa harus login, lalu registrasi, login, memilih paket, melakukan pemesanan, mengunggah bukti pembayaran, dan melihat status pemesanan serta keberangkatan
- **Tampilan Admin**: mengelola data paket umroh, data jamaah, pembayaran/bukti transfer, dan informasi keberangkatan jamaah

## 📱 Cara Menggunakan

### 1️⃣ JAMAAH (Member) - Browsing & Booking

**Langkah 1: Kunjungi Beranda**

- Buka http://localhost:8000
- Lihat paket-paket umroh yang tersedia tanpa login

**Langkah 2: Registrasi / Daftar Akun**

- Klik tombol "Daftar" di navbar
- Isi form dengan:
    - Nama lengkap
    - Email
    - Password
- Klik "Daftar Sekarang"

**Langkah 3: Login**

- Klik "Login" di navbar
- Masukkan email dan password
- Klik "Masuk"

**Langkah 4: Pilih Paket**

- Klik "Paket Umroh" di navbar
- Lihat daftar semua paket
- Klik paket yang diinginkan untuk melihat detail lengkap

**Langkah 5: Pemesanan**

- Di halaman detail paket, klik "Pesan Sekarang"
- Isi form pemesanan:
    - Jumlah peserta (orang)
    - Nama-nama peserta
    - Catatan tambahan jika ada
- Klik "Lakukan Pemesanan"
- Pemesanan tersimpan dengan status **PENDING**

**Langkah 6: Pembayaran / Upload Bukti**

- Buka detail pemesanan setelah booking berhasil
- Transfer sejumlah total harga ke rekening yang ditampilkan sistem
- Upload bukti pembayaran (foto/scan)
- Admin akan memverifikasi bukti pembayaran sebelum proses lanjutan

**Langkah 7: Melihat Pemesanan**

- Klik "Pemesanan Saya" di navbar
- Lihat daftar semua pemesanan dengan status
- Klik salah satu untuk melihat detail

**Langkah 8: Melihat Info Keberangkatan**

- Jika status pemesanan sudah **DIKONFIRMASI**, klik "Lihat Info Keberangkatan"
- Di sini jamaah bisa melihat:
    - ✅ Tanggal berkumpul
    - ✅ Waktu berkumpul
    - ✅ Lokasi berkumpul
    - ✅ Alamat lengkap
    - ✅ Nama contact person (guide/organizer)
    - ✅ No. HP contact (bisa chat via WhatsApp)
    - ✅ Instruksi persiapan
    - ✅ Catatan khusus
    - ✅ Checklist persiapan

---

### 2️⃣ ADMIN - Verifikasi & Manage Pemesanan

**Akun Admin untuk Testing:**

- Email: `test@example.com`
- Password: `password`

**Langkah 1: Login sebagai Admin**

- Buka http://localhost:8000/login
- Masukkan email: `test@example.com`
- Masukkan password: `password`
- Klik "Masuk"
- Perhatikan di navbar akan muncul link "Admin Panel" dengan warna orange

**Langkah 2: Akses Dashboard Admin**

- Klik "Admin Panel" di navbar
- Atau klik dropdown user → "Dashboard Admin"
- Di dashboard admin bisa melihat:
    - 📊 Statistik Total Jamaah
    - 📊 Statistik Total Pemesanan
    - 📊 Pemesanan Pending (menunggu)
    - 📊 Total Revenue (dari pemesanan confirmed)
    - 📋 Tabel pemesanan terbaru

**Langkah 3: Kelola Pemesanan**

- Klik "Pemesanan" di menu admin
- Lihat daftar semua pemesanan dengan status:
    - 🟠 **PENDING** = Menunggu verifikasi / bukti pembayaran
    - 🟢 **CONFIRMED** = Sudah dikonfirmasi + info keberangkatan sudah diinput
    - 🔴 **DIBATALKAN** = Pemesanan dibatalkan
- Cek detail pemesanan untuk melihat bukti pembayaran yang diunggah jamaah

**Langkah 4: Verifikasi & Input Info Keberangkatan**

- Klik pemesanan dengan status **PENDING**
- Klik tombol "Konfirmasi Pemesanan"
- Form akan muncul dengan field:
    - 📅 **Tanggal Berkumpul** - tanggal jamaah berkumpul
    - 🕐 **Waktu Berkumpul** - jam berapa jamaah harus berkumpul
    - 📍 **Lokasi Berkumpul** - nama tempat/landmark
    - 🏢 **Alamat Lengkap** - alamat lengkap lokasi berkumpul
    - 👤 **Nama Contact Person** - nama guide/organizer
    - 📱 **No. HP Contact** - nomor hp guide (untuk WhatsApp)
    - 📝 **Instruksi Persiapan** - instruksi apa yang perlu jamaah siapkan
    - 📌 **Catatan Khusus** - catatan tambahan jika ada
- Klik "Simpan Konfirmasi"
- Status akan berubah menjadi **CONFIRMED** ✅
- Jamaah akan bisa melihat informasi ini di halaman "Info Keberangkatan"

**Langkah 5: Kelola Jamaah**

- Klik "Jamaah" di menu admin
- Lihat daftar semua jamaah dengan total pemesanan mereka
- Klik jamaah untuk melihat profil dan riwayat booking

**Langkah 6: Batalkan Pemesanan (Jika Diperlukan)**

- Di halaman detail pemesanan, klik tombol "Batalkan Pemesanan"
- Status akan berubah menjadi **DIBATALKAN** 🔴

---

## 🗄️ Struktur Database

### Tabel: `users`

- `id` - ID user
- `name` - Nama lengkap
- `email` - Email unik
- `password` - Password terenkripsi
- `is_admin` - Boolean (true = admin, false = jamaah)
- `created_at` - Tanggal dibuat
- `updated_at` - Tanggal diupdate

### Tabel: `pakets`

- `id` - ID paket
- `nama_paket` - Nama paket (cth: "Paket Umroh Hemat")
- `deskripsi` - Deskripsi paket
- `harga` - Harga paket per orang
- `kuota` - Total kuota pemesanan
- `tersedia` - Kuota tersisa
- `tanggal_berangkat` - Tanggal departure
- `tanggal_kembali` - Tanggal return
- `durasi_hari` - Durasi dalam hari
- `fasilitas` - Daftar fasilitas
- `itinerari` - Itinerari perjalanan
- `status` - Status paket (active/inactive)
- `gambar` - URL gambar paket

### Tabel: `pemesanans`

- `id` - ID pemesanan
- `user_id` - ID jamaah yang pesan
- `paket_id` - ID paket yang dipesan
- `jumlah_peserta` - Jumlah orang yang booking
- `nama_peserta` - Nama-nama peserta (JSON)
- `total_harga` - Total harga = harga paket × jumlah peserta
- `status` - Status pemesanan:
    - `pending` - Menunggu verifikasi admin
    - `confirmed` - Sudah dikonfirmasi
    - `dibatalkan` - Dibatalkan
- `catatan` - Catatan tambahan dari jamaah (opsional)
- `created_at` - Tanggal pesan
- `updated_at` - Tanggal update

### Tabel: `departure_infos` (Baru)

- `id` - ID info keberangkatan
- `pemesanan_id` - ID pemesanan (foreign key)
- `tanggal_berkumpul` - Tanggal berkumpul
- `waktu_berkumpul` - Waktu berkumpul (HH:MM format)
- `lokasi_berkumpul` - Lokasi berkumpul
- `alamat_lengkap` - Alamat lengkap lokasi
- `contact_person` - Nama guide/organizer
- `no_hp_contact` - No HP guide
- `instruksi_persiapan` - Instruksi persiapan
- `catatan_khusus` - Catatan khusus
- `created_at` - Tanggal dibuat
- `updated_at` - Tanggal update

---

## 🔐 Keamanan

### Authentication & Authorization

- ✅ Semua rute protected (kecuali beranda & paket list)
- ✅ Admin hanya bisa akses jika `is_admin = true`
- ✅ Jamaah hanya bisa lihat pemesanan mereka sendiri
- ✅ Password di-hash dengan bcrypt

### Middleware

- `auth` - Cek user sudah login
- `guest` - Cek user belum login (untuk login/register page)
- Custom middleware di AdminController - cek `is_admin`

---

## 🧪 Testing Manual

### Test Case 1: Jamaah Booking

1. ✅ Buka http://localhost:8000
2. ✅ Klik "Daftar" → isi form → daftar
3. ✅ Klik "Login" → login dengan akun baru
4. ✅ Klik "Paket Umroh" → pilih paket
5. ✅ Klik "Pesan Sekarang" → isi jumlah peserta → booking
6. ✅ Klik "Pemesanan Saya" → lihat status PENDING

### Test Case 2: Admin Konfirmasi

1. ✅ Buka http://localhost:8000/login
2. ✅ Login dengan `test@example.com` / `password`
3. ✅ Lihat "Admin Panel" di navbar
4. ✅ Klik "Admin Panel" → dashboard admin
5. ✅ Klik "Pemesanan" → lihat pemesanan PENDING
6. ✅ Klik salah satu pemesanan → klik "Konfirmasi Pemesanan"
7. ✅ Isi form info keberangkatan
8. ✅ Klik "Simpan Konfirmasi" → status jadi CONFIRMED

### Test Case 3: Jamaah Lihat Info Keberangkatan

1. ✅ Logout dari admin, login ulang dengan akun jamaah
2. ✅ Klik "Pemesanan Saya"
3. ✅ Klik pemesanan yang sudah CONFIRMED
4. ✅ Klik "Lihat Info Keberangkatan"
5. ✅ Lihat semua informasi keberangkatan
6. ✅ Klik link WhatsApp untuk chat guide

---

## 🚀 Cara Jalankan Sistem

### 1. Setup Database

```bash
php artisan migrate
```

### 2. Jalankan Server

```bash
php artisan serve
```

Akses di http://localhost:8000

### 3. Clear Cache (Jika Ada Perubahan)

```bash
php artisan cache:clear
php artisan config:clear
```

---

## 📝 Catatan Penting

1. **Data Sample**: Sudah ada 4 paket sample di database
2. **Akun Admin**: Email `test@example.com` dengan password `password`
3. **Database**: Menggunakan SQLite (file: `database/database.sqlite`)
4. **Email**: Fitur email belum diimplementasikan
5. **Payment**: Pembayaran dilakukan secara manual via transfer dan upload bukti pembayaran
6. **Report**: Fitur export/print laporan belum diimplementasikan

---

## 🔄 Alur Pemesanan Lengkap

```
1. Jamaah daftar & login
        ↓
2. Browse paket umroh
        ↓
3. Klik paket, isi form booking
        ↓
4. Submit pemesanan → Status: PENDING
        ↓
5. Jamaah transfer & upload bukti pembayaran
        ↓
6. Admin verifikasi & input info keberangkatan
        ↓
7. Status berubah: CONFIRMED
        ↓
8. Jamaah bisa lihat info keberangkatan
        ↓
9. Jamaah berkumpul di lokasi & waktu yang ditentukan
        ↓
10. Berangkat ke tanah suci! ✈️
```

---

## 📧 Support

Untuk pertanyaan atau masalah teknis, silakan hubungi developer.

**Dibuat dengan ❤️ menggunakan Laravel 11 + Bootstrap 5**

---

_Panduan ini dibuat untuk memudahkan penggunaan sistem Travelkartika Mas._

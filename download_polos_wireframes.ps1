$saltCodes = @{
    "login" = @"
@startsalt
{+
  <b>KARTIKA MAS</b> | {* Beranda | Paket | Info | Kontak | Masuk | Daftar }
  ==
  {+
    <b>Selamat Datang</b>
    Masuk ke akun Anda
    --
    <b>Email</b>
    "admin@example.com      "
    <b>Password</b>
    "********               "
    [X] Ingat saya
    [  <b>Masuk Sekarang</b>  ]
    --
    Belum punya akun? ^Daftar^
  }
}
@endsalt
"@

    "registrasi" = @"
@startsalt
{+
  <b>KARTIKA MAS</b> | {* Beranda | Paket | Info | Kontak | Masuk | Daftar }
  ==
  {+
    <b>Daftar Akun Baru</b>
    --
    <b>Nama Lengkap</b>
    "Amalia Fitri           "
    <b>Email & No HP</b>
    { "nama@email.com   " | "081234567 " }
    <b>Kata Sandi & Konfirmasi</b>
    { "********         " | "********  " }
    [ <b>Daftar Sekarang</b> ]
  }
}
@endsalt
"@

    "beranda" = @"
@startsalt
{+
  <b>KARTIKA MAS</b> | {* Beranda | Paket | Info | Kontak | Profil }
  ==
  <b>Kartika Mas Tour & Travel: Perjalanan Umroh Terpercaya</b>
  [Cari Paket Umroh]   [Konsultasi Gratis]
  ==
  {
    <b>Premium (Jul & Ags)</b> | <b>New Season</b>
    [Poster Paket A] | [Poster Paket B]
    Sisa Kuota: 20/21 | Sisa Kuota: 25/25
    Mulai: <b>Rp 150.000</b> | Mulai: <b>Rp 100.000</b>
    [Lihat Detail] | [Lihat Detail]
  }
}
@endsalt
"@

    "pemesanan" = @"
@startsalt
{+
  <b>KARTIKA MAS</b> | {* Beranda | Paket | Pemesanan | Profil }
  ==
  <b>TRANSAKSI PEMESANAN BARU</b>
  --
  PILIHAN PAKET UMROH:
  {#
    Paket | Harga/Pack | Berangkat | Kuota
    Premium | Rp 150.000 | 20 Jul | 20
  }
  --
  INPUT DATA PEMESANAN:
  Tipe Kamar: | ^Quad (Sekamar ber-4)^
  Jml Peserta:| "1      "
  Catatan:    | "       "
  --
  Total Harga | Rp 150.000
  [ Lanjutkan Pembayaran ]
}
@endsalt
"@

    "upload_dokumen" = @"
@startsalt
{+
  <b>KARTIKA MAS</b> | {* Beranda | Paket | Pemesanan | Profil }
  ==
  <b>UPLOAD DOKUMEN (TRX-001)</b>
  --
  Pilih Jenis: ^Paspor...^
  [Browse] File_Paspor.pdf
  [ <b>UPLOAD</b> ]
  --
  <b>Status Kelengkapan:</b>
  [X] KTP (Oke)
  [X] KK (Oke)
  [ ] Paspor (Belum)
}
@endsalt
"@

    "pembayaran" = @"
@startsalt
{+
  <b>KARTIKA MAS</b> | {* Beranda | Paket | Pemesanan | Profil }
  ==
  <b>[ LOGO MIDTRANS ]</b>
  ==
  TOTAL BAYAR: <b>Rp 50.000</b> (DP)
  --
  <b>Metode Pembayaran:</b>
  () BCA Virtual Account
  () Mandiri Bill Payment
  () QRIS
  --
  [ <b>LANJUTKAN VIA MIDTRANS</b> ]
}
@endsalt
"@

    "riwayat" = @"
@startsalt
{+
  <b>KARTIKA MAS</b> | {* Beranda | Paket | Info | Kontak | Profil }
  ==
  <b>DETAIL RIWAYAT TRANSAKSI</b>
  
  INVOICE NO. TRX-001 (LUNAS)
  [ Download Invoice ]
  --
  DETAIL PEMESANAN PAKET:
  {#
    No. | Paket | Tipe Kamar | Berangkat | Jml | Total
    1 | Premium | Quad | 20 Jul | 1 | Rp 150k
  }
  --
  RINGKASAN PEMBAYARAN:
  Sub Total | Rp 150.000
  Total | Rp 150.000
}
@endsalt
"@

    "dasbor_admin" = @"
@startsalt
{+
  {
    <b>[ LOGO ]</b>
    --
    [ Dasbor ]
    [ Paket ]
    [ Jamaah ]
    [ Jadwal ]
    --
    Admin
  } | {
    <b>Laporan Bisnis</b> | [Notif]
    ==
    <b>Dasbor Admin Travel</b>
    {
      OMSET | PESANAN | PENDING
      <b>Rp 150k</b> | <b>45</b> | <b>12</b>
    }
    ==
    <b>Tren Pendapatan & Status</b>
    [ GARIS TREN ] | [ LINGKARAN ]
    . | o Lunas o DP
  }
}
@endsalt
"@

    "kelola_paket" = @"
@startsalt
{+
  {
    <b>[ LOGO ]</b>
    --
    [ Dasbor ]
    <b>[ Paket ]</b>
    [ Jamaah ]
    [ Jadwal ]
    --
    Admin
  } | {
    <b>Manajemen Paket</b> | [Notif]
    ==
    [+ Tambah Paket]
    --
    <b>Edit Paket:</b>
    Nama: | "Umroh Premium  "
    Maskapai: | "Saudi Airlines "
    Harga: | "150000         "
    Kuota: | "21             "
    [ Simpan Perubahan ]
  }
}
@endsalt
"@

    "kelola_jamaah" = @"
@startsalt
{+
  {
    <b>[ LOGO ]</b>
    --
    [ Dasbor ]
    [ Paket ]
    <b>[ Jamaah ]</b>
    [ Jadwal ]
    --
    Admin
  } | {
    <b>Manajemen Jamaah</b> | [Notif]
    ==
    Cari: ["Nama.."] [Cari]
    --
    {#
      <b>Nama</b> | <b>Dokumen</b> | <b>Bayar</b> | <b>Aksi</b>
      Amalia | [Lengkap] | [Lunas] | [Detail]
      Budi | [Kurang] | [DP] | [Verif]
    }
  }
}
@endsalt
"@

    "informasi_berangkat" = @"
@startsalt
{+
  {
    <b>[ LOGO ]</b>
    --
    [ Dasbor ]
    [ Paket ]
    [ Jamaah ]
    <b>[ Jadwal ]</b>
    --
    Admin
  } | {
    <b>Jadwal & Logistik</b> | [Notif]
    ==
    Pilih: ^Umroh Premium (20 Jul)^
    --
    Tgl Kumpul: | "19 Jul 2026 "
    Waktu: | "13:00 WIB   "
    Lokasi: | "Bandara T3  "
    Instruksi: | "Bawa koper  "
    [ Simpan Jadwal ]
  }
}
@endsalt
"@

    "kuitansi" = @"
@startsalt
{+
  <b>[ KOP SURAT KARTIKA MAS ]</b>
  ==
  <b>INVOICE PEMBAYARAN</b>
  --
  ID Transaksi: TRX-001
  Jamaah: Amalia Fitri
  Tanggal: 10 Jun 2026
  --
  <b>Rincian:</b>
  Pelunasan Umroh Premium
  Metode: BCA VA
  Total: <b>Rp 150.000</b>
  Status: <b>LUNAS</b>
  --
  <i>Dokumen digital sah.</i>
}
@endsalt
"@
}

foreach ($key in $saltCodes.Keys) {
    $text = $saltCodes[$key]
    $outFile = "C:\Users\MY HP\.gemini\antigravity-ide\brain\4d09b22c-8efb-455d-a2cb-9740baef7a29\wireframe_$key.png"
    Invoke-RestMethod -Uri 'https://kroki.io/plantuml/png' -Method Post -Body $text -ContentType 'text/plain' -OutFile $outFile
}

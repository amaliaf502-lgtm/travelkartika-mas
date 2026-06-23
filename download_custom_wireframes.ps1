$saltCodes = @{
    "login" = @"
@startsalt
{
  {* Beranda | Paket Umroh | Cara Pendaftaran | Tentang Kami | Kontak | Masuk | Daftar }
  ==
  {+
    {
      <color:white><back:darkred>                         </back></color>
      <color:white><back:darkred>         [ LOGO ]        </back></color>
      <color:white><back:darkred>       KARTIKA MAS       </back></color>
      <color:white><back:darkred>      TOUR & TRAVEL      </back></color>
      <color:white><back:darkred>                         </back></color>
      <color:white><back:darkred>  [V] Terdaftar Resmi    </back></color>
      <color:white><back:darkred>  [V] Layanan Terpercaya </back></color>
      <color:white><back:darkred>  [V] Support 24/7       </back></color>
      <color:white><back:darkred>                         </back></color>
    } | {
      <b>Selamat Datang</b>
      Masuk ke akun Anda untuk melanjutkan
      --
      <b>EMAIL</b>
      "admin@example.com                   "
      <b>PASSWORD</b>
      "Masukkan password                   "
      [ ] Ingat saya
      [       <b>Masuk</b>       ]
      --
      Belum punya akun? ^Daftar sekarang^
    }
  }
}
@endsalt
"@

    "registrasi" = @"
@startsalt
{
  {* Beranda | Paket Umroh | Cara Pendaftaran | Tentang Kami | Kontak | Masuk | Daftar }
  ==
  {+
    {
      <color:white><back:darkred>                         </back></color>
      <color:white><back:darkred>         [ LOGO ]        </back></color>
      <color:white><back:darkred>       BERGABUNGLAH      </back></color>
      <color:white><back:darkred>                         </back></color>
      <color:white><back:darkred>  Jadilah bagian dari    </back></color>
      <color:white><back:darkred>  keluarga besar         </back></color>
      <color:white><back:darkred>  Kartika Mas Tour &     </back></color>
      <color:white><back:darkred>  Travel.                </back></color>
      <color:white><back:darkred>                         </back></color>
    } | {
      <b>Daftar Akun Baru</b>
      Lengkapi formulir di bawah ini
      --
      <b>NAMA LENGKAP SESUAI KTP</b>
      "Nama Lengkap                        "
      { <b>ALAMAT EMAIL</b> | <b>NOMOR HP / WHATSAPP</b> }
      { "nama@email.com   " | "08123456789      " }
      { <b>KATA SANDI</b> | <b>KONFIRMASI KATA SANDI</b> }
      { "Minimal 8 karakte" | "Ketik ulang sandi" }
      [       <b>Daftar Sekarang</b>       ]
      Sudah punya akun? ^Masuk di sini^
    }
  }
}
@endsalt
"@

    "beranda" = @"
@startsalt
{
  {* Beranda | Paket Umroh | Cara Pendaftaran | Tentang Kami | Kontak | Masuk | Daftar }
  ==
  <color:white><back:gray>                                                                         </back></color>
  <color:white><back:gray>                       <b>Kartika Mas Tour & Travel</b>                       </back></color>
  <color:white><back:gray>  Kartika Mas Tour & Travel adalah mitra terpercaya dalam memfasilitasi  </back></color>
  <color:white><back:gray>      perjalanan ibadah ke kota suci Mekkah dan Madinah.                 </back></color>
  <color:white><back:gray>              [Cari Paket Umroh]   [Konsultasi Gratis]                   </back></color>
  <color:white><back:gray>                                                                         </back></color>
  ==
  {
    <b>Umroh Premium (Jul & Ags)</b> | <b>Umroh New Season</b> | <b>Umroh Premium September</b>
    [Gambar Poster] | [Gambar Poster] | [Gambar Poster]
    Berangkat: 20 Jul 2026 | Berangkat: 15 Aug 2026 | Berangkat: 10 Sep 2026
    Maskapai: Saudi Airlines | Maskapai: Saudi Airlines | Maskapai: Saudi Airlines
    Sisa Kuota: 20/21 | Sisa Kuota: 25/25 | Sisa Kuota: 25/25
    Mulai dari: <b>Rp 35.000.000</b> | Mulai dari: <b>Rp 32.000.000</b> | Mulai dari: <b>Rp 35.000.000</b>
    [Lihat Detail ->] | [Lihat Detail ->] | [Lihat Detail ->]
  }
}
@endsalt
"@

    "pemesanan" = @"
@startsalt
{
  {* Beranda | Paket Umroh | Cara Pendaftaran | Tentang Kami | Kontak | Profil | Logout }
  ==
  <b>FORM PEMESANAN PAKET UMROH</b>
  == Umroh Premium (Jul & Ags)
  Tgl Berangkat: 20 Juli 2026 | Sisa Kuota: 20 Kursi
  --
  <b>Pilih Tipe Kamar:</b>
  () Quad (Sekamar ber-4)
  () Triple (Sekamar ber-3)
  () Double (Sekamar ber-2)
  --
  <b>Jumlah Peserta:</b>
  "1   " ^Orang^
  --
  <b>Catatan Tambahan (Opsional):</b>
  {S
  "                                    "
  "                                    "
  }
  --
  Total Harga: | <b>Rp 35.000.000</b>
  [   <b>BUAT PEMESANAN</b>   ] | [ Batal ]
}
@endsalt
"@

    "upload_dokumen" = @"
@startsalt
{
  {* Beranda | Paket Umroh | Cara Pendaftaran | Tentang Kami | Kontak | Profil | Logout }
  ==
  {+
  == UPLOAD DOKUMEN PERSYARATAN (TRX-001)
  --
  <b>Pilih Jenis Dokumen:</b>
  ^Paspor...^
  --
  <b>Pilih File Anda:</b>
  [ Browse... ] File_Paspor_Amalia.pdf
  --
  [ <b>UPLOAD SEKARANG</b> ]
  --
  <b>Status Kelengkapan Dokumen Jamaah:</b>
  [X] KTP (Terkonfirmasi)
  [X] Kartu Keluarga (Terkonfirmasi)
  [ ] Paspor (Belum Diunggah)
  [ ] Pas Foto 4x6 (Belum Diunggah)
  }
}
@endsalt
"@

    "pembayaran" = @"
@startsalt
{
  {* Beranda | Paket Umroh | Cara Pendaftaran | Tentang Kami | Kontak | Profil | Logout }
  ==
  {+
  <color:gray><b>[ LOGO MIDTRANS PAYMENT GATEWAY ]</b></color>
  == TOTAL PEMBAYARAN: Rp 10.000.000 (DP)
  --
  <b>Pilih Metode Pembayaran:</b>
  () BCA Virtual Account
  () Mandiri Bill Payment
  () QRIS
  --
  [ <b>LANJUTKAN PEMBAYARAN VIA MIDTRANS</b> ]
  }
}
@endsalt
"@

    "riwayat" = @"
@startsalt
{
  {* Beranda | Paket Umroh | Cara Pendaftaran | Tentang Kami | Kontak | Profil | Logout }
  ==
  <b>RIWAYAT PEMESANAN SAYA</b>
  {#
    <b>ID TRX</b> | <b>Paket</b> | <b>Total Harga</b> | <b>Status Bayar</b> | <b>Dokumen</b> | <b>Aksi</b>
    TRX-001 | Umroh Premium | Rp 35.000.000 | [LUNAS] | [Lengkap] | [Cetak Bukti]
    TRX-005 | Umroh New Season | Rp 32.000.000 | [DP] | [Kurang] | [Bayar Sisa]
  }
}
@endsalt
"@

    "dasbor_admin" = @"
@startsalt
{
  {* <b>KARTIKA MAS ADMIN</b> | Dasbor | Paket | Jamaah | Berangkat | Logout }
  ==
  == Ringkasan Sistem
  {
    <b>Total Jamaah</b> | <b>Pemesanan Aktif</b> | <b>Menunggu Verifikasi</b>
    [    150     ] | [      45       ] | [         12          ]
  }
  --
  == Data Pemesanan Terbaru (Real-time)
  {#
    <b>ID</b> | <b>Nama Jamaah</b> | <b>Paket</b> | <b>Status Bayar</b> | <b>Aksi</b>
    TRX-001 | Amalia Fitri | Premium Jul | [Pending] | [Verifikasi]
    TRX-002 | Budi Santoso | New Season | [Lunas] | [Detail]
    TRX-003 | Siti Aminah | Premium Sep | [DP] | [Verifikasi]
  }
}
@endsalt
"@

    "kelola_paket" = @"
@startsalt
{
  {* <b>KARTIKA MAS ADMIN</b> | Dasbor | Paket | Jamaah | Berangkat | Logout }
  ==
  == KELOLA MASTER PAKET UMROH
  [ + Tambah Paket Baru ]
  --
  <b>Form Edit Paket:</b>
  Nama Paket: | "Umroh Premium (Jul & Ags)"
  Maskapai: | "Saudi Airlines          "
  Harga (Mulai):| "35000000              "
  Kuota: | "21                    "
  [ Simpan Perubahan Paket ]
}
@endsalt
"@

    "kelola_jamaah" = @"
@startsalt
{
  {* <b>KARTIKA MAS ADMIN</b> | Dasbor | Paket | Jamaah | Berangkat | Logout }
  ==
  == MANAJEMEN DATA JAMAAH & PEMESANAN
  Cari Jamaah: [ "Nama / ID Transaksi..." ] [Cari]
  {#
    <b>Nama Jamaah</b> | <b>Paket</b> | <b>Status Dokumen</b> | <b>Status Bayar</b> | <b>Aksi</b>
    Amalia Fitri | Premium Jul | [Lengkap] | [Lunas] | [Edit/Detail]
    Budi Santoso | Premium Sep | [Kurang 2] | [DP] | [Edit/Detail]
  }
}
@endsalt
"@

    "informasi_berangkat" = @"
@startsalt
{
  {* <b>KARTIKA MAS ADMIN</b> | Dasbor | Paket | Jamaah | Berangkat | Logout }
  ==
  == PENGELOLAAN INFORMASI KEBERANGKATAN
  Pilih Paket: ^Umroh Premium (20 Jul 2026)^
  --
  <b>Tanggal Berkumpul:</b> | "19 Juli 2026          "
  <b>Waktu Berkumpul:</b> | "13:00 WIB             "
  <b>Lokasi Kumpul:</b> | "Bandara Soetta T3     "
  <b>Instruksi Tambahan:</b>
  {S
  "Kenakan seragam batik travel, bawa koper kabin"
  }
  [ Simpan Informasi Keberangkatan ]
}
@endsalt
"@

    "kuitansi" = @"
@startsalt
{+
  <color:gray><b>[ KOP SURAT PT KARTIKA MAS JAYA AGUNG ]</b></color>
  == INVOICE PEMBAYARAN UMROH
  --
  <b>ID Transaksi:</b> TRX-001
  <b>Nama Jamaah:</b> Amalia Fitri
  <b>Tanggal Cetak:</b> 10 Juni 2026
  --
  <b>Rincian Pembayaran:</b>
  Pembayaran Pelunasan Paket Umroh Premium (Jul & Ags)
  Metode: Midtrans (BCA Virtual Account)
  Total Dibayar: <b>Rp 35.000.000</b>
  Status: <b>LUNAS</b>
  --
  <i>Dokumen digital ini sah dicetak otomatis oleh sistem.</i>
}
@endsalt
"@
}

foreach ($key in $saltCodes.Keys) {
    $text = $saltCodes[$key]
    $outFile = "C:\Users\MY HP\.gemini\antigravity-ide\brain\4d09b22c-8efb-455d-a2cb-9740baef7a29\wireframe_$key.png"
    Invoke-RestMethod -Uri 'https://kroki.io/plantuml/png' -Method Post -Body $text -ContentType 'text/plain' -OutFile $outFile
}

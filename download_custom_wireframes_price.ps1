$saltCodes = @{
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
    Mulai dari: <b>Rp 150.000</b> | Mulai dari: <b>Rp 100.000</b> | Mulai dari: <b>Rp 125.000</b>
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
  Total Harga: | <b>Rp 150.000</b>
  [   <b>BUAT PEMESANAN</b>   ] | [ Batal ]
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
  == TOTAL PEMBAYARAN: Rp 50.000 (DP)
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
    TRX-001 | Umroh Premium | Rp 150.000 | [LUNAS] | [Lengkap] | [Cetak Bukti]
    TRX-005 | Umroh New Season | Rp 100.000 | [DP] | [Kurang] | [Bayar Sisa]
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
  Harga (Mulai):| "150000                "
  Kuota: | "21                    "
  [ Simpan Perubahan Paket ]
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
  Total Dibayar: <b>Rp 150.000</b>
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

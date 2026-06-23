$saltCodes = @{
    "beranda" = @"
@startsalt
{+
  == SISTEM INFORMASI UMROH PT KARTIKA MAS
  [ Beranda ] | [ Paket Umroh ] | [ Login ]
  --
  <b>DAFTAR PAKET UMROH</b>
  {#
    [ GAMBAR PAKET 1 ] | <b>Reguler 9 Hari</b>\nRp 32.500.000 | [ Detail ]
    [ GAMBAR PAKET 2 ] | <b>Plus Turki 12 Hari</b>\nRp 41.000.000 | [ Detail ]
  }
}
@endsalt
"@

    "upload_dokumen" = @"
@startsalt
{+
  == UPLOAD DOKUMEN PERSYARATAN
  --
  <b>Jenis Dokumen:</b>
  ^Pilih Dokumen...^
  --
  <b>Pilih File:</b>
  [ Browse... ] File_KTP.pdf
  --
  [ <b>UPLOAD SEKARANG</b> ]
  --
  <b>Status Dokumen:</b>
  [X] KTP (Terkonfirmasi)
  [ ] Paspor (Belum Diunggah)
}
@endsalt
"@

    "pembayaran" = @"
@startsalt
{+
  <color:gray><b>[ LOGO MIDTRANS ]</b></color>
  == TOTAL PEMBAYARAN: Rp 10.000.000 (DP)
  --
  <b>Pilih Metode Pembayaran:</b>
  () BCA Virtual Account
  () Mandiri Bill Payment
  () QRIS
  --
  [ <b>LANJUTKAN PEMBAYARAN</b> ]
}
@endsalt
"@

    "riwayat" = @"
@startsalt
{+
  == RIWAYAT PEMESANAN SAYA
  {#
    <b>ID TRX</b> | <b>Paket</b> | <b>Total Harga</b> | <b>Status Bayar</b> | <b>Aksi</b>
    TRX-001 | Reguler 9 Hari | Rp 32.500.000 | [LUNAS] | [Cetak Bukti]
    TRX-005 | Plus Dubai | Rp 39.000.000 | [DP] | [Bayar Sisa]
  }
}
@endsalt
"@

    "kelola_paket" = @"
@startsalt
{+
  == KELOLA PAKET UMROH
  [ + Tambah Paket Baru ]
  --
  <b>Form Edit Paket:</b>
  Nama Paket: | "Reguler 9 Hari          "
  Harga: | "32500000              "
  Kuota: | "45                    "
  [ Simpan Perubahan ]
}
@endsalt
"@

    "kelola_jamaah" = @"
@startsalt
{+
  == DATA JAMAAH & PEMESANAN
  Cari Jamaah: [ "Nama/ID..." ] [Cari]
  {#
    <b>Nama Jamaah</b> | <b>Paket</b> | <b>Dokumen</b> | <b>Bayar</b> | <b>Aksi</b>
    Amalia Fitri | Reguler 9 Hari | [Lengkap] | [Lunas] | [Verifikasi]
    Budi Santoso | Plus Turki | [Kurang] | [DP] | [Verifikasi]
  }
}
@endsalt
"@

    "informasi_berangkat" = @"
@startsalt
{+
  == KELOLA INFORMASI KEBERANGKATAN
  Paket: ^Reguler 9 Hari (10 Agustus 2026)^
  --
  <b>Tanggal Berkumpul:</b> | "09 Agustus 2026       "
  <b>Waktu:</b> | "13:00 WIB             "
  <b>Lokasi:</b> | "Bandara Soetta T3     "
  <b>Instruksi Tambahan:</b>
  {S
  "Kenakan seragam batik travel"
  }
  [ Simpan Informasi ]
}
@endsalt
"@

    "kuitansi" = @"
@startsalt
{+
  <color:gray><b>[ KOP SURAT PT KARTIKA MAS ]</b></color>
  == INVOICE PEMBAYARAN
  --
  <b>ID Transaksi:</b> TRX-001
  <b>Nama:</b> Amalia Fitri
  <b>Tanggal:</b> 10 Juni 2026
  --
  <b>Rincian:</b>
  Pembayaran Pelunasan Paket Reguler 9 Hari
  Total Dibayar: <b>Rp 32.500.000</b>
  Status: <b>LUNAS</b>
  --
  <i>Dokumen ini sah dicetak otomatis oleh sistem.</i>
}
@endsalt
"@
}

foreach ($key in $saltCodes.Keys) {
    $text = $saltCodes[$key]
    $outFile = "C:\Users\MY HP\.gemini\antigravity-ide\brain\4d09b22c-8efb-455d-a2cb-9740baef7a29\wireframe_$key.png"
    Invoke-RestMethod -Uri 'https://kroki.io/plantuml/png' -Method Post -Body $text -ContentType 'text/plain' -OutFile $outFile
}

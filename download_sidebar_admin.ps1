$saltCodes = @{
    "dasbor_admin" = @"
@startsalt
{+
  {
    <b>[ GAMBAR LOGO ]</b>
    --
    [ Dashboard ]
    [ Paket Umroh ]
    [ Data Jamaah ]
    [ Keberangkatan ]
    --
    .
    .
    Admin Pusat
  } | {
    <b>Laporan & Analisis Bisnis</b> | Periode: ^Keseluruhan^ | [Download PDF] | [Notif] | [Keluar ->]
    ==
    <color:white><back:gray>   <b>Dashboard Admin Kartika Mas Tour & Travel</b>   </back></color>
    ==
    {
      TOTAL OMSET (PAID) | TOTAL PEMESANAN | MENUNGGU VERIFIKASI
      <b>Rp 150.000</b> [Ikon] | <b>45 Trx</b> [Ikon] | <b>12 Trx</b> [Ikon]
    }
    ==
    {
      <b>Tren Pemesanan</b> | <b>Komposisi Status Transaksi</b>
      [ GRAFIK GARIS TREN ] | [ GRAFIK LINGKARAN ]
      . | o Pending  o Lunas
      . | o DP  o Batal
    }
  }
}
@endsalt
"@

    "kelola_paket" = @"
@startsalt
{+
  {
    <b>[ GAMBAR LOGO ]</b>
    --
    [ Dashboard ]
    <b>[ Paket Umroh ]</b>
    [ Data Jamaah ]
    [ Keberangkatan ]
    --
    .
    .
    Admin Pusat
  } | {
    <b>Manajemen Paket</b> | [Notif] | [Keluar ->]
    ==
    <color:white><back:gray>   <b>Kelola Data Master Paket Umroh</b>   </back></color>
    ==
    [ + Tambah Paket Baru ]
    --
    <b>Form Edit Paket:</b>
    Nama Paket: | "Umroh Premium (Jul & Ags) "
    Maskapai: | "Saudi Airlines            "
    Harga: | "150000                    "
    Kuota: | "21                        "
    [ Simpan Perubahan Paket ]
  }
}
@endsalt
"@

    "kelola_jamaah" = @"
@startsalt
{+
  {
    <b>[ GAMBAR LOGO ]</b>
    --
    [ Dashboard ]
    [ Paket Umroh ]
    <b>[ Data Jamaah ]</b>
    [ Keberangkatan ]
    --
    .
    .
    Admin Pusat
  } | {
    <b>Manajemen Transaksi</b> | [Notif] | [Keluar ->]
    ==
    <color:white><back:gray>   <b>Kelola Data Jamaah & Verifikasi</b>   </back></color>
    ==
    Cari Jamaah: [ "Nama / ID Transaksi..." ] [Cari]
    --
    {#
      <b>Nama Jamaah</b> | <b>Paket</b> | <b>Dokumen</b> | <b>Bayar</b> | <b>Aksi</b>
      Amalia Fitri | Premium Jul | [Lengkap] | [Lunas] | [Detail]
      Budi Santoso | Premium Sep | [Kurang] | [DP] | [Verifikasi]
    }
  }
}
@endsalt
"@

    "informasi_berangkat" = @"
@startsalt
{+
  {
    <b>[ GAMBAR LOGO ]</b>
    --
    [ Dashboard ]
    [ Paket Umroh ]
    [ Data Jamaah ]
    <b>[ Keberangkatan ]</b>
    --
    .
    .
    Admin Pusat
  } | {
    <b>Jadwal & Logistik</b> | [Notif] | [Keluar ->]
    ==
    <color:white><back:gray>   <b>Pengelolaan Informasi Keberangkatan</b>   </back></color>
    ==
    Pilih Paket: ^Umroh Premium (20 Jul 2026)^
    --
    <b>Tanggal Berkumpul:</b> | "19 Juli 2026          "
    <b>Waktu Berkumpul:</b> | "13:00 WIB             "
    <b>Lokasi Kumpul:</b> | "Bandara Soetta T3     "
    <b>Instruksi Tambahan:</b>
    {S
    "Kenakan seragam batik travel, bawa koper"
    }
    [ Simpan Informasi Keberangkatan ]
  }
}
@endsalt
"@
}

foreach ($key in $saltCodes.Keys) {
    $text = $saltCodes[$key]
    $outFile = "C:\Users\MY HP\.gemini\antigravity-ide\brain\4d09b22c-8efb-455d-a2cb-9740baef7a29\wireframe_$key.png"
    Invoke-RestMethod -Uri 'https://kroki.io/plantuml/png' -Method Post -Body $text -ContentType 'text/plain' -OutFile $outFile
}

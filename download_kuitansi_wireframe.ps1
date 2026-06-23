$saltCodes = @{
    "kuitansi" = @"
@startsalt
{+
  {
    <b>[ GAMBAR LOGO ]</b> | <b>INVOICE / BUKTI PEMESANAN</b>
    <b>KARTIKA MAS</b> | No. Pesanan: #00004
    Travel Umroh & Haji Khusus | Tanggal: 19 June 2026
  }
  ==
  <color:white><back:white>                      </back></color>
  <b>BUKTI PEMESANAN UMROH</b>
  {
    Nama Pemesan | : Test User | Status Pembayaran | : [LUNAS]
    Email | : test@example.com | Total Pembayaran | : Rp 150.000
    Jamaah (Manifest) | : Belum diisi | Tipe Kamar | : QUAD
  }
  
  {#
    <b>Deskripsi Paket</b> | <b>Keberangkatan</b> | <b>Peserta</b> | <b>Harga Total</b>
    Umroh Premium (Jul & Ags) | 20 Jul 2026 s/d | 1 Orang | Rp 150.000
    Durasi: 9 Hari | 28 Jul 2026 | . | .
  }
  
  <b>Informasi Keberangkatan:</b>
  <i>Informasi keberangkatan akan segera diupdate oleh Admin</i>
  <i>mendekati hari-H. Silakan cek secara berkala di sistem.</i>
}
@endsalt
"@
}

foreach ($key in $saltCodes.Keys) {
    $text = $saltCodes[$key]
    $outFile = "C:\Users\MY HP\.gemini\antigravity-ide\brain\4d09b22c-8efb-455d-a2cb-9740baef7a29\wireframe_$key.png"
    Invoke-RestMethod -Uri 'https://kroki.io/plantuml/png' -Method Post -Body $text -ContentType 'text/plain' -OutFile $outFile
}

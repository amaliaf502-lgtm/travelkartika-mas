<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pembayaran Umroh - #{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .page {
            width: 210mm;
            padding: 20mm;
            margin: 0 auto;
        }
        h1.title {
            font-size: 24px;
            margin: 0 0 30px 0;
            color: #333;
            text-transform: uppercase;
            font-weight: 500;
        }
        .invoice-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .status-badge {
            color: {{ in_array($pemesanan->status, ['confirmed', 'completed']) ? '#27ae60' : '#d32f2f' }};
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            font-size: 13px;
        }
        th, td {
            padding: 12px 8px;
            text-align: center;
        }
        th {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            font-weight: bold;
            color: #555;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tbody tr td {
            border-bottom: 1px solid #eee;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
            margin-top: 20px;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .summary-table td {
            padding: 12px 8px;
            font-size: 13px;
        }
        .summary-label {
            text-align: left;
            width: 60%;
        }
        .summary-currency {
            text-align: left;
            width: 5%;
        }
        .summary-value {
            text-align: right;
            width: 35%;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
        }
        .company-info {
            display: flex;
            align-items: center;
            flex: 1;
        }
        .company-info img {
            height: 55px;
            margin-right: 12px;
        }
        .company-text h2 {
            margin: 0;
            color: #8B2D2D;
            font-size: 18px;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .company-text p {
            margin: 3px 0 0 0;
            font-size: 11px;
            color: #777;
        }
        .invoice-details {
            text-align: right;
            flex: 1;
        }
        .invoice-details h1.title {
            font-size: 20px;
            margin: 0 0 5px 0;
            color: #333;
            text-transform: uppercase;
            font-weight: bold;
            white-space: nowrap;
        }
        .invoice-details .invoice-no {
            font-size: 14px;
            font-weight: bold;
            color: #555;
            text-transform: uppercase;
        }
        .status-badge {
            color: {{ in_array($pemesanan->status, ['confirmed', 'completed']) ? '#27ae60' : '#d32f2f' }};
        }
        .catatan-text {
            font-size: 13px;
            color: #555;
            margin-bottom: 30px;
        }

        @media print {
            body { background: white; }
            .page {
                margin: 0;
                padding: 15mm;
                width: auto;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="page">
        <div class="header">
            <div class="company-info">
                <img src="{{ asset('images/kartikamas.png') }}" alt="Logo">
                <div class="company-text">
                    <h2>KARTIKA MAS Tour & Travel</h2>
                    <p>Biro Perjalanan Umroh & Haji Khusus<br>Melayani Ibadah dengan Sepenuh Hati</p>
                </div>
            </div>
            <div class="invoice-details">
                <h1 class="title">TRANSAKSI {{ in_array($pemesanan->status, ['confirmed', 'completed']) ? 'SELESAI' : 'PENDING' }}</h1>
                <div class="invoice-no">
                    INVOICE NO. TRV-{{ $pemesanan->created_at->format('dmy') }}-{{ str_pad($pemesanan->id, 4, '0', STR_PAD_LEFT) }}<br>
                    (<span class="status-badge">{{ in_array($pemesanan->status, ['confirmed', 'completed']) ? 'LUNAS' : 'BELUM LUNAS' }}</span>)
                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; margin-bottom: 30px;">
            <div>
                <div class="section-title" style="margin-top: 0;">DITAGIHKAN KEPADA:</div>
                <div style="font-size: 14px;">
                    <strong>{{ $pemesanan->user->name }}</strong><br>
                    {{ $pemesanan->user->email }}
                </div>
            </div>
            <div style="text-align: right;">
                <div class="section-title" style="margin-top: 0;">STATUS PEMBAYARAN:</div>
                <div style="font-size: 14px; font-weight: bold;" class="status-badge">
                    {{ in_array($pemesanan->status, ['confirmed', 'completed']) ? 'TELAH DITERIMA (LUNAS)' : 'MENUNGGU PEMBAYARAN' }}
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Paket Umroh</th>
                    <th>Harga Per Pax</th>
                    <th>Tanggal Pesan</th>
                    <th>Berangkat</th>
                    <th>Durasi</th>
                    <th>Kamar</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $hargaPerOrang = match(strtolower($pemesanan->tipe_kamar ?? 'quad')) {
                        'triple' => $pemesanan->paket->harga_triple ?? $pemesanan->paket->harga,
                        'double' => $pemesanan->paket->harga_double ?? $pemesanan->paket->harga,
                        default  => $pemesanan->paket->harga,
                    };
                @endphp
                <tr>
                    <td>1</td>
                    <td style="text-align: left;">{{ $pemesanan->paket->nama_paket }}</td>
                    <td>{{ number_format($hargaPerOrang, 0, ',', '.') }}</td>
                    <td>{{ $pemesanan->created_at->format('d M Y') }}</td>
                    <td>{{ $pemesanan->paket->tanggal_berangkat->format('d M Y') }}</td>
                    <td>{{ $pemesanan->paket->durasi_hari }} Hari</td>
                    <td>{{ $pemesanan->jumlah_peserta }} Pax ({{ strtoupper($pemesanan->tipe_kamar ?? 'QUAD') }})</td>
                    <td style="text-align: right;">{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="section-title">DAFTAR BIAYA TAMBAHAN</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="text-align: left; width: 40%;">Nama</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" style="text-align: center; color: #888;">Tidak ada biaya tambahan</td>
                </tr>
            </tbody>
        </table>

        <table class="summary-table">
            <tr style="background-color: #f9f9f9; border-top: 1px solid #ccc;">
                <td class="summary-label">SubTotal</td>
                <td class="summary-currency">Rp</td>
                <td class="summary-value">{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <td class="summary-label">Diskon (Promo)</td>
                <td class="summary-currency">Rp</td>
                <td class="summary-value">0</td>
            </tr>
            <tr style="background-color: #f9f9f9; border-bottom: 1px solid #ccc; font-weight: bold;">
                <td class="summary-label">Grand Total</td>
                <td class="summary-currency">Rp</td>
                <td class="summary-value">{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="section-title">Catatan:</div>
        <div class="catatan-text">
            {{ $pemesanan->catatan ?: '-' }}
        </div>
    </div>
</body>
</html>

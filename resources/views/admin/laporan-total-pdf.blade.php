<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Total Jamaah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }
        .text-center {
            text-align: center;
        }
        .header-title {
            color: #8B2D2D;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .header-subtitle {
            color: #555;
            font-size: 13px;
            margin-top: 0;
            margin-bottom: 15px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }
        .data-table th {
            background-color: #8B2D2D;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-bottom: 2px solid #8B2D2D;
        }
        .header-table td {
            border: none;
            padding: 0 0 10px 0;
            vertical-align: middle;
        }
        .text-muted {
            color: #666;
            font-size: 10px;
        }
        .divider {
            border-bottom: 2px solid #8B2D2D;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td style="width: 20%; text-align: left;">
                @if(file_exists(public_path('images/kartikamas.png')))
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/kartikamas.png'))) }}" alt="Logo" style="max-height: 75px;">
                @endif
            </td>
            <td style="width: 60%; text-align: center;">
                <h2 class="header-title" style="margin-top: 0;">PT. KARTIKA MAS JAYA AGUNG</h2>
                <p class="header-subtitle" style="margin-bottom: 0;">Laporan Rekapitulasi Total Data Jamaah</p>
            </td>
            <td style="width: 20%;"></td> <!-- Spacer untuk menyeimbangkan agar judul benar-benar di tengah -->
        </tr>
    </table>

    <div style="text-align: right; margin-bottom: 5px; font-size: 11px;">
        Total: {{ $pemesanans->count() }} data
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%" style="text-align: center;">No.</th>
                <th width="25%">Identitas Jamaah</th>
                <th width="35%">Biodata Lengkap</th>
                <th width="20%">Pesanan Paket</th>
                <th width="15%" style="text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemesanans as $index => $pemesanan)
            <tr>
                <td class="text-center" style="vertical-align: top; padding-top: 10px;">{{ $index + 1 }}</td>
                <td style="vertical-align: top; padding-top: 10px; line-height: 1.4;">
                    <strong style="font-size: 12px; color: #333;">{{ ucwords($pemesanan->user->name ?? '-') }}</strong><br>
                    <span style="color: #666;">{{ $pemesanan->jenis_kelamin ?? 'Gender Belum Diisi' }}</span><br>
                    <span style="color: #666;">{{ $pemesanan->user->no_hp ?? 'HP Belum Diisi' }}</span>
                </td>
                <td style="vertical-align: top; padding-top: 10px; line-height: 1.5;">
                    <strong>TTL:</strong> {{ ucwords($pemesanan->tempat_lahir ?? '-') }}, {{ $pemesanan->tanggal_lahir ? \Carbon\Carbon::parse($pemesanan->tanggal_lahir)->translatedFormat('d F Y') : '-' }}<br>
                    <strong>Ayah:</strong> {{ ucwords($pemesanan->nama_ayah ?? '-') }} &bull; <strong>Ibu:</strong> {{ ucwords($pemesanan->nama_ibu ?? '-') }}<br>
                    <strong>Pekerjaan:</strong> {{ ucwords($pemesanan->pekerjaan ?? '-') }}<br>
                    <strong>Status Nikah:</strong> {{ ucwords($pemesanan->status_nikah ?? '-') }}
                </td>
                <td style="vertical-align: top; padding-top: 10px; line-height: 1.5;">
                    <strong style="color: #333;">{{ $pemesanan->paket->nama_paket ?? '-' }}</strong><br>
                    <span style="color: #666;">Kamar: {{ strtoupper($pemesanan->tipe_kamar ?? '-') }}</span><br>
                    <span style="color: #666;">Peserta: {{ $pemesanan->jumlah_peserta ?? 1 }} Orang</span>
                </td>
                <td class="text-center" style="vertical-align: top; padding-top: 10px; font-weight: bold;">
                    @if($pemesanan->status === 'paid')
                        <span style="color: #0066cc;">Menunggu</span>
                    @elseif($pemesanan->status === 'confirmed')
                        <span style="color: #1e8e3e;">Dikonfirmasi</span>
                    @elseif($pemesanan->status === 'completed')
                        <span style="color: #1e8e3e;">Selesai</span>
                    @else
                        <span style="color: #666;">{{ ucwords($pemesanan->status ?? '-') }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Data pemesanan jamaah belum tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>

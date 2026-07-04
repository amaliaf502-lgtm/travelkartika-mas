@extends('layouts.admin')

@section('title', 'Admin Dashboard - Travelkartika Mas')

@section('content')
    <div class="page-title">
        <h2>Admin Dashboard</h2>
    </div>

    @section('css')
    <style>
        .small-box {
            border-radius: 4px;
            position: relative;
            display: block;
            margin-bottom: 20px;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            color: #fff !important;
            overflow: hidden;
        }
        .small-box > .inner {
            padding: 20px;
            text-align: left;
        }
        .small-box h3 {
            font-size: 38px;
            font-weight: bold;
            margin: 0 0 5px 0;
            white-space: nowrap;
            padding: 0;
            z-index: 5;
        }
        .small-box p {
            font-size: 15px;
            z-index: 5;
            margin-bottom: 0;
            text-transform: uppercase;
            font-weight: 600;
        }
        .small-box .icon {
            transition: all .3s linear;
            position: absolute;
            top: 15px;
            right: 20px;
            z-index: 0;
            font-size: 55px;
            color: rgba(255, 255, 255, 0.3);
        }
        .small-box:hover .icon {
            font-size: 60px;
            color: rgba(255, 255, 255, 0.6);
        }
        .small-box > .small-box-footer {
            position: relative;
            text-align: center;
            padding: 8px 0;
            color: rgba(255,255,255,0.8);
            display: block;
            z-index: 10;
            background: rgba(0,0,0,0.1);
            text-decoration: none;
            font-size: 13px;
        }
        .small-box > .small-box-footer:hover {
            color: #fff;
            background: rgba(0,0,0,0.15);
        }
        
        .bg-blue-custom { background-color: #00c0ef !important; }
        .bg-green-custom { background-color: #00a65a !important; }
        .bg-orange-custom { background-color: #f39c12 !important; }
        .bg-red-custom { background-color: #dd4b39 !important; }
    </style>
    @endsection

    <!-- Statistics -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="small-box bg-blue-custom">
                <div class="inner">
                    <h3>{{ $total_jamaah }}</h3>
                    <p>Total Jamaah</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.jamaah.index') }}" class="small-box-footer">Selengkapnya</a>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="small-box bg-green-custom">
                <div class="inner">
                    <h3>{{ $total_pemesanan }}</h3>
                    <p>Total Pemesanan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="{{ route('admin.pemesanans.index') }}" class="small-box-footer">Selengkapnya</a>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="small-box bg-orange-custom">
                <div class="inner">
                    <h3>{{ $pemesanan_pending }}</h3>
                    <p>Menunggu</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <a href="{{ route('admin.pemesanans.index', ['status' => 'pending']) }}" class="small-box-footer">Selengkapnya</a>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="small-box bg-red-custom">
                <div class="inner">
                    <h3 style="font-size: 1.5rem; line-height:38px;">Rp {{ number_format($total_revenue, 0, ',', '.') }}</h3>
                    <p>Omset (Lunas)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <a href="{{ route('admin.pemesanans.index') }}" class="small-box-footer">Selengkapnya</a>
            </div>
        </div>
    </div>

    <!-- Main Analytics Row -->
    <div class="row mb-4">
        <!-- Grafik Pendaftaran -->
        <div class="col-md-8 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Pendaftaran Jamaah (7 Bulan Terakhir)</h5>
                </div>
                <div class="card-body">
                    <canvas id="registrationChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Keberangkatan Terdekat -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Keberangkatan Terdekat</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($keberangkatan_terdekat as $paket)
                            @php
                                $hari_lagi = Carbon\Carbon::today()->diffInDays($paket->tanggal_berangkat, false);
                            @endphp
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <a href="{{ route('admin.pakets.show', $paket) }}" class="text-decoration-none text-dark fw-bold">{{ Str::limit($paket->nama_paket, 20) }}</a>
                                    @if($hari_lagi == 0)
                                        <span class="badge rounded-pill" style="background-color: #fdecec; color: #c5221f; font-weight: 500; padding: 4px 10px;">Hari Ini!</span>
                                    @elseif($hari_lagi < 0)
                                        <span class="badge rounded-pill" style="background-color: #f8f9fa; color: #475569; font-weight: 500; padding: 4px 10px;">Selesai</span>
                                    @else
                                        <span class="badge rounded-pill" style="background-color: #e6f2ff; color: #0066cc; font-weight: 500; padding: 4px 10px;">{{ $hari_lagi }} Hari</span>
                                    @endif
                                </div>
                                <div class="text-muted small">
                                    <i class="far fa-calendar-alt"></i> {{ $paket->tanggal_berangkat->format('d M') }} &bull;
                                    <i class="fas fa-users"></i> {{ $paket->jumlahPesertaTerpesan() }}/{{ $paket->kuota }} Kursi
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-3">Tidak ada jadwal dalam waktu dekat.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <!-- Tabel Pemesanan Terbaru -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
                    <h5 class="mb-0">Pemesanan Terbaru</h5>
                    <a href="{{ route('admin.pemesanans.index') }}" class="btn btn-sm" style="background:#8B2D2D; color:white; font-size:0.8rem;">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Jamaah</th>
                                <th>Paket</th>
                                <th>Peserta</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pemesanan_terbaru as $pemesanan)
                                <tr>
                                    <td><strong>{{ $pemesanan->user->name }}</strong></td>
                                    <td>{{ $pemesanan->paket->nama_paket }}</td>
                                    <td>{{ $pemesanan->jumlah_peserta }} orang</td>
                                    <td>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @if($pemesanan->status === 'pending')
                                            <span class="badge rounded-pill" style="background-color: #e6f2ff; color: #0066cc; font-weight: 500; padding: 6px 12px;">Menunggu</span>
                                        @elseif($pemesanan->status === 'confirmed')
                                            <span class="badge rounded-pill" style="background-color: #e6f4ea; color: #1e8e3e; font-weight: 500; padding: 6px 12px;">Dikonfirmasi</span>
                                        @elseif($pemesanan->status === 'dibatalkan')
                                            <span class="badge rounded-pill" style="background-color: #fdecec; color: #c5221f; font-weight: 500; padding: 6px 12px;">Dibatalkan</span>
                                        @elseif($pemesanan->status === 'completed')
                                            <span class="badge rounded-pill" style="background-color: #e6f4ea; color: #1e8e3e; font-weight: 500; padding: 6px 12px;">Selesai</span>
                                        @endif
                                    </td>
                                    <td>{{ $pemesanan->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.pemesanans.show', $pemesanan) }}" class="btn btn-sm btn-primary" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($pemesanan->status === 'pending')
                                                <a href="{{ route('admin.pemesanans.confirm', $pemesanan) }}" class="btn btn-sm btn-success" title="Konfirmasi">
                                                    <i class="fas fa-clipboard-check"></i>
                                                </a>
                                                <form action="{{ route('admin.pemesanans.cancel', $pemesanan) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pemesanan ini?');">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Batalkan">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox"></i> Belum ada pemesanan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data dari controller sudah urut dari bulan terlama ke terbaru
        var labels = @json($chartLabels);
        var data = @json($chartValues);
        var revenueData = @json($chartRevenue);

        // Chart Pendaftaran
        var ctxReg = document.getElementById('registrationChart').getContext('2d');
        new Chart(ctxReg, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Pemesanan',
                    data: data,
                    backgroundColor: 'rgba(139, 45, 45, 0.1)',
                    borderColor: '#8B2D2D',
                    borderWidth: 2,
                    pointBackgroundColor: '#8B2D2D',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });
    });
</script>
@endsection

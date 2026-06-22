<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pemesanan;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $pakets_terbaru = Paket::where('status', 'aktif')
            ->orderBy('tanggal_berangkat', 'asc')
            ->limit(3)
            ->get();
        
        $total_paket = Paket::where('status', 'aktif')->count();
        $total_pemesanan = Pemesanan::reservasiAktif()->count();
        $total_kursi_terisi = (int) Pemesanan::reservasiAktif()->sum('jumlah_peserta');
        $paket_penuh = Paket::where('status', 'aktif')->where('tersedia', '<=', 0)->count();

        return view('home', compact('pakets_terbaru', 'total_paket', 'total_pemesanan', 'total_kursi_terisi', 'paket_penuh'));
    }
}

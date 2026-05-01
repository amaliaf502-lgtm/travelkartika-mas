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
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        $total_paket = Paket::where('status', 'aktif')->count();
        $total_pemesanan = Pemesanan::count();
        $paket_penuh = Paket::where('tersedia', 0)->count();

        return view('home', compact('pakets_terbaru', 'total_paket', 'total_pemesanan', 'paket_penuh'));
    }
}

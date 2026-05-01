<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\View\View;

class PaketController extends Controller
{
    public function index(): View
    {
        $pakets = Paket::where('status', 'aktif')->paginate(6);
        return view('pakets.index', compact('pakets'));
    }

    public function show(Paket $paket): View
    {
        return view('pakets.show', compact('paket'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PemesananController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    public function create(Paket $paket): View
    {
        return view('pemesanans.create', compact('paket'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'jumlah_peserta' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        $paket = Paket::findOrFail($validated['paket_id']);

        if ($paket->tersedia < $validated['jumlah_peserta']) {
            return back()->with('error', 'Kuota tidak mencukupi untuk jumlah peserta yang diminta.');
        }

        $total_harga = $paket->harga * $validated['jumlah_peserta'];

        Pemesanan::create([
            'user_id' => Auth::id(),
            'paket_id' => $validated['paket_id'],
            'jumlah_peserta' => $validated['jumlah_peserta'],
            'total_harga' => $total_harga,
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil dibuat!');
    }

    public function index(): View
    {
        $pemesanans = Auth::user()->pemesanans()->with('paket')->paginate(10);
        return view('pemesanans.index', compact('pemesanans'));
    }

    public function show(Pemesanan $pemesanan): View
    {
        $this->authorize('view', $pemesanan);
        return view('pemesanans.show', compact('pemesanan'));
    }

    public function cancel(Pemesanan $pemesanan): RedirectResponse
    {
        $this->authorize('view', $pemesanan);

        if ($pemesanan->status !== 'pending') {
            return back()->with('error', 'Hanya pemesanan dengan status pending yang bisa dibatalkan.');
        }

        $pemesanan->update(['status' => 'dibatalkan']);
        return back()->with('success', 'Pemesanan berhasil dibatalkan.');
    }

    public function departureInfo(Pemesanan $pemesanan): View
    {
        $this->authorize('view', $pemesanan);

        if ($pemesanan->status !== 'confirmed') {
            abort(403, 'Informasi keberangkatan hanya tersedia untuk pemesanan yang sudah dikonfirmasi.');
        }

        $pemesanan->load('departureInfo', 'paket');
        
        return view('pemesanans.departure-info', compact('pemesanan'));
    }
}
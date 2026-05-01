<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\User;
use App\Models\DepartureInfo;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    //

    public function dashboard(): View
    {
        $total_jamaah = User::where('is_admin', false)->count();
        $total_pemesanan = Pemesanan::count();
        $pemesanan_pending = Pemesanan::where('status', 'pending')->count();
        $total_revenue = Pemesanan::where('status', 'confirmed')->sum('total_harga');

        $pemesanan_terbaru = Pemesanan::with('user', 'paket')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'total_jamaah',
            'total_pemesanan',
            'pemesanan_pending',
            'total_revenue',
            'pemesanan_terbaru'
        ));
    }

    public function pemesanans_index(): View
    {
        $pemesanans = Pemesanan::with('user', 'paket')
            ->latest()
            ->paginate(10);
        
        return view('admin.pemesanans.index', compact('pemesanans'));
    }

    public function pemesanans_show(Pemesanan $pemesanan): View
    {
        $pemesanan->load('user', 'paket', 'departureInfo');
        return view('admin.pemesanans.show', compact('pemesanan'));
    }

    public function pemesanans_confirm(Pemesanan $pemesanan): View
    {
        if ($pemesanan->status !== 'pending') {
            abort(403, 'Hanya pemesanan pending yang bisa dikonfirmasi');
        }

        return view('admin.pemesanans.confirm', compact('pemesanan'));
    }

    public function pemesanans_confirm_store(Request $request, Pemesanan $pemesanan): RedirectResponse
    {
        if ($pemesanan->status !== 'pending') {
            return back()->with('error', 'Hanya pemesanan pending yang bisa dikonfirmasi');
        }

        $validated = $request->validate([
            'tanggal_berkumpul' => 'required|date|after:today',
            'waktu_berkumpul' => 'required|date_format:H:i',
            'lokasi_berkumpul' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'contact_person' => 'required|string|max:255',
            'no_hp_contact' => 'required|string|max:20',
            'instruksi_persiapan' => 'nullable|string',
            'catatan_khusus' => 'nullable|string',
        ]);

        // Update status pemesanan
        $pemesanan->update(['status' => 'confirmed']);

        // Create atau update departure info
        DepartureInfo::updateOrCreate(
            ['pemesanan_id' => $pemesanan->id],
            $validated
        );

        return redirect()->route('admin.pemesanans.show', $pemesanan)
            ->with('success', 'Pemesanan berhasil dikonfirmasi!');
    }

    public function pemesanans_cancel(Pemesanan $pemesanan): RedirectResponse
    {
        if ($pemesanan->status === 'dibatalkan') {
            return back()->with('error', 'Pemesanan sudah dibatalkan sebelumnya');
        }

        $pemesanan->update(['status' => 'dibatalkan']);

        return back()->with('success', 'Pemesanan berhasil dibatalkan!');
    }

    public function jamaah_index(): View
    {
        $jamaah = User::where('is_admin', false)
            ->latest()
            ->paginate(15);
        
        return view('admin.jamaah.index', compact('jamaah'));
    }

    public function jamaah_show(User $jamaah): View
    {
        if ($jamaah->is_admin) {
            abort(403);
        }

        $pemesanans = $jamaah->pemesanans()->with('paket')->latest()->get();
        
        return view('admin.jamaah.show', compact('jamaah', 'pemesanans'));
    }

    public function departure_info_index(): View
    {
        $departure_infos = DepartureInfo::with('pemesanan.user', 'pemesanan.paket')
            ->latest()
            ->paginate(15);
        
        return view('admin.departure-info.index', compact('departure_infos'));
    }
}

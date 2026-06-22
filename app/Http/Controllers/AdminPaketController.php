<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;

class AdminPaketController extends Controller
{
    public function index(): View
    {
        $pakets = Paket::paginate(10);
        return view('admin.pakets.index', compact('pakets'));
    }

    public function kuota_index(): View
    {
        $pakets = Paket::paginate(10);
        return view('admin.pakets.kuota', compact('pakets'));
    }

    public function create(): View
    {
        return view('admin.pakets.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'durasi_hari' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'kuota' => 'required|integer|min:1',
            'tanggal_berangkat' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_berangkat',
            'fasilitas' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
            'harga_triple' => 'nullable|numeric|min:0',
            'harga_double' => 'nullable|numeric|min:0',
            'hotel_makkah_nama' => 'nullable|string|max:255',
            'hotel_makkah_bintang' => 'nullable|integer|min:1|max:5',
            'hotel_makkah_jarak' => 'nullable|string|max:255',
            'hotel_madinah_nama' => 'nullable|string|max:255',
            'hotel_madinah_bintang' => 'nullable|integer|min:1|max:5',
            'hotel_madinah_jarak' => 'nullable|string|max:255',
        ]);

        $paket = Paket::create([
            ...$validated,
            'tersedia' => $validated['kuota'],
        ]);

        return redirect()->route('admin.pakets.show', $paket)->with('success', 'Paket berhasil dibuat!');
    }

    public function show(Paket $paket): View
    {
        return view('admin.pakets.show', compact('paket'));
    }

    public function edit(Paket $paket): View
    {
        return view('admin.pakets.edit', compact('paket'));
    }

    public function update(Request $request, Paket $paket): RedirectResponse
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'durasi_hari' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'kuota' => 'required|integer|min:1',
            'tanggal_berangkat' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_berangkat',
            'fasilitas' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
            'harga_triple' => 'nullable|numeric|min:0',
            'harga_double' => 'nullable|numeric|min:0',
            'hotel_makkah_nama' => 'nullable|string|max:255',
            'hotel_makkah_bintang' => 'nullable|integer|min:1|max:5',
            'hotel_makkah_jarak' => 'nullable|string|max:255',
            'hotel_madinah_nama' => 'nullable|string|max:255',
            'hotel_madinah_bintang' => 'nullable|integer|min:1|max:5',
            'hotel_madinah_jarak' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($paket, $validated) {
            $paket = Paket::lockForUpdate()->findOrFail($paket->id);

            $jumlahTerpesan = (int) Pemesanan::where('paket_id', $paket->id)
                ->reservasiAktif()
                ->sum('jumlah_peserta');

            if ($validated['kuota'] < $jumlahTerpesan) {
                throw ValidationException::withMessages([
                    'kuota' => 'Kuota tidak boleh lebih kecil dari jumlah peserta yang sudah memesan.',
                ]);
            }

            $validated['tersedia'] = $validated['kuota'] - $jumlahTerpesan;
            $paket->update($validated);
        });

        return redirect()->route('admin.pakets.show', $paket)->with('success', 'Paket berhasil diperbarui!');
    }

    public function destroy(Paket $paket): RedirectResponse
    {
        $paket->delete();
        return redirect()->route('admin.pakets.index')->with('success', 'Paket berhasil dihapus!');
    }
}

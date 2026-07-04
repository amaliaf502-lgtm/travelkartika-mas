<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Paket;
use App\Models\User;
use App\Models\DepartureInfo;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    //

    public function dashboard(): View
    {
        $total_jamaah = User::where('is_admin', false)->count();
        $total_pemesanan = Pemesanan::reservasiAktif()->count();
        $pemesanan_pending = Pemesanan::where('status', 'pending')->count();
        $total_revenue = Pemesanan::where('status', 'confirmed')->sum('total_harga');
        $total_kuota = (int) Paket::where('status', 'aktif')->sum('kuota');
        $total_tersedia = (int) Paket::where('status', 'aktif')->sum('tersedia');
        $total_kursi_terisi = $total_kuota - $total_tersedia;
        $paket_penuh = Paket::where('status', 'aktif')->where('tersedia', '<=', 0)->count();

        $pemesanan_terbaru = Pemesanan::with('user', 'paket')
            ->latest()
            ->limit(5)
            ->get();

        // Data chart 7 bulan terakhir
        $chartData = collect(range(6, 0))->map(function ($i) {
            $month = Carbon::now()->subMonths($i);
            return [
                'label' => $month->format('M Y'),
                'total' => Pemesanan::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count(),
                'revenue' => Pemesanan::where('status', 'confirmed')
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->sum('total_harga'),
            ];
        });
        $chartLabels = $chartData->pluck('label');
        $chartValues = $chartData->pluck('total');
        $chartRevenue = $chartData->pluck('revenue');

        // Paket Terlaris (Berdasarkan jumlah pemesanan confirmed/completed)
        $paket_terlaris = Paket::withCount(['pemesanans' => function($q) {
            $q->whereIn('status', ['confirmed', 'completed']);
        }])->orderBy('pemesanans_count', 'desc')->take(5)->get();

        // Keberangkatan Terdekat
        $keberangkatan_terdekat = Paket::where('status', 'aktif')
            ->whereDate('tanggal_berangkat', '>=', Carbon::today())
            ->orderBy('tanggal_berangkat', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'total_jamaah',
            'total_pemesanan',
            'pemesanan_pending',
            'total_revenue',
            'total_kursi_terisi',
            'total_kuota',
            'paket_penuh',
            'pemesanan_terbaru',
            'chartLabels',
            'chartValues',
            'chartRevenue',
            'paket_terlaris',
            'keberangkatan_terdekat'
        ));
    }

    public function pemesanans_index(Request $request): View
    {
        $query = Pemesanan::with('user', 'paket')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%")
                                                  ->orWhere('email', 'like', "%{$search}%"))
                  ->orWhereHas('paket', fn($p) => $p->where('nama_paket', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('bukti')) {
            if ($request->bukti === 'sudah') {
                $query->whereNotNull('bukti_pembayaran');
            } elseif ($request->bukti === 'belum') {
                $query->whereNull('bukti_pembayaran');
            }
        }

        $pemesanans = $query->paginate(10)->withQueryString();
        $pending_count = Pemesanan::where('status', 'pending')->count();

        return view('admin.pemesanans.index', compact('pemesanans', 'pending_count'));
    }

    public function verifikasi_pembayaran_index(Request $request): View
    {
        // Hanya mengambil data dengan status pending untuk diverifikasi
        $query = Pemesanan::with('user', 'paket')
            ->where('status', 'pending')
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%")
                                                  ->orWhere('email', 'like', "%{$search}%"))
                  ->orWhereHas('paket', fn($p) => $p->where('nama_paket', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('bukti')) {
            if ($request->bukti === 'sudah') {
                $query->whereNotNull('bukti_pembayaran');
            } elseif ($request->bukti === 'belum') {
                $query->whereNull('bukti_pembayaran');
            }
        }

        $pemesanans = $query->paginate(10)->withQueryString();
        $pending_count = Pemesanan::where('status', 'pending')->count();

        return view('admin.pemesanans.verifikasi', compact('pemesanans', 'pending_count'));
    }

    public function pemesanans_show(Pemesanan $pemesanan): View
    {
        $pemesanan->load('user', 'paket', 'departureInfo');
        return view('admin.pemesanans.show', compact('pemesanan'));
    }

    public function cetakKuitansi(Pemesanan $pemesanan)
    {
        // Pastikan hanya pemesanan yang tidak dibatalkan / pending yang bisa dicetak kuitansinya
        if (!in_array($pemesanan->status, ['confirmed', 'completed'])) {
            abort(403, 'Kuitansi hanya dapat dicetak untuk pemesanan yang telah dikonfirmasi atau selesai.');
        }

        $pemesanan->load('user', 'paket');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pemesanans.cetak_kuitansi', compact('pemesanan'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('Kuitansi_Pemesanan_' . $pemesanan->id . '.pdf');
    }

    public function pemesanans_confirm(Pemesanan $pemesanan): View
    {
        if (!in_array($pemesanan->status, ['pending', 'confirmed'])) {
            abort(403, 'Hanya pemesanan pending atau confirmed yang bisa diatur keberangkatannya');
        }

        return view('admin.pemesanans.confirm', compact('pemesanan'));
    }

    public function pemesanans_confirm_store(Request $request, Pemesanan $pemesanan): RedirectResponse
    {
        if (!in_array($pemesanan->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'Hanya pemesanan pending atau confirmed yang bisa diatur keberangkatannya');
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

        DB::transaction(function () use ($pemesanan, $validated) {
            $pemesanan = Pemesanan::lockForUpdate()->findOrFail($pemesanan->id);

            if (!in_array($pemesanan->status, ['pending', 'confirmed'])) {
                throw ValidationException::withMessages([
                    'status' => 'Hanya pemesanan pending atau confirmed yang bisa diatur keberangkatannya',
                ]);
            }

            $pemesanan->update(['status' => 'confirmed']);

            DepartureInfo::updateOrCreate(
                ['pemesanan_id' => $pemesanan->id],
                $validated
            );
        });

        if ($request->query('from') === 'departure') {
            return redirect()->route('admin.departure-info.index')
                ->with('success', 'Info keberangkatan berhasil disimpan!');
        }

        return redirect()->route('admin.pemesanans.show', $pemesanan)
            ->with('success', 'Pemesanan berhasil dikonfirmasi!');
    }

    public function pemesanans_cancel(Pemesanan $pemesanan): RedirectResponse
    {
        if ($pemesanan->status === 'dibatalkan') {
            return back()->with('error', 'Pemesanan sudah dibatalkan sebelumnya');
        }

        DB::transaction(function () use ($pemesanan) {
            $pemesanan = Pemesanan::lockForUpdate()->findOrFail($pemesanan->id);

            if ($pemesanan->status === 'dibatalkan') {
                throw ValidationException::withMessages([
                    'status' => 'Pemesanan sudah dibatalkan sebelumnya',
                ]);
            }

            $statusSebelum = $pemesanan->status;
            $pemesanan->update(['status' => 'dibatalkan']);

            if (in_array($statusSebelum, ['pending', 'confirmed'], true)) {
                $paket = Paket::whereKey($pemesanan->paket_id)->lockForUpdate()->firstOrFail();
                $tersediaBaru = min($paket->kuota, $paket->tersedia + $pemesanan->jumlah_peserta);
                $paket->update(['tersedia' => $tersediaBaru]);
            }
        });

        return back()->with('success', 'Pemesanan berhasil dibatalkan!');
    }

    public function jamaah_index(): View
    {
        $jamaah = User::where('is_admin', false)
            ->withCount('pemesanans')
            ->latest()
            ->get();
        
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

    public function jamaah_create(): View
    {
        return view('admin.jamaah.create');
    }

    public function jamaah_store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no_hp' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
            'is_admin' => false,
        ]);

        return redirect()->route('admin.jamaah.index')->with('success', 'Berhasil menambahkan data jamaah baru.');
    }

    public function jamaah_edit(User $jamaah): View
    {
        if ($jamaah->is_admin) {
            abort(403);
        }
        return view('admin.jamaah.edit', compact('jamaah'));
    }

    public function jamaah_update(Request $request, User $jamaah): RedirectResponse
    {
        if ($jamaah->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $jamaah->id,
            'no_hp' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $jamaah->name = $validated['name'];
        $jamaah->email = $validated['email'];
        $jamaah->no_hp = $validated['no_hp'];
        
        if (!empty($validated['password'])) {
            $jamaah->password = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }
        
        $jamaah->save();

        return redirect()->route('admin.jamaah.index')->with('success', 'Data jamaah berhasil diperbarui.');
    }

    public function jamaah_destroy(User $jamaah): RedirectResponse
    {
        if ($jamaah->is_admin) {
            abort(403);
        }

        // Pastikan jamaah tidak punya pemesanan aktif
        if ($jamaah->pemesanans()->whereIn('status', ['pending', 'confirmed'])->exists()) {
            return back()->with('error', 'Tidak dapat menghapus jamaah karena masih memiliki pemesanan aktif (pending/confirmed). Batalkan pemesanan terlebih dahulu.');
        }

        $jamaah->delete();

        return redirect()->route('admin.jamaah.index')->with('success', 'Data jamaah berhasil dihapus.');
    }

    public function departure_info_index(): View
    {
        $departure_infos = DepartureInfo::with('pemesanan.user', 'pemesanan.paket')
            ->latest()
            ->paginate(15);
        
        return view('admin.departure-info.index', compact('departure_infos'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Log;
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
            'paket_id'       => 'required|exists:pakets,id',
            'jumlah_peserta' => 'required|integer|min:1',
            'tipe_kamar'     => 'required|in:quad,triple,double',
            'catatan'        => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {
            $paket = Paket::whereKey($validated['paket_id'])->lockForUpdate()->firstOrFail();

            if ($paket->tersedia < $validated['jumlah_peserta']) {
                throw ValidationException::withMessages([
                    'jumlah_peserta' => 'Kuota tidak mencukupi untuk jumlah peserta yang diminta.',
                ]);
            }

            // Hitung harga sesuai tipe kamar
            $harga = match($validated['tipe_kamar']) {
                'triple' => $paket->harga_triple ?? $paket->harga,
                'double' => $paket->harga_double ?? $paket->harga,
                default  => $paket->harga, // quad
            };

            $total_harga = $harga * $validated['jumlah_peserta'];

            Pemesanan::create([
                'user_id'        => Auth::id(),
                'paket_id'       => $validated['paket_id'],
                'jumlah_peserta' => $validated['jumlah_peserta'],
                'tipe_kamar'     => $validated['tipe_kamar'],
                'total_harga'    => $total_harga,
                'catatan'        => $validated['catatan'] ?? null,
            ]);

            $paket->decrement('tersedia', $validated['jumlah_peserta']);
        });

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

        // Cek status real-time ke Midtrans jika masih pending dan punya midtrans_transaction_id
        // Ini SANGAT PENTING untuk localhost karena webhook Midtrans tidak bisa masuk ke PC lokal.
        if ($pemesanan->status === 'pending' && $pemesanan->midtrans_transaction_id) {
            try {
                \Midtrans\Config::$serverKey = config('midtrans.server_key');
                \Midtrans\Config::$isProduction = config('midtrans.is_production');
                \Midtrans\Config::$curlOptions = [
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_HTTPHEADER => []
                ];
                
                $statusResponse = \Midtrans\Transaction::status($pemesanan->midtrans_transaction_id);
                
                if ($statusResponse->transaction_status == 'capture' || $statusResponse->transaction_status == 'settlement') {
                    $pemesanan->update([
                        'status' => 'confirmed',
                        'nominal_dibayar' => $statusResponse->gross_amount,
                        'catatan' => ($pemesanan->catatan ? $pemesanan->catatan . "\n" : "") . "Pembayaran Lunas Otomatis (Sinkronisasi Midtrans)"
                    ]);
                    session()->flash('success', 'Pembayaran berhasil disinkronisasi dan dikonfirmasi Lunas dari Midtrans!');
                }
            } catch (\Exception $e) {
                // Biarkan saja jika error (misal transaksi belum ada di Midtrans)
            }
        }

        // Jika status masih pending dan belum ada token, buat token baru menggunakan MidtransController
        if ($pemesanan->status === 'pending' && !$pemesanan->snap_token) {
            $remainingAmount = $pemesanan->total_harga - ($pemesanan->nominal_dibayar ?? 0);
            
            if ($remainingAmount > 0) {
                // Memanggil class MidtransController yang sudah menggunakan library resmi Midtrans\Snap
                $midtransController = app(\App\Http\Controllers\MidtransController::class);
                $snapToken = $midtransController->getSnapToken($pemesanan);
                
                if ($snapToken) {
                    $pemesanan->update(['snap_token' => $snapToken]);
                }
            }
        }

        return view('pemesanans.show', compact('pemesanan'));
    }

    public function cetakBukti(Pemesanan $pemesanan): View
    {
        $this->authorize('view', $pemesanan);

        if (!in_array($pemesanan->status, ['confirmed', 'completed'])) {
            abort(403, 'Bukti pemesanan hanya dapat dicetak setelah pembayaran dikonfirmasi.');
        }

        $pemesanan->load('paket', 'departureInfo', 'user');
        return view('pemesanans.cetak', compact('pemesanan'));
    }

    public function cancel(Pemesanan $pemesanan): RedirectResponse
    {
        $this->authorize('view', $pemesanan);

        if ($pemesanan->status !== 'pending') {
            return back()->with('error', 'Hanya pemesanan dengan status pending yang bisa dibatalkan.');
        }

        DB::transaction(function () use ($pemesanan) {
            $pemesanan = Pemesanan::with('paket')->lockForUpdate()->findOrFail($pemesanan->id);

            if ($pemesanan->status !== 'pending') {
                throw ValidationException::withMessages([
                    'status' => 'Hanya pemesanan dengan status pending yang bisa dibatalkan.',
                ]);
            }

            $pemesanan->update(['status' => 'dibatalkan']);

            $paket = Paket::whereKey($pemesanan->paket_id)->lockForUpdate()->firstOrFail();
            $tersediaBaru = min($paket->kuota, $paket->tersedia + $pemesanan->jumlah_peserta);
            $paket->update(['tersedia' => $tersediaBaru]);
        });

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



    public function simulasiBayar(Request $request, Pemesanan $pemesanan): RedirectResponse
    {
        $this->authorize('view', $pemesanan);

        if ($pemesanan->status !== 'pending') {
            return back()->with('error', 'Pemesanan ini tidak dapat dibayar.');
        }

        $request->validate([
            'nominal' => 'required|numeric|min:1',
        ]);

        $nominal = $request->nominal;
        $total_harga = $pemesanan->total_harga;

        // Logika Status
        $status = 'pending';
        if ($nominal >= $total_harga) {
            $status = 'confirmed'; // Lunas
            $message = 'Pembayaran Lunas berhasil! (Simulasi).';
        } elseif ($nominal >= ($total_harga * 0.1)) {
            $status = 'confirmed'; // Kita set confirmed saja biar seat aman, tapi catat nominalnya
            $message = 'Pembayaran DP 10% berhasil! (Simulasi). Seat Anda telah aman.';
        } else {
            return back()->with('error', 'Minimal pembayaran adalah DP 10% dari total harga.');
        }

        $pemesanan->update([
            'nominal_dibayar' => $nominal,
            'status' => $status,
            'catatan' => ($pemesanan->catatan ? $pemesanan->catatan . "\n" : "") . "Pembayaran: Rp " . number_format($nominal, 0, ',', '.') . " (" . ($nominal >= $total_harga ? 'Lunas' : 'DP') . ")",
        ]);

        return back()->with('success', $message);
    }

    public function cekStatusMidtrans(Pemesanan $pemesanan): RedirectResponse
    {
        $this->authorize('view', $pemesanan);

        if (!$pemesanan->midtrans_transaction_id) {
            return back()->with('error', 'Belum ada transaksi Midtrans untuk pemesanan ini.');
        }

        try {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$curlOptions = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => []
            ];
            
            $statusResponse = \Midtrans\Transaction::status($pemesanan->midtrans_transaction_id);
            
            if ($statusResponse->transaction_status == 'capture' || $statusResponse->transaction_status == 'settlement') {
                $pemesanan->update([
                    'status' => 'confirmed',
                    'nominal_dibayar' => $statusResponse->gross_amount,
                    'catatan' => ($pemesanan->catatan ? $pemesanan->catatan . "\n" : "") . "Pembayaran Lunas (Update Manual dari Midtrans)"
                ]);
                return back()->with('success', 'Status berhasil dicek: Pembayaran Lunas dari Midtrans!');
            } elseif ($statusResponse->transaction_status == 'pending') {
                return back()->with('info', 'Status pembayaran di Midtrans saat ini masih Pending.');
            } else {
                // misal expire / cancel / deny
                $pemesanan->update([
                    'status' => 'pending', 
                    'catatan' => ($pemesanan->catatan ? $pemesanan->catatan . "\n" : "") . "Transaksi Midtrans: " . $statusResponse->transaction_status
                ]);
                return back()->with('error', 'Status Midtrans: ' . $statusResponse->transaction_status . '. Pembayaran dibatalkan atau kedaluwarsa.');
            }
        } catch (\Exception $e) {
            // Jika transaksi belum ada di Midtrans (belum dibuka di popup)
            return back()->with('error', 'Transaksi Midtrans belum diproses / dibuat. Silakan klik Bayar Sekarang terlebih dahulu.');
        }
    }

    public function completeData(Pemesanan $pemesanan): View
    {
        $this->authorize('view', $pemesanan);
        return view('pemesanans.complete_data', compact('pemesanan'));
    }

    public function updateManifest(Request $request, Pemesanan $pemesanan): RedirectResponse
    {
        $this->authorize('view', $pemesanan);

        $request->validate([
            'nama_ayah'    => 'required|string|max:255',
            'nama_ibu'     => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan'    => 'required|string|max:255',
            'status_nikah' =>'required|string',
            'status_jamaah' => 'required|in:Jamaah,Ketua Rombongan,Mahram',
            'file_foto'    => 'nullable|image|max:2048',
            'file_ktp'     => 'nullable|image|max:2048',
            'file_kk'      => 'nullable|image|max:2048',
            'file_paspor'  => 'nullable|image|max:2048',
            'file_surat_nikah' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'nama_ayah', 'nama_ibu', 'tempat_lahir', 'tanggal_lahir', 
            'jenis_kelamin', 'pekerjaan', 'status_nikah', 'status_jamaah'
        ]);

        $files = ['file_foto', 'file_ktp', 'file_kk', 'file_paspor', 'file_surat_nikah'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                // Delete old file if exists
                if ($pemesanan->$file) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $pemesanan->$file));
                }
                $path = $request->file($file)->store('manifest_docs', 'public');
                $data[$file] = '/storage/' . $path;
            }
        }

        $data['data_completed_at'] = now();
        
        // Handle Payment if selected
        if ($request->has('pay_option') && $pemesanan->status === 'pending') {
            if ($request->pay_option === 'dp') {
                $nominal = $pemesanan->total_harga * 0.1;
            } elseif ($request->pay_option === 'custom') {
                // Parse the formatted Rupiah string
                $customNominal = str_replace(['Rp', '.', ' '], '', $request->custom_nominal);
                $nominal = is_numeric($customNominal) ? (float) $customNominal : 0;
                
                if ($nominal < ($pemesanan->total_harga * 0.1)) {
                    return back()->with('error', 'Minimal nominal custom adalah 10% dari total harga.');
                }
            } else {
                $nominal = $pemesanan->total_harga;
            }
            
            $data['nominal_dibayar'] = $nominal;
            $data['status'] = 'confirmed'; // Simulasi lunas/DP berhasil
            $data['catatan'] = "Pembayaran " . strtoupper($request->payment_method ?? 'Transfer') . ": Rp " . number_format($nominal, 0, ',', '.') . 
                               " (" . ($request->pay_option === 'custom' ? 'Custom' : ($request->pay_option === 'dp' ? 'DP' : 'Lunas')) . ")";
        }

        $pemesanan->update($data);

        $msg = $request->has('pay_option') ? 'Data berhasil disimpan dan Pembayaran berhasil diproses!' : 'Biodata dan Dokumen berhasil diperbarui!';
        return redirect()->route('pemesanans.show', $pemesanan)->with('success', $msg);
    }

    /**
     * Endpoint Callback Webhook Midtrans.
     */
    public function midtransCallback(Request $request, MidtransService $midtransService): \Illuminate\Http\JsonResponse
    {
        $notification = $request->all();
        Log::info('Midtrans Webhook Received: ', $notification);
        
        $orderIdWithTimestamp = $notification['order_id'] ?? '';
        // Ekstrak ID pemesanan dari format TRV-{id}-{timestamp}
        $parts = explode('-', $orderIdWithTimestamp);
        $pemesananId = $parts[1] ?? null;

        if (!$pemesananId) {
            return response()->json(['message' => 'Invalid Order ID format'], 400);
        }

        $pemesanan = Pemesanan::find($pemesananId);
        if (!$pemesanan) {
            return response()->json(['message' => 'Pemesanan not found'], 404);
        }

        $statusCode = $notification['status_code'] ?? '';
        $grossAmount = $notification['gross_amount'] ?? '';
        $incomingSignature = $notification['signature_key'] ?? '';

        // Validasi Signature Key dari Midtrans
        if (!$midtransService->isValidSignature($orderIdWithTimestamp, $statusCode, $grossAmount, $incomingSignature)) {
            Log::warning('Midtrans Webhook Invalid Signature!');
            return response()->json(['message' => 'Invalid Signature'], 403);
        }

        $transactionStatus = $notification['transaction_status'] ?? '';
        $paymentType = $notification['payment_type'] ?? '';

        DB::transaction(function () use ($pemesanan, $transactionStatus, $paymentType, $grossAmount, $notification) {
            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                // Sukses terbayar
                $pemesanan->update([
                    'status' => 'confirmed',
                    'nominal_dibayar' => (float) $grossAmount,
                    'midtrans_transaction_id' => $notification['transaction_id'] ?? null,
                    'catatan' => ($pemesanan->catatan ? $pemesanan->catatan . "\n" : "") . 
                                 "Pembayaran otomatis Midtrans (" . strtoupper($paymentType) . ") sukses sebesar Rp " . number_format($grossAmount, 0, ',', '.'),
                ]);
            } elseif ($transactionStatus == 'pending') {
                // Menunggu pembayaran
                $pemesanan->update([
                    'midtrans_transaction_id' => $notification['transaction_id'] ?? null,
                ]);
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                // Transaksi gagal atau kedaluwarsa
                $pemesanan->update([
                    'status' => 'pending', // Kembalikan ke pending agar bisa coba bayar lagi
                    'catatan' => ($pemesanan->catatan ? $pemesanan->catatan . "\n" : "") . 
                                 "Transaksi Midtrans (" . strtoupper($paymentType) . ") " . strtoupper($transactionStatus),
                ]);
            }
        });

        return response()->json(['message' => 'Callback processed successfully']);
    }
}
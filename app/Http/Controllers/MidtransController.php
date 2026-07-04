<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Fix CURL SSL certificate error di Laragon (Sandbox only)
        Config::$curlOptions = [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [] // Fix error PHP 8: Undefined array key 10023
        ];
    }

    /**
     * Generate Snap Token dari Midtrans
     */
    public function getSnapToken(Pemesanan $pemesanan)
    {
        Config::$curlOptions = [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => []
        ];

        // Sederhanakan parameter: HAPUS item_details agar bebas error pecahan desimal!
        $grossAmount = (int) $pemesanan->total_harga;

        $orderId = 'TRV-' . $pemesanan->id . '-' . time();
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount, 
            ],
            'customer_details' => [
                'first_name' => $pemesanan->user->name ?? 'Jamaah',
                'email' => $pemesanan->user->email ?? 'jamaah@mail.com',
                'phone' => $pemesanan->user->no_hp ?? '08123456789',
            ],
            'callbacks' => [
                'finish' => route('pemesanans.show', $pemesanan->id),
                'error' => route('pemesanans.show', $pemesanan->id),
                'pending' => route('pemesanans.show', $pemesanan->id),
            ]
        ];

        try {
            $token = \Midtrans\Snap::getSnapToken($params);
            
            // Simpan Order ID ini ke database supaya nanti bisa kita cek statusnya secara manual
            // karena webhook Midtrans tidak bisa menembus masuk ke localhost.
            $pemesanan->update(['midtrans_transaction_id' => $orderId]);
            
            return $token;
        } catch (\Exception $e) {
            \Log::error('Midtrans Snap Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Handle webhook notifikasi otomatis dari Midtrans
     */
    public function handleNotification(Request $request)
    {
        try {
            // Menggunakan class Notification dari library Midtrans
            $notif = new Notification();
        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error: ' . $e->getMessage());
            return response()->json(['message' => 'Invalid Notification'], 400);
        }

        $transactionStatus = $notif->transaction_status;
        $orderId = $notif->order_id;
        $grossAmount = $notif->gross_amount;
        $paymentType = $notif->payment_type;
        $fraudStatus = $notif->fraud_status;

        // Ekstrak ID Pemesanan dari format TRV-{id}-{timestamp}
        $parts = explode('-', $orderId);
        $pemesananId = $parts[1] ?? null;

        $pemesanan = Pemesanan::find($pemesananId);
        if (!$pemesanan) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Logika update status otomatis berdasarkan notifikasi Midtrans
        if ($transactionStatus == 'capture') {
            if ($paymentType == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    $pemesanan->update(['status' => 'pending']);
                } else {
                    $pemesanan->update([
                        'status' => 'confirmed',
                        'nominal_dibayar' => (float) $grossAmount,
                        'catatan' => 'Pembayaran Credit Card Sukses'
                    ]);
                }
            }
        } else if ($transactionStatus == 'settlement') {
            // Jika berhasil / lunas
            $pemesanan->update([
                'status' => 'confirmed',
                'nominal_dibayar' => (float) $grossAmount,
                'catatan' => 'Pembayaran ' . strtoupper($paymentType) . ' Sukses'
            ]);
        } else if ($transactionStatus == 'pending') {
            // Masih menunggu pembayaran
            $pemesanan->update(['status' => 'pending']);
        } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            // Gagal, kedaluwarsa, atau dibatalkan
            $pemesanan->update([
                'status' => 'pending', // Dikembalikan ke pending agar user bisa mencoba bayar ulang
                'catatan' => 'Pembayaran ' . strtoupper($transactionStatus)
            ]);
        }

        return response()->json(['message' => 'Notification processed successfully']);
    }
}


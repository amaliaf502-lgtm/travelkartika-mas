<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    protected string $serverKey;
    protected string $clientKey;
    protected bool $isProduction;
    protected string $snapUrl;

    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
        $this->clientKey = config('midtrans.client_key');
        $this->isProduction = (bool) config('midtrans.is_production');
        
        $this->snapUrl = $this->isProduction 
            ? 'https://app.midtrans.com/snap/v1/transactions' 
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';
    }

    /**
     * Membuat Snap Token untuk transaksi.
     * 
     * @param array $params
     * @return string|null
     */
    public function getSnapToken(array $params): ?string
    {
        try {
            $response = Http::withBasicAuth($this->serverKey, '')
                ->contentType('application/json')
                ->accept('application/json')
                ->post($this->snapUrl, $params);

            if ($response->successful()) {
                return $response->json()['token'] ?? null;
            }

            Log::error('Midtrans Snap API Error response: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Connection Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Memvalidasi signature key dari notifikasi callback Midtrans.
     * 
     * @param string $orderId
     * @param string $statusCode
     * @param string $grossAmount
     * @param string $incomingSignature
     * @return bool
     */
    public function isValidSignature(string $orderId, string $statusCode, string $grossAmount, string $incomingSignature): bool
    {
        // Formula signature Midtrans: SHA512(order_id + status_code + gross_amount + ServerKey)
        $payload = $orderId . $statusCode . $grossAmount . $this->serverKey;
        $calculatedSignature = hash('sha512', $payload);
        return hash_equals($calculatedSignature, $incomingSignature);
    }
}

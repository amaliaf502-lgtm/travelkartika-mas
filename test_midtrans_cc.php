<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\Midtrans\Config::$serverKey = config('midtrans.server_key');
\Midtrans\Config::$isProduction = config('midtrans.is_production');
\Midtrans\Config::$curlOptions = [
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_HTTPHEADER => []
];

// 1. Get Card Token (Bypass 3DS for simple test)
$cardParams = [
    'card_number' => '4811111111111114',
    'card_exp_month' => '12',
    'card_exp_year' => '2028',
    'card_cvv' => '123',
    'client_key' => config('midtrans.client_key')
];

$url = 'https://api.sandbox.midtrans.com/v2/token?' . http_build_query($cardParams);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
$tokenData = json_decode($response, true);

if (!isset($tokenData['token_id'])) {
    die("Gagal mendapatkan token kartu: " . $response);
}

// 2. Charge using CoreAPI with Real High Amount
$orderId = 'TRV-REAL-' . time();
$chargeParams = [
    'payment_type' => 'credit_card',
    'transaction_details' => [
        'order_id' => $orderId,
        'gross_amount' => 94000000
    ],
    'credit_card' => [
        'token_id' => $tokenData['token_id'],
        'authentication' => false
    ]
];

try {
    $result = \Midtrans\CoreApi::charge($chargeParams);
    echo "BERHASIL! Transaksi masuk ke Midtrans.\n";
    echo "Order ID: " . $orderId . "\n";
    echo "Status di Midtrans: " . $result->transaction_status . "\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}

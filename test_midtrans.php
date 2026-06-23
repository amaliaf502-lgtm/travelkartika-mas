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

$params = [
    'transaction_details' => [
        'order_id' => 'TEST-' . time(),
        'gross_amount' => 10000
    ],
    'customer_details' => [
        'first_name' => 'Test',
        'email' => 'test@test.com'
    ]
];

try {
    $token = \Midtrans\Snap::getSnapToken($params);
    echo "BERHASIL! Snap Token: " . $token;
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString();
}

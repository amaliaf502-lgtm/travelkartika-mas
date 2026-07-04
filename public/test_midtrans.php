<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$p = App\Models\Pemesanan::latest()->first();
echo "Order ID: " . $p->midtrans_transaction_id . "\n";
if (!$p->midtrans_transaction_id) {
    die("No transaction ID");
}

\Midtrans\Config::$serverKey = config('midtrans.server_key');
\Midtrans\Config::$isProduction = config('midtrans.is_production');
\Midtrans\Config::$curlOptions = [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_HTTPHEADER => []];

try {
    $res = \Midtrans\Transaction::status($p->midtrans_transaction_id);
    print_r($res);
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

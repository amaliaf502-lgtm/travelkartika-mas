<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$paket = App\Models\Paket::where('nama_paket', 'like', '%Umroh New Season%')->first();
if($paket) {
    $paket->harga = 100000;
    $paket->harga_triple = 110000;
    $paket->harga_double = 120000;
    $paket->save();
    echo "Harga berhasil dikembalikan ke 100rb, 110rb, 120rb!\n";
} else {
    echo "Paket tidak ditemukan\n";
}

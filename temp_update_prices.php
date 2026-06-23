<?php
$p1 = App\Models\Paket::where('nama_paket', 'Umroh Premium September')->first();
if ($p1) {
    $p1->harga = 125000;
    $p1->harga_triple = 135000;
    $p1->harga_double = 145000;
    $p1->save();
}

$p2 = App\Models\Paket::where('nama_paket', 'Umroh Premium (Jul & Ags)')->first();
if ($p2) {
    $p2->harga = 150000;
    $p2->harga_triple = 160000;
    $p2->harga_double = 170000;
    $p2->save();
}
echo "OK";

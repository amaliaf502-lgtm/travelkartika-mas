<?php
$p = App\Models\Paket::where('nama_paket', 'Umroh New Season (Jul, Ags, Sep)')->first();
if ($p) {
    $p->harga = 100000;
    $p->harga_triple = 110000;
    $p->harga_double = 120000;
    $p->save();
    echo "OK";
}

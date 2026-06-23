<?php
use App\Models\Paket;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\DB;

// Restore kuota
Paket::query()->update(['tersedia' => DB::raw('kuota')]);

// Delete all pemesanans
Pemesanan::query()->delete();

echo "Cleanup OK";

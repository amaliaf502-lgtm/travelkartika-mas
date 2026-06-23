<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Paket;
use App\Models\Pemesanan;
use App\Models\User;

class BookingQuotaTest extends TestCase
{
    use RefreshDatabase;

    public function test_quota_sync_after_pemesanan()
    {
        // Create paket with kuota 10
        $paket = Paket::create([
            'nama_paket' => 'Test Paket',
            'deskripsi' => 'Desc',
            'durasi_hari' => 5,
            'harga' => 1000,
            'kuota' => 10,
            'tersedia' => 10,
            'tanggal_berangkat' => now()->addDays(10),
            'tanggal_kembali' => now()->addDays(15),
            'status' => 'aktif',
            'fasilitas' => 'Test Fasilitas',
        ]);

        $user = User::factory()->create();

        // first pemesanan 3 peserta
        Pemesanan::create([
            'user_id' => $user->id,
            'paket_id' => $paket->id,
            'jumlah_peserta' => 3,
            'total_harga' => 3 * $paket->harga,
            'status' => 'pending',
            'tanggal_pemesanan' => now(),
        ]);

        // second pemesanan 4 peserta
        Pemesanan::create([
            'user_id' => $user->id,
            'paket_id' => $paket->id,
            'jumlah_peserta' => 4,
            'total_harga' => 4 * $paket->harga,
            'status' => 'pending',
            'tanggal_pemesanan' => now(),
        ]);

        // Refresh paket from DB and assert tersedia is updated
        $paket->refresh();

        $this->assertEquals(10 - (3 + 4), $paket->tersedia);
    }
}

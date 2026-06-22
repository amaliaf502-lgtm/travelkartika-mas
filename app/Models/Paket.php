<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'durasi_hari',
        'harga',
        'harga_triple',
        'harga_double',
        'kuota',
        'tersedia',
        'tanggal_berangkat',
        'tanggal_kembali',
        'fasilitas',
        'status',
        'gambar',
        'hotel_makkah_nama',
        'hotel_makkah_bintang',
        'hotel_makkah_jarak',
        'hotel_madinah_nama',
        'hotel_madinah_bintang',
        'hotel_madinah_jarak',
    ];

    protected $casts = [
        'tanggal_berangkat' => 'date',
        'tanggal_kembali' => 'date',
        'harga' => 'float',
        'harga_triple' => 'float',
        'harga_double' => 'float',
        'hotel_makkah_bintang' => 'integer',
        'hotel_madinah_bintang' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($paket) {
            // Prevent infinite recursion by only syncing if departure date changed
            if ($paket->isDirty('tanggal_berangkat') || $paket->isDirty('kuota')) {
                self::syncKuotaBersama($paket->tanggal_berangkat);
            }
        });
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function jumlahPesertaTerpesan(): int
    {
        return (int) $this->pemesanans()
            ->reservasiAktif()
            ->sum('jumlah_peserta');
    }

    public static function syncKuotaBersama($tanggal): void
    {
        if (!$tanggal) return;

        // Perform the whole operation inside a transaction and lock involved rows
        DB::transaction(function () use ($tanggal) {
            // Lock paket rows for this date to prevent concurrent updates
            $paketsOnDate = self::whereDate('tanggal_berangkat', $tanggal)
                ->where('status', 'aktif')
                ->lockForUpdate()
                ->get();

            if ($paketsOnDate->isEmpty()) return;

            // Group quota limit is determined by the maximum 'kuota' set among these packages
            $groupLimit = $paketsOnDate->max('kuota');

            // Collect paket ids
            $paketIds = $paketsOnDate->pluck('id')->toArray();

            // Sum active bookings for all packages sharing this departure date while locking those pemesanan rows
            $totalTerpesan = 0;
            $pemesanans = Pemesanan::whereIn('paket_id', $paketIds)
                ->reservasiAktif()
                ->lockForUpdate()
                ->get(['jumlah_peserta']);

            foreach ($pemesanans as $p) {
                $totalTerpesan += (int) $p->jumlah_peserta;
            }

            $sisa = max(0, $groupLimit - $totalTerpesan);

            // Perform raw update to bypass Eloquent events and avoid recursion
            self::whereIn('id', $paketIds)->update([
                'tersedia' => $sisa
            ]);
        });
    }

    public function refreshKetersediaan(): void
    {
        self::syncKuotaBersama($this->tanggal_berangkat);
    }
}

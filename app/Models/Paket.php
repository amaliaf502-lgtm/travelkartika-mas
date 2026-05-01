<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'durasi_hari',
        'harga',
        'kuota',
        'tersedia',
        'tanggal_berangkat',
        'tanggal_kembali',
        'fasilitas',
        'itinerari',
        'status',
        'gambar',
    ];

    protected $casts = [
        'tanggal_berangkat' => 'date',
        'tanggal_kembali' => 'date',
        'harga' => 'float',
    ];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}

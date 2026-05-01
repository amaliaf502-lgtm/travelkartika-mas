<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartureInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemesanan_id',
        'tanggal_berkumpul',
        'waktu_berkumpul',
        'lokasi_berkumpul',
        'alamat_lengkap',
        'contact_person',
        'no_hp_contact',
        'instruksi_persiapan',
        'catatan_khusus',
    ];

    protected $casts = [
        'tanggal_berkumpul' => 'date',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}

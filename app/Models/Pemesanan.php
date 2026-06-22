<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paket_id',
        'jumlah_peserta',
        'tipe_kamar',
        'total_harga',
        'nominal_dibayar',
        'status',
        'status_jamaah',
        'bukti_pembayaran',
        'snap_token',
        'midtrans_transaction_id',
        'catatan',
        'tanggal_pemesanan',
        // Manifest Biodata
        'nama_ayah',
        'nama_ibu',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'status_nikah',
        // Manifest Dokumen
        'file_foto',
        'file_ktp',
        'file_kk',
        'file_paspor',
        'file_surat_nikah',
        'data_completed_at',
    ];

    protected $casts = [
        'tanggal_pemesanan' => 'datetime',
        'tanggal_lahir' => 'date',
        'data_completed_at' => 'datetime',
        'total_harga' => 'float',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($pemesanan) {
            if ($pemesanan->paket) {
                Paket::syncKuotaBersama($pemesanan->paket->tanggal_berangkat);
            }
        });

        static::deleted(function ($pemesanan) {
            if ($pemesanan->paket) {
                Paket::syncKuotaBersama($pemesanan->paket->tanggal_berangkat);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function departureInfo()
    {
        return $this->hasOne(DepartureInfo::class);
    }

    public function scopeReservasiAktif($query)
    {
        return $query->whereIn('status', ['pending', 'confirmed']);
    }
}

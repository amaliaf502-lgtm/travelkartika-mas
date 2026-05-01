<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departure_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->unique()->constrained()->onDelete('cascade');
            $table->date('tanggal_berkumpul');
            $table->time('waktu_berkumpul');
            $table->string('lokasi_berkumpul');
            $table->text('alamat_lengkap')->nullable();
            $table->string('contact_person');
            $table->string('no_hp_contact');
            $table->text('instruksi_persiapan')->nullable();
            $table->text('catatan_khusus')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departure_infos');
    }
};

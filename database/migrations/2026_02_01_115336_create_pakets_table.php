<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->text('deskripsi');
            $table->integer('durasi_hari');
            $table->decimal('harga', 15, 2);
            $table->integer('kuota');
            $table->integer('tersedia');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali');
            $table->text('fasilitas');
            $table->text('itinerari');
            $table->string('status')->default('aktif');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};

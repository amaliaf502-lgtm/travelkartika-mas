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
        Schema::table('pemesanans', function (Blueprint $table) {
            // Biodata
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('status_nikah')->nullable();

            // Dokumen
            $table->string('file_foto')->nullable();
            $table->string('file_ktp')->nullable();
            $table->string('file_kk')->nullable();
            $table->string('file_paspor')->nullable();
            $table->string('file_surat_nikah')->nullable();

            // Meta
            $table->timestamp('data_completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropColumn([
                'nama_ayah', 'nama_ibu', 'tempat_lahir', 'tanggal_lahir', 
                'jenis_kelamin', 'pekerjaan', 'status_nikah',
                'file_foto', 'file_ktp', 'file_kk', 'file_paspor', 'file_surat_nikah',
                'data_completed_at'
            ]);
        });
    }
};

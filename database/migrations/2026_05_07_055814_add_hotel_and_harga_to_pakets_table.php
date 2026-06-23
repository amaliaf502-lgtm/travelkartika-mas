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
        Schema::table('pakets', function (Blueprint $table) {
            $table->decimal('harga_triple', 15, 2)->nullable()->after('harga');
            $table->decimal('harga_double', 15, 2)->nullable()->after('harga_triple');
            $table->string('hotel_makkah_nama')->nullable()->after('status');
            $table->integer('hotel_makkah_bintang')->nullable()->after('hotel_makkah_nama');
            $table->string('hotel_makkah_jarak')->nullable()->after('hotel_makkah_bintang');
            $table->string('hotel_madinah_nama')->nullable()->after('hotel_makkah_jarak');
            $table->integer('hotel_madinah_bintang')->nullable()->after('hotel_madinah_nama');
            $table->string('hotel_madinah_jarak')->nullable()->after('hotel_madinah_bintang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pakets', function (Blueprint $table) {
            $table->dropColumn([
                'harga_triple',
                'harga_double',
                'hotel_makkah_nama',
                'hotel_makkah_bintang',
                'hotel_makkah_jarak',
                'hotel_madinah_nama',
                'hotel_madinah_bintang',
                'hotel_madinah_jarak'
            ]);
        });
    }
};

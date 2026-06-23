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
            $table->decimal('nominal_dibayar', 15, 2)->default(0)->after('total_harga');
        });
    }

    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropColumn('nominal_dibayar');
        });
    }
};

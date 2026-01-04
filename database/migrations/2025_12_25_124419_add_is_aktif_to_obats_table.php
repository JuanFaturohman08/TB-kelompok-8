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
        Schema::table('obats', function (Blueprint $table) {
            // kolom status aktif, default true (1)
            $table->boolean('is_aktif')
                ->default(true)
                ->after('barcode'); // sesuaikan posisi dengan struktur tabelmu
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('obats', function (Blueprint $table) {
            $table->dropColumn('is_aktif');
        });
    }
};

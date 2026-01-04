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
            // sesuaikan urutan kolom dengan tabelmu
            $table->string('barcode', 100)->nullable()->after('kode');
            $table->string('kandungan', 255)->nullable()->after('nama_obat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('obats', function (Blueprint $table) {
            // rollback harus menghapus kolom yang tadi ditambah
            $table->dropColumn(['barcode', 'kandungan']);
        });
    }
};

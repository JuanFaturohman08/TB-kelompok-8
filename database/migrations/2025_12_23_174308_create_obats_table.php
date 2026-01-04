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
    Schema::create('obats', function (Blueprint $table) {
        $table->id();
        $table->string('kode')->unique();          // kode obat / barcode
        $table->string('nama_obat');               // nama obat
        $table->string('kategori')->nullable();    // misal: antibiotik, vitamin
        $table->string('bentuk')->nullable();      // tablet, kapsul, sirup
        $table->string('satuan')->nullable();      // strip, botol, box
        $table->integer('stok')->default(0);       // stok saat ini
        $table->integer('stok_minimum')->default(0); // batas minimum
        $table->decimal('harga_beli', 12, 2)->default(0);
        $table->decimal('harga_jual', 12, 2)->default(0);
        $table->date('tanggal_kadaluarsa')->nullable();
        $table->string('produsen')->nullable();    // pabrik / supplier
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};

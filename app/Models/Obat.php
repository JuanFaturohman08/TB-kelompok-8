<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
    'kode',
    'nama_obat',
    'kandungan',      // tambah
    'kategori',
    'bentuk',
    'satuan',
    'stok',
    'stok_minimum',
    'lokasi_rak',     // tambah
    'harga_beli',
    'harga_jual',
    'tanggal_kadaluarsa',
    'produsen',
    'barcode',        // tambah
    'is_aktif',       // tambah
];


}

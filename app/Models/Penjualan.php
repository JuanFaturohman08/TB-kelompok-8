<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'user_id',
        'total',
        'catatan',
    ];

    // Cast kolom tanggal menjadi instance Carbon (datetime)
    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(PenjualanItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


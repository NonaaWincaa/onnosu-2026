<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketOrder extends Model
{
    use HasFactory;

    // Matikan pencarian kolom updated_at
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'jurusan',
        'asal_fakultas',
        'jumlah_tiket',
        'batch_pembelian',
        'harga_per_tiket',
        'diskon',
        'total_bayar',
        'bukti_pembayaran',
        'status_pembayaran',
    ];
}
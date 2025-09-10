<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;
use App\Models\Product;

class TransaksiDetail extends Model
{
    protected $table = 'transaksi_detail';
    protected $fillable = [
        'transaksi_id',
        'product_id',
        'jumlah',
        'harga',
        'subtotal',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

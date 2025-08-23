<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "transaksi";
    protected $fillable = ['product_id', 'jumlah', 'total'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

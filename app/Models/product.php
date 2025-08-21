<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table ="product";
        protected $fillable = [
        'kategori_id',
        'nama_produk',
        'harga_beli',
        'harga_jual',
        'stok',
        'stok_minimal',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}

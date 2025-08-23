<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = "product";

        protected $fillable = [
        'kategori_id',
        'supplier_id',
        'harga_beli',
        'harga_jual',
        'stok',
        'stok_minimal',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}

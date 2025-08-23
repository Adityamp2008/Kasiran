<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table="supplier";

        protected $fillable = [
        'nama_supplier',
        'kontak',
        'alamat',
        'nama_product',
    ];

    public function product()
{
    return $this->hasMany(Product::class);
}
}

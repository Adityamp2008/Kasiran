<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TransaksiDetail;
use App\Models\Diskon;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'kode_transaksi',
        'total',
        'diskon_id',
    ];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    public function diskon()
    {
        return $this->belongsTo(Diskon::class);
    }
}

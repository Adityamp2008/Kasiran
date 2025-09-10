<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $table = "diskon";

        protected $fillable = [
        'nama_diskon',
        'tipe',
        'nilai',
        'min_belanja',
        'min_qty',
        'status'
    ];
}

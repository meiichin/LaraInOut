<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'kategori_id', 'nominal', 'deskripsi',
    ];

    public function kat()
    {
        return $this->hasMany('App\models\Kategori');
    }
}

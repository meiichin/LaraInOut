<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'tipe', 'nama', 'deskripsi',
    ];

    public function katkat()
    {
        return $this->belongsTo('App\models\Transaksi');
    }
}

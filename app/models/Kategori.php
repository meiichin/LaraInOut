<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'tipe', 'nama', 'deskripsi',
    ];
}

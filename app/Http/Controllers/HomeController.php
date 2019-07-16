<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Transaksi;
use App\models\Kategori;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $model = Transaksi::all();
        $saldo = 0;
        $luar = 0;
        $masuk = 0;
        foreach ($model as $key => $value) {
            $transak = Kategori::findOrFail($value->kategori_id);
            if($transak->tipe == "0"){
                $saldo = $saldo - $value->nominal;
                $luar = $luar + $value->nominal;
            }else{
                $saldo = $saldo + $value->nominal;
                $masuk = $masuk + $value->nominal;
            }
        }
        return view('welcome')
        ->with('saldo', $saldo)
        ->with('luar', $luar)
        ->with('masuk', $masuk);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\models\Transaksi;
use App\models\Kategori;
use Illuminate\Support\Facades\Input;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Transaksi::all();
        $saldo = 0;
        foreach ($model as $key => $value) {
            $transak = Kategori::findOrFail($value->kategori_id);
            if($transak->tipe == "0"){
                $saldo = $saldo - $value->nominal;
            }else{
                $saldo = $saldo + $value->nominal;
            }
        }
        return view('transaksi.index')
        ->with('saldo', $saldo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Transaksi();
        return view('transaksi.form', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori_id' => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'deskripsi' => 'required|string|max:255'
        ]);

        $model = Transaksi::create($request->all());
        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Transaksi::findOrFail($id);
        $kate = Kategori::findOrFail($model->kategori_id);
        $kateall = Kategori::where('tipe',$kate->tipe)->get();
        // return $kateall;
        return view('transaksi.form')
        ->with('model', $model)
        ->with('kate', $kate)
        ->with('kateall', $kateall);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kategori_id' => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'deskripsi' => 'required|string|max:255'
        ]);

        $model = Transaksi::findOrFail($id);

        $model->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Transaksi::findOrFail($id);
        $model->delete();
    }

    public function dataTable()
    {
        $model = Transaksi::all();
        return DataTables::of($model)
        ->addColumn('kate', function ($model) {
            $kate = Kategori::find($model->kategori_id)->nama ?? "Undifined";
            return "<span class='badge badge-info text-white'>".$kate."</span>";
        })
        ->addColumn('tipe', function ($model) {
            $kate = Kategori::find($model->kategori_id)->tipe ?? "Undifined";
            if($kate == "0"){
                return "<span class='badge badge-danger text-white'>Pengeluaran</span>";
            }else{
                return "<span class='badge badge-success text-white'>Pemasukan</span>";
            }
        })
        ->addColumn('action', function ($model) {
            return view('layouts._action', [
                'model' => $model,
                'url_edit' => route('transaksi.edit', $model->id),
                'url_destroy' => route('transaksi.destroy', $model->id)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action','kate','tipe'])
        ->make(true);
    }

    public function dataTableFilter($start, $end)
    {
        $model = Transaksi::whereBetween('created_at', [$start, $end])->get();
        return DataTables::of($model)
        ->addColumn('action', function ($model) {
            return view('layouts._action', [
                'model' => $model,
                'url_edit' => route('transaksi.edit', $model->id),
                'url_destroy' => route('transaksi.destroy', $model->id)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }

    public function filter()
    {
        $start = input::get('start');
        $end = input::get('end');
        $model = Transaksi::whereBetween('created_at', [$start, $end])->get();
        $saldo = 0;
        foreach ($model as $key => $value) {
            $transak = Kategori::findOrFail($value->kategori_id);
            if($transak->tipe == "0"){
                $saldo = $saldo - $value->nominal;
            }else{
                $saldo = $saldo + $value->nominal;
            }
        }
        // return $saldo;
        return view('transaksi.filter')
        ->with('saldo', $saldo)
        ->with('start', $start)
        ->with('end', $end);
    }
}

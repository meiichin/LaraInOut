<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Kategori();
        return view('kategori.form', compact('model'));
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
            'tipe' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255'
        ]);

        $model = Kategori::create($request->all());
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
        $model = Kategori::findOrFail($id);
        return view('kategori.form', compact('model'));
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
            'tipe' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255'
        ]);

        $model = Kategori::findOrFail($id);

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
        $model = Kategori::findOrFail($id);
        $model->delete();
    }

    public function dataTable()
    {
        $model = Kategori::all();
        return DataTables::of($model)
        ->addColumn('action', function ($model) {
            return view('layouts._action', [
                'model' => $model,
                'url_edit' => route('kategori.edit', $model->id),
                'url_destroy' => route('kategori.destroy', $model->id)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }
}

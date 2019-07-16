<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Route::resource('kategori', 'KategoriController');
Route::get('/table/kategori', 'KategoriController@dataTable')->name('table.kategori');

Route::resource('transaksi', 'TransaksiController');
Route::get('/table/transaksi', 'TransaksiController@dataTable')->name('table.transaksi');
Route::get('/table/filter/{start}/{end}', 'TransaksiController@dataTableFilter')->name('table.filter');
Route::get('/filter/transaksi', 'TransaksiController@filter')->name('filter.transaksi');
Route::get('/valkategori/{id}', 'KategoriController@valkategori')->name('valkategori');

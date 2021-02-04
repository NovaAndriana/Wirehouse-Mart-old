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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
//edit data
//Route::get('edit','ProdukController@edit')->name('edit');
//update data
//Route::POST('update','ProdukController@update')->name('update');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/exportproduk', 'ProdukController@produkexport')->name('exportproduk');
Route::post('/importproduk','ProdukController@produkimport')->name('importproduk');
//Route::get('/dropdownlistbrand', 'ProdukController@getBrands');

Route::resource('/user', 'UserController');
Route::resource('/produk', 'ProdukController');
Route::resource('/brand', 'BrandController');
Route::resource('/supplier', 'SupplierController');
Route::resource('/satuan', 'SatuanController');
Route::resource('/kategori', 'KategoriController');
Route::resource('/menu', 'MenuController');
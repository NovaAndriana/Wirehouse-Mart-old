<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'Api\UserappController@login');
Route::post('register', 'Api\UserappController@register');
Route::post('checkout', 'Api\TransaksiController@store');
Route::get('checkout/userapp/{id}', 'Api\TransaksiController@history');
Route::get('produk', 'Api\ProdukController@index');
Route::get('menu', 'Api\MenuController@index');
Route::get('produkdiskon', 'Api\ProdukController@produkdiskon');
Route::get('brandpopuler','Api\BrandController@index');
Route::get('brandall','Api\BrandController@getbrandall');

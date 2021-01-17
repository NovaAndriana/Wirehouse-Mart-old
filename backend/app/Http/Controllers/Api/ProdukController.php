<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produk;

class ProdukController extends Controller
{
    public function index(){
        // dd($requset->all());die();
        $produk = Produk::where('diskon', '=','0')->get();
        $jumlahdata = $produk->count();
        return response()->json([
            'success' => 1,
            'message' => 'Get Produk Berhasil',
            'jumlah_data' => $jumlahdata,
            'produk' => $produk
        ]);
    }
     public function produkdiskon(){
         // dd($requset->all());die();
         $produkdiskon = Produk::where('diskon', '<>','0')->get();
         $jumlahdata = $produkdiskon->count();
         return response()->json([
             'success' => 1,
             'message' => 'Get Produk Diskon Berhasil',
             'jumlah_data' => $jumlahdata,
             'produk' => $produkdiskon
         ]);
     }
}

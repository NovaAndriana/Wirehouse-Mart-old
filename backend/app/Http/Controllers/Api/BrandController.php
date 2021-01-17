<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;

class BrandController extends Controller
{
    public function index(){
        // dd($requset->all());die();
        $brand = Brand::where('is_populer', '=','1')->get();
        $jumlahdata = $brand->count();
        return response()->json([
            'success' => 1,
            'message' => 'Get Brand Populer Berhasil',
            'jumlah_data' => $jumlahdata,
            'databrand' => $brand
        ]);
    }
     public function getbrandall(){
         // dd($requset->all());die();
         $brandall = Brand::all();
         $jumlahdata = $brandall->count();
         return response()->json([
             'success' => 1,
             'message' => 'Get Brand All Berhasil',
             'jumlah_data' => $jumlahdata,
             'databrand' => $brandall
         ]);
     }
}

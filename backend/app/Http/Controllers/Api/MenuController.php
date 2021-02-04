<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;

class MenuController extends Controller
{
    public function index(){
        // dd($requset->all());die();
        $getmenu = Menu::all();
         $jumlahdata = $getmenu->count();
         return response()->json([
             'success' => 1,
             'message' => 'Get Menu Berhasil',
             'jumlah_data' => $jumlahdata,
             'datamenu' => $getmenu
         ]);
    }
}

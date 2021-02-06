<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Transaksi;
use App\TransaksiDetail;

class TransaksiController extends Controller
{
    public function store(Request $requset){
        //nama, email, password
        $validasi = Validator::make($requset->all(), [
            'user_id' => 'required',
            'total_item' => 'required',
            'total_harga' => 'required',
            'nama' => 'required',
            'phone' => 'required'
        ]);

        if($validasi->fails()){
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $kode_payment = "INVP/WM/".now()->format('Ymd')."/".rand(100,999);
        $kode_trx = "INVT/WM/".now()->format('Ymd')."/".rand(100,999);
        $kode_unik = rand(100,999);
        $status = "MENUNGGU";
        $expired_at = now()->addDays();

        $dataTransaksi = array_merge($requset->all(),[
            'kode_payment' => $kode_payment,
            'kode_trx' => $kode_trx,
            'kode_unik' => $kode_unik,
            'status' => $status,
            'expired_at' => $expired_at
        ]);

        \DB::beginTransaction();
        $transaksi = Transaksi::create($dataTransaksi);

        foreach ($requset->produks as $produk){
            $detail = [
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produk['id'],
                'total_item' => $produk['total_item'],
                'catatan' => $produk['catatan'],
                'total_harga' => $produk['total_harga']
            ];
            $transaksiDetail = TransaksiDetail::create($detail);
        }

        if (!empty($transaksi) && !empty($transaksiDetail)){
            \DB::commit();
            return response()->json([
                'success' => 0,
                'message' => 'Transaksi Berhasil',
                'transaksi' => collect($transaksi)
            ]);
        } else {
            \DB::rollback();
            $this->error('Transaksi Gagal');
        }

    }

     public function history($id){

         //$transaksi = Transaksi::where('user_id',$id)->first();
         $transaksis = Transaksi::with(['userapp'])->whereHas('userapp', function ($query) use ($id){
             $query->whereId($id);
         })->get();

         foreach ($transaksis as $transaksi){
            $details = $transaksi->details;
                foreach ($details as $detail){
                    $detail->produk;
                }
         }

         if (!empty($transaksis)){
             return response()->json([
                 'success' => 0,
                 'message' => 'Transaksi Berhasil',
                 'transaksis' => collect($transaksis)
             ]);
         } else {
             $this->error('Transaksi Gagal');
            //  return response()->json([
            //     'success' => 0,
            //     'message' => 'Transaksi Gagal',
            //     'transaksis' => 'Data Tidak Ditemukan'
            // ]);
         }
     }

    public function error($pasan){
        return response()->json([
            'success' => 0,
            'message' => $pasan
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Brand;
use App\Exports\ProdukExport;
use App\Imports\ProdukImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk['listProduk'] = Produk::all();
        return view('produks.index')->with($produk);

        
        //$brand = Brand::all();
        $brand = Brand::pluck('brand_name', 'brand_name');
        return view('produks.index')->with($brand);
    }

    // //data combobox brand
    // public function getBrands()
    // {
    //     $brandcb = DB::table('brands')->pluck("brand_name","id");
    //     return view('produks.index',compact('brandcb'));
    // }

    public function produkexport(){
        return Excel::download(new ProdukExport,'produk_wm.xlsx');
    }

    public function produkimport(Request $request){
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataProduk',$namaFile);

        Excel::import(new ProdukImport,public_path('/DataProduk/'.$namaFile));
        return redirect()->route('produk.index')->with('success', 'Data Berhasil di import');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());die();

        $fileName='';
        if($request->image->getClientOriginalName()){
            $file = str_replace(' ', '', $request->image->getClientOriginalName());
            $fileName = date('ymdHs').rand(1,999).'_'.$file;
            $request->image->storeAs('public/img_produk', $fileName);
        }

        $produk = Produk::create(array_merge($request->all(),[

            'image' => $fileName

        ]));
        return redirect()->route('produk.index')->with('success', 'Data Product Inserted Successfully');
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
        $produk = Produk::find($id);
        return view('produks.edit', ['produk'=>$produk]);
        //$data = Produk::findOrFail($request->get('id'));
        //echo json_encode($data);
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
        $fileName='';
        if($request->image->getClientOriginalName()){
            $file = str_replace(' ', '', $request->image->getClientOriginalName());
            $fileName = date('ymdHs').rand(1,999).'_'.$file;
            $request->image->storeAs('public/img_produk', $fileName);
            //$request->image->save();
        }
        $updateProduk = Produk::find($id);
        $updateData = $this->validate($request, [
            'name' =>  'required',
            'stok'  =>  'required',
            'satuan' =>  'required',
            'category'    =>  'required',
            'brand'   =>  'required',
            'supplier'  =>  'required',
            'harga_beli'   => 'required',
            'harga_jual'  =>  'required',
            'harga_sdiskon' => 'required',
            'diskon'   => 'required',
            'deskripsi'  =>  'required',
            'image'   => 'required',
        ]);
        

        //  $updateProduk = Produk::create(array_merge($request->all(),[

        //      'image' => $fileName

        //  ]));
        $updateProduk->update(array_merge($updateData,['image' => $fileName]));
        return redirect()->route('produk.index')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delRow = Produk::find($id);
        $delRow->delete();
        return redirect()->route('produk.index')->with('success', 'Data Product Deleted Successfully');
    }
}

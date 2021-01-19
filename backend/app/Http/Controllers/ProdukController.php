<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Brand;
use App\Supplier;
use App\Satuan;
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
        $brands = Brand::all();
        $suppliers = Supplier::all();
        $satuans = Satuan::all();
        //return view('produks.index', compact('brands'));
        $produk['listProduk'] = Produk::all();
        return view('produks.index', compact('brands','suppliers','satuans'))
        ->with($produk);

        
        //$brand = Brand::all();
        //$brand = Brand::pluck('brand_name', 'brand_name');
        //return view('produks.index')->with($brand);
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
        $brands = Brand::all();
        return view('produks.index', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
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
            'image'   => 'required|image|max:2048',
        ]);

        //  $fileName='';
        //  if($request->image->getClientOriginalName()){
        //      $file = str_replace(' ', '', $request->image->getClientOriginalName());
        //      $fileName = date('ymdHs').rand(1,999).'_'.$file;
        //      $request->image->storeAs('public/img_produk', $fileName);
        //  }

        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move('uploads', $new_name);

         $produk = Produk::create(array_merge($request->all(),[

             'image' => $new_name

         ]));
         return redirect()->route('produk.index')->with('success', 'Data Product Inserted Successfully');
        // if($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $extension = $file->getClientExtension();
        //     $filename = time() . "." . $extension;
        //     $file->move('uploads',$filename);
        //     $produk->image = $filename;
        // }else{
        //     return $request;
        //     $produk->image = '';
        // }

        // $produk->save();
        // return redirect()->route('produk.index')->with('success', 'Data Product Inserted Successfully');
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
        $brands = Brand::all();
        $suppliers = Supplier::all();
        $satuans = Satuan::all();
        $produk = Produk::findOrfail($id);
        return view('produks.edit', ['produk'=>$produk], compact('brands','suppliers','satuans'));
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
             'deskripsi'  =>  'required'
        //     'image'   => 'required|image|max:2048',
         ]);
        

        // $updateProduk->update(array_merge($updateData,['image' => $fileName]));
        // return redirect()->route('produk.index')->with('success', 'Data Updated Successfully');

        $image_name = $request->hidden_image;
        $image_name = '';
        $image = $request->file('image');
        if($image != ''){
            $request->validate([
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
                'image'   => 'required|image|max:2048'
            ]);
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads',$image_name);
        }else{
            $request->validate([
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
                'deskripsi'  =>  'required'
            ]);
        }

        
         $updateProduk->update(array_merge($updateData,['image' => $image_name]));
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

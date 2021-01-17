<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand['listBrand'] = Brand::all();
        return view('brands.index')->with($brand);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $brand = Brand::create(array_merge($request->all(),[

            'image' => $fileName

        ]));
        return redirect()->route('brand.index')->with('success', 'Data Product Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_brand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('brands.edit', ['brand'=>$brand]);
        //$data = Produk::findOrFail($request->get('id'));
        //echo json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fileName='';
        if($request->image->getClientOriginalName()){
            $file = str_replace(' ', '', $request->image->getClientOriginalName());
            $fileName = date('ymdHs').rand(1,999).'_'.$file;
            $request->image->storeAs('public/img_produk', $fileName);
        }
        $updateBrand = Brand::find($id);
        $updateData = $this->validate($request, [
            'brand_name' =>  'required',
            'is_populer'  =>  'required',
            'image'   => 'required',
        ]);
        

        //  $updateProduk = Produk::create(array_merge($request->all(),[

        //      'image' => $fileName

        //  ]));
        $updateBrand->update(array_merge($updateData,['image' => $fileName]));
        return redirect()->route('brand.index')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delRow = Brand::find($id);
        $delRow->delete();
        return redirect()->route('brand.index')->with('success', 'Data Branda Deleted Successfully');
    }
}

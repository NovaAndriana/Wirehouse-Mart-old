<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori['listKategori'] = Kategori::all();
        return view('kategoris.index')->with($kategori);
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

        // $fileName='';
        // if($request->image->getClientOriginalName()){
        //     $file = str_replace(' ', '', $request->image->getClientOriginalName());
        //     $fileName = date('ymdHs').rand(1,999).'_'.$file;
        //     $request->image->storeAs('public/img_produk', $fileName);
        // }

        $request->validate([
            'name' =>  'required',
            'image'   => 'required|image|max:2048'
        ]);
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move('uploads', $new_name);

        $kategori = Kategori::create(array_merge($request->all(),[

             'image' => $new_name

        ]));

        return redirect()->route('kategori.index')->with('success', 'Data Kategori Inserted Successfully');
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
        $kategori = Kategori::findOrfail($id);
        return view('kategoris.edit', ['kategori'=>$kategori]);
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
        // $fileName='';
        // if($request->image->getClientOriginalName()){
        //     $file = str_replace(' ', '', $request->image->getClientOriginalName());
        //     $fileName = date('ymdHs').rand(1,999).'_'.$file;
        //     $request->image->storeAs('public/img_produk', $fileName);
        // }

        $updateKategori = Kategori::find($id);
        $updateData = $this->validate($request, [
            'name' =>  'required'
        ]);
        
        $image_name = $request->hidden_image;
        $image_name = '';
        $image = $request->file('image');

        if($image != ''){
            $request->validate([
                'name' =>  'required',
                'image'   => 'required|image|max:2048'
            ]);
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads',$image_name);
        }else{
            $request->validate([
                'name' =>  'required'
            ]);
        }


    
        $updateKategori->update(array_merge($updateData,['image' => $image_name]));
        return redirect()->route('kategori.index')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delRow = Kategori::find($id);
        $delRow->delete();
        return redirect()->route('kategori.index')->with('success', 'Data Kategori Deleted Successfully');
    }
}

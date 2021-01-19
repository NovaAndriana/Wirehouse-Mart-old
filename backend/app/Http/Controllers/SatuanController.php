<?php

namespace App\Http\Controllers;

use App\Satuan;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan['listSatuan'] = Satuan::all();
        return view('satuans.index')->with($satuan);
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

        $request->validate([
            'name' =>  'required',
            'keterangan'  =>  'required'
        ]);

         $satuan = Satuan::create($request->all());
         return redirect()->route('satuan.index')->with('success', 'Data Satuan Inserted Successfully');
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
        $satuan = Satuan::find($id);
        return view('satuans.edit', ['satuan'=>$satuan]);
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

         $updateSatuan = Satuan::find($id);
         $updateData = $this->validate($request, [
            'name' =>  'required',
            'keterangan'  =>  'required'
         ]);
        
         $updateSatuan->update($updateData);
         return redirect()->route('satuan.index')->with('success', 'Data Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delRow = Satuan::find($id);
        $delRow->delete();
        return redirect()->route('satuan.index')->with('success', 'Data Satuan Deleted Successfully');
    }
}

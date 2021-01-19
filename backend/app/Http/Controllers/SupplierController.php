<?php

namespace App\Http\Controllers;

use App\Supplier;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier['listSupplier'] = Supplier::all();
        return view('suppliers.index')->with($supplier);
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
            'contact_person'  =>  'required',
            'email' =>  'required',
            'no_telp'    =>  'required',
            'alamat'   =>  'required'
        ]);

         $supplier = Supplier::create($request->all());
         return redirect()->route('supplier.index')->with('success', 'Data Supplier Inserted Successfully');
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
        $supplier = Supplier::find($id);
        return view('suppliers.edit', ['supplier'=>$supplier]);
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

         $updateSupplier = Supplier::find($id);
         $updateData = $this->validate($request, [
            'name' =>  'required',
            'contact_person'  =>  'required',
            'email' =>  'required',
            'no_telp'    =>  'required',
            'alamat'   =>  'required'
         ]);
        
         $updateSupplier->update($updateData);
         return redirect()->route('supplier.index')->with('success', 'Data Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delRow = Supplier::find($id);
        $delRow->delete();
        return redirect()->route('supplier.index')->with('success', 'Data Supplier Deleted Successfully');
    }
}

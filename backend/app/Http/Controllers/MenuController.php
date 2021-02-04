<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $menu['listMenu'] = Menu::all();
        return view('menus.index')->with($menu);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $menus = Menu::all();
        // return view('menus.index');
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
            'image'   => 'required|image|max:2048',
        ]);

        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move('uploads', $new_name);

         $menu = Menu::create(array_merge($request->all(),[

             'image' => $new_name

         ]));
         return redirect()->route('menu.index')->with('success', 'Data Menu Inserted Successfully');
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
        $menu = Menu::findOrfail($id);
        return view('menus.edit', ['menu'=>$menu]);
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

         $updateMenu = Menu::find($id);
         $image_name = $request->hidden_image;
         //$image_name = '';
         $image = $request->file('image');
         if($image != ''){
             $request->validate([
                 'name' =>  'required',
                 'image'   => 'image|max:2048'
             ]);
             $image_name = rand() . '.' . $image->getClientOriginalExtension();
             $image->move('uploads',$image_name);
         }else{
             $request->validate([
                 'name' =>  'required'
             ]);
         }
         
         $updateData = array(
             'name' =>  $request->name,
             'image'   => $image_name
         );
        
         $updateMenu->update($updateData);
         return redirect()->route('menu.index')->with('success', 'Data Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delRow = Menu::find($id);
        $delRow->delete();
        return redirect()->route('menu.index')->with('success', 'Data Menu Deleted Successfully');
    }
}

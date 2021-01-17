<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userapp;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = Userapp::count();
        //return View::make('home')->with('userCount',$userCount);
        return view('home')->with('userCount',$userCount);
    }
}

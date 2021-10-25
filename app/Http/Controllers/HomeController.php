<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test1;

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
        $post=Test1::all();
        return view('home',compact('post'));
    }
}

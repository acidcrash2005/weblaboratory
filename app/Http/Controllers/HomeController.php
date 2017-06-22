<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts as Posts;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::all();
        $data = array(
            'posts' => $posts
        );


        //return view('home', $data);
        return redirect('/user_page');
    }


}

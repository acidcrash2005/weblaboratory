<?php

namespace App\Http\Controllers;

use App\Vebinars as Vebinars;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;

class VebinarsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Vebinars::all();
        $data = array(
          'posts' => $posts
        );

        return view('vebinars', $data);
    }

    public function view($slug)
    {

        $post = Vebinars::where('slug','=',$slug)->first();
        $t = explode('=', $post->video);

        $post->video = $t[1];


        $data = array(
            'post' => $post
        );

        return view('vebinars_view', $data);

    }
}

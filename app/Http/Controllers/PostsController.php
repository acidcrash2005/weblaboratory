<?php

namespace App\Http\Controllers;

use App\Posts as Posts;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;

class PostsController extends Controller
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
        $posts = Posts::all();
        $data = array(
          'posts' => $posts
        );

        return view('posts', $data);
    }

    public function view($slug)
    {

        $post = Posts::where('slug','=',$slug)->first();
        $data = array(
            'post' => $post
        );

        return view('postsview', $data);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course as Cours;

class CourseController extends Controller
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

    public function index(){

        $courses = Cours::all();
        $data = array(
            'courses' => $courses
        );

        return view('courses', $data);
    }

    public function view($slug)
    {

        $course = Cours::where('slug','=',$slug)->first();
        $course->skill_up = explode(",", $course->skill_up);

        $data = array(
            'course' => $course
        );
        return view('courseview', $data);

    }
}

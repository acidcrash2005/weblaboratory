<?php

namespace App\Http\Controllers;

use App\Course;
use App\Product;
use App\User;
use App\UserPurchase;
use App\UserPurchasesProduct;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

use App\Course as Cours;
use App\Lesson as Lesson;
use App\Vebinars as Vebinars;
use App\Homework as Homework;
use App\HomeworkAnswer as HomeworkAnswer;
use App\HomeworkDialog as HomeworkDialog;

class UserpageController extends Controller
{

    public function index(){

        $HomeworkDialog = HomeworkDialog::where('user_id','=', Auth::user()->id)->orderBy('new_answer','desc')->get();

        $onAir = Vebinars::where('acess','=', 2)->orderBy('start','desc')->get();

        if (Auth::user()->role_id != 1 && Auth::user()->role_id != 6){
            $courses = UserPurchase::where('user_id','=',Auth::user()->id)->orderBy('course_id','asc')->get();
            $products = UserPurchasesProduct::where('user_id','=',Auth::user()->id)->orderBy('product_id','asc')->get();

        }else{
            $courses = Course::all();
            $products = Product::all();
        }


        //if (Auth::user()->id == '49' || Auth::user()->id == '1'){
            $userP = UserPurchase::where([
                ['user_id','=', Auth::user()->id]
            ])->count();

            if ($userP == 0){
                $coursesDemo = Course::where('demo','=',1)->get();
            }else{
                $coursesDemo = '';
            }
        //}


//        $lessons = Lesson::whereDate('created_at', '2017-07-03')->count();
//
//
//        print_r($lessons);


        $data = [
            'onAir' => $onAir,
            'HomeworkDialog' => $HomeworkDialog,
            'courses' => $courses,
            'coursesDemo' => $coursesDemo,
            'products' => $products
        ];

        return view('user_page', $data);
    }

    public function courses(){

        if (Auth::user()->role_id != 1 && Auth::user()->role_id != 6){
            //$user_purchase = UserPurchase::where('user_id','=',Auth::user()->id)->get();

            $user_purchase = Course::all();

            foreach ($user_purchase as $purchase){
                if (UserPurchase::where([
                        ['course_id','=',$purchase->id],
                        ['user_id','=',Auth::user()->id]
                    ])->first() === null)
                {
                    $purchase->nopay = 1;
                }
            }

            $data = array(
                'courses' => $user_purchase
            );

            return view('user_page_courses', $data);
        }else{
            $courses = Course::all();

            $data = array(
                'courses' => $courses
            );

            return view('user_page_courses_admin', $data);
        }


    }

    public function curse($slug){

        $course = Cours::where('slug','=',$slug)->first();

        if (UserPurchase::where([
                ['course_id','=',$course->id],
                ['user_id','=',Auth::user()->id]
            ])->first() !== null || Auth::user()->role_id == 1 || Auth::user()->role_id == 6) {

            $lessons = Lesson::where('cours_id', '=', $course->id)->orderBy('order_by','asc')->get();


            $data = array(
                'course' => $course,
                'lessons' => $lessons
            );

            return view('courselist', $data);
        }else{
            $lessons = Lesson::where('cours_id', '=', $course->id)->orderBy('order_by','asc')->get();

            if (UserPurchase::where([
                    ['course_id','=',$course->id],
                    ['user_id','=',Auth::user()->id]
                ])->first() === null)
            {
                $course->nopay = 1;
            }

            $data = array(
                'course' => $course,
                'lessons' => $lessons
            );

            return view('courselist', $data);
        }
    }

    public function cursePage($slug, $id){


        $course = Cours::where('slug','=',$slug)->first();
        $lessone = Lesson::find($id);

        if ($course === null || $lessone === null){
            return response()->view('missing', [], 404);
        }

        if (
            UserPurchase::where([['course_id','=',$course->id],['user_id','=',Auth::user()->id] ])->first() !== null
            || Auth::user()->role_id == 1
            || Auth::user()->role_id == 6
            || $lessone->acess == 3
        )
        {
            $HomeworkDialog = HomeworkDialog::where([
                ['lesson_id','=',$lessone->id],
                ['user_id','=', Auth::user()->id]
            ])->first();

            if ($HomeworkDialog !== null){
                $Homework = Homework::where('dialog_id','=',$HomeworkDialog->id);

                $dialog = HomeworkAnswer::where('dialog_id','=',$HomeworkDialog->id)
                    ->union($Homework)
                    ->orderBy('created_at','desc')
                    ->get();
                $dialog_new = HomeworkAnswer::where([
                    ['dialog_id','=',$HomeworkDialog->id],
                    ['new','=','1']
                ])->get();
            }else{
                $dialog = [];
                $dialog_new = [];
            }


            $lessons = Lesson::where('cours_id','=',$course->id)->orderBy('order_by','asc')->get();

            // get previous
            $previous = Lesson::where('id', '<', $id)->where('cours_id','=',$course->id)->max('id');

            // get next
            $next = Lesson::where('id', '>', $id)->where('cours_id','=',$course->id)->min('id');

            $lessone->video = explode(PHP_EOL, $lessone->video);


            foreach ($lessone->video as $key=>$video){
                $t = explode('=', $video);
                if (array_key_exists(1, $t)){
                    $videoId[] = $t[1];
                }else{
                    $videoId[] = '';
                }
            }
            $lessone->video = $videoId;

            if (UserPurchase::where([
                    ['course_id','=',$course->id],
                    ['user_id','=',Auth::user()->id]
                ])->first() === null)
            {
                $course->nopay = 1;
            }else{
                $course->nopay = 0;
            }

            $data = array(
                'course' => $course,
                'lessone' => $lessone,
                'lessons' => $lessons,
                'previous' =>$previous,
                'next' =>$next,
                'dialog' => $dialog,
                'dialog_new' => $dialog_new
            );

            return view('coursepage', $data);
        }else{
            return redirect('/courses');
        }

    }


    public function products(){


        return view('uaser_products');
    }



   
}

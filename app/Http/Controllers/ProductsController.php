<?php

namespace App\Http\Controllers;

use App\Course;
use App\Product;
use App\UserPurchasesProduct;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\Course as Cours;
use App\Lesson as Lesson;
use App\UserPurchase;

class ProductsController extends Controller
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
        $courses = Course::all();
        $products = Product::all();

        return view('product.products', compact('courses', 'products'));
    }

    public function course($id)
    {
        $course = Course::where('id','=',$id)->first();
        $course->skill_up = explode(',',$course->skill_up);

        if (!\Auth::guest()){
            if (UserPurchase::where([
                    ['course_id','=',$course->id],
                    ['user_id','=',\Auth::user()->id]
                ])->first() === null)
            {
                $course->nopay = 1;
            }
        }

        $lessons = Lesson::where('cours_id','=',$id)->orderBy('order_by','asc')->get();


        return view('product.course', compact('course', 'lessons'));
    }

    public function product($id)
    {
        $product = Product::where('id','=',$id)->first();


        return view('product.product', compact('product'));
    }

    public function user_products(){
        $UserPurchase = UserPurchasesProduct::where([
            ['user_id','=',\Auth::user()->id]
        ])->get();

        return view('product.user_products', compact('UserPurchase'));
    }

    public function user_product_view($id){

        $Product = Product::find($id);

        $UserPurchase = UserPurchasesProduct::where([
            ['user_id','=',\Auth::user()->id],
            ['product_id','=',$id]
        ])->first();


        if ($UserPurchase !== null){
            return view('product.user_product_view', compact('Product'));
        }else{
            return redirect('user_products');
        }



    }


}

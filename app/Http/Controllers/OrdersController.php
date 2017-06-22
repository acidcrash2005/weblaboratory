<?php

namespace App\Http\Controllers;

use App\Pay;
use App\Payes;
use App\Posts as Posts;
use App\Orders as Orders;
use App\UserPurchase as UserPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use App\lib\LiqPay as LiqPay;
use \App\Mail\BayMail as BayMail;
use \App\Mail\OrderPayedMail as OrderPayedMail;


class OrdersController extends Controller
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

    public function index(){
        $orders = Orders::where('user_id','=',Auth::user()->id)->get();

        return view('orders.index', compact('orders'));
    }



}

<?php

namespace App\Http\Controllers;

use App\Pay;
use App\Payes;
use App\Posts as Posts;
use App\Orders as Orders;
use App\UserPurchase as UserPurchase;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\lib\LiqPay as LiqPay;
use \App\Mail\BayMail as BayMail;
use \App\Mail\OrderPayedMail as OrderPayedMail;


class PayesController extends Controller
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

//    public function index(){
//        $liqpay = new LiqPay('i52140507387', 'lI6KunG0Ubi1x6wYGm0HICC2ktXxtUG4uAB3yA79');
//
//        $html = $liqpay->cnb_form(array(
//            'action'         => 'pay',
//            'amount'         => '1',
//            'currency'       => 'UAH',
//            'description'    => 'description text',
//            'order_id'       => '5',
//            'version'        => '3'
//        ));
//
//        echo ('<form action="https://demo.weblaboratory.in.ua/pay" method="post">');
//        echo ('<textarea name="data">eyJhY3Rpb24iOiJwYXkiLCJwYXltZW50X2lkIjo0MzQ5NjQwOTgsInN0YXR1cyI6InN1Y2Nlc3MiLCJ2ZXJzaW9uIjozLCJ0eXBlIjoiYnV5IiwicGF5dHlwZSI6ImNhcmQiLCJwdWJsaWNfa2V5IjoiaTUyMTQwNTA3Mzg3IiwiYWNxX2lkIjo0MTQ5NjMsIm9yZGVyX2lkIjoiNCIsImxpcXBheV9vcmRlcl9pZCI6IkZFUVQ1ODFXMTQ5NzU0MDQ4ODMyNTQ5NiIsImRlc2NyaXB0aW9uIjoiZGVzY3JpcHRpb24gdGV4dCIsInNlbmRlcl9waG9uZSI6IjM4MDY2MDI5NzEwOSIsInNlbmRlcl9jYXJkX21hc2syIjoiNDczMTIxKjMzIiwic2VuZGVyX2NhcmRfYmFuayI6InBiIiwic2VuZGVyX2NhcmRfdHlwZSI6InZpc2EiLCJzZW5kZXJfY2FyZF9jb3VudHJ5Ijo4MDQsImlwIjoiMzEuMTM0LjEyMS4xMjgiLCJhbW91bnQiOjEuMCwiY3VycmVuY3kiOiJVQUgiLCJzZW5kZXJfY29tbWlzc2lvbiI6MC4wLCJyZWNlaXZlcl9jb21taXNzaW9uIjowLjAzLCJhZ2VudF9jb21taXNzaW9uIjowLjAsImFtb3VudF9kZWJpdCI6MS4wLCJhbW91bnRfY3JlZGl0IjoxLjAsImNvbW1pc3Npb25fZGViaXQiOjAuMCwiY29tbWlzc2lvbl9jcmVkaXQiOjAuMDMsImN1cnJlbmN5X2RlYml0IjoiVUFIIiwiY3VycmVuY3lfY3JlZGl0IjoiVUFIIiwic2VuZGVyX2JvbnVzIjowLjAsImFtb3VudF9ib251cyI6MC4wLCJhdXRoY29kZV9kZWJpdCI6IjI3OTExNCIsImF1dGhjb2RlX2NyZWRpdCI6Ijk1MzAxMCIsInJybl9kZWJpdCI6IjAwMDYzMjE1MjA2NyIsInJybl9jcmVkaXQiOiIwMDA2MzIxNTIwNzgiLCJtcGlfZWNpIjoiNyIsImlzXzNkcyI6ZmFsc2UsImNyZWF0ZV9kYXRlIjoxNDk3NTQwNDgzMDY0LCJlbmRfZGF0ZSI6MTQ5NzU0MDUwMjE2NCwidHJhbnNhY3Rpb25faWQiOjQzNDk2NDA5OH0</textarea>');
//
//        echo ('<input type="text" name="signature" value="Nbh6P21fE4jVD6WIBIBXwRZjYAQ=">');
//        echo ('<input type="submit">');
//        echo ('</form>');
//
//        echo $html;
//    }

    public function api(Request $request){
        $sign = base64_encode( sha1(
            'lI6KunG0Ubi1x6wYGm0HICC2ktXxtUG4uAB3yA79' .
            $request->data .
            'lI6KunG0Ubi1x6wYGm0HICC2ktXxtUG4uAB3yA79'
            , 1 ));

        if ($sign == $request->signature){

            $dataObj = base64_decode($request->data);
            $dataObj = json_decode($dataObj);

            $pay = new Payes();
            $pay->post = base64_decode($request->data);
            $pay->data = $request->data;
            $pay->order_id = $dataObj->order_id;
            $pay->signature = $request->signature;

            if ($pay->save()){
                $payData = json_decode($pay->post);
                $order = Orders::where('id','=',$payData->order_id)->first();
                $order->payed = 1;

                if($order->save()){
                    $UserPurchase = new UserPurchase();
                    $UserPurchase->course_id = $order->course_id ;
                    $UserPurchase->user_id = $order->user_id;

                    if($UserPurchase->save()){

                        \Mail::to(\Voyager::setting('email_bay'))->send(new OrderPayedMail($order));
                    }
                }
            }
        }

    }


    public function redirect(){
        return redirect('courses');
    }


    public function bay(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'phone' => 'required|min:10',
        ]);


        \Mail::to(\Voyager::setting('email_bay'))->send(new BayMail($request));
    }

    public function order(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'phone' => 'required|min:10',
        ]);

        if (empty(\Auth::user()->phone)){
            $user = \Auth::user();
            $user->phone = $request->phone;
            $user->save();
        }

        $order = new Orders();
        $order->user_id = \Auth::user()->id;
        $order->course_id = $request->course_id;
        $order->phone = $request->phone;
        $order->payed = 0;

        if ($order->save()){
            $liqpay = new LiqPay('i52140507387', 'lI6KunG0Ubi1x6wYGm0HICC2ktXxtUG4uAB3yA79');

            $html = $liqpay->cnb_form(array(
                'action'         => 'pay',
                'amount'         => $order->cours->price,
                'currency'       => 'USD',
                'description'    => $order->cours->title,
                'order_id'       => $order->id,
                'version'        => '3'
            ));

            echo $html;

            exit();

            \Mail::to(\Voyager::setting('email_bay'))->send(new BayMail($request));
        }else{
            echo 'error';
        }

    }

}

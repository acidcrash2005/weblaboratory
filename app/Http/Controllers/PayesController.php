<?php

namespace App\Http\Controllers;

use App\Pay;
use App\User;
use App\Payes;
use App\Posts as Posts;
use App\Orders as Orders;
use App\UserPurchase as UserPurchase;
use App\UserPurchasesProduct as UserPurchasesProduct;
use App\Product as Product;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\lib\LiqPay as LiqPay;
use App\lib\GetResponse;

use \App\Mail\BayMail as BayMail;
use \App\Mail\OrderPayedMail as OrderPayedMail;

use \App\Mail\RegisterMail as RegisterMail;
use \App\Mail\NewuserMail as NewuserMail;
use \App\Mail\ProductPayedMail as ProductPayedMail;
use \App\Mail\ProductUserMail as ProductUserMail;



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

    public function  wayforpay(Request $request){

    }

    public function api(Request $request){
        $sign = base64_encode( sha1(
            'lI6KunG0Ubi1x6wYGm0HICC2ktXxtUG4uAB3yA79' .
            $request->data .
            'lI6KunG0Ubi1x6wYGm0HICC2ktXxtUG4uAB3yA79'
            , 1 ));

        if ($sign == $request->signature){
            $dataObj = base64_decode($request->data);
            $dataObj = json_decode($dataObj);

            if ($dataObj->status == 'success'){

                // Елси человек купил курс
                if ($dataObj->product_category == 'course'){
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

                // Елси человек купил продукт
                else{
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

                            // Добавляем продук в купленные продукты
                            $UserPurchaseProduct = new UserPurchasesProduct();
                            $UserPurchaseProduct->product_id = $order->course_id ;
                            $UserPurchaseProduct->user_id = $order->user_id;

                            if ($UserPurchaseProduct->save()){
                                $product = Product::where('id','=',$order->course_id)->first();

                                // Если выбрана подписка, подписывает на Getresponse компанию
                                if ($product->subscribe_id != 'none'){
                                    $getresponse = new GetResponse( \Voyager::setting('getrespons_key') );

                                    $call = $getresponse->addContact(array(
                                        'name'              => $order->user->name,
                                        'email'             => $order->user->email,
                                        'dayOfCycle'        => 0,
                                        'campaign'          => array('campaignId' => $product->subscribe_id),
                                        'customFieldValues' => array(
                                            array('customFieldId' => 'OGkpw',
                                                'value' => array(
                                                    $order->user->phone
                                                ))
                                        )
                                    ));
                                }

                                // Если есть список с курсам добавляем курсы в купленные
                                if (!empty($order->product->courses_list)){
                                    $courseArr = explode(',', $order->product->courses_list);
                                    foreach ($courseArr as $course){
                                        $UserPurchase = new UserPurchase();
                                        $UserPurchase->course_id = $course ;
                                        $UserPurchase->user_id = $order->user_id;
                                        $UserPurchase->save();
                                    }
                                }

                                \Mail::to($order->user->email)->send(new ProductUserMail(compact('order','product')));
                                \Mail::to(\Voyager::setting('email_bay'))->send(new ProductPayedMail(compact('order','product')));
                            }
                        }
                    }
                }

            }else{

                $pay = new Payes();
                $pay->post = base64_decode($request->data);
                $pay->data = $request->data;
                $pay->order_id = $dataObj->order_id;
                $pay->signature = $request->signature;


                if ($pay->save()){
                    $payData = json_decode($pay->post);
                    $order = Orders::where('id','=',$payData->order_id)->first();
                    $order->payed = 0;
                    $order->save();
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

        // Если поукупает курс
        if ($request->product_category == 'course'){

            // Если авторизирован
            if (!\Auth::guest()){
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
                $order->name = $request->name;
                $order->email = $request->email;
                $order->category = $request->product_category;
                $order->payed = 0;

                if ($order->save()){
                    $liqpay = new LiqPay('i52140507387', 'lI6KunG0Ubi1x6wYGm0HICC2ktXxtUG4uAB3yA79');

                    $html = $liqpay->cnb_form(array(
                        'action'         => 'pay',
                        'amount'         => $order->cours->price,
                        'currency'       => 'USD',
                        'description'    => $order->cours->title,
                        'order_id'       => $order->id,
                        'product_category' => $order->product_category,
                        'version'        => '3'
                    ));

                    \Mail::to(\Voyager::setting('email_bay'))->send(new BayMail($request));

                    echo $html;
                }else{
                    echo 'error';
                }
            }
            // Если неавторизирован при покупке
            else{
                $this->validate($request, [
                    'email' => 'required|email',
                    'phone' => 'required|min:10'
                ]);

            if (User::where('email', '=', $request->email)->exists()) {
                $user = User::where('email', $request->email)->get()->first();
                \Auth::login($user);

                if (empty(\Auth::user()->phone)){
                    $user = \Auth::user();
                    $user->phone = $request->phone;
                    $user->save();
                }

                $order = new Orders();
                $order->user_id = \Auth::user()->id;
                $order->course_id = $request->course_id;
                $order->phone = $request->phone;
                $order->category = $request->product_category;
                $order->payed = 0;

                if ($order->save()){
                    $liqpay = new LiqPay('i52140507387', 'lI6KunG0Ubi1x6wYGm0HICC2ktXxtUG4uAB3yA79');

                    $html = $liqpay->cnb_form(array(
                        'action'         => 'pay',
                        'amount'         => $order->cours->price,
                        'currency'       => 'USD',
                        'description'    => $order->cours->title,
                        'order_id'       => $order->id,
                        'product_category' => $order->product_category,
                        'version'        => '3'
                    ));

                    \Mail::to(\Voyager::setting('email_bay'))->send(new BayMail($request));

                    echo $html;
                }else{
                    echo 'error';
                }


            }
            else{
               $pass = $this::randomPassword();

               $order = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($pass),
                ]);

                $data = $request;
                $data['password'] = $pass;

                \Mail::to($data['email'])->send(new RegisterMail($data));
                \Mail::to(\Voyager::setting('email'))->send(new NewuserMail($data));

                $user = User::where('email', $request->email)->get()->first();
                \Auth::login($user);

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

                    \Mail::to(\Voyager::setting('email_bay'))->send(new BayMail($request));

                    echo $html;
                }else{
                    echo 'error';
                }
            }



            }

        }

        // Если поукупает продукт
        else{
            $this->validate($request, [
                'email' => 'required|email',
                'phone' => 'required|min:10',
            ]);

            if (User::where('email', '=', $request->email)->exists()) {
                $user = User::where('email', $request->email)->get()->first();

                $order = new Orders();
                $order->user_id = $user->id;
                $order->course_id = $request->course_id;
                $order->phone = $request->phone;
                $order->name = $request->name;
                $order->email = $request->email;
                $order->category = $request->product_category;
                $order->payed = 0;

                if ($order->save()){
                    \Mail::to(\Voyager::setting('email_bay'))->send(new BayMail($request));
                    return redirect()->action('PayesController@order_get', $order->id);
                }

            }
            else{
                $pass = $this::randomPassword();

                $order = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($pass),
                ]);

                $data = $request;
                $data['password'] = $pass;

                \Mail::to($data['email'])->send(new RegisterMail($data));
                \Mail::to(\Voyager::setting('email'))->send(new NewuserMail($data));

                $user = User::where('email', $request->email)->get()->first();
                \Auth::login($user);

                if (empty(\Auth::user()->phone)){
                    $user = \Auth::user();
                    $user->phone = $request->phone;
                    $user->save();
                }

                $order = new Orders();
                $order->user_id = \Auth::user()->id;
                $order->course_id = $request->course_id;
                $order->phone = $request->phone;
                $order->name = $request->name;
                $order->email = $request->email;
                $order->category = $request->product_category;
                $order->payed = 0;

                if ($order->save()){
                    \Mail::to(\Voyager::setting('email_bay'))->send(new BayMail($request));
                    return redirect()->action('PayesController@order_get', $order->id);
                }
            }
        }

    }

    public function order_get($id){
        $liqpay = new LiqPay('i52140507387', 'lI6KunG0Ubi1x6wYGm0HICC2ktXxtUG4uAB3yA79');
        $order = Orders::where('id','=',$id)->first();

        if ($order->category == 'course'){
            $price = $order->cours->price;
            $title =  $order->cours->title;
        }else{

            $title =  $order->product->title;

            //Если есть скидка или спец цена
            if ($order->product->sale_price != 0){
                $price = $order->product->sale_price;
            }else{
                $price = $order->product->price;
            }
        }

        $pay_form = $liqpay->cnb_form(array(
            'action'         => 'pay',
            'amount'         => $price,
            'currency'       => 'USD',
            'description'    => $title,
            'order_id'       => $order->id,
            'product_category' => $order->category,
            'version'        => '3'
        ));

        return view('orders.order', compact('pay_form','order'));
    }

    public function payform(Request $request){

        $liqpay = new LiqPay('i52140507387', 'lI6KunG0Ubi1x6wYGm0HICC2ktXxtUG4uAB3yA79');

        $html = $liqpay->cnb_form(array(
            'action'         => 'pay',
            'amount'         => $request->price,
            'currency'       => 'USD',
            'description'    => $request->title,
            'order_id'       => $request->order_id,
            'version'        => '3'
        ));

        echo $html;
    }

    public static function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function test(){

//        $order = Orders::where('id','=',89)->first();
//        $product = Product::where('id','=',$order->course_id)->first();
//
//
//        if ($product->subscribe_id != 'none'){
//            $getresponse = new GetResponse( \Voyager::setting('getrespons_key') );
//
//            $fields = $getresponse->getCustomFields();
//
//            $call = $getresponse->addContact(array(
//                'name'              => $order->user->name,
//                'email'             => $order->user->email,
//                'dayOfCycle'        => 0,
//                'campaign'          => array('campaignId' => $product->subscribe_id),
//                'customFieldValues' => array(
//                    array('customFieldId' => 'OGkpw',
//                        'value' => array(
//                            $order->user->phone
//                        ))
//                )
//            ));
//
//        }

//        $getresponse = new GetResponse( \Voyager::setting('getrespons_key') );
//
//
//        $compains = $getresponse->getCustomFields();
//
//
//
//        print_r($compains);

//        $call = $getresponse->addContact(array(
//            'name'              => 'Геннадий',
//            'email'             => 'acidcrash2005@gmail.com',
//            'dayOfCycle'        => 0,
//            'campaign'          => array('campaignId' => 'TdTGV'),
//            'customFieldValues' => array(
//                array('customFieldId' => 'OGkpw',
//                    'value' => array(
//                        '+380660297109'
//                    ))
//            )
//        ));
//
//        print_r($call);


        return view('test');

    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

use \App\Mail\BayMail as BayMail;

class UserController extends Controller
{

    public function profile(Request $request){
        $data = array(
            'user' => Auth::user(),
            'request' => $request
        );

        bcrypt($data['user']->password);

        return view('profile', $data);
    }

    public function update(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'min:6',
            're_password' => 'min:6|same:password',
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->notification = $request->notification;

        if ($request->hasFile('avatar')) {
            $user->avatar = $request->avatar->store('ava','public');
        }

        if (!empty($user->password) && !empty($user->re_password)){
            $user->password = bcrypt($request->password);
        }

        $user->save();

        $data = array(
            'user' => Auth::user(),
            'request' => $request
        );

        return redirect('profile');
    }

    public function userpay(Request $request){

        echo ('<form action="/userpay">');
        echo ('<input type="text" name="status">');
        echo ('<input type="submit">');
        echo ('</form>');

        if ($request->status == 5){
            echo ('status 5');

            $key = md5($request->id.$request->email.$request->phone.'EEjFUjWNYamxAFLt7Ke7XKtgEw9WphN3sKX7dy');

            if ($request->hash == $key){
                echo ('Done');
            }

        }else{
            echo ('No post data');
        }
    }


   
}

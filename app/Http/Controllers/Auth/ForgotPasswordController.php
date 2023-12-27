<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function index(){
        return view('auth.forgot_password');
    }

    public function create_reset_code(Request $request){
        $this->validate($request,[
            'username'=>'required'
        ]);

        $username =$request->input('username');
        $user =User::where('username',$username)->first();

        if ($user != null) {
            $phone =$user->phone;
            $name  =$user->name;
            $reset_code =$this->reset_code();

            $reset =new PasswordReset;
            $reset->reset_code =$reset_code;
            $reset->user_id    =$user->id;
            $reset->save();

            $msg = "hello"." ".$name."\n";
            $msg .="Please Use the Reset code".$reset_code." to reset the password: \n";
            

            if ($reset->save() == true) {
                return response()->json(['message'=>'Request accepted, You will receive sms to reset password'],200);
            } else {
                return response()->json(['errors'=>'Request denied'],500);
            }
            
        } else {
            return response()->json(['errors'=>'The provided username / Email was not exist ,please provide valid username / Email'],500);
        }
        
    }

        public function reset_code() { 
            do
            {
                $token = mt_rand(100000,999999);
                $user_code = PasswordReset::where('reset_code',$token)->first();
            }
            while(!empty($user_code));
            return $token;
        }
}

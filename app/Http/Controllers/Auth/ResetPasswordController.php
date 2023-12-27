<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Models\User;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function index(){
        return view('auth.reset_password');
    }

    public function reset_password(Request $request){
        $this->validate($request,[
            'code'             =>'required',
            'password'          => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password'  => 'min:6'
        ]);

        $password   =$request->input('password');
        $code       =$request->input('code');
        $check_code =PasswordReset::where('reset_code',$code)->where('status',0)->orderBy('created_at','DESC')->first();

        $hourdiff = round((strtotime(now()) - strtotime($check_code->created_at))/3600, 0);
        if (($hourdiff <= 1) && ($check_code != null)) {
            
            $user =User::where('id',$check_code->user_id)->first();
            $user->password =\Hash::make($password);
            $user->save();

            $check_code->status =1;
            $check_code->save();

            return response()->json([
                'status'  =>true,
                'message' =>'You have Successfully Reset the Password Please Use New Password To Sign-in',
            ]);
            
        } else {
            return response()->json(['errors'=>'Wrong Reset code or Reset code has already expired please try again to reset password'],500);
        }

    }
}

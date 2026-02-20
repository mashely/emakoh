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

    public function index(Request $request){
        return view('auth.reset_password');
    }

    public function reset_password(Request $request){
        $this->validate($request,[
            'email'            =>'required|email',
            'password'          => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password'  => 'min:6'
        ]);

        $password   =$request->input('password');
        $email      =$request->input('email');
        $user       =User::where('email',$email)->first();

        if (!$user) {
            return response()->json(['errors'=>'The provided email does not exist'],500);
        }

        $user->password =\Hash::make($password);
        $user->save();

        return response()->json([
            'status'  =>true,
            'message' =>'You have Successfully Reset the Password Please Use New Password To Sign-in',
        ]);

    }
}

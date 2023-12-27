<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
//use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use URL;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
  //  protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function index(){
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $this->validate(
            $request,
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Username is required',
                'password.required' => 'Password is required',
            ]
        );

        $username = $request->input('username');
        $password = $request->input('password');
        $remember = $request->input('remember');

        if (Auth::attempt(['username' => $username, 'password' => $password], $remember)) {
            $user = User::find(auth()->user()->id);
            if ($user->active == 1) {
                if (Auth::user()->hasRole(1)) {
                    $url  =URL::to('dashboard');
                    return response()->json([
                        'success' =>true,
                        'message' =>greeting().' '.$user->name.' Welcome Again at Fp Kidijitali',
                        'url'     =>$url,
                    ],200);
                } else {
                    $url  =URL::to('hospital/dashboard');
                    return response()->json([
                        'success' =>true,
                        'message' =>greeting().' '.$user->name.' Welcome Again at Fp Kidijitali',
                        'url'     =>$url,
                    ],200);
                }
                
                
            } else {
                Auth::logout();
                return response()->json([
                    'success' =>false,
                    'errors' =>'Your Account has been deactivate , Contact System Adminstrator to Activate Your Account',
                ],500);
            }
        } else {
            return response()->json([
                'success' =>false,
                'errors' =>'Invalid Username or Password',
            ],500);
        }
    }

    //logout
    public function logout()
    {
        Auth::logout();
        return Redirect::route('/');
    }

}

<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gender;
use App\Models\Role;
use App\Models\UserRole;
use Auth;

class UserController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }

    public function list(){
        $gender   =Gender::orderby('name','DESC')->whereNot('id',3)->get();
        $roles    =Role::orderby('name','ASC')->get();
        // $roles    =Role::orderby('name','ASC')->whereNotIn('id',[2,3])->get();
        $users =User::orderby('created_at','DESC')->get();
        return view('users.list',compact('users','gender','roles'));
    }

    public function create(Request $request){
        $this->validate($request,[
            'first_name'       =>'required',
            'last_name'      =>'required',
            'gender'            =>'required',
            'phone_number'      =>'required',
            'email'             =>'required',
            'role_id'           =>'required',
            'password'          => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password'  => 'min:6'
        ]);

        $first_name  =$request->input('first_name');
        $middle_name =$request->input('middle_name');
        $last_name   =$request->input('last_name');
        $gender      =$request->input('gender');
        $email       =$request->input('email');
        $password    =$request->input('password');
        $phone_number=$request->input('phone_number');
        $role_id     =$request->input('role_id');
        $name =ucwords($first_name.' '.$middle_name.' '.$last_name);

        $check_user =User::where('username',$email)->first();

        if ( $check_user) {
            return response()->json([
                'success' =>false,
                'errors'  =>'Username/Email has Already Used Please Provide another Email',
            ],500);
        }

        $user =new User;
        $user_id =$user->register($name,$gender,$email,$password,$phone_number);

        $role_user =new UserRole;
        $role =$role_user->register($user_id,$role_id);

        if ($role) {
            return response()->json([
                'success' =>true,
                'message' =>'User Registration done Successfully'
            ],200);
        } else {
            return response()->json([
                'success' =>false,
                'errors'  =>'User Registration Failed'
            ],500);
        }


    }

    public function update(Request $request){
        $this->validate($request,[
            'name'       =>'required',
            'gender'           =>'required',
            'phone_number'     =>'required',
        ]);
        $name      =$request->input('name');
        $gender      =$request->input('gender');
        $phone_number=$request->input('phone_number');
        $user_id     =$request->input('user_id');


        $user =new User;
        $user_id =$user->updateUser($name,$gender,$phone_number,$user_id);

        if ($user_id) {
            return response()->json([
                'success' =>true,
                'message' =>'User Update done Successfully'
            ],200);
        } else {
            return response()->json([
                'success' =>false,
                'errors'  =>'User Update Failed'
            ],500);
        }


    }

    public function disable_user(Request $request){
        $id =$request->input('my_id');

        $user =User::where('id',$id)->first();
        $user->active     =0;
        $user->updated_by =Auth::user()->id;
        $user->save();

        if ($user) {
            return response()->json([
                'success' =>true,
                'message' =>'User Update done Successfully'
            ],200);
        } else {
            return response()->json([
                'success' =>false,
                'errors'  =>'User Update Failed'
            ],500);
        }
    }

    public function enable_user(Request $request){
        $id =$request->input('my_id');

        $user =User::where('id',$id)->first();
        $user->active     =1;
        $user->updated_by =Auth::user()->id;
        $user->save();

        if ($user) {
            return response()->json([
                'success' =>true,
                'message' =>'User Update done Successfully'
            ],200);
        } else {
            return response()->json([
                'success' =>false,
                'errors'  =>'User Update Failed'
            ],500);
        }
    }

    public function profile(){
        $user =Auth::user();
        $gender =Gender::orderby('name','ASC')->whereNot('id',3)->get();
        return view('users.profile',compact('user','gender'));
    }
}

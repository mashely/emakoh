<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gender;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\Staff;

class StaffController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }
    
    public function list($hospital_id){
        $gender   =Gender::orderby('name','ASC')->whereNot('id',3)->get();
        $roles    =Role::orderby('name','ASC')->whereNot('id',1)->get();
        $staffs   =Staff::orderby('created_at','DESC')->where('hospital_id',$hospital_id)->get();
        return view('staff.list',compact('gender','hospital_id','roles','staffs'));
    }

    public function create(Request $request){
        $this->validate($request,[
            'first_name'        =>'required',
            'last_name'         =>'required',
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
        $hospital_id =$request->input('hospital_id');
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

        $staff =new Staff;
        $staff =$staff->register($user_id,$hospital_id);

        if ($staff) {
            return response()->json([
                'success' =>true,
                'message' =>'Staff Registration done Successfully'
            ],200);
        } else {
            return response()->json([
                'success' =>false,
                'errors'  =>'Staff Registration Failed'
            ],500);
        }


    }
}

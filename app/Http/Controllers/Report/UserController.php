<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Gender;
use App\Models\User;
use App\Models\Staff;
use Excel;
use App\Exports\UsersExport;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $hospitals =Hospital::orderby('name','ASC')->get();
        $gender    =Gender::orderby('name','ASC')->whereNot('id',3)->get();
        return view('report.user.list',compact('hospitals','gender'));
    }

    public function filter_users(Request $request){
        $start_date =$request->input('start_date');
        $end_date   =$request->input('end_date');
        $status     =$request->input('status');
        $hospital   =$request->input('hospital');

        $user =new User;
        $users =$user->filterUser($start_date,$end_date,$status);

        if ($hospital) {
            $user_ids =Staff::where('hospital_id',$hospital)->get(['user_id']);
            $users   =User::whereIn('id',$user_ids)->get();
        }

        return view('report.user.filtered_list',compact('users'))->render();
    }

    public function generate_report(Request $request){
        $start_date =$request->input('start_date');
        $end_date   =$request->input('end_date');
        $status     =$request->input('status');
        $hospital   =$request->input('hospital');

        $user =new User;
        $users =$user->filterUser($start_date,$end_date,$status);

        if ($hospital) {
            $user_ids =Staff::where('hospital_id',$hospital)->get(['user_id']);
            $users   =User::whereIn('id',$user_ids)->get();
        }

        return Excel::download(new UsersExport($users),'Users Report.xlsx');
    }
}

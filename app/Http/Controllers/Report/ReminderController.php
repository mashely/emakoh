<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Gender;
use App\Models\MaritalStatus;
use App\Models\Service;
use App\Models\Hospital;
use App\Models\ServiceAppointment;
use App\Models\Patient;
use Excel;
use App\Exports\RemindersExport;


class ReminderController extends Controller
{
    public function index(){

        $regions  =Region::orderby('reg_name','ASC')->get();
        $gender   =Gender::orderby('name','ASC')->get();
        $services =Service::orderby('name','ASC')->get();
        $hospitals =Hospital::orderby('name','ASC')->get();
        $marital_status =MaritalStatus::orderby('name','ASC')->get();
        return view('report.reminder.list',compact('regions','gender','services','marital_status','hospitals'));
    }

    public function filter_reminders(Request $request){
        $start_date   =$request->input('start_date');
        $end_date     =$request->input('end_date');
        $return_start_date   =$request->input('return_start_date');
        $return_end_date     =$request->input('return_end_date');
        $gender              =$request->input('gender');
        $marital_status      =$request->input('marital_status');
        $hospital_id         =$request->input('hospital_id');
        $service             =$request->input('service');
        $reminder_status     =$request->input('reminder_status');
        $region              =$request->input('region');
        $district            =$request->input('district');
        $client   =new Patient;
        $clients  =$client->filterClient($start_date = null,$end_date =null,$gender,$marital_status,$hospital_id =null,$region,$district);


        $client    =new ServiceAppointment;
        $reminders =$client->filterReminder($start_date,$end_date,$return_start_date,$return_end_date,$hospital_id,$service,$reminder_status,$clients->pluck('id'));

        return view('report.reminder.filtered_list',compact('reminders'))->render();
    }

    public function generate_report(Request $request){
        $start_date   =$request->input('start_date');
        $end_date     =$request->input('end_date');
        $return_start_date   =$request->input('return_start_date');
        $return_end_date     =$request->input('return_end_date');
        $gender              =$request->input('gender');
        $marital_status      =$request->input('marital_status');
        $hospital_id         =$request->input('hospital_id');
        $service             =$request->input('service');
        $reminder_status     =$request->input('reminder_status');
        $region              =$request->input('region');
        $district            =$request->input('district');

        $client   =new Patient;
        $clients  =$client->filterClient($start_date = null,$end_date =null,$gender,$marital_status,$hospital_id =null,$region,$district);


        $client    =new ServiceAppointment;
        $reminders =$client->filterReminder($start_date,$end_date,$return_start_date,$return_end_date,$hospital_id,$service,$reminder_status,$clients->pluck('id'));

        return Excel::download(new RemindersExport($reminders),'Reminders Report.xlsx');

    }
}

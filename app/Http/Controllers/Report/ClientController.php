<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Gender;
use App\Models\MaritalStatus;
use App\Models\Service;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\ServiceAppointment;
use Excel;
use App\Exports\ClientsExport;


class ClientController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $regions  =Region::orderby('name','ASC')->get(); 
        $gender   =Gender::orderby('name','ASC')->get();
        $services =Service::orderby('name','ASC')->get();
        $hospitals =Hospital::orderby('name','ASC')->get();
        $marital_status =MaritalStatus::orderby('name','ASC')->get();
        return view('report.client.list',compact('regions','gender','services','marital_status','hospitals'));
    }

    public function filter_clients(Request $request){
        $start_date   =$request->input('start_date');
        $end_date     =$request->input('end_date');
        $gender       =$request->input('gender');
        $marital_status =$request->input('marital_status');
        $hospital_id    =$request->input('hospital_id');
        $service        =$request->input('service');
        $region         =$request->input('region');
        $district       =$request->input('district');

        $client =new Patient;
        $clients =$client->filterClient($start_date,$end_date,$gender,$marital_status,$hospital_id,$region,$district);

        if ($service ) {
           $clients_id =ServiceAppointment::where('service_id',$service)->get(['patient_id']);
           $clients   =$clients->whereIn('id',$clients_id);
        }

        return view('report.client.filtered_list',compact('clients'))->render();
    }

    public function generate_report(Request $request){
        $start_date   =$request->input('start_date');
        $end_date     =$request->input('end_date');
        $gender       =$request->input('gender');
        $marital_status =$request->input('marital_status');
        $hospital_id    =$request->input('hospital_id');
        $service        =$request->input('service');
        $region         =$request->input('region');
        $district       =$request->input('district');

        $client =new Patient;
        $clients =$client->filterClient($start_date,$end_date,$gender,$marital_status,$hospital_id,$region,$district);

        if ($service ) {
           $clients_id =ServiceAppointment::where('service_id',$service)->get(['patient_id']);
           $clients   =$clients->whereIn('id',$clients_id);
        }

        return Excel::download(new ClientsExport($clients) ,'Client Report.xlsx');
    }
}

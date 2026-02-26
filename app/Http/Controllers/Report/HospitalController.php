<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Hospital;
use App\Exports\HospitalsExport;
use Excel;



class HospitalController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }
    
    public function index(){
        $regions  =Region::orderby('reg_name','ASC')->get();
        return view('report.hospital.list',compact('regions'));
    }

    public function filter_hospitals(Request $request){
        $start_date =$request->input('start_date');
        $end_date   =$request->input('end_date');
        $region     =$request->input('region');
        $district   =$request->input('district');

        $hospitals =new Hospital;
        $hospitals =$hospitals->seacrhHospital($start_date,$end_date,$region,$district);

        return view('report.hospital.filtered_list',compact('hospitals'))->render();
    }

    public function generate_report(Request $request){
        $start_date =$request->input('start_date');
        $end_date   =$request->input('end_date');
        $region     =$request->input('region');
        $district   =$request->input('district');

        $hospitals =new Hospital;
        $hospitals =$hospitals->seacrhHospital($start_date,$end_date,$region,$district);

        return Excel::download(new HospitalsExport($hospitals),'Hospital Report.xlsx');

    }


}

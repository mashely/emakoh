<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gender;
use App\Models\IdType;
use App\Models\MaritalStatus;
use App\Models\Service;
use App\Models\Patient;
use App\Models\ServiceAppointment;
use App\Models\Region;
use App\Models\District;
use App\Models\Ward;
use Auth;


class RegistrationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if (Auth::user()->hasRole(1)) {
           $clients =Patient::orderby('created_at','DESC')->get();
        } else {
           $hospital_id =hospitalId(Auth::user()->id);
           $clients =Patient::orderby('created_at','DESC')->where('hospital_id',$hospital_id)->get();
        }
        return view('patients.list',compact('clients'));
    }

    public function search_client(Request $request){
        $id_number    =$request->input('id_number');
        $client_id    =$request->input('client_id');
        $phone_number =$request->input('phone_number');

        $client =new Patient;
        $clients =$client->searchClient($id_number,$client_id,$phone_number);
        return view('patients.list',compact('clients'));

     }

    public function edit($id){
        $client =Patient::where('id',$id)->first();
        $gender   =Gender::orderby('name','ASC')->whereNot('id',3)->get();
        $idtype   =IdType::get();
        $services =Service::orderby('name','ASC')->get();
        $regions  =Region::orderby('name','ASC')->get();
        $marital_status =MaritalStatus::orderby('name','ASC')->whereNot('id',4)->get();
        return view('patients.edit',compact('client','gender','idtype','services','marital_status','regions'));
    }

    public function district($region_id){
        $districts =District::where('reg_code',$region_id)->orderBy('dis_name','ASC')->get();
        $district_output=array();
        $district_output [] ="<option value='' Selected>Please Choose District</option>";
          foreach($districts as $row ) {
              $district_output[] = '<option value="'.$row->id.'">'.$row->dis_name.'</option>';
          }
         return $district_output;
    }

    public function ward($district_id){
        $wards =Ward::where('dis_code',$district_id)->orderBy('ward_name','ASC')->get();
        $wards_output=array();
        $wards_output [] ="<option value='' Selected>Please Choose Ward</option>";
          foreach($wards as $row ) {
              $wards_output[] = '<option value="'.$row->id.'">'.$row->ward_name.'</option>';
          }
         return $wards_output;
    }

    public function patient_form(){
        $gender   =Gender::orderby('name','ASC')->whereNot('id',3)->get();
        $idtype   =IdType::get();
        $services =Service::orderby('name','ASC')->get();
        $regions  =Region::orderby('name','ASC')->get();
        $marital_status =MaritalStatus::orderby('name','ASC')->whereNot('id',4)->get();
        return view('patients.add',compact('gender','idtype','services','marital_status','regions'));
    }

    public function create(Request $request){
        $this->validate($request,[
            'first_name' =>'required',
            'last_name'  =>'required',
            'gender'     =>'required',
            'marital_status' =>'required',
            'dob'        =>'required',
            'region'         =>'required',
            'district'       =>'required',
            'ward'           =>'required',
            'phone_number'   =>'required',
            'service'        =>'required',
            'start_date'     =>'required',
            'end_date'       =>'required',
            'id_type'        =>'required',
        ]);

        $id_number      =$request->input('id_number');
        $first_name     =$request->input('first_name');
        $middle_name    =$request->input('middle_name');
        $last_name      =$request->input('last_name');
        $dob            =$request->input('dob');
        $gender         =$request->input('gender');
        $marital_status =$request->input('marital_status');
        $id_type        =$request->input('id_type');
        $id_number      =$request->input('id_number');
        $region         =$request->input('region');
        $district       =$request->input('district');
        $ward           =$request->input('ward');
        $location       =$request->input('location');
        $phone_number   =$request->input('phone_number');
        $service        =$request->input('service');
        $start_date     =$request->input('start_date');
        $end_date       =$request->input('end_date');

        $hospital_id =hospitalId(Auth::user()->id);

        if (!$hospital_id){
            return response()->json([
                'success' =>false,
                'errors'  =>'You are not allowed to perform this action'
            ],500);
        }

        if ($id_number) {
            $check_patient =Patient::where('id_number',$id_number)->first();
            if ($check_patient) {
                return response()->json([
                    'success' =>false,
                    'errors'  =>'The Client Already Exist in our system'
                ],500);
            }
        }

        $patient_reg =new Patient();
        $patient_reg =$patient_reg->registration($first_name,$middle_name,$last_name,$dob,$marital_status,$id_type,$id_number,
        $region,$district,$ward,$location,$phone_number,$gender,$hospital_id);

        $appointment =new ServiceAppointment();
        $appointment =$appointment->registration($patient_reg,$start_date,$end_date,$service,$hospital_id);

        if ($appointment) {
            return response()->json([
                'success' =>true,
                'message' =>'Client Registration done Successfully'
            ],200);
        } else {
            return response()->json([
                'success' =>false,
                'errors'  =>'Client Registration Failed'
            ],500);
        }

    }



    public function update(Request $request){
        $this->validate($request,[
            'first_name' =>'required',
            'last_name'  =>'required',
            'gender'     =>'required',
            'dob'        =>'required',
            'region'         =>'required',
            'district'       =>'required',
            'ward'           =>'required',
            'phone_number'   =>'required',
        ]);

        $id_number      =$request->input('id_number');
        $first_name     =$request->input('first_name');
        $middle_name    =$request->input('middle_name');
        $last_name      =$request->input('last_name');
        $dob            =$request->input('dob');
        $gender         =$request->input('gender');
        $marital_status =$request->input('marital_status');
        $id_type        =$request->input('id_type');
        $id_number      =$request->input('id_number');
        $region         =$request->input('region');
        $district       =$request->input('district');
        $ward           =$request->input('ward');
        $location       =$request->input('location');
        $phone_number   =$request->input('phone_number');
        $client_id      =$request->input('client_id');

        $patient_reg =new Patient();
        $patient_reg =$patient_reg->updateClient($first_name,$middle_name,$last_name,$dob,$marital_status,$id_type,$id_number,
        $region,$district,$ward,$location,$phone_number,$gender,$client_id);


        if ($patient_reg) {
            return response()->json([
                'success' =>true,
                'message' =>'Updation of Client Data Done Successfully'
            ],200);
        } else {
            return response()->json([
                'success' =>false,
                'errors'  =>'Failed to Update Client Data'
            ],500);
        }

    }
}

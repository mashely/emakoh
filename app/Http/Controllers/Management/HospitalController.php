<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\District;
use App\Models\Ward;
use App\Models\Hospital;
use App\Models\HospitalPersonel;

class HospitalController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }

    public function list(){
        $regions  =Region::orderby('reg_name','ASC')->get();
        $hospitals =Hospital::with(['region','district','ward','personel'])->orderby('name','ASC')->get();
        return view('hospital.list',compact('regions','hospitals'));
    }

    public function create(Request $request){
        $this->validate($request,[
            'name' =>'required',
            'region' =>'required',
            'district' =>'required',
            'ward' =>'required',
            'person_name' =>'required',
            'phone_number' =>'required',
        ]);

        $name =$request->input('name');
        $hospital_contact =$request->input('hospital_contact','');
        $hospital_email =$request->input('hospital_email','');
        $region =$request->input('region');
        $district =$request->input('district');
        $ward =$request->input('ward');
        $location =$request->input('location');
        $person_name =$request->input('person_name');
        $phone_number =$request->input('phone_number');
        $designation =$request->input('designation');

        $check_hospital =Hospital::where('name',$name)->first();

        if ($check_hospital) {
            return response()->json([
                'success' =>false,
                'errors'  =>'Hospital with the same name already exist !!!1'
            ],500);
        }

        $hospital =new Hospital;
        $hospital =$hospital->register($name,$hospital_contact,$hospital_email,$region,$district,$ward,$location);

        $personel =new HospitalPersonel;
        $personel =$personel->register($hospital,$person_name,$phone_number,$designation);

        if ($personel) {
            return response()->json([
                'success' =>true,
                'message' =>'Hospital Registration done Successfully'
            ],200);
        } else {
            return response()->json([
                'success' =>false,
                'errors'  =>'Hospital Registration Failed'
            ],500);
        }

    }

    public function update(Request $request){
        $this->validate($request,[
            'name' =>'required',
            'region' =>'required',
            'district' =>'required',
            'ward' =>'required',
            'location' =>'required',
            'person_name' =>'required',
            'phone_number' =>'required',
            'designation'  =>'required'
        ]);

        //return $request->all();

        $name =$request->input('name');
        $hospital_contact =$request->input('hospital_contact','');
        $hospital_email =$request->input('hospital_email','');
        $region =$request->input('region');
        $district =$request->input('district');
        $ward =$request->input('ward');
        $location =$request->input('location');
        $person_name =$request->input('person_name');
        $phone_number =$request->input('phone_number');
        $designation =$request->input('designation');
        $hospital_id =$request->input('hospital_id');

        $hospital =new Hospital;
        $hospital =$hospital->updateHospital($name,$hospital_contact,$hospital_email,$region,$district,$ward,$location,$hospital_id);

        $personel =new HospitalPersonel;
        $personel =$personel->updatePersonel($hospital,$person_name,$phone_number,$designation);

        if ($personel) {
            return response()->json([
                'success' =>true,
                'message' =>'Hospital Update done Successfully'
            ],200);
        } else {
            return response()->json([
                'success' =>false,
                'errors'  =>'Hospital Update Failed'
            ],500);
        }

    }
}

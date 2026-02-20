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
use App\Models\Hospital;
use Illuminate\Support\Facades\DB;
use PDF;
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
        $client =Patient::with(['gender','marital','idType','region','district','ward'])->findOrFail($id);
        $gender   =Gender::orderby('name','ASC')->whereNot('id',3)->get();
        $idtype   =IdType::get();
        $services =Service::orderby('name','ASC')->get();
        $regions  =Region::orderby('reg_name','ASC')->get();
        $marital_status =MaritalStatus::orderby('name','ASC')->whereNot('id',4)->get();

        $pregnancy =DB::table('pregnant_women')
            ->where('patient_id',$id)
            ->orderBy('created_at','DESC')
            ->first();

        return view('pregnant_woman.edit',compact('client','gender','idtype','services','marital_status','regions','pregnancy'));
    }

    public function district($region_id){
        $districts =District::where('reg_code',$region_id)->orderBy('dis_name','ASC')->get();
        $district_output=array();
        $district_output [] ="<option value='' Selected>Please Choose District</option>";
          foreach($districts as $row ) {
              $district_output[] = '<option value="'.$row->dis_code.'">'.$row->dis_name.'</option>';
          }
         return $district_output;
    }

    public function ward($district_id){
        $wards =Ward::where('dis_code',$district_id)->orderBy('ward_name','ASC')->get();
        $wards_output=array();
        $wards_output [] ="<option value='' Selected>Please Choose Ward</option>";
          foreach($wards as $row ) {
              $wards_output[] = '<option value="'.$row->ward_code.'">'.$row->ward_name.'</option>';
          }
         return $wards_output;
    }

    public function patient_form(){
        $gender   =Gender::orderby('name','ASC')->whereNot('id',3)->get();
        $idtype   =IdType::get();
        $services =Service::orderby('name','ASC')->get();
        $regions  =Region::orderby('reg_name','ASC')->get();
        $marital_status =MaritalStatus::orderby('name','ASC')->whereNot('id',4)->get();
        return view('pregnant_woman.add',compact('gender','idtype','services','marital_status','regions'));
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
            if (Auth::user()->hasRole(1)) {
                $hospital_id = Hospital::value('id');

                if (!$hospital_id) {
                    return response()->json([
                        'success' =>false,
                        'errors'  =>'No hospital is registered yet. Please register a hospital first'
                    ],500);
                }
            } else {
                return response()->json([
                    'success' =>false,
                    'errors'  =>'You are not allowed to perform this action'
                ],500);
            }
        }

        $existingPatient =null;
        if ($id_number) {
            $existingPatient =Patient::where('id_number',$id_number)->first();
        }

        $region = $request->input('region');
        if (!Region::find($region)) {
            $region = 1;
        }

        $district = $request->input('district');
        if (!District::find($district)) {
            $district = 1;
        }

        $ward = $request->input('ward');
        if (!Ward::find($ward)) {
            $ward = 1;
        }

        $patient_reg =null;
        $usedExisting =false;

        if ($existingPatient) {
            $patient_reg =$existingPatient->id;
            $usedExisting =true;
        } else {
            $patientModel =new Patient();
            $patient_reg  =$patientModel->registration($first_name,$middle_name,$last_name,$dob,$marital_status,$id_type,$id_number,
                $region,$district,$ward,$location, $service,$phone_number,$gender,$hospital_id);
        }

        $appointment =new ServiceAppointment();
        $appointment =$appointment->registration($patient_reg,$start_date,$end_date,$service,$hospital_id);

        if ($appointment) {
            $isPregnancy = (bool) $request->input('is_pregnancy_registration');
            if ($isPregnancy) {
                $this->storePregnancyDetails($request,$patient_reg);
            }
            return response()->json([
                'success'        =>true,
                'message'        =>$usedExisting ? 'Pregnancy registration added for existing client' : 'Client Registration done Successfully',
                'patient_id'     =>$patient_reg,
                'is_pregnancy'   =>$isPregnancy,
                'existing_client'=>$usedExisting,
            ],200);
        } else {
            return response()->json([
                'success' =>false,
                'errors'  =>'Client Registration Failed'
            ],500);
        }

    }

    protected function storePregnancyDetails(Request $request,$patientId){
        $dangerSigns =$request->input('danger_signs');
        if (is_array($dangerSigns)) {
            $dangerSigns =implode(',',$dangerSigns);
        }

        $chronicIllnesses =$request->input('chronic_illnesses');
        if (is_array($chronicIllnesses)) {
            $chronicIllnesses =implode(',',$chronicIllnesses);
        }

        $previousComplications =$request->input('previous_pregnancy_complications');
        if (is_array($previousComplications)) {
            $previousComplications =implode(',',$previousComplications);
        }

        DB::table('pregnant_women')->insert([
            'patient_id'                 =>$patientId,
            'gravida'                    =>$request->input('gravida'),
            'para'                       =>$request->input('para'),
            'living_children'            =>$request->input('living_children'),
            'miscarriages'               =>$request->input('miscarriages'),
            'stillbirths'                =>$request->input('stillbirths'),
            'cesarean_sections'          =>$request->input('cesarean_sections'),
            'preterm_births'             =>$request->input('preterm_births'),
            'lmp'                        =>$request->input('lmp'),
            'edd'                        =>$request->input('edd'),
            'gestational_age_weeks'      =>$request->input('gestational_age_weeks'),
            'pregnancy_planned'          =>$request->input('pregnancy_planned'),
            'first_anc_visit_date'       =>$request->input('first_anc_visit_date'),
            'pregnancy_confirmation_method' =>$request->input('pregnancy_confirmation_method'),
            'pregnancy_number'           =>$request->input('pregnancy_number'),
            'fetal_movements'            =>$request->input('fetal_movements'),
            'fetal_movements_started_at' =>$request->input('fetal_movements_started_at'),
            'multiple_pregnancy_type'    =>$request->input('multiple_pregnancy_type'),
            'danger_signs'               =>$dangerSigns,
            'alt_phone_number'           =>$request->input('alt_phone_number'),
            'emergency_contact_name'     =>$request->input('emergency_contact_name'),
            'emergency_contact_phone'    =>$request->input('emergency_contact_phone'),
            'chronic_illnesses'          =>$chronicIllnesses,
            'previous_pregnancy_complications' =>$previousComplications,
            'blood_transfusion_history'  =>$request->input('blood_transfusion_history'),
            'surgical_history'           =>$request->input('surgical_history'),
            'allergies'                  =>$request->input('allergies'),
            'height_cm'                  =>$request->input('height_cm'),
            'weight_kg'                  =>$request->input('weight_kg'),
            'bmi'                        =>$request->input('bmi'),
            'blood_pressure'             =>$request->input('blood_pressure'),
            'temperature_c'              =>$request->input('temperature_c'),
            'pulse_rate'                 =>$request->input('pulse_rate'),
            'muac_cm'                    =>$request->input('muac_cm'),
            'blood_group'                =>$request->input('blood_group'),
            'rhesus_factor'              =>$request->input('rhesus_factor'),
            'hemoglobin_level'           =>$request->input('hemoglobin_level'),
            'hiv_status'                 =>$request->input('hiv_status'),
            'syphilis_result'            =>$request->input('syphilis_result'),
            'hepatitis_b_result'         =>$request->input('hepatitis_b_result'),
            'urinalysis_protein'         =>$request->input('urinalysis_protein'),
            'urinalysis_sugar'           =>$request->input('urinalysis_sugar'),
            'blood_sugar'                =>$request->input('blood_sugar'),
            'malaria_test_result'        =>$request->input('malaria_test_result'),
            'iron_folic_started'         =>$request->input('iron_folic_started'),
            'deworming_status'           =>$request->input('deworming_status'),
            'tetanus_toxoid_doses'       =>$request->input('tetanus_toxoid_doses'),
            'current_medications'        =>$request->input('current_medications'),
            'occupation'                 =>$request->input('occupation'),
            'education_level'            =>$request->input('education_level'),
            'smoking_status'             =>$request->input('smoking_status'),
            'alcohol_use'                =>$request->input('alcohol_use'),
            'domestic_violence_exposure' =>$request->input('domestic_violence_exposure'),
            'nutritional_status'         =>$request->input('nutritional_status'),
            'created_at'                 =>now(),
            'updated_at'                 =>now(),
        ]);
    }

    public function pregnancyPdf($id){
        $patient =Patient::with(['gender','marital','idType','region','district','ward','hospital'])->findOrFail($id);

        $pregnancy =DB::table('pregnant_women')
            ->where('patient_id',$id)
            ->orderBy('created_at','DESC')
            ->first();

        $pdf =PDF::loadView('pregnant_woman.pdf',[
            'patient' =>$patient,
            'pregnancy' =>$pregnancy,
        ]);

        $fileName ='pregnancy_registration_'.$patient->patient_id.'.pdf';

        return $pdf->stream($fileName);
    }

    public function update(Request $request){
        $client_id      =$request->input('client_id');
        $existingPatient =Patient::findOrFail($client_id);

        $this->validate($request,[
            'first_name'   =>'required',
            'last_name'    =>'required',
            'gender'       =>'required',
            'dob'          =>'required',
            'phone_number' =>'required',
        ]);

        $first_name     =$request->input('first_name');
        $middle_name    =$request->input('middle_name');
        $last_name      =$request->input('last_name');
        $dob            =$request->input('dob');
        $gender         =$request->input('gender');
        $marital_status =$request->input('marital_status',$existingPatient->marital_status_id);
        $id_type        =$request->input('id_type',$existingPatient->id_type);
        $id_number      =$request->input('id_number',$existingPatient->id_number);
        $region         =$request->input('region',$existingPatient->region_id);
        $district       =$request->input('district',$existingPatient->district_id);
        $ward           =$request->input('ward',$existingPatient->ward_id);
        $location       =$request->input('location',$existingPatient->physical_address);
        $phone_number   =$request->input('phone_number');
        $isPregnancy    =(bool) $request->input('is_pregnancy_registration',false);

        $patient_reg =new Patient();
        $patient_reg =$patient_reg->updateClient($first_name,$middle_name,$last_name,$dob,$marital_status,$id_type,$id_number,
            $region,$district,$ward,$location,$phone_number,$gender,$client_id);

        if ($patient_reg && $isPregnancy) {
            $dangerSigns =$request->input('danger_signs');
            if (is_array($dangerSigns)) {
                $dangerSigns =implode(',',$dangerSigns);
            }

            $chronicIllnesses =$request->input('chronic_illnesses');
            if (is_array($chronicIllnesses)) {
                $chronicIllnesses =implode(',',$chronicIllnesses);
            }

            $previousComplications =$request->input('previous_pregnancy_complications');
            if (is_array($previousComplications)) {
                $previousComplications =implode(',',$previousComplications);
            }

            $pregnancyData =[
                'gravida'                    =>$request->input('gravida'),
                'para'                       =>$request->input('para'),
                'living_children'            =>$request->input('living_children'),
                'miscarriages'               =>$request->input('miscarriages'),
                'stillbirths'                =>$request->input('stillbirths'),
                'cesarean_sections'          =>$request->input('cesarean_sections'),
                'preterm_births'             =>$request->input('preterm_births'),
                'lmp'                        =>$request->input('lmp'),
                'edd'                        =>$request->input('edd'),
                'gestational_age_weeks'      =>$request->input('gestational_age_weeks'),
                'pregnancy_planned'          =>$request->input('pregnancy_planned'),
                'first_anc_visit_date'       =>$request->input('first_anc_visit_date'),
                'pregnancy_confirmation_method' =>$request->input('pregnancy_confirmation_method'),
                'pregnancy_number'           =>$request->input('pregnancy_number'),
                'fetal_movements'            =>$request->input('fetal_movements'),
                'fetal_movements_started_at' =>$request->input('fetal_movements_started_at'),
                'multiple_pregnancy_type'    =>$request->input('multiple_pregnancy_type'),
                'danger_signs'               =>$dangerSigns,
                'alt_phone_number'           =>$request->input('alt_phone_number'),
                'emergency_contact_name'     =>$request->input('emergency_contact_name'),
                'emergency_contact_phone'    =>$request->input('emergency_contact_phone'),
                'chronic_illnesses'          =>$chronicIllnesses,
                'previous_pregnancy_complications' =>$previousComplications,
                'blood_transfusion_history'  =>$request->input('blood_transfusion_history'),
                'surgical_history'           =>$request->input('surgical_history'),
                'allergies'                  =>$request->input('allergies'),
                'height_cm'                  =>$request->input('height_cm'),
                'weight_kg'                  =>$request->input('weight_kg'),
                'bmi'                        =>$request->input('bmi'),
                'blood_pressure'             =>$request->input('blood_pressure'),
                'temperature_c'              =>$request->input('temperature_c'),
                'pulse_rate'                 =>$request->input('pulse_rate'),
                'muac_cm'                    =>$request->input('muac_cm'),
                'blood_group'                =>$request->input('blood_group'),
                'rhesus_factor'              =>$request->input('rhesus_factor'),
                'hemoglobin_level'           =>$request->input('hemoglobin_level'),
                'hiv_status'                 =>$request->input('hiv_status'),
                'syphilis_result'            =>$request->input('syphilis_result'),
                'hepatitis_b_result'         =>$request->input('hepatitis_b_result'),
                'urinalysis_protein'         =>$request->input('urinalysis_protein'),
                'urinalysis_sugar'           =>$request->input('urinalysis_sugar'),
                'blood_sugar'                =>$request->input('blood_sugar'),
                'malaria_test_result'        =>$request->input('malaria_test_result'),
                'iron_folic_started'         =>$request->input('iron_folic_started'),
                'deworming_status'           =>$request->input('deworming_status'),
                'tetanus_toxoid_doses'       =>$request->input('tetanus_toxoid_doses'),
                'current_medications'        =>$request->input('current_medications'),
                'occupation'                 =>$request->input('occupation'),
                'education_level'            =>$request->input('education_level'),
                'smoking_status'             =>$request->input('smoking_status'),
                'alcohol_use'                =>$request->input('alcohol_use'),
                'domestic_violence_exposure' =>$request->input('domestic_violence_exposure'),
                'nutritional_status'         =>$request->input('nutritional_status'),
                'updated_at'                 =>now(),
            ];

            $existingPregnancy =DB::table('pregnant_women')
                ->where('patient_id',$client_id)
                ->orderBy('created_at','DESC')
                ->first();

            if ($existingPregnancy) {
                DB::table('pregnant_women')
                    ->where('id',$existingPregnancy->id)
                    ->update($pregnancyData);
            } else {
                $pregnancyData['patient_id'] =$client_id;
                $pregnancyData['created_at'] =now();
                DB::table('pregnant_women')->insert($pregnancyData);
            }
        }

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

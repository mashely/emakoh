<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceAppointment;
use App\Models\Service;
use Auth;



class AppointmentController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }

    public function index($patient_id){
        $appointments =ServiceAppointment::orderby('created_at','desc')->where('patient_id',$patient_id)->get();
        $services =Service::orderby('name','ASC')->get();
        return view('appointments.list',compact('appointments','services','patient_id'));

    }

    public function reminders($hospital_id){
        $services =Service::orderby('name','ASC')->get();
        $appointments =ServiceAppointment::orderby('created_at','desc')->where('hospital_id',$hospital_id)->get();
        return view('appointments.hospital_reminders',compact('appointments','services'));

    }

    public function create(Request $request){
        $this->validate($request,[
            'service'    =>'required',
            'start_date' =>'required|date',
            'end_date'   =>'required|date|after_or_equal:start_date',
            'frequency'  =>'required|in:weekly,monthly',
        ]);

        $patient_id  =$request->input('patient_id');
        $service     =$request->input('service');
        $start_date  =$request->input('start_date');
        $end_date    =$request->input('end_date');
        $frequency   =$request->input('frequency');

        $hospital_id =hospitalId(Auth::user()->id);

        if (!$hospital_id){
            return response()->json([
                'success' =>false,
                'errors'  =>'You are not allowed to perform this action'
            ],500);
        }

        $created =0;
        $current = \Carbon\Carbon::parse($start_date);
        $end     = \Carbon\Carbon::parse($end_date);

        while ($current->lte($end)) {
            $appointment = new ServiceAppointment();
            $appointment = $appointment->registration(
                $patient_id,
                $current->format('Y-m-d'),
                $current->format('Y-m-d'),
                $service,
                $hospital_id
            );
            if ($appointment) $created++;
            if ($frequency === 'weekly') {
                $current->addWeek();
            } else {
                $current->addMonth();
            }
        }

        if ($created > 0) {
            return response()->json([
                'success' =>true,
                'message' =>'Reminders created Successfully'
            ],200);
        } else {
            return response()->json([
                'success' =>false,
                'errors'  =>'Fail to Create Reminders'
            ],500);
        }
    }

    public function list(){ 
        if (Auth::user()->hasRole(1)) {
            $appointments =ServiceAppointment::orderby('created_at','desc')->get();

        } else {
            $hospital_id=hospitalId(Auth::user()->id);
            $appointments =ServiceAppointment::orderby('created_at','desc')->where('hospital_id',$hospital_id)->get();
        }
        $services =Service::orderby('name','ASC')->get();
        return view('appointments.all_appointment',compact('appointments','services'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'service'    =>'required',
            'start_date' =>'required',
            'end_date'   =>'required',
        ]);

        $reminder_id  =$request->input('reminder_id');
        $service     =$request->input('service');
        $start_date  =$request->input('start_date');
        $end_date    =$request->input('end_date');
        $reason      =$request->input('reason');


        $appointment =new ServiceAppointment();
        $appointment =$appointment->updateReminder($reminder_id,$start_date,$end_date,$service,$reason);

        if ($appointment) {
            return response()->json([
                'success' =>true,
                'message' =>'Reminder Updated Successfully'
            ],200);
        } else {
            return response()->json([
                'success' =>false,
                'errors'  =>'Fail to Update Reminder'
            ],500);
        }
    }

    public function confirm(Request $request){
        $this->validate($request,[
            'reminder_id' =>'required|integer|exists:service_appointments,id',
        ]);

        $reminder_id =$request->input('reminder_id');
        $reminder    =ServiceAppointment::find($reminder_id);
        if (!$reminder) {
            return response()->json([
                'success' =>false,
                'errors'  =>'Reminder not found'
            ],404);
        }

        $reminder->status =1;
        $reminder->attended_by =Auth::user()->id;
        $reminder->save();

        return response()->json([
            'success' =>true,
            'message' =>'Visit confirmed Successfully'
        ],200);
    }
}

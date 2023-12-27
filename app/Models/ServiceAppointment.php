<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class ServiceAppointment extends Model
{
    use HasFactory;
    public $table ="service_appointments";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function registration($patient_id,$start_date,$end_date,$service,$hospital_id){
        $appointment =ServiceAppointment::create([
            'patient_id' =>$patient_id,
            'created_by' =>Auth::user()->id,
            'service_id' =>$service,
            'start_date' =>$start_date,
            'end_date'   =>$end_date,
            'hospital_id'   =>$hospital_id,
        ]);

        return $appointment;
    }

    public function updateReminder($reminder_id,$start_date,$end_date,$service,$reason){
        $reminder =ServiceAppointment::where('id',$reminder_id)->first();
        $reminder->start_date =$start_date;
        $reminder->end_date   =$end_date;
        $reminder->service_id =$service;
        $reminder->edit_reason =$reason;
        $reminder->attended_by =Auth::user()->id;
        $reminder->save();

        return $reminder->id;
    }

    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function hospital(){
        return $this->belongsTo(Hospital::class,'hospital_id');
    }

    public static function filterReminder($start_date = null,$end_date=null,$return_start_date=null,$return_end_date=null,
    $hospital_id=null,$service=null,$reminder_status=null,$client_id){
        $reminders = static::orderBy('created_at','DESC');

        if ($hospital_id != null)
            $reminders = $reminders->where('hospital_id',$hospital_id);

        if ($client_id != null)
            $reminders = $reminders->whereIn('patient_id',$client_id);

        if ($service != null)
            $reminders = $reminders->where('service_id',$service);

        if ($reminder_status != null){
            if ($reminder_status == "OPEN") {
                 $reminders =$reminders->where('end_date','<=',date('Y-m-d'));
            } else {
                 $reminders =$reminders->where('end_date','>',date('Y-m-d'));
            }
        }

        if ($start_date != null || $end_date != null) {
            if ($start_date != null && $end_date != null)
                $reminders = $reminders->whereBetween('start_date', [$start_date, $end_date]);

            else if ($start_date != null)
                $reminders = $reminders->where('start_date', '>=', $start_date);

            else if ($end_date != null)
                $reminders = $reminders->where('start_date', '<=', $end_date);
        }

        if ($return_start_date != null || $return_end_date != null) {
            if ($return_start_date != null && $return_end_date != null)
                $reminders = $reminders->whereBetween('end_date', [$return_start_date, $return_end_date]);

            else if ($return_start_date != null)
                $reminders = $reminders->where('end_date', '>=', $return_start_date);

            else if ($return_end_date != null)
                $reminders = $reminders->where('end_date', '<=', $return_end_date);
        }

        return $reminders->get();
    }
}

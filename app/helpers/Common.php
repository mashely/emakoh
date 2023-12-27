<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Models\ServiceAppointment;



//check_time
if (!function_exists('greeting')) {
    function greeting()
    {
        $time = date("H");
        /* Set the $timezone variable to become the current timezone */
        $timezone = date("e");
        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            return "Good morning";
        } else
        /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
        if ($time >= "12" && $time < "17") {
            return "Good afternoon";
        } else
        /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
        if ($time >= "17" && $time < "19") {
            return "Good evening";
        } else
        /* Finally, show good night if the time is greater than or equal to 1900 hours */
        if ($time >= "19") {
            return "Good evening";
        }
    }
}
// Help to return Hospital Id
if (!function_exists('hospitalId')) {
    function hospitalId($user_id){
        $staff =Staff::where('user_id',$user_id)->first();
        if ($staff) {
            return $staff->hospital_id;
        }else {
            return false;
        }
    }
}

if (!function_exists('age')) {
    function age($dob){
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dob),date_create($today));
        return $diff->format('%y');
    }
}

if (!function_exists('todayReminders')) {
    function todayReminders(){

        if (Auth::user()->hasRole(1)) {
            $reminder =ServiceAppointment::where('end_date',date('Y-m-d'))->count();

        } else {
            $hospital_id=hospitalId(Auth::user()->id);
            $reminder =ServiceAppointment::where('end_date',date('Y-m-d'))->where('hospital_id',$hospital_id)->count();
        }

        return $reminder;
    }
}

if (!function_exists('hospitalReminders')) {
    function hospitalReminders($hospital_id){
        $reminder =ServiceAppointment::where('hospital_id',$hospital_id)->count();
        return $reminder;
    }
}


if (!function_exists('clientReminder')) {
    function clientReminder($client_id){
        $reminder =ServiceAppointment::where('patient_id',$client_id)->count();
        return $reminder;
    }
}


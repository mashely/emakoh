<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Patient;
use App\Models\ServiceAppointment;
use Datetime;


class HospitalController extends Controller
{
     
    public function __construct(){
        return $this->middleware('auth');
    }

    public function index(){
        $hospital_id =HospitalId(Auth::user()->id);
        $data =array(
            'total_client'    =>Patient::where('hospital_id',$hospital_id)->count(),
            'total_reminder'  =>ServiceAppointment::where('hospital_id',$hospital_id)->count(),
            'open_reminder'   =>ServiceAppointment::where('hospital_id',$hospital_id)->where('end_date','>',date('Y-m-d'))->count(),
            'closed_reminder' =>ServiceAppointment::where('hospital_id',$hospital_id)->where('end_date','<',date('Y-m-d'))->count(),
            'gender'          =>$this->gender(),
            'clients'          =>$this->clients(),
            'visits'          =>$this->visits(),
        );

        //return json_encode($data['clients'],true);

        return view('dashboard.dashboard',compact('data'));
    }

    public function gender(){
        $hospital_id =HospitalId(Auth::user()->id);
        $gender =array(
            'male'   =>Patient::where('hospital_id',$hospital_id)->where('gender_id',1)->count(),
            'female' =>Patient::where('hospital_id',$hospital_id)->where('gender_id',2)->count(),
            'not_specified' =>Patient::where('hospital_id',$hospital_id)->whereNotIn('gender_id',[1,2])->count(),
        );

        return $gender;
    }

    public function clients() {
        $hospital_id =HospitalId(Auth::user()->id);
        $monthly_reg = Patient::
        whereYear( 'created_at', date( 'Y' ) )
        ->where('hospital_id',$hospital_id)
        ->selectRaw( ' COUNT(*) as count, YEAR(created_at) year,MONTH(created_at) month ')
        ->groupBy(  'year', 'month' )
        ->get( array( 'month', 'count' ) );
  
        $members_array = array();
        foreach ( $monthly_reg as $month ) {
  
            $dateObj   = DateTime::createFromFormat( '!m', $month->month );
            $monthName = substr( $dateObj->format( 'F' ), 0, 3 );
            $sale_ = $month->count;
  
            $members_array[$monthName] = $month->count;
  
        }
  
        
        $month_array = array();
        for ( $i = 1; $i <= 12; $i++ ) {
  
            $dateObj   = DateTime::createFromFormat( '!m', $i );
            $monthName = substr( $dateObj->format( 'F' ), 0, 3 );
  
            if ( array_key_exists( $monthName, $members_array ) ) {
                $month_array[] = $members_array[$monthName];
            } else {
                $month_array[] = 0;
            }
  
        }
  
        return implode(",",$month_array);
  
  
    }

    public function visits() {
        $hospital_id =HospitalId(Auth::user()->id);
        $monthly_reg = ServiceAppointment::
        whereYear( 'created_at', date( 'Y' ) )
        ->where('hospital_id',$hospital_id)
        ->selectRaw( ' COUNT(*) as count, YEAR(created_at) year,MONTH(created_at) month ')
        ->groupBy(  'year', 'month' )
        ->get( array( 'month', 'count' ) );
  
        $members_array = array();
        foreach ( $monthly_reg as $month ) {
  
            $dateObj   = DateTime::createFromFormat( '!m', $month->month );
            $monthName = substr( $dateObj->format( 'F' ), 0, 3 );
            $sale_ = $month->count;
  
            $members_array[$monthName] = $month->count;
  
        }
  
        
        $month_array = array();
        for ( $i = 1; $i <= 12; $i++ ) {
  
            $dateObj   = DateTime::createFromFormat( '!m', $i );
            $monthName = substr( $dateObj->format( 'F' ), 0, 3 );
  
            if ( array_key_exists( $monthName, $members_array ) ) {
                $month_array[] = $members_array[$monthName];
            } else {
                $month_array[] = 0;
            }
  
        }
  
        return implode(",",$month_array);
  
  
    }
}

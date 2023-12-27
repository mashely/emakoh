<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Patient;
use App\Models\ServiceAppointment;
use Datetime;


class HomeController extends Controller
{
     
    public function __construct(){
        return $this->middleware('auth');
    }

    public function index(){
        $data =array(
            'total_client'    =>Patient::count(),
            'total_reminder'  =>ServiceAppointment::count(),
            'open_reminder'   =>ServiceAppointment::where('end_date','>',date('Y-m-d'))->count(),
            'closed_reminder' =>ServiceAppointment::where('end_date','<',date('Y-m-d'))->count(),
            'gender'          =>$this->gender(),
            'clients'          =>$this->clients(),
            'visits'          =>$this->visits(),
        );

        //return json_encode($data['clients'],true);

        return view('dashboard.dashboard',compact('data'));
    }

    public function gender(){
        $gender =array(
            'male'   =>Patient::where('gender_id',1)->count(),
            'female' =>Patient::where('gender_id',2)->count(),
            'not_specified' =>Patient::whereNotIn('gender_id',[1,2])->count(),
        );

        return $gender;
    }

    public function clients() {

        $monthly_reg = Patient::
        whereYear( 'created_at', date( 'Y' ) )
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

        $monthly_reg = ServiceAppointment::
        whereYear( 'created_at', date( 'Y' ) )
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

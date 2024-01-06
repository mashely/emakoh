<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Patient extends Model
{
    use HasFactory;

    public $table ="patients";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function registration($first_name,$middle_name,$last_name,$dob,$marital_status,$id_type,$id_number,
    $region,$district,$ward,$location,$phone_number,$gender,$hospital_id){

        $check_number =Patient::orderby('id','desc')->first();

        if ($check_number) {
            $patient_id =$check_number->patient_id + 1;
        } else {
            $patient_id =1000;
        }

        $patient =Patient::create([
            'first_name'      =>ucwords($first_name),
            'middle_name'     =>ucwords($middle_name),
            'last_name'       =>ucwords($last_name),
            'dob'             =>$dob,
            'gender_id'       =>$gender,
            'marital_status_id' =>$marital_status,
            'id_type'         =>$id_type,
            'id_number'       =>$id_number,
            'region_id'       =>$region,
            'district_id'      =>$district,
            'ward_id'          =>$ward,
            'phone_number'     =>$phone_number,
            'patient_id'       =>$patient_id,
            'hospital_id'      =>$hospital_id,
            'created_by'       =>Auth::user()->id,
            'physical_address'  =>$location,
        ]);


        return $patient->id;

    }

    public function updateClient($first_name,$middle_name,$last_name,$dob,$marital_status,$id_type,$id_number,
    $region,$district,$ward,$location,$phone_number,$gender,$client_id){
        $patient =Patient::where('id',$client_id)->first();
        $patient->first_name       =ucwords($first_name);
        $patient->middle_name      =ucwords($middle_name);
        $patient->last_name        =ucwords($last_name);
        $patient->dob              =$dob;
        $patient->gender_id        =$gender;
        $patient->marital_status_id =$marital_status;
        $patient->id_type        =$id_type;
        $patient->id_number     =$id_number;
        $patient->physical_address = $location;
        $patient->region_id     =$region;
        $patient->district_id   =$district;
        $patient->ward_id       =$ward;
        $patient->phone_number  =$phone_number;
        $patient->updated_by    =Auth::user()->id;
        $patient->save();

        return $patient->id;
    }

    public function gender(){
        return $this->belongsTo(Gender::class,'gender_id');
    }

    public function marital(){
        return $this->belongsTo(MaritalStatus::class,'marital_status_id');
    }


    public function idType(){
        return $this->belongsTo(IdType::class,'id_type');
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }


    public function region(){
        return $this->belongsTo(Region::class,'region_id');
    }

    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }

    public function ward(){
        return $this->belongsTo(Ward::class,'ward_id');
    }

    public function hospital(){
        return $this->belongsTo(Hospital::class,'hospital_id');
    }

    public function reminders(){
        return $this->hasMany(ServiceAppointment::class,'id','patient_id');
    }

    public static function searchClient($id_number = null,$client_id = null,$phone_number = null)
    {
        $clients = static::orderBy('created_at', 'ASC');

        if ($phone_number != null)
            $clients = $clients->where('phone_number','like','%'.$phone_number.'%');

        if ($client_id != null)
            $clients = $clients->where('patient_id','like','%'.$client_id.'%');

        if ($id_number != null)
            $clients = $clients->where('id_number','like','%'.$id_number.'%');

        return $clients->get();
    }

    public static function filterClient($start_date = null,$end_date = null,$gender =null,$marital_status = null,$hospital_id =null,$region =null,$district = null)
    {
        $clients = static::orderBy('created_at','DESC');

        if ($gender != null)
            $clients = $clients->where('gender_id',$gender);

        if ($marital_status != null)
            $clients = $clients->where('marital_status_id',$marital_status);

        if ($hospital_id != null)
            $clients = $clients->where('hospital_id',$hospital_id);

        if ($region != null)
            $clients = $clients->where('region_id',$region);

        if ($district != null)
            $clients = $clients->where('district_id',$district);

        if ($start_date != null || $end_date != null) {
            if ($start_date != null && $end_date != null)
                $clients = $clients->whereBetween('created_at', [$start_date, $end_date]);

            else if ($start_date != null)
                $clients = $clients->where('created_at', '>=', $start_date);

            else if ($end_date != null)
                $clients = $clients->where('created_at', '<=', $end_date);
        }

        return $clients->get();
    }





}

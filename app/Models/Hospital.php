<?php

namespace App\Models;
use Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    public $table ="hospitals";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function register($name,$hospital_contact,$hospital_email,$region,$district,$ward,$location){
        $hospital =Hospital::create([
            'name' =>$name,
            'phone_number' =>$hospital_contact,
            'email' =>$hospital_email,
            'region_id' =>$region,
            'district_id' =>$district,
            'ward_id' =>$ward,
            'location' =>$location,
            'created_by' =>Auth::user()->id,
        ]);

        return $hospital->id;
    }

    public function updateHospital($name,$hospital_contact,$hospital_email,$region,$district,$ward,$location,$hospital_id){
        $hospital =Hospital::where('id',$hospital_id)->first();
        $hospital->name =$name;
        $hospital->phone_number =$hospital_contact;
        $hospital->email =$hospital_email;
        $hospital->region_id =$region;
        $hospital->district_id =$district;
        $hospital->ward_id =$ward;
        $hospital->location =$location;
        $hospital->updated_by =Auth::user()->id;
        $hospital->save();

        return $hospital->id;
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

    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function personel(){
        return $this->hasOne(HospitalPersonel::class,'hospital_id','id');
    }

    public function reminders(){
        return $this->hasMany(ServiceAppointment::class,'id','hospital_id');
    }

    public static function seacrhHospital($start_date = null,$end_date = null,$region = null,$district = null)
    {
        $hospitals = static::orderBy('created_at','DESC');

        if ($region != null)
            $hospitals = $hospitals->where('region_id',$region);

        if ($district != null)
            $hospitals = $hospitals->where('district_id',$district);

        if ($start_date != null || $end_date != null) {
            if ($start_date != null && $end_date != null)
                $hospitals = $hospitals->whereBetween('created_at', [$start_date, $end_date]);

            else if ($start_date != null)
                $hospitals = $hospitals->where('created_at', '>=', $start_date);

            else if ($end_date != null)
                $hospitals = $hospitals->where('created_at', '<=', $end_date);
        }

        return $hospitals->get();
    }
}

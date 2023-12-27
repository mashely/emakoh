<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalPersonel extends Model
{
    use HasFactory;

    public $table ="hospital_contact_personels";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function register($hospital,$person_name,$phone_number,$designation){
        $personel =HospitalPersonel::create([
            'name'         =>$person_name,
            'phone_number' =>$phone_number,
            'designation'  =>$designation,
            'hospital_id'  =>$hospital,
        ]);

        return $personel->id;
    }

    public function updatePersonel($hospital,$person_name,$phone_number,$designation){
        $personel =HospitalPersonel::where('hospital_id',$hospital)->first();
        $personel->name =$person_name;
        $personel->phone_number =$phone_number;
        $personel->designation =$designation;
        $personel->save();

        return $personel->id;
    }
}

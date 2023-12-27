<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    public $table="staffs";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function register($user_id,$hospital_id){
        $staff =Staff::create([
            'user_id'     =>$user_id,
            'hospital_id' =>$hospital_id,
        ]);

        return $staff->id;
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function hospital(){
        return $this->hasOne(Hospital::class,'id','hospital_id');
    }

   
}

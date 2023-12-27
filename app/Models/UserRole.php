<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    public $table ="role_user";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function register($user_id,$role_id){
        $roles =UserRole::create([
            'user_id' =>$user_id,
            'role_id' =>$role_id,
        ]);

        return $roles;
    }

    public function userRole()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }
}

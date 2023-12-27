<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone',
        'gender_id',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        //roles
    public function roles()
    {
        return $this->hasOne(UserRole::class,'user_id');
    }

    /**
     * @param string|array $roles
     * @return bool
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized.');
        }

        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles
     * @param array $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check one role
     * @param string $role
     * @return bool
     */
    public function hasRole($role_id)
    {
        return null !== $this->roles()->where('role_id',$role_id)->first();
    }

    public function register($name,$gender,$email,$password,$phone_number){
        $user =User::create([
            'name'      =>$name,
            'username'  =>$email,
            'email'     =>$email,
            'phone'     =>$phone_number,
            'gender_id' =>$gender,
            'password' =>\Hash::make($password),
            'created_by' =>Auth::user()->id,
        ]);

        return $user->id;
    }

    public function gender(){
        return $this->belongsTo(Gender::class,'gender_id');
    }

    public function staff(){
        return $this->hasOne(Staff::class,'user_id','id');
    }

    public function reminderCreate(){
        return $this->hasMany(ServiceAppointment::class,'id','created_by');
    }

    public function updateUser($name,$gender,$phone_number,$user_id){
        $user =User::where('id',$user_id)->first();
        $user->name =ucwords($name);
        $user->phone =$phone_number;
        $user->gender_id =$gender;
        $user->save();

        return $user->id;
    }

    public static function filterUser($start_date = null,$end_date = null,$status = null){
        $users = static::orderBy('created_at','DESC');

        if ($status != null)
            $users = $users->where('active',$status);

        if ($start_date != null || $end_date != null) {
            if ($start_date != null && $end_date != null)
                $users = $users->whereBetween('created_at', [$start_date, $end_date]);

            else if ($start_date != null)
                $users = $users->where('created_at', '>=', $start_date);

            else if ($end_date != null)
                $users = $users->where('created_at', '<=', $end_date);
        }

        return $users->get();
    }
}

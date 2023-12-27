<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use OwenIt\Auditing\Contracts\Auditable;
// use OwenIt\Auditing\Auditable as AuditableTrait;

class Role extends Model
{
    use HasFactory;
   // use AuditableTrait;
    public $table ="roles";
    protected $guarded = ['id'];
    public $timestamps = false;

    //users
    
}

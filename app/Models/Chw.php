<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chw extends Model
{
    protected $table = 'chws';
    protected $fillable = ['full_name','phone_number','created_by'];
}


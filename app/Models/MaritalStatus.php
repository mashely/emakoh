<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory;

    public $table ="marital_status";
    protected $guarded = ['id'];
    public $timestamps = false;
}

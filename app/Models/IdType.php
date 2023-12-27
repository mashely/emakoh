<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdType extends Model
{
    use HasFactory;
    public $table ="id_types";
    protected $guarded = ['id'];
    public $timestamps = false;
}

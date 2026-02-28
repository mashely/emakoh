<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiskFactorCategory extends Model
{
    protected $table = 'risk_factor_categories';
    protected $fillable = ['name','description','created_by'];
}


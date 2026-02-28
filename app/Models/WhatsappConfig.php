<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappConfig extends Model
{
    protected $table = 'whatsapp_configs';
    protected $fillable = ['channel','phone_number_id','access_token','verify_token','is_active','created_by'];
    protected $casts = ['is_active'=>'boolean'];
}


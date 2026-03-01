<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappConversation extends Model
{
    protected $table = 'whatsapp_conversations';
    protected $fillable = ['phone','display_name','last_message_at','last_message_preview','unread_count','is_archived'];
    protected $casts = ['last_message_at'=>'datetime','is_archived'=>'boolean'];

    public function messages()
    {
        return $this->hasMany(WhatsappMessage::class,'conversation_id');
    }
}


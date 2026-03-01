<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappMessage extends Model
{
    protected $table = 'whatsapp_messages';
    protected $fillable = ['conversation_id','direction','type','text','media_url','wa_message_id','status','sent_by','sent_at'];
    protected $casts = ['sent_at'=>'datetime'];

    public function conversation()
    {
        return $this->belongsTo(WhatsappConversation::class,'conversation_id');
    }
}


<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WhatsappConfig;
use App\Models\WhatsappConversation;
use App\Models\WhatsappMessage;
use Illuminate\Support\Facades\Log;

class WhatsappWebhookController extends Controller
{
    public function verify(Request $request){
        $mode = $request->get('hub_mode');
        $token = $request->get('hub_verify_token');
        $challenge = $request->get('hub_challenge');
        $cfg = WhatsappConfig::where('is_active',true)->first();
        if($mode==='subscribe' && $token && $cfg && hash_equals($cfg->verify_token,$token)){
            return response($challenge,200);
        }
        return response('Forbidden',403);
    }

    public function receive(Request $request){
        $payload = $request->all();
        $entry = $payload['entry'][0]['changes'][0]['value'] ?? null;
        if(!$entry) return response()->json(['ok'=>true]);
        $messages = $entry['messages'] ?? [];
        foreach($messages as $m){
            $from = $m['from'] ?? null;
            $text = $m['text']['body'] ?? null;
            $name = $entry['contacts'][0]['profile']['name'] ?? null;
            if(!$from || !$text) continue;
            $conv = WhatsappConversation::firstOrCreate(['phone'=>$from],[
                'display_name'=>$name,
                'last_message_at'=>now(),
                'last_message_preview'=>mb_substr($text,0,50),
                'unread_count'=>0
            ]);
            WhatsappMessage::create([
                'conversation_id'=>$conv->id,
                'direction'=>'in',
                'type'=>'text',
                'text'=>$text,
                'wa_message_id'=>$m['id'] ?? null,
                'status'=>'received',
                'sent_at'=>now()
            ]);
            $conv->last_message_at = now();
            $conv->last_message_preview = mb_substr($text,0,50);
            $conv->unread_count = $conv->unread_count + 1;
            $conv->save();
        }
        return response()->json(['ok'=>true]);
    }
}


<?php

namespace App\Http\Controllers\Communication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WhatsappConversation;
use App\Models\WhatsappMessage;
use App\Models\WhatsappConfig;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Auth;

class WhatsappChatController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }

    public function index(){
        return view('whatsapp.chat');
    }

    public function conversations(Request $request){
        $q = $request->get('q');
        $query = WhatsappConversation::orderBy('last_message_at','DESC');
        if($q){
            $query->where(function($w) use ($q){
                $w->where('phone','like',"%$q%")->orWhere('display_name','like',"%$q%");
            });
        }
        return response()->json($query->get());
    }

    public function thread($id){
        $conv = WhatsappConversation::findOrFail($id);
        $messages = WhatsappMessage::where('conversation_id',$conv->id)->orderBy('sent_at','ASC')->get();
        $conv->unread_count = 0;
        $conv->save();
        return response()->json(['conversation'=>$conv,'messages'=>$messages]);
    }

    public function send(Request $request){
        $this->validate($request,[
            'conversation_id'=>'required|exists:whatsapp_conversations,id',
            'text'=>'required|string'
        ]);
        $conv = WhatsappConversation::findOrFail($request->conversation_id);
        $cfg = WhatsappConfig::where('is_active',true)->first();
        if (!$cfg) {
            return response()->json(['success'=>false,'errors'=>'No active WhatsApp configuration'],422);
        }
        $msg = WhatsappMessage::create([
            'conversation_id'=>$conv->id,
            'direction'=>'out',
            'type'=>'text',
            'text'=>$request->text,
            'status'=>'pending',
            'sent_by'=>Auth::id(),
            'sent_at'=>now()
        ]);
        $url = 'https://graph.facebook.com/v18.0/'.$cfg->phone_number_id.'/messages';
        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => $conv->phone,
            'type' => 'text',
            'text' => ['body' => $request->text]
        ];
        $resp = Http::withToken($cfg->access_token)->post($url,$payload);
        if($resp->successful()){
            $data = $resp->json();
            $msg->status = 'sent';
            $msg->wa_message_id = $data['messages'][0]['id'] ?? null;
            $msg->save();
            $conv->last_message_at = now();
            $conv->last_message_preview = mb_substr($request->text,0,50);
            $conv->save();
            return response()->json(['success'=>true,'message'=>'Message sent']);
        }else{
            $msg->status = 'failed';
            $msg->save();
            return response()->json(['success'=>false,'errors'=>'Failed to send message'],500);
        }
    }
}


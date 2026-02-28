<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WhatsappConfig;
use Auth;
use Illuminate\Support\Facades\DB;

class WhatsappConfigController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }

    public function index(){
        $configs = WhatsappConfig::orderBy('created_at','DESC')->get();
        return view('whatsapp.config',compact('configs'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'phone_number_id' =>'required|string|max:100|unique:whatsapp_configs,phone_number_id',
            'access_token'    =>'required|string',
            'verify_token'    =>'required|string|max:255',
        ]);
        $cfg = WhatsappConfig::create([
            'channel'         =>'WHATSAPP',
            'phone_number_id' =>$request->input('phone_number_id'),
            'access_token'    =>$request->input('access_token'),
            'verify_token'    =>$request->input('verify_token'),
            'created_by'      =>Auth::id(),
        ]);
        if ($cfg) {
            return response()->json(['success'=>true,'message'=>'WhatsApp configuration saved'],200);
        }
        return response()->json(['success'=>false,'errors'=>'Failed to save configuration'],500);
    }

    public function update(Request $request){
        $this->validate($request,[
            'config_id'       =>'required|exists:whatsapp_configs,id',
            'phone_number_id' =>'required|string|max:100|unique:whatsapp_configs,phone_number_id,'.$request->input('config_id'),
            'access_token'    =>'required|string',
            'verify_token'    =>'required|string|max:255',
        ]);
        $cfg = WhatsappConfig::findOrFail($request->input('config_id'));
        $cfg->phone_number_id = $request->input('phone_number_id');
        $cfg->access_token    = $request->input('access_token');
        $cfg->verify_token    = $request->input('verify_token');
        if ($cfg->save()) {
            return response()->json(['success'=>true,'message'=>'WhatsApp configuration updated'],200);
        }
        return response()->json(['success'=>false,'errors'=>'Failed to update configuration'],500);
    }

    public function activate(Request $request){
        $this->validate($request,[
            'config_id' =>'required|exists:whatsapp_configs,id',
        ]);
        DB::transaction(function() use ($request){
            WhatsappConfig::query()->update(['is_active'=>false]);
            WhatsappConfig::where('id',$request->input('config_id'))->update(['is_active'=>true]);
        });
        return response()->json(['success'=>true,'message'=>'WhatsApp configuration set as active'],200);
    }

    public function delete(Request $request){
        $this->validate($request,[
            'config_id' =>'required|exists:whatsapp_configs,id',
        ]);
        $cfg = WhatsappConfig::findOrFail($request->input('config_id'));
        if ($cfg->delete()) {
            return response()->json(['success'=>true,'message'=>'WhatsApp configuration deleted'],200);
        }
        return response()->json(['success'=>false,'errors'=>'Failed to delete configuration'],500);
    }
}


<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Auth;

class SettingController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }

    public function index(){
        if (!Auth::user()->hasRole(1)) {
            abort(403);
        }

        $settings = [
            'mail_mailer' => Setting::getValue('mail_mailer','smtp'),
            'mail_host' => Setting::getValue('mail_host',''),
            'mail_port' => Setting::getValue('mail_port',''),
            'mail_encryption' => Setting::getValue('mail_encryption','tls'),
            'mail_username' => Setting::getValue('mail_username',''),
            'mail_password' => Setting::getValue('mail_password',''),
            'mail_from_address' => Setting::getValue('mail_from_address',''),
            'mail_from_name' => Setting::getValue('mail_from_name',''),
            'sms_api_url' => Setting::getValue('sms_api_url',''),
            'sms_api_key' => Setting::getValue('sms_api_key',''),
            'sms_sender_id' => Setting::getValue('sms_sender_id',''),
            'app_language' => Setting::getValue('app_language','en'),
        ];

        return view('settings.index',compact('settings'));
    }

    public function save(Request $request){
        if (!Auth::user()->hasRole(1)) {
            abort(403);
        }

        $this->validate($request,[
            'mail_mailer' =>'nullable|string',
            'mail_host' =>'nullable|string',
            'mail_port' =>'nullable|string',
            'mail_encryption' =>'nullable|string',
            'mail_username' =>'nullable|string',
            'mail_password' =>'nullable|string',
            'mail_from_address' =>'nullable|email',
            'mail_from_name' =>'nullable|string',
            'sms_api_url' =>'nullable|string',
            'sms_api_key' =>'nullable|string',
            'sms_sender_id' =>'nullable|string',
            'app_language' =>'required|in:en,sw',
        ]);

        $data = $request->only([
            'mail_mailer',
            'mail_host',
            'mail_port',
            'mail_encryption',
            'mail_username',
            'mail_password',
            'mail_from_address',
            'mail_from_name',
            'sms_api_url',
            'sms_api_key',
            'sms_sender_id',
            'app_language',
        ]);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('settings.index')->with('status','Settings saved successfully');
    }
}

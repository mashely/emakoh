<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chw;
use Auth;

class ChwController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }

    public function list(){
        $chws = Chw::orderBy('created_at','DESC')->get();
        return view('chw.list',compact('chws'));
    }

    public function create(Request $request){
        $this->validate($request,[
            'full_name'   =>'required|string|max:255',
            'phone_number'=>'required|string|max:20|unique:chws,phone_number',
        ]);
        $chw = Chw::create([
            'full_name'    =>$request->input('full_name'),
            'phone_number' =>$request->input('phone_number'),
            'created_by'   =>Auth::id(),
        ]);
        if ($chw) {
            return response()->json(['success'=>true,'message'=>'CHW created successfully'],200);
        }
        return response()->json(['success'=>false,'errors'=>'Failed to create CHW'],500);
    }

    public function update(Request $request){
        $this->validate($request,[
            'chw_id'      =>'required|exists:chws,id',
            'full_name'   =>'required|string|max:255',
            'phone_number'=>'required|string|max:20|unique:chws,phone_number,'.$request->input('chw_id'),
        ]);
        $chw = Chw::findOrFail($request->input('chw_id'));
        $chw->full_name = $request->input('full_name');
        $chw->phone_number = $request->input('phone_number');
        if ($chw->save()) {
            return response()->json(['success'=>true,'message'=>'CHW updated successfully'],200);
        }
        return response()->json(['success'=>false,'errors'=>'Failed to update CHW'],500);
    }

    public function delete(Request $request){
        $this->validate($request,[
            'chw_id'=>'required|exists:chws,id',
        ]);
        $chw = Chw::findOrFail($request->input('chw_id'));
        if ($chw->delete()) {
            return response()->json(['success'=>true,'message'=>'CHW deleted successfully'],200);
        }
        return response()->json(['success'=>false,'errors'=>'Failed to delete CHW'],500);
    }
}


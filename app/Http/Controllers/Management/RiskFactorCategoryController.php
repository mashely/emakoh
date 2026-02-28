<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskFactorCategory;
use Auth;

class RiskFactorCategoryController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }

    public function list(){
        $categories = RiskFactorCategory::orderBy('created_at','DESC')->get();
        return view('risk_categories.list',compact('categories'));
    }

    public function create(Request $request){
        $this->validate($request,[
            'name'        =>'required|string|max:255|unique:risk_factor_categories,name',
            'description' =>'nullable|string',
        ]);
        $cat = RiskFactorCategory::create([
            'name'        =>$request->input('name'),
            'description' =>$request->input('description'),
            'created_by'  =>Auth::id(),
        ]);
        if ($cat) {
            return response()->json(['success'=>true,'message'=>'Category created successfully'],200);
        }
        return response()->json(['success'=>false,'errors'=>'Failed to create category'],500);
    }

    public function update(Request $request){
        $this->validate($request,[
            'category_id' =>'required|exists:risk_factor_categories,id',
            'name'        =>'required|string|max:255|unique:risk_factor_categories,name,'.$request->input('category_id'),
            'description' =>'nullable|string',
        ]);
        $cat = RiskFactorCategory::findOrFail($request->input('category_id'));
        $cat->name = $request->input('name');
        $cat->description = $request->input('description');
        if ($cat->save()) {
            return response()->json(['success'=>true,'message'=>'Category updated successfully'],200);
        }
        return response()->json(['success'=>false,'errors'=>'Failed to update category'],500);
    }

    public function delete(Request $request){
        $this->validate($request,[
            'category_id' =>'required|exists:risk_factor_categories,id',
        ]);
        $cat = RiskFactorCategory::findOrFail($request->input('category_id'));
        if ($cat->delete()) {
            return response()->json(['success'=>true,'message'=>'Category deleted successfully'],200);
        }
        return response()->json(['success'=>false,'errors'=>'Failed to delete category'],500);
    }
}


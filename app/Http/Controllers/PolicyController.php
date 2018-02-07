<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policy;
class PolicyController extends Controller
{
    public function index(){
        $policy = Policy::all();
        return view('backend.pages.policy.index',compact('policy'));
    }

    public function update(Request $request,$id){
        $policy = Policy::findOrFail($id)->first();
        $policy->service_charges = $request->service_charges;
        $policy->menu_price = $request->menu_price;
        $policy->update();
        return redirect('/policy-pricing')->with('message','Successfuly update the Policy');

    }
}

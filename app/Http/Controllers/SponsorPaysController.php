<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SponsorPay;

class SponsorPaysController extends Controller
{

    public function show($id_pay){
    	if(\Shinobi::can('sponsor.pay.show')){
    		$pay = SponsorPay::find($id_pay);
    		if($pay != null){
    			return view('klorofil.sponsors.pay-show')->with('pay',$pay);
    		}
    	}
  		abort(404);
    }
    
    public function active($id_pay){
    	if(\Shinobi::can('sponsor.pay.active')){
    		$pay = SponsorPay::find($id_pay);
    		if($pay != null){
    			return view('klorofil.sponsors.pay-active')->with('pay',$pay);
    		}
    	}
  		abort(404);
    }
    
    public function saveActive(Request $request, $id_pay){
    	if(\Shinobi::can('sponsor.pay.active')){
    		$pay = SponsorPay::find($id_pay);
    		if($pay != null){
    			$pay->update($request->all());
    			$pay->update(['status'=>'active']);
    			return redirect()->route('sponsor-pays.show',['pID'=>$pay->id]);
    		}
    	}
  		abort(404);
    }
    
    public function cancel($id_pay){
    	if(\Shinobi::can('sponsor.admin.pay.cancel')){
    		$pay = SponsorPay::find($id_pay);
    		if($pay != null){
    			$pay->update(['status'=>'canceled']);
    			return redirect()->back();
    		}
    	}
  		abort(404);
    }

}

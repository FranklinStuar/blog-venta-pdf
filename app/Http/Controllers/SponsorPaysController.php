<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SponsorPay;

class SponsorPaysController extends Controller
{

    public function create($sponsor_id, $user_id){
        $sponsor = \App\Sponsor::find($sponsor_id);
        $user = \App\User::find($user_id);
        if($sponsor != null && $user != null){
            $premiums = \DB::table('sponsor_prices')
                ->select(\DB::raw('CONCAT("$ ",price_month," - ",prints," impresiones") as name'), 'id')
                ->get();
            return view('klorofil.sponsors.pay-create')
            ->with('sponsor',$sponsor)
            ->with('premiums', array_pluck($premiums,'name','id'))
            ->with('user',$user);
        }
    }
    
    public function store(Request $request){
        // dd(\Carbon\Carbon::now());
        // dd($request->finish_date);
        list($dia, $mes, $anio) = explode("/", $request->finish_date);
        $pay = \App\SponsorPay::create([
            'price_month' => $request->price_month,
            'author_id' => $request->uID,
            'sponsor_price_id' => $request->sponsor_price_id,
            'sponsor_id' => $request->sID,
            'method_payment' => $request->method_payment,
            'created_at' => \Carbon\Carbon::now(),
            'prints' => $request->prints,
            'finish_date' => \Carbon\Carbon::create($anio, $mes, $dia),
        ]);

        $request->session()->flash('success', 'Se realizó nuevo pago');
        return redirect()->route('sponsors.show',['sID'=>$request->sID]);
        
        abort(404);
    }
    
    public function show($id_pay){
		$pay = SponsorPay::find($id_pay);
		if($pay != null){
			return view('klorofil.sponsors.pay-show')->with('pay',$pay);
		}
    }
    
    public function active($id_pay){
		$pay = SponsorPay::find($id_pay);
		if($pay != null){
			return view('klorofil.sponsors.pay-active')->with('pay',$pay);
		}
    }
    
    public function saveActive(Request $request, $id_pay){
		$pay = SponsorPay::find($id_pay);
		if($pay != null){
			$pay->update($request->all());
			$pay->update(['status'=>'active']);
			return redirect()->route('sponsor-pays.show',['pID'=>$pay->id]);
		}
    }
    
    public function cancel($id_pay){
		$pay = SponsorPay::find($id_pay);
		if($pay != null){
			$pay->update(['status'=>'canceled']);
			return redirect()->back();
		}
    }

}

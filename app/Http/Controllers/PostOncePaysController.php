<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\PostOncePay;
use \App\PostOncePrice;
use \Carbon\Carbon;
class PostOncePaysController extends Controller
{
    
	public function __construct(){
		Carbon::setLocale('es');
	}
	
	public function index(Request $request)
	{
		return view('klorofil.once-pay-post.index')
			->with('pays', PostOncePay::all());
	}

	public function create()
	{
		return view('klorofil.once-pay-post.create')
			->with('posts', \App\Post::allPluck())
			->with('users', \App\User::usersList())
			->with('pay', new PostOncePay);
	}

	public function store(Request $request){

		$this->validate($request, [
			'user_id' 				=> 'required',
			'post_id'		 		=> 'required',
			'finish' 				=> 'required',
			'price' 				=> 'required',
			'post_once_price_id' 	=> 'required',
			'method_payment' 		=> 'required',
		]);
		if($request->method_payment == "deposit"){
			$this->validate($request, [
				'bank_deposit' 		=> 'required',
				'account_deposit'	=> 'required',
				'number_deposit' 	=> 'required',
			]);
		}
      	list($dia, $mes, $anio) = explode("/", $request->finish);


		$pay = PostOncePay::create([
			'user_id'				=> $request->user_id,
			'post_id'				=> $request->post_id,
			'finish'				=> \Carbon\Carbon::create($anio, $mes, $dia),
			'price'					=> $request->price,
			'post_once_price_id'	=> $request->post_once_price_id,
			'method_payment'		=> $request->method_payment,
		]);
		if($request->method_payment == "deposit"){
			$deposit = \App\PaymentDeposit::create([
				'bank'				=> $request->bank_deposit,
				'account'			=> $request->account_deposit,
				'number_deposit'	=> $request->number_deposit,
				'user_id'			=> $request->user_id,
			]);
			$pay->update(['payment_deposit_id'=>$deposit->id]);
		}
		$request->session()->flash('success', 'Pago realizado correctamente');
		return redirect()->route('only-pay-post.index');
	}

	public function edit($id){
		return view('klorofil.once-pay-post.edit')
			->with('posts', \App\Post::allPluck())
			->with('users', \App\User::usersList())
			->with('pay', PostOncePay::find($id));
	}

	public function update(Request $request,$id){

		$this->validate($request, [
			'user_id' 				=> 'required',
			'post_id'		 		=> 'required',
			'finish' 				=> 'required',
			'price' 				=> 'required',
			'post_once_price_id' 	=> 'required',
		]);

		if($request->method_payment == "deposit"){
			$this->validate($request, [
				'bank_deposit' 		=> 'required',
				'account_deposit'	=> 'required',
				'number_deposit' 	=> 'required',
			]);
		}
      	list($dia, $mes, $anio) = explode("/", $request->finish);


		$pay = PostOncePay::find($id);
		
		if($request->method_payment == "deposit" && $pay->method_payment == "deposit"){
			\App\PaymentDeposit::find($pay->payment_deposit_id)->update([
				'bank'				=> $request->bank_deposit,
				'account'			=> $request->account_deposit,
				'number_deposit'	=> $request->number_deposit,
				'user_id'			=> $request->user_id,
			]);
		}else if($request->method_payment != "deposit" && $pay->method_payment == "deposit"){
				\App\PaymentDeposit::destroy($pay->payment_deposit_id);
				$pay->update(['payment_deposit_id'=>null]);
			
		}else if($request->method_payment == "deposit" && $pay->method_payment != "deposit"){
			$deposit = \App\PaymentDeposit::create([
				'bank'				=> $request->bank_deposit,
				'account'			=> $request->account_deposit,
				'number_deposit'	=> $request->number_deposit,
				'user_id'			=> $request->user_id,
			]);
			$pay->update(['payment_deposit_id'=>$deposit->id]);
		}
		$pay->update([
			'user_id'				=> $request->user_id,
			'post_id'				=> $request->post_id,
			'finish'				=> \Carbon\Carbon::create($anio, $mes, $dia),
			'price'					=> $request->price,
			'post_once_price_id'	=> $request->post_once_price_id,
			'method_payment'		=> ($request->method_payment)?$request->method_payment:$pay->method_payment,
			'status'		=> $request->status,
		]);
		$request->session()->flash('success', 'Pago realizado correctamente');
		return redirect()->route('only-pay-post.index');
	}

	public function show($id){
		return view('klorofil.once-pay-post.show')
			->with('pay', PostOncePay::find($id));
	}

	public function destroy(Request $request,$id){
		PostOncePay::find($id)->update(['status'=>'cancel']);
		$request->session()->flash('success', 'Pago cancelado correctamente');
		return redirect()->back();
	}

	public function getShow($pay_id){
		$pay = PostOncePay::find($pay_id);
		$finish = new Carbon($pay->finish);
		$finish = $finish->format('d/m/Y');
		if($pay->method_payment == "deposit"){
			return response()->json([
				'user_id'				=> $pay->user_id,
				'post_id'				=> $pay->post_id,
				'finish'				=> $finish,
				'price'					=> $pay->price,
				'post_once_price_id'	=> $pay->post_once_price_id,
				'method_payment'		=> $pay->method_payment,
				'bank_deposit'			=> $pay->deposit->bank,
				'account_deposit'		=> $pay->deposit->account,
				'number_deposit'		=> $pay->deposit->number_deposit,
			]);
		}
		return response()->json([
			'user_id'				=> $pay->user_id,
			'post_id'				=> $pay->post_id,
			'finish'				=> $finish,
			'price'					=> $pay->price,
			'post_once_price_id'	=> $pay->post_once_price_id,
			'method_payment'		=> $pay->method_payment,
		]);
	}
}

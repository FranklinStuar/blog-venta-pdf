<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\PostPay;

class PostPaysController extends Controller
{
   
	public function __construct(){
		Carbon::setLocale('es');
	}
	
	public function index(Request $request)
	{
		return view('klorofil.pay-post.list-pay')->with('pays', PostPay::paginate(10));
	}

	
	public function create(Request $request)
	{
		$pay = new PostPay;
		if ($request->has('uID')) 
			$pay->user_id = $request->uID;
		return view('klorofil.pay-post.new-pay')
			->with('pay', $pay)
			// ->with('user_id', ($request->has('uID'))?$request->uID:null)
			->with('users', \App\User::usersList())
			->with('roles', \App\Role::rolesList())
			->with('postPrices', array_pluck(\App\PostPrice::all(),'name','id'))
			;
	}

	public function store(Request $request)
	{
      	list($dia, $mes, $anio) = explode("/", $request->finish);

		PostPay::create([
			'method_payment' => $request->method_payment,
			'price' => $request->price,
			'user_id' => $request->user_id,
			'post_price_id' => $request->post_price_id,
			'finish' => \Carbon\Carbon::create($anio, $mes, $dia),
			'created_at' => \Carbon\Carbon::now(),

		]);
      	$request->session()->flash('success', 'Nuevo pago realizado correctamente');
			return redirect()->route('pay-post.index');
	}


	
	public function show($id)
	{
		return view('klorofil.pay-post.show')
			->with('pay', PostPay::find($id))
			;
	}

	public function edit(Request $request, $id)
	{
		return view('klorofil.pay-post.edit-pay')
			->with('pay', PostPay::find($id))
			->with('users', \App\User::usersList())
			->with('roles', \App\Role::rolesList())
			->with('postPrices', array_pluck(\App\PostPrice::all(),'name','id'))
			;
	}

	public function update(Request $request, $id)
	{
  		list($dia, $mes, $anio) = explode("/", $request->finish);

		PostPay::find($id)->update([
			'method_payment' => $request->method_payment,
			'price' => $request->price,
			'user_id' => $request->user_id,
			'post_price_id' => $request->post_price_id,
			'finish' => \Carbon\Carbon::create($anio, $mes, $dia),
			'created_at' => \Carbon\Carbon::now(),
			'status' => $request->status,
			'observations' => ($request->status == 'cancel')?'Cancelado desde el administrador':'Activado desde el administrador',
		]);
      	$request->session()->flash('success', 'Pago editado correctamente');
			return redirect()->route('pay-post.index');
	}


	public function destroy(Request $request, $id)
	{
		PostPay::find($id)->update([ 
			'status' => 'cancel', 
			'observations' => 'Cancelado desde el administrador',
		]);
      	$request->session()->flash('success', 'Pago Cancelado correctamente');
		return redirect()->route('pay-post.index');
	}




}

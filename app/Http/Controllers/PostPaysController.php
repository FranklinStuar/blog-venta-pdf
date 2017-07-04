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
		if (\Shinobi::can('post.admin.pay.list')) {
			return view('klorofil.pay-post.list-pay')->with('pays', PostPay::all());
		}else
			abort(404);
	}

	
	public function create(Request $request)
	{
		if (\Shinobi::can('post.admin.pay.new')) {
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
		}else
			abort(404);
	}

	public function store(Request $request)
	{
		if (\Shinobi::can('post.admin.pay.new')) {
      	list($dia, $mes, $anio) = explode("/", $request->finish);

			PostPay::create([
				'method_payment' => $request->method_payment,
				'price' => $request->price,
				'user_id' => $request->user_id,
				'role_id' => $request->role_id,
				'post_price_id' => $request->post_price_id,
				'finish' => \Carbon\Carbon::create($anio, $mes, $dia),
				'created_at' => \Carbon\Carbon::now(),

			]);
      $request->session()->flash('success', 'Nuevo pago realizado correctamente');
			return redirect()->route('pay-post.index');
		}else
			abort(404);
	}


	
	public function show($id)
	{
		if (\Shinobi::can('post.admin.pay.show')) {
			return view('klorofil.pay-post.show')
				->with('pay', PostPay::find($id))
				;
		}else
			abort(404);
	}

	public function edit(Request $request, $id)
	{
		if (\Shinobi::can('post.admin.pay.edit')) {
			return view('klorofil.pay-post.edit-pay')
				->with('pay', PostPay::find($id))
				->with('users', \App\User::usersList())
				->with('roles', \App\Role::rolesList())
				->with('postPrices', array_pluck(\App\PostPrice::all(),'name','id'))
				;
		}else
			abort(404);
	}

	public function update(Request $request, $id)
	{
		if (\Shinobi::can('post.admin.pay.edit')) {
      list($dia, $mes, $anio) = explode("/", $request->finish);

			PostPay::find($id)->update([
				'method_payment' => $request->method_payment,
				'price' => $request->price,
				'user_id' => $request->user_id,
				'role_id' => $request->role_id,
				'post_price_id' => $request->post_price_id,
				'finish' => \Carbon\Carbon::create($anio, $mes, $dia),
				'created_at' => \Carbon\Carbon::now(),
				'status' => $request->status,
				'observations' => ($request->status == 'cancel')?'Cancelado desde el administrador':'Activado desde el administrador',

			]);
      $request->session()->flash('success', 'Pago editado correctamente');
			return redirect()->route('pay-post.index');
		}else
			abort(404);
	}


	public function destroy(Request $request, $id)
	{
		if (\Shinobi::can('post.admin.pay.cancel')) {
			PostPay::find($id)->update([ 
				'status' => 'cancel', 
				'observations' => 'Cancelado desde el administrador',
			]);
      $request->session()->flash('success', 'Pago Cancelado correctamente');
			return redirect()->route('pay-post.index');
		}else
			abort(404);
	}




}

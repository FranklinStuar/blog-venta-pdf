<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\SponsorPrice;
use \App\SponsorPriceDetail;

class PremiumSponsorsController extends Controller
{
	
	public function index()
	{
		if (\Shinobi::can('sponsor.price.list')) {
			return view('klorofil.premium-sponsor.index')->with('premiums', SponsorPrice::all());
		}else
			abort(404);
	}

	public function create()
	{
		if (\Shinobi::can('sponsor.price.new')) {
			return view('klorofil.premium-sponsor.create',[
				'premium'=> new SponsorPrice,
			]);
		}else
			abort(404);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
				// 'prints','price_month','months','featured',
			'prints' => 'required|min:0.001|numeric',
			'price_month' => 'required|min:1|numeric',
			'months' => 'required|integer|min:1',
		]);

		$sponsor = SponsorPrice::create([
		  'prints' => $request->prints,
		  'price_month' => $request->price_month,
		  'months' => $request->months,
		]);
		$request->session()->flash('success', 'Precio guardado correctamente');
		return redirect()->route('premium-sponsor.edit',['pID'=>$sponsor->id]);
	}


	public function edit($id)
	{
		if (\Shinobi::can('sponsor.price.edit')) {
			return view('klorofil.premium-sponsor.edit',[
				'premium'=> SponsorPrice::find($id),
			]);
		}else
			abort(404);
	}


	public function update(Request $request,$id)
	{
		$this->validate($request, [
				// 'prints','price_month','months','featured',
			'prints' => 'required|min:0.001|numeric',
			'price_month' => 'required|min:1|numeric',
			'months' => 'required|integer|min:1',
		]);

		SponsorPrice::find($id)->update($request->all());
		$request->session()->flash('success', 'Premium editado correctamente');
		return redirect()->back();
	}

	public function destroy(Request $request, $id)
	{
		if (\Shinobi::can('sponsor.price.destroy')) {
			if(SponsorPrice::destroy($id))
				$request->session()->flash('success', 'Premium  eliminado correctamente');
			else
				$request->session()->flash('errors', 'Premium No se pudo eliminar');
			return redirect()->back();
		}else
			abort(404);
	}

	public function addFeature(Request $request){
		if (\Shinobi::can('sponsor.price.edit')) {
			$premiums = SponsorPrice::where('featured',true)->get();
			foreach ($premiums as $premium) 
				$premium->update(['featured'=>false]);
			if(SponsorPrice::find($request->pID)->update(['featured'=>true]))
		  $request->session()->flash('success', 'Se destacó premium');
		return redirect()->back();
	  }
		  
	  $request->session()->flash('errors', 'No se puedo detacar premium');
	  return redirect()->back();

	}

	public function addCategory(Request $request, $premium_id){
		$this->validate($request, [
		'title' => 'required|string|max:255',
		'excerpt' => 'required|string|max:255',
	  ]);
		$premium = SponsorPrice::find($premium_id);
		if($premium != null){
			SponsorPriceDetail::create([
			  'title' => $request->title,
			  'excerpt' => $request->excerpt,
			  'sponsor_price_id' => $premium_id,
			]);
			$request->session()->flash('success', 'Agregado detalle al premium');
			return redirect()->back();
		}else{
			$request->session()->flash('errors', 'No existe el premiun designado');
		return redirect()->route('premium-sponsor.index');
		}
	}


	public function quitCategory(Request $request, $id)
	{
		if (\Shinobi::can('sponsor.detail.destroy')) {
			$detail = SponsorPriceDetail::find($id);
			if($detail){
				$name = $detail->title;
				if($detail->delete())
					$request->session()->flash('success', 'Detalle "'.$name.'" eliminado correctamente');
				else
					$request->session()->flash('errors', 'Detalle "'.$name.'" No se pudo eliminar');
					return redirect()->back();
			}else{
					$request->session()->flash('success', 'No existe detalle');
					return redirect()->back();
			}
		}else
			abort(404);
	}

}

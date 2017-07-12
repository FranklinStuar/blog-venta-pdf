<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\SponsorPrice;
use \App\Sponsor;
use \App\User;

class SponsorsController extends Controller
{
	public function index(){
		if (\Shinobi::can('sponsor.admin.list')) {
			return view('klorofil.sponsors.index')->with('sponsors', Sponsor::all());
		}
		abort(404);

	}
	
	public function create(Request $request){
		if (\Shinobi::can('sponsor.admin.add')) {
			$sponsor = new Sponsor;
			if ($request->has('uID')) 
				$sponsor->user_id = $request->uID;
			return view('klorofil.sponsors.create')
			->with('users', User::usersList())
			->with('sponsor', $sponsor);
		}
		abort(404);
	}

	public function store(Request $request){
		if (\Shinobi::can('sponsor.admin.add')) {
			$this->validate($request, [
				'name' => 'required|max:50',
				'excerpt' => 'required|max:80',
				'web' => 'required|max:150',
			]);
			Sponsor::create($request->all());
			$request->session()->flash('success', 'Publicidad: "'.$request->name .'" guardado con éxito');
			return redirect()->route('sponsors.index');
		}
		abort(404);
	}

	public function edit($id){
		if (\Shinobi::can('sponsor.admin.edit')) {
			return view('klorofil.sponsors.edit')
			->with('users', User::usersList())
			->with('sponsor', Sponsor::find($id));
		}
		abort(404);

	}

	public function update(Request $request, $id){
		if (\Shinobi::can('sponsor.admin.add')) {
			$this->validate($request, [
				'name' => 'required|max:50',
				'excerpt' => 'required|max:80',
				'web' => 'required|max:150',
			]);
			Sponsor::find($id)->update($request->all());
			$request->session()->flash('success', 'Publicidad: "'.$request->name .'" editado con éxito');
			return redirect()->route('sponsors.index');
		}
		abort(404);
	}

	public function show($id){
		if (\Shinobi::can('sponsor.admin.edit')) {
			$sponsor = Sponsor::find($id);
			if($sponsor != null){
				return view('klorofil.sponsors.show')
				->with('sponsor', $sponsor);
			}
		}
		abort(404);
	}

	public function destroy(Request $request, $id){
		if (\Shinobi::can('sponsor.admin.destroy')) {
			$sponsor = Sponsor::find($id);
			if($sponsor != null){
				if(count($sponsor->pays) > 0){
					$request->session()->flash('success', 'Tiene pagos realizados, se han cancelado todos los pagos y ya no están accesible para el usuario');
					$sponsor->cancel();
				}else{
					$sponsor->delete();
					$request->session()->flash('success', 'Sponsor eliminado de la lista');
				}
				return redirect()->back();
			}
		}
		abort(404);
	}


	public function historial($id){
		if (\Shinobi::can('sponsor.admin.historial')) {
			$sponsor = Sponsor::find($id);
			if($sponsor != null){
				return view('klorofil.sponsors.historial')
				->with('sponsor', $sponsor);
			}
		}
		abort(404);

	}


	/**************** Esta parte es para todos las vistas que no son de administración *****************/


	public function listUser(Request $request){
		if (\Shinobi::can('sponsor.price.list')) {
			if($request->has('sp')){
				$sponsor = Sponsor::find($request->sp);
				if($sponsor != null && \Auth::user()->id == $sponsor->user_id){
					return view('corporate.list-sponsor')
						->with('sponsor', $sponsor)
							->with('premiums',SponsorPrice::all());
				}		    			
				else
					abort(404);
			}
			return view('corporate.list-sponsor')
				->with('premiums',SponsorPrice::all());
		}
		abort(404);
	}

	public function payment(Request $request){
		$premium = SponsorPrice::find(explode("x", $request->sprice)[0]);
		$sponsor = Sponsor::find($request->sp);
		if ($premium != null && $sponsor != null && \Auth::user()->id == $sponsor->user_id){
			return view('corporate.type-payment-sponsor',[
				'sponsor' => $sponsor, 
				'sponsor_premium' => $premium
				]);
		}
		else
		abort(404);
	}

	public function createSponsor(Request $request){
		$premium = SponsorPrice::find(explode("x", $request->sprice)[0]);
		if (\Shinobi::can('sponsor.add') && $premium != null) {
			return view('corporate.sponsors.create')
				->with('premium',$premium)
				->with('sponsor', new Sponsor)
				;
			}
		abort(404);
	}
	public function sponsorSave(Request $request){
		if (\Shinobi::can('sponsor.add')) {
			$this->validate($request, [
				'name' => 'required|max:255',
				'excerpt' => 'required|max:80',
				'web' => 'required|max:150',
			]);
			$sponsor = Sponsor::create([
				'name' => $request->name,
				'excerpt' => $request->excerpt,
				'web' => $request->web,
				'finish' => \Carbon\Carbon::now(),
				'user_id' => \Auth::user()->id,
				'phone' => $request->phone,
				'address' => $request->address,
				'url_facebook' => $request->url_facebook,
				'url_twitter' => $request->url_twitter,
				'url_instagram' => $request->url_instagram,
				'url_youtube' => $request->url_youtube,
			]);
			return redirect()->route('sponsor.payment',['sprice'=>$request->sprice,'sp'=>$sponsor->id]);
			
			}
		abort(404);
	}

	// 'price_month','author_id','sponsor_price_id','sponsor_id','method_payment','created_at',
	
	public function makePaymentCard(Request $request){
		$premium = SponsorPrice::find(explode("x", $request->sprice)[0]);
		$sponsor = Sponsor::find($request->sp);
		if ($premium != null && $sponsor != null && \Auth::user()->id == $sponsor->user_id){    	
			$payment = \App\SponsorPay::create([
				'price_month' => $premium->price_month,
				'prints' => $premium->prints,
				'author_id' => \Auth::user()->id,
				'sponsor_price_id' => $premium->id,
				'sponsor_id' => $sponsor->id,
				'method_payment' => 'card',
				'created_at' => \Carbon\Carbon::now(),
				'finish_date' => \Carbon\Carbon::now()->addMonths($premium->months),
			]);
			$request->session()->flash('success', 'Pago a la publicidad: '. $sponsor->name .". Realizado con éxito");
			return view('corporate.profile');
		}else{
			abort(404);
		}
	}
	public function paymentPaypal($sponsor_id, $sponsor_price_id){
		$price = SponsorPrice::find($sponsor_price_id);
		$sponsor = Sponsor::find($sponsor_id);
		$paypal = new \App\PayPalSponsor($price, $sponsor);
		$payment = $paypal->generate();
		return redirect($payment->getApprovalLink());
	}

	public function makePaymentPaypal(Request $request){ //complete payment
		$premium = SponsorPrice::find($request->spId);
		$sponsor = Sponsor::find($request->sId);

		$paypal = new \App\PayPalSponsor($premium, $sponsor);
		$response = $paypal->execute($request->paymentId,$request->PayerID);
		if($response->state == 'approved'){
			$orderData = $response->payer->payer_info->shipping_address->toArray();
			$orderData['email'] = $response->payer->payer_info->email;
			$orderData['total'] = $premium->price_month;
			$orderData['user_id'] = \Auth::user()->id;
			$payment_paypal = \App\PaymentPaypal::create($orderData);

			$payment = \App\SponsorPay::create([
				'price_month'				=> $premium->price_month,
				'prints'						=> $premium->prints,
				'author_id'					=> \Auth::user()->id,
				'sponsor_price_id'	=> $premium->id,
				'sponsor_id'				=> $sponsor->id,
				'method_payment'		=> 'paypal',
				'created_at'				=> \Carbon\Carbon::now(),
				'finish_date'				=> \Carbon\Carbon::now()->addMonths($premium->months),
				'payment_paypal_id'	=> $payment_paypal->id,
			]);

			$data = array('sponsor' => $sponsor,'premium'=>$premium);
			$system = \App\System::first();
			\Mail::send('emails.payments.sponsor', $data, function ($message) use($system,$sponsor) {
				$message->from($system->email, $sponsor->name);
				$message->to(\Auth::user()->email)->subject('Pago realizado en Neurocodigo');
			});

			$request->session()->flash('success', 'Pago a la publicidad: '. $sponsor->name .". Realizado con éxito");
			return view('corporate.profile');
		}else{
			$request->session()->flash('success', 'Pago rechazado, Por favor revise que tenga el monto necesario para realizar el pago');
			return view('corporate.profile');
		}
	}

	public function editSponsorUser($id_sponsor){
		$sponsor = Sponsor::find($id_sponsor);	
		if($sponsor != null && \Auth::user()->id == $sponsor->user_id){
			return view('corporate.sponsors.edit')
				->with('sponsor',$sponsor);
		}else
		abort(404);
	}

	public function showSponsor($id_sponsor){
		$sponsor = Sponsor::find($id_sponsor);	
		if($sponsor != null && \Auth::user()->id == $sponsor->user_id){
			return view('corporate.sponsors.show')
				->with('sponsor',$sponsor);
		}else
		abort(404);
	}

	public function saveEdit(Request $request, $id_sponsor){
		$sponsor = Sponsor::find($id_sponsor);  
		if($sponsor != null){
			$sponsor->update($request->all());
				$request->session()->flash('success', 'Publicidad "'.$request->name.'" editado correctamente');
			return redirect()->route('sponsor.show-user',['sID'=>$sponsor->id]);
		}
		abort(404);
	}

	public function cancelPaySponsor(Request $request, $id_sponsor,$id_pay_sponsor){
		$sponsor = Sponsor::find($id_sponsor);	
		$pay = \App\SponsorPay::find($id_pay_sponsor);
		if($sponsor && $pay && $sponsor->user_id == \Auth::user()->id){
			$pay->update(['status' => 'canceled']);
			$request->session()->flash('success', 'Publicidad cancelada');
			return redirect()->back();
		}
		abort(404);
		
	}

}

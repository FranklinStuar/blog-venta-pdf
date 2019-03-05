<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\SponsorPrice;
use \App\Sponsor;
use \App\User;

class SponsorsController extends Controller
{
	public function index(){
		return view('klorofil.sponsors.index')->with('sponsors', Sponsor::all());

	}
	
	public function create(Request $request){
		$sponsor = new Sponsor;
		if ($request->has('uID')) 
			$sponsor->user_id = $request->uID;
		return view('klorofil.sponsors.create')
		->with('users', User::usersList())
		->with('sponsor', $sponsor);
	}

	public function store(Request $request){
		$this->validate($request, [
			'name' => 'required|max:50',
			'excerpt' => 'required|max:80',
			'image' => 'required',
		]);
		if($request->has('phone')){
			$this->validate($request, [
				'phone' => 'max:20',
			]);
		}
		$sponsor = Sponsor::create($request->all());

		// Nombre de como se va a guardar 
		$file_name = str_slug(\Carbon\Carbon::now());

		//indicamos que queremos guardar un nuevo archivo en el disco local
		\Storage::disk('local')->put('public/users/sponsor/'.$file_name.'.'.$request->image->getClientOriginalExtension(),  \File::get($request->image));
		
		$sponsor->update([
			'image'=> 'users/sponsor/'.$file_name.'.'.$request->image->getClientOriginalExtension(),
		]);
		$request->session()->flash('success', 'Publicidad: "'.$request->name .'" guardado con éxito');
		return redirect()->route('sponsors.index');
	}

	public function edit($id){
		return view('klorofil.sponsors.edit')
		->with('users', User::usersList())
		->with('sponsor', Sponsor::find($id));

	}

	public function update(Request $request, $id){
		$this->validate($request, [
			'name' => 'required|max:50',
			'excerpt' => 'required|max:80',
		]);

		if($request->has('phone')){
			$this->validate($request, [
				'phone' => 'max:20',
			]);
		}
		$sponsor = Sponsor::find($id);
		
		if($request->hasFile('image')){
			// Nombre de como se va a guardar 
			$file_name = str_slug(\Carbon\Carbon::now());

			//indicamos que queremos guardar un nuevo archivo en el disco local
			\Storage::disk('local')->put('public/users/sponsor/'.$file_name.'.'.$request->image->getClientOriginalExtension(),  \File::get($request->image));
		
			$sponsor->update([
				'image'=> 'users/sponsor/'.$file_name.'.'.$request->image->getClientOriginalExtension(),
			]);
		}
		$sponsor->update($request->except(['image']));
		$request->session()->flash('success', 'Publicidad: "'.$request->name .'" editado con éxito');
		return redirect()->route('sponsors.index');
	}

	public function show($id){
		$sponsor = Sponsor::find($id);
		if($sponsor != null){
			return view('klorofil.sponsors.show')
			->with('sponsor', $sponsor);
		}
	}

	public function destroy(Request $request, $id){
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


	public function historial($id){
		$sponsor = Sponsor::find($id);
		if($sponsor != null){
			return view('klorofil.sponsors.historial')
			->with('sponsor', $sponsor);
		}
	}


	/**************** Esta parte es para todos las vistas que no son de administración *****************/


	public function listUser(Request $request){
		if($request->has('sp')){
			$sponsor = Sponsor::find($request->sp);
			if($sponsor != null && \Auth::user()->id == $sponsor->user_id){
				return view('flat.sponsors.list-sponsor')
					->with('sponsor', $sponsor)
						->with('premiums',SponsorPrice::all());
			}		    			
			else
				abort(404);
		}
		return view('flat.sponsors.list-sponsor')
			->with('premiums',SponsorPrice::all());
	}

	public function payment(Request $request){
		$premium = SponsorPrice::find(explode("x", $request->sprice)[0]);
		$sponsor = Sponsor::find($request->sp);

		if ($premium != null && $sponsor != null && \Auth::user()->id == $sponsor->user_id){
				return view('flat.sponsors.type-payment-sponsor',[
					'sponsor' => $sponsor, 
					'sponsor_premium' => $premium
				]);

		}
		abort(404);
	}

	public function paymentCard(Request $request){
		$premium = SponsorPrice::find(explode("x", $request->sprice)[0]);
		$sponsor = Sponsor::find($request->sp);

		if ($premium != null && $sponsor != null && \Auth::user()->id == $sponsor->user_id){
				
			return view('flat.payment.sponsor-card')
			->with('sponsor',$sponsor)
			->with('price_id',$premium->id)
			->with('price',$premium->price_month);

		}
		abort(404);
	}

	public function createSponsor(Request $request){
		$premium = SponsorPrice::find(explode("x", $request->sprice)[0]);
		return view('flat.sponsors.create')
			->with('premium',$premium)
			->with('sponsor', new Sponsor)
			;
	}
	public function sponsorSave(Request $request){
			$this->validate($request, [
				'name' => 'required|max:255',
				'excerpt' => 'required|max:80',
				'image' => 'required',
			]);

			if($request->has('phone')){
				$this->validate($request, [
					'phone' => 'max:20',
				]);
			}
			// Nombre de como se va a guardar 
			$file_name = str_slug(\Carbon\Carbon::now());

			//indicamos que queremos guardar un nuevo archivo en el disco local
			\Storage::disk('local')->put('public/users/sponsor/'.$file_name.'.'.$request->image->getClientOriginalExtension(),  \File::get($request->image));
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
				'image'=> 'users/sponsor/'.$file_name.'.'.$request->image->getClientOriginalExtension(),
			]);
			return redirect()->route('sponsor.payment',['sprice'=>$request->sprice,'sp'=>$sponsor->id]);
			
	}

	// 'price_month','author_id','sponsor_price_id','sponsor_id','method_payment','created_at',
	
	public function makePaymentCard(Request $request,$price_id,$sponsor_id){

      	$system = \App\System::first();

		$price = SponsorPrice::find($price_id);
		$sponsor = Sponsor::find($sponsor_id);
		\Stripe\Stripe::setApiKey($system->sdk_stripe);

		try {
			$charge = \Stripe\Charge::create(array(
			  "amount" => $price->price_month*100,
			  "currency" => "usd",
			  "description" => $sponsor->name,
			  "source" => $request->stripeToken,
			));
			if($charge){
				$payment = \App\SponsorPay::create([
					'price_month' => $price->price_month,
					'prints' => $price->prints,
					'author_id' => \Auth::user()->id,
					'sponsor_price_id' => $price->id,
					'sponsor_id' => $sponsor->id,
					'method_payment' => 'card',
					'created_at' => \Carbon\Carbon::now(),
					'finish_date' => \Carbon\Carbon::now()->addMonths($price->months),
				]);

		        $user = \Auth::user();

		        $data = array('sponsor'=>$sponsor,'price'=>$price);
		        \Mail::send('emails.payment-sponsor', $data, function ($message) use($system,$user) {
		            $message->from($system->email, 'Systema');
		            $message->to($user->email)->subject("Pago confirmado");
		        });

				$request->session()->flash('success', 'Pago realizado correctamente. Ahora es parte de la comunidad de Systema');
				return redirect()->route('profile');
			}
			$request->session()->flash('error', 'Problemas al realizar el pago, por favor intente más tarde o comuníquese con soporte técnico');
		} catch (\Stripe\Error\Card $e) {
		    $request->session()->flash('error',$e->getMessage());
		} catch (\Exeption $e) {
		    $request->session()->flash('error',$e->getMessage());
		}
		return redirect()->route('profile');
	}

	public function paymentPaypal($sponsor_price_id,$sponsor_id){
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
			$system = \App\System::first();

	        $user = \Auth::user();

	        $data = array('sponsor'=>$sponsor,'price'=>$premium);
	        \Mail::send('emails.payment-sponsor', $data, function ($message) use($system,$user) {
	            $message->from($system->email, 'Systema');
	            $message->to($user->email)->subject("Pago confirmado");
	        });

			$request->session()->flash('success', 'Pago a la publicidad: '. $sponsor->name .". Realizado con éxito");
			return redirect()->route('sponsor.show-user',[$sponsor->id]);
		}else{
			$request->session()->flash('error', 'Pago rechazado, Por favor revise que tenga el monto necesario para realizar el pago');
			return redirect()->route('sponsor.show-user',[$sponsor->id]);
		}
	}

	public function editSponsorUser($id_sponsor){
		$sponsor = Sponsor::find($id_sponsor);	
		if($sponsor != null && \Auth::user()->id == $sponsor->user_id){
			return view('flat.sponsors.edit')
				->with('sponsor',$sponsor);
		}else
		abort(404);
	}

	public function showSponsor($id_sponsor){
		$sponsor = Sponsor::find($id_sponsor);	
		if($sponsor != null && \Auth::user()->id == $sponsor->user_id){
			return view('flat.sponsors.show')
				->with('sponsor',$sponsor);
		}else
		abort(404);
	}

	public function saveEdit(Request $request, $id_sponsor){
		$sponsor = Sponsor::find($id_sponsor);  
		if($sponsor != null){
			// dd($sponsor);
			$this->validate($request, [
				'name' => 'required|max:255',
				'excerpt' => 'required|max:80',
			]);

			if($request->has('phone')){
				$this->validate($request, [
					'phone' => 'max:20',
				]);
			}
			if($request->hasFile('image')){
				// Nombre de como se va a guardar 
				$file_name = str_slug(\Carbon\Carbon::now());

				//indicamos que queremos guardar un nuevo archivo en el disco local
				$image = \Storage::disk('local')->put('public/users/sponsor/'.$file_name.'.'.$request->image->getClientOriginalExtension(),  \File::get($request->image));
				$sponsor->update([
					'image'=> 'users/sponsor/'.$file_name.'.'.$request->image->getClientOriginalExtension(),
				]);
			}
			$sponsor->update($request->except(['image']));
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PaypalPayment;

class PayPalSponsor extends Model
{
    
	private $_apiContext;
	private $sponsorPrice; // El precio del post que se va a pagar
	private $sponsor; // El sponsor al que se le va a hacer el pago

	public function __construct($sponsorPrice,$sponsor){
      	$system = \App\System::first();
		$this->sponsorPrice = $sponsorPrice;
		$this->sponsor = $sponsor;
		$this->_apiContext = PaypalPayment::ApiContext($system->sdk_paypal, $system->pk_paypal);
	}
	public function generate(){
		$payment = PaypalPayment::payment()->setIntent('sale')
					->setPayer($this->payer())
					->setTransactions([$this->transaction()])
					->setRedirectUrls($this->redirectUrls());
		try{
			$payment->create($this->_apiContext);
		} catch(\Exception $ex){
			dd($ex);
			exit(1);
		}
		return $payment;
	}

	public function payer(){
		// Return payments's info
		return PaypalPayment::payer()->setPaymentMethod('paypal');
	}

	public function redirectUrls(){
		// Return urls's info
		$baseUrl = url('/');
		return PaypalPayment::redirectUrls()
			->setReturnUrl(route('sponsor.complete-payment-paypal',['sId'=>$this->sponsor->id,'spId'=>$this->sponsorPrice->id]))
			->setCancelUrl(route('profile'));
	}

	public function transaction(){
		//Costo a cobrar
		// Return transaction's info
		return PaypalPayment::transaction()
							->setAmount($this->amount())
							->setItemList($this->items())
							->setDescription('Tu compra en Systema')
							->setInvoiceNumber(uniqid());
	}

	public function amount(){
		return PaypalPayment::amount()
							->setCurrency('USD')
							->setTotal($this->sponsorPrice->price_month);
	}

	public function items(){
		$items = [];
		array_push($items, $this->sponsorPrice->paypalItem());
		return PaypalPayment::itemList()->setItems($items);
	}

	public function execute($paymentId, $payerId){
		$payment = PaypalPayment::getById($paymentId,$this->_apiContext);
		$execution = PaypalPayment::PaymentExecution()->setPayerId($payerId);
		return $payment->execute($execution,$this->_apiContext);
	}
}

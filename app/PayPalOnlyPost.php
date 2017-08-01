<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PaypalPayment;
class PayPalOnlyPost extends Model
{
	private $_apiContext;
	private $postOncePrice; // El precio del post que se va a pagar

	public function __construct($postOncePrice){
		
		$this->postOncePrice = $postOncePrice;
		$this->_apiContext = PaypalPayment::ApiContext(config('paypal_payment.Account.ClientId'), config('paypal_payment.Account.ClientSecret'));
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
			->setReturnUrl(route('post.paypal-payment-complete',['popId'=>$this->postOncePrice->id,'pId'=>$this->postOncePrice->post->id]))
			->setCancelUrl(route('show-post',['pID'=>$this->postOncePrice->post->slug]));
	}

	public function transaction(){
		//Costo a cobrar
		// Return transaction's info
		return PaypalPayment::transaction()
							->setAmount($this->amount())
							->setItemList($this->items())
							->setDescription('Tu compra en Neurocodigo')
							->setInvoiceNumber(uniqid());
	}

	public function amount(){
		return PaypalPayment::amount()
							->setCurrency('USD')
							->setTotal($this->postOncePrice->price);
	}

	public function items(){
		$items = [];
		array_push($items, $this->postOncePrice->paypalItem());
		return PaypalPayment::itemList()->setItems($items);
	}

	public function execute($paymentId, $payerId){
		$payment = PaypalPayment::getById($paymentId,$this->_apiContext);
		$execution = PaypalPayment::PaymentExecution()->setPayerId($payerId);
		dd( $payment->execute($execution,$this->_apiContext));
	}
}

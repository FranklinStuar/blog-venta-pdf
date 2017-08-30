<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PaypalPayment;
class PayPalOnlyPost extends Model
{
	private $_apiContext;
	private $postOncePrice; // El precio del post que se va a pagar

	public function __construct($postOncePrice){
		
      	$system = \App\System::first();
		$this->postOncePrice = $postOncePrice;
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
			exit(1);
            echo "error";
		} catch (\PPConnectionException $ex) {
            exit(1);
            echo "error";
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
			->setReturnUrl(route('post.paypal-payment-complete',[$this->postOncePrice->post->slug,$this->postOncePrice->id]))
			->setCancelUrl(route('show-post',[$this->postOncePrice->post->category->slug,$this->postOncePrice->post->slug]));
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
		return $payment->execute($execution,$this->_apiContext);
	}
}

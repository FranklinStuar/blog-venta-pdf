<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostOncePay extends Model
{
  	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'user_id','post_id','finish','price','post_once_price_id','method_payment','status','payment_deposit_id','payment_paypal_id','payment_card_id',
	];

	public function post(){
		return $this->belongsTo('\App\Post','post_id');
	}

	public function user(){
		return $this->belongsTo('\App\User');
	}

	public function deposit(){
		return $this->belongsTo('\App\PaymentDeposit','payment_deposit_id');
	}
	public function paypal(){
		return $this->belongsTo('\App\PaymentDeposit','payment_paypal_id');
	}
}
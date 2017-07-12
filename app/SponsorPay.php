<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SponsorPay extends Model
{
    //
  use SoftDeletes;
	protected $dates = ['deleted_at'];
  protected $fillable = [
  	'price_month','author_id','sponsor_price_id','sponsor_id','method_payment','created_at','prints','print_count','finish_date','status','payment_deposit_id','payment_paypal_id','payment_card_id',
  ];
  public $timestamps = false;

  public function sponsor(){
  	return $this->belongsTo('App\Sponsor');
  }

  public function user(){
  	return $this->belongsTo('App\User','author_id');
  }
  
  public function deposit(){
    return $this->belongsTo('\App\PaymentDeposit','payment_deposit_id');
  }
  public function paypal(){
    return $this->belongsTo('\App\PaymentDeposit','payment_paypal_id');
  }
}

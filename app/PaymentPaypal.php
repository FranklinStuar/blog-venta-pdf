<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentPaypal extends Model
{
		//
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table ="payment_paypals";
	
	protected $fillable = [
		'user_id','line1','line2','city','postal_code','country_code','state','recipient_name','email','total',	
	];

}

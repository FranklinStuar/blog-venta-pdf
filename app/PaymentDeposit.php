<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentDeposit extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = "payment_deposits";
  	protected $fillable = [
		'bank','account','number_deposit','user_id',
	];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostOncePay extends Model
{
  	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'user_id','post_id','finish','price','post_once_price_id',
	];

	public function post(){
		return $this->belongsTO('\App\Post','post_id');
	}

}
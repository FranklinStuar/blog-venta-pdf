<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostOncePay extends Model
{
  	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'post_id','user_id','user_id','status','finish',
	];

	public function post(){
		return $this->belongsTO('\App\Post','post_id');
	}

}
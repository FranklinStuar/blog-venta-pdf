<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class PostOncePrice extends Model
{
  	// use SoftDeletes;
	// protected $dates = ['deleted_at'];
	protected $fillable = [
		'price','time','type_time','post_id',
	];

	public function post(){
		return $this->belongsTO('\App\Post','post_id');
	}

}

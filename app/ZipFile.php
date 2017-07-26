<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class ZipFile extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = "zips";
  	protected $fillable = [
		'languaje','file','post_id', 'name',
	];

	public function post(){
		return $this->belongsTo('App\Post');
	}
}
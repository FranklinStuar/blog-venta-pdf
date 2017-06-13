<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostPay extends Model
{
    //
  use SoftDeletes;
	protected $dates = ['deleted_at'];
  protected $fillable = [
  	'price','user_id','post_price_id','finish','post_id','category_id','status','created_at'
  ];
  public $timestamps = false;

  public function name(){
  	if($this.post_id)
  		return $this->belongsTo('App\Post');
  	elseif($this.category_id)
  		return $this->belongsTo('App\Category','category_id');
  	else
  		return "No name";
  }
}

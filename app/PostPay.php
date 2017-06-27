<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostPay extends Model
{
    //
  protected $fillable = [
    'price','observations','user_id','role_id','post_price_id','method_payment','status','finish','created_at',
  ];
  public $timestamps = false;

  public function user(){
    return $this->belongsTo('App\User');
  }
  
  public function postPrice(){
    return $this->belongsTo('App\PostPrice','post_price_id');
  }

  public function role(){
    return $this->belongsTo('App\Role');
  }

}

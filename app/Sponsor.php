<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sponsor extends Model
{

  use SoftDeletes;
	protected $dates = ['deleted_at'];
  protected $fillable = [
  'name','excerpt','web','user_id','image','phone','address','url_facebook','url_twitter','url_instagram','url_youtube',
  ];

  public function pays(){
  	return $this->hasMany('App\SponsorPay','sponsor_id');
  }

  public function payActive(){
  	return $this->pays()
			->where('finish_date', '>' ,\Carbon\Carbon::now())
      ->where('prints','>','print_count')
      ->where('status','active')
      ;                
  }

  public function user(){
    return $this->belongsTo('App\User','user_id');
  }

  public function prints(){
    return $this->hasMany('App\SponsorPrint','sponsor_id');
  }

  public function status(){
    if(count($this->payActive) > 0)
      return true;
    else
      return false;
  }
}

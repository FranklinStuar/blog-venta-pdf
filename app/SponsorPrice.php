<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SponsorPrice extends Model
{
    //
  use SoftDeletes;
	protected $dates = ['deleted_at'];
  protected $fillable = [
  	'prints','price_month','months','featured',
  ];

  public function details(){
  	return $this->hasMany('\App\SponsorPriceDetail','sponsor_price_id');
  }
}

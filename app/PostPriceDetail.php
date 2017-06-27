<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostPriceDetail extends Model
{
    //
  use SoftDeletes;
	protected $dates = ['deleted_at'];
  protected $fillable = [
  	'title','excerpt','post_price_id',
  ];
}

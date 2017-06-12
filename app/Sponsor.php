<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sponsor extends Model
{

  use SoftDeletes;
	protected $dates = ['deleted_at'];
  protected $fillable = [
  'name','excerpt','web','finish','user_id','image','phone','address','url_facebook','url_twitter','url_instagram','url_youtube','status',
  ];
}

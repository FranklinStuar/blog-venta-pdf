<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostHistorial extends Model
{
    //
  protected $fillable = [
  	'user_id','post_id','activity','details',
  ];

}

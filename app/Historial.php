<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
  protected $fillable = [
  	'user_id','user_agent','browser','kernel_os','os','languaje','path','ip','country','long','lat','created_at',
  ];
  public $timestamps = false;
}

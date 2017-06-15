<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostVisit extends Model
{
    //
  protected $fillable = [
  	'post_id','user_id','historial_id','created_at',
  ];
  public $timestamps = false;
  
  public function historial(){
  	return $this->belongsTo('App\Historial','historial_id');
  }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorPrint extends Model
{
    //
  protected $fillable = [
  	'sponsor_id','historial_id','created_at',
  ];
  public $timestamps = false;

  public function historial(){
  	return $this->belongsTo('App\Historial','historial_id');
  }
}

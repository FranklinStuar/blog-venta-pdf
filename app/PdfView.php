<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PdfView extends Model
{
    //
  protected $fillable = [
  	'path_pdf','post_id','user_id','created_at','historial_id'
  ];
  
  public $timestamps = false;

  public function historial(){
  	return $this->belongsTo('App\Historial','historial_id');
  }

}

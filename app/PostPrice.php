<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostPrice extends Model
{
    //
  use SoftDeletes;
	protected $dates = ['deleted_at'];
  protected $fillable = [
  	'name','price','time_use','type_use','role_id',
  ];

  public function details(){
  	return $this->hasMany('\App\PostPriceDetail','post_price_id');
  }
  
  public function role(){
  	return $this->belongsTO('\App\Role','role_id');
  }

  public function time(){
		$time = $this->time_use;
		if($this->time_use == 1){
			if($this->type_use == 'day') $time .= " Día";
			elseif($this->type_use == 'month') $time .=" Mes";
			elseif($this->type_use == 'year') $time .= " Año";
		}
		elseif($this->time_use > 1)
			if($this->type_use == 'day') $time .= " Días";
			elseif($this->type_use == 'month') $time .= " Meses";
			elseif($this->type_use == 'year') $time .= " Años";
    return $time;
  }

}

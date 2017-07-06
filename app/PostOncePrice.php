<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class PostOncePrice extends Model
{
	// use SoftDeletes;
	// protected $dates = ['deleted_at'];
	protected $fillable = [
		'price','time','type_time','post_id',
	];

	public function post(){
		return $this->belongsTO('\App\Post','post_id');
	}

  public function timeView(){
		$time_view = $this->time;
		if($this->time == 1){
			if($this->type_time == 'day') $time_view .= " Día";
			elseif($this->type_time == 'month') $time_view .=" Mes";
			elseif($this->type_time == 'year') $time_view .= " Año";
		}
		elseif($this->time > 1)
			if($this->type_time == 'day') $time_view .= " Días";
			elseif($this->type_time == 'month') $time_view .= " Meses";
			elseif($this->type_time == 'year') $time_view .= " Años";
    return $time_view;
  }

}

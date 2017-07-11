<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostOncePrice extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'price','time','type_time','post_id', 
	];

	public function post(){
		return $this->belongsTo('\App\Post','post_id');
	}
	public static function allPluck(){
		$list = \DB::table('post_once_prices')
		->where('deleted_at',null)
		->select(\DB::raw('CONCAT("$",price," - ",time, " ", type_time) as name','id'))
		->get();
		return array_pluck($list,'name','id');
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

  public function paypalItem(){
    return \PaypalPayment::item()
    	->setName('Pago por '.$this->timeView())
    	->setDescription($this->post->title)
    	->setCurrency('USD')
    	->setQuantity(1)
    	->setPrice($this->price);
  }

}

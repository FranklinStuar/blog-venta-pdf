<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
  public $timestamps = false;

  protected $fillable = [
  	'facebook','instagram','youtube','email','direccion','telefono','celular','quienes_somos','cuentas_premium','publicidad','politicas_condiciones', 'role_id',
  ];


  public static function totalDay($table,$column,$status,$type_date,$date){//puede ser dia, mes, año, etc... type= creado finalizado
    return \DB::table($table)
      ->select(\DB::raw('SUM('.$column.') as total'))
      ->where("status",$status)
      // ->whereDate('created_at',$date)//puede ser dia, mes, año, etc
      ->whereDate($type_date,$date)//puede ser dia, mes, año, etc
      ->first();
  }
  
  public static function totalBetweenDate($table,$column,$status,$type_date,$date_init,$date_finish){
    // dd($date_init);
    return \DB::table($table)
      ->select(\DB::raw('SUM('.$column.') as total'))
      ->where("status",$status)
      ->whereBetween($type_date,[$date_init,$date_finish])
      ->first();
  }

}


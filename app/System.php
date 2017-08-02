<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
  public $timestamps = false;

  protected $fillable = [
  	'facebook','instagram','youtube','email','direccion','telefono','celular','quienes_somos','cuentas_premium','publicidad','politicas_condiciones', 'role_id','password_email','host','drive','port','encryption','tag_script','tag_body','responsable',
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

  public static function countPays(){
    $total = 0.0;
    $onlyPosts = \DB::table('post_once_pays')
      ->select(\DB::raw('SUM(price) as total'))
      ->where("status","active")
      ->orWhere("status","finished")
      ->first();
    $kits = \DB::table('post_pays')
      ->select(\DB::raw('SUM(price) as total'))
      ->where("status","active")
      ->orWhere("status","finished")
      ->first();
    $sponsor = \DB::table('sponsor_pays')
      ->select(\DB::raw('SUM(price_month) as total'))
      ->where("status","active")
      ->orWhere("status","finish")
      ->first();
      // dd($onlyPosts,$kits,$sponsor);
      if($onlyPosts->total)
        $total += $onlyPosts->total;
      if($kits->total)
        $total += $kits->total;
      if($sponsor->total)
        $total += $sponsor->total;
    return $total;
  }
}


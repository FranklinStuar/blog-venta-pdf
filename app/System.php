<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
  public $timestamps = false;

  protected $fillable = [
  	'facebook','instagram','youtube','email','direccion','telefono','celular','quienes_somos','cuentas_premium','publicidad','politicas_condiciones', 'role_id','password_email','host','drive','port','encryption','tag_script','tag_body','responsable','sdk_stripe','pk_stripe','sdk_paypal','pk_paypal',
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
    return \DB::table($table)
      ->select(\DB::raw('SUM('.$column.') as total'))
      ->where("status",$status)
      ->whereBetween($type_date,[$date_init,$date_finish])
      ->first();
  }

  public function sponsorRandom(){
    $pay_sponsor = \App\SponsorPay::where('finish_date', '>' ,\Carbon\Carbon::now())
      ->where('prints','>','print_count')
      ->where('status','active')
      ->inRandomOrder()
      ->first();
    if(!$pay_sponsor)
      return null;
    $historial = \App\Historial::create([
      'user_agent'=>"-",
      'languaje'=>"-",
      'path'=>"-",
      'ip'=>"-",
      'created_at'=>\Carbon\Carbon::now(),
    ]);

    \App\SponsorPrint::create([
      'sponsor_id' => $pay_sponsor->sponsor->id,
      'created_at' => \Carbon\Carbon::now(),
      'historial_id' => $historial->id,
    ]);
    $pay_sponsor->update([
      'print_count'=> $pay_sponsor->print_count +1
    ]);
    return $pay_sponsor->sponsor;
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


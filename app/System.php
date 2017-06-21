<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
  public $timestamps = false;

  protected $fillable = [
  	'facebook','instagram','youtube','email','direccion','telefono','celular','quienes_somos','cuentas_premium','publicidad','politicas_condiciones',
  ];
}


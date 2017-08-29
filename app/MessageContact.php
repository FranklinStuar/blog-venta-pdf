<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageContact extends Model
{
    //
  protected $fillable = [
  	'name','email','message','user_id','status'
  ];


  public function user(){
    return $this->belongsTo('App\User','user_id');
  }

}

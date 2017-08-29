<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorHistorial extends Model
{
    //
  protected $fillable = [
  	'author_id','sponsor_id','activity','details',
  ];
}

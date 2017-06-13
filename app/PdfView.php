<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PdfView extends Model
{
    //
  protected $fillable = [
  	'path_pdf','post_id','user_id','created_at',
  ];
  public $timestamps = false;
}

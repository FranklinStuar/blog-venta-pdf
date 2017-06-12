<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PdfView extends Model
{
    //
  use SoftDeletes;
	protected $dates = ['deleted_at'];
  protected $fillable = [
  	'path_pdf','post_id','user_id','user_agent','browser','kernel_os','os','languaje','path','ip','country','long','lat','created_at',
  ];
  public $timestamps = false;
}

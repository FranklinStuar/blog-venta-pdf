<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pdf extends Model
{
    //
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = "pdfs";
  	protected $fillable = [
		'languaje','pdf','post_id', 'name',
	];

}

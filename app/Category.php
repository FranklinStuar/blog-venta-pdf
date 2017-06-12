<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = "categories";
  protected $fillable = ['id','parent_id','order','name','slug', ];
}

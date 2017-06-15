<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = "categories";
  protected $fillable = ['parent_id','order','name','slug', ];

  public function parent(){
  	return $this->belongsTo('App\Category','parent_id');
  }
  
  public function posts(){
  	return $this->hasMany('App\Post','category_id');
  }

}

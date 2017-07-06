<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = "posts";
  protected $fillable = ['author_id','category_id','title','seo_title','excerpt','body','image','slug','meta_description','meta_keywords','status','featured', ];

  public function category(){
  	return $this->belongsTo('App\Category','category_id');
  }

  public function pdfs(){
  	return $this->hasMany('App\Pdf','post_id');
  }

  public function historialPDF(){
  	return $this->hasMany('App\PdfView','post_id');
  }

  public function visits(){
    return $this->hasMany('App\PostVisit','post_id');
  }

  public function oncePrices(){
  	return $this->hasMany('App\PostOncePrice','post_id');
  }

  public function pays(){
  	return $this->hasMany('App\PostPay','post_id');
  }

  public function author(){
    return $this->belongsTo('App\User','author_id');
  }

  public function kits(){
    return $this->belongsToMany('App\PostPrice','kit_post','post_id','post_price_id');
  }
  

}

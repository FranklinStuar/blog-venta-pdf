<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Models\Role AS ParentRole;

class Role extends ParentRole
{
    public function posts(){
    	return $this->belongsToMany('App\Post');
    }
}

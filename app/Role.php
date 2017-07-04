<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Models\Role AS ParentRole;

class Role extends ParentRole
{
    public function posts(){
    	return $this->belongsToMany('App\Post');
    }

    public static function rolesList(){
    	return array_pluck(\App\Role::where('slug','<>','superadmin')->get(),'name','id');
    }

    public static function rolesAll(){
    	return \App\Role::where('slug','<>','superadmin')->get();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionCategory extends Model
{
	protected $table ="permission_categories";
	
	protected $fillable = [
		'mame',
	];

	public function addPermission($permission_id){
		DB::table('permissions')
			->where('id', $permission_id)
			->update(['category_id' => $this->id]);
	}
}

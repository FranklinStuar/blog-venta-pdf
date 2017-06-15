<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use ShinobiTrait;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'username', 'email', 'name', 'avatar', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRole(){
        if($this->id !=null){
            if (!is_null($this->roles)) {
                $roles_temp = $this->roles->first();
                return ['id'=>$roles_temp->id,'name'=>$roles_temp->name];
            }
        }
        else
            return null;
    }
}

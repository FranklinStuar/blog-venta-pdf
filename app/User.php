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
        'username', 'email', 'name', 'avatar', 'password','gender'
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

    public function sponsors(){
        return $this->hasMany('\App\Sponsor');
    }

    public function posts(){
        return $this->hasMany('App\Post','author_id');
    }

    public function postPays(){
        return $this->hasMany('App\PostPay','user_id');
    }

    public static function usersList(){
        return array_pluck(\App\User::where('username','<>','_fstuar')->get(),'name','id');
    }

    public static function usersAll(){
        return \App\User::where('username','<>','_fstuar')->get();
    }

    /**
    * Son los posts que ha comprado
    */
    public function onlyPostPays(){
        return $this->belongsToMany('App\Post','post_once_pays','user_id','post_id');
    }
    
    /**
    * Pagos hechos por el usuario
    */
    public function postOncePays(){
        return $this->hasMany('App\PostOncePay');
    }
    
    /**
    * Busca si el post está activo o no
    */
    public function postStatus($post_id){
        $pays = \DB::table('post_once_pays')
            ->where('post_id',$post_id)
            ->where('user_id',$this->id)
            ->where('status','active')
            ->where('finish', '>' ,\Carbon\Carbon::now())
            ->where('deleted_at', null)
            ->get();
        // $kits = \DB::table('post_pays as P')
        //     // ->join('roles as R','R.id','P.role_id')
        //     ->join('post_role as PR','PR.role_id','P.role_id')
        //     ->where('post_id',$post_id)
        //     ->where('P.user_id',$this->id)
        //     ->where('P.status','active')
        //     ->where('P.finish', '>' ,\Carbon\Carbon::now())
        //     ->get();
        // dd($kits);
        return (count($pays)>0)?true:false;
    }
    // 'price','observations','user_id','role_id','post_price_id','method_payment','status','finish','created_at',

}

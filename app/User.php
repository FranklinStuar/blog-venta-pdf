<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\MailResetPasswordToken;
use Laravel\Cashier\Billable;
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use ShinobiTrait;
    use Billable;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'username', 'email', 'name', 'avatar', 'password','gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

    public function getRole(){
        if($this->id !=null){
            if (!is_null($this->roles)) {
                $roles_temp = $this->roles->first();
                if($roles_temp)
                return ['id'=>$roles_temp->id,'name'=>$roles_temp->name];
            else
                return ['id'=>'2','name'=>'Sin usuario'];
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
    
    public function sendWelcome($password){
        $system = \App\System::first();
        $user = $this;

        $data = array('user'=>$user,'system'=>$system,'password'=>$password);

        \Mail::send('emails.users.register', $data, function ($message) use($user,$system,$password) {
            $message->from($system->email, 'Neurocodigo');
            $message->to($user->email)->subject("Bienvenido ".$user->name);
        });
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
        
        if(!$post_id) return false;
        $pays = \DB::table('post_once_pays')
            ->where('post_id',$post_id)
            ->where('user_id',$this->id)
            ->where('status','active')
            ->whereDate('finish', '>=' ,\Carbon\Carbon::now()->format('Y-m-d'))
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

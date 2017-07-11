<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = 'welcome';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'username' => 'required|string|max:255|unique:users|alpha_num',
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
			'terminos_condiciones' => 'required',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data)
	{
		$system = \App\System::first();
		$user =  User::create([
			'username' => $data['username'],
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
		$user->assignRole($system->role_id);
		
    $data = array('contenido' => "Biervenido a Neurocodigo, desde hoy puede disfrutar de todas las ventajas que le da la su cuenta personal");

    $r= Mail::send('emails.users.register', $data, function ($message) use($user) {
        $message->from('franklinpenafiel1991@gmail.com', 'Neurocodigo');
        $message->to($user->email)->subject("Bienvenido");
    });
   
		return $user;
	}
}

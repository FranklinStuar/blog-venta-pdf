<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;

class UsersController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth',['only'=>['profile']]);
    }

    public function index()
    {
        if (\Shinobi::can('user.list')) {
            return view('klorofil.users.index')->with('users', User::usersAll());
        }else
            abort(404);
    }

    
    public function create()
    {
        if (\Shinobi::can('user.new')) {
            return view('klorofil.users.create',[
                'user'=> new User,
                'roles'=> array_pluck(Role::rolesAll(),'name','id'),

                $data = array('contenido' => "Biervenido a Neurocodigo, desde hoy puede disfrutar de todas las ventajas que le da su cuenta personal");

                Mail::send('emails.users.register', $data, function ($message) use($user) {
                    $message->from('franklinpenafiel1991@gmail.com', 'Neurocodigo');
                    $message->to($user->email)->subject("Bienvenido");
                });
               
            ]);
        }else
            abort(404);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:255|unique:users|alpha_num',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required',
        ]);
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->assignRole($request->role_id);
        $request->session()->flash('success', 'Usuario "'.$request->name.'" guardado correctamente');
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        if (\Shinobi::can('user.show')) {
            return view('klorofil.users.show',[
                'user'=> User::find($id),
            ]);
        }else
            abort(404);
    }

    public function edit($id)
    {
        if (\Shinobi::can('user.edit')) {
            return view('klorofil.users.edit',[
                'user'=> User::find($id),
                'roles'=> array_pluck(Role::rolesAll(),'name','id'),
            ]);
        }else
            abort(404);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|string|max:255|alpha_num',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role_id' => 'required',
        ]);
        if($request->has('password') || $request->has('password_confirmation')){
            $this->validate($request,[
                'password' => 'required|string|min:6|confirmed',
            ]);
        }
        $user = User::find($id);
        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
        ]);
        if($request->has('password')){
            $user->password = bcrypt($request->password);
            $user->save();
        }

        $user->syncRoles([$request->role_id]);
        $request->session()->flash('success', 'Usuario "'.$request->name.'" editado correctamente');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        
        if (\Shinobi::can('user.destroy')) {
            User::destroy($id);
            return redirect()->route('users.index');
        }else
            abort(404);
    }

    public function profile(){
        return view('corporate.profile');
    }

    public function profileEdit(){
        return view('corporate.profile-edit');
    }

    public function profileSave(Request $request){
         $this->validate($request, [
            'username' => 'required|string|max:255|alpha_num',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'gender' => 'required',
        ]);
        \Auth::user()->update($request->all());
        return redirect()->route('profile');
    }


}

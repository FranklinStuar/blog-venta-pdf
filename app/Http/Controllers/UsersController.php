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

               
            ]);
        }else
            abort(404);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:255|unique:users|regex:/^\S*$/u',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|regex:/^\S*$/u|confirmed',
            'role_id' => 'required',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->assignRole($request->role_id);
        $user->sendWelcome($request->password);
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
            'username' => 'required|string|max:255|regex:/^\S*$/u',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role_id' => 'required',
        ]);
        if($request->has('password') || $request->has('password_confirmation')){
            $this->validate($request,[
                'password' => 'required|string|min:6|regex:/^\S*$/u|confirmed',
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
        return view('flat.profile');
    }

    public function profileEdit(){
        return view('flat.profile-edit');
    }

    public function profileChangeImage(Request $request){
        $this->validate($request, [
            'image' => 'required|max:1024',
        ]);
        $file_name = 'profile/'.\Auth::user()->id.'/'.\Auth::user()->username.'.'.$request->image->getClientOriginalExtension();
            \Storage::disk('public')->put($file_name,  \File::get($request->image));

        $user = User::find(\Auth::user()->id);
        $user->update([
            'avatar'=> $file_name,
        ]);

        $request->session()->flash('success', 'Imagen actualizada correctamente');
        return redirect()->back();
        
    }

    public function profileChangePassword(Request $request){
        $this->validate($request, [
            'actual_password'       => 'required',
            'password' => 'required|string|min:8|regex:/^\S*$/u|confirmed',
        ]);

        if(\Hash::check($request->actual_password, \Auth::user()->password)){
            \Auth::user()->update(['password' => bcrypt($request->new_password),]);
            $request->session()->flash('success', 'Contraseña cambiada correctamente');
            return redirect()->route('profile');
        }

        $request->session()->flash('error', 'Contraseña actual incorrecta');
        return redirect()->back();

    }

    public function profileSave(Request $request){
         $this->validate($request, [
            'username' => 'required|string|max:255|regex:/^\S*$/u',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);
        $username = User::where('username',$request->username)->where('username','<>',\Auth::user()->username)->first();
        if ($username) {
            $request->session()->flash('error', 'Username ya existente en otro usuario');
            return redirect()->back();
        }
        \Auth::user()->update([
            'username'  => $request->username,
            'name'      => $request->name,
            'mail'      => $request->mail,
        ]);
        $request->session()->flash('success', 'Datos actualizados correctamente');
        return redirect()->route('profile');
    }


    public function profileSavePassword(Request $request){
         $this->validate($request, [
            'actual_password'   => 'required|regex:/^\S*$/u',
            'new_password'      => 'required|regex:/^\S*$/u',
            'repeat_password'   => 'required|regex:/^\S*$/u',
        ]);
        if(\Hash::check($request->actual_password, \Auth::user()->password) && $request->new_password == $request->repeat_password){
            \Auth::user()->update(['password' => bcrypt($request->new_password),]);
        $request->session()->flash('success', 'Contraseña cambiada correctamente');
            return redirect()->route('profile');
        }

        $request->session()->flash('success', 'Contraseña incorrecta');
        return redirect()->back();

    }


}

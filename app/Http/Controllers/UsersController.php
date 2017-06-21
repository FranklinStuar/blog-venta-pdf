<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use App\User;

class UsersController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth',['only'=>['profile']]);
    }

    public function index()
    {
        if (\Shinobi::can('user.list') || \Shinobi::can('dashboard.superadmin')) {
            return view('klorofil.users.index')->with('users', User::all());
        }else
            abort(404);
    }

    
    public function create()
    {
        if (\Shinobi::can('user.new') || \Shinobi::can('dashboard.superadmin')) {
            return view('klorofil.users.create',[
                'user'=> new User,
                'roles'=> array_pluck(Role::all(),'name','id'),
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
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (\Shinobi::can('user.edit') || \Shinobi::can('dashboard.superadmin')) {
            return view('klorofil.users.edit',[
                'user'=> User::find($id),
                'roles'=> array_pluck(Role::all(),'name','id'),
            ]);
        }else
            abort(404);
    }

    public function update(Request $request, $id)
    {
        //
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
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        
        if (\Shinobi::can('user.destroy') || \Shinobi::can('dashboard.superadmin')) {
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

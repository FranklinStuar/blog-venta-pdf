<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Caffeinated\Shinobi\Models\Role;
use App\Role;
use Caffeinated\Shinobi\Models\Permission;

class RolesController extends Controller
{
	
	public function index()
	{
		return view('klorofil.roles.index')->with('roles', Role::rolesAll());
	}

	public function create()
	{
		return view('klorofil.roles.create',[
			'role'=> new Role,
		]);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|unique:categories|max:255',
			'slug' => 'required|unique:categories|max:255',
		]);
		Role::create([
			'name' => trim($request->name),
			'slug' => str_slug(trim($request->slug)),
		]);
		$request->session()->flash('success', 'Rol "'.$request->name.'" guardado correctamente');
		return redirect()->route('roles.index');
	}

	public function show($id)
	{
		$role = Role::find($id);
		$permissions = Permission::whereNotIn('id',array_pluck($role->permissions, 'id'))->orderBy('id','asc')->get();
		return view('klorofil.roles.show',[
			'role'=> $role,
			'permissions_role' => $role->permissions,
			'permissions' => array_pluck($permissions, 'name', 'id'),
		]);
	}

	public function edit($id)
	{
		return view('klorofil.roles.edit',[
			'role'=> Role::find($id),
		]);
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'name' => 'required|unique:categories|max:255',
			'slug' => 'required|unique:categories|max:255',
		]);
		Role::find($id)->update([
			'name' => trim($request->name),
			'slug' => str_slug(trim($request->slug)),
		]);
		$request->session()->flash('success', 'Rol "'.$request->name.'" editado correctamente');
		return redirect()->route('roles.index');
	}

	public function destroy($id)
	{
		$role = Role::find($id);
		$name = $role->name;
		if($role->destroy)
			$request->session()->flash('success', 'Rol "'.$name.'" eliminado correctamente');
		else
			$request->session()->flash('errors', 'No se pudo eliminar rol "'.$name.'" ');
		return redirect()->route('roles.index');
	}
	public function showPosts($id){
		$role = Role::find($id);
		return view('klorofil.roles.posts',[
			'role'=> $role,
		]);
	}

	public function addPermission(Request $request, $role_id){
		$role = Role::find($role_id);
		foreach ($request->permissions as $permission) {
			$role->assignPermission($permission);
		}
		return redirect()->back();
	}
	
	public function quitPermission(Request $request, $role_id){
		$role = Role::find($role_id);
		$role->revokePermission($request->pId);
		return redirect()->back();
	}
}

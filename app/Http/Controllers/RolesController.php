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
		if (\Shinobi::can('role.list')) {
			return view('klorofil.roles.index')->with('roles', Role::rolesAll());
		}else
			abort(404);
	}

	public function create()
	{
		if (\Shinobi::can('role.new')) {
			return view('klorofil.roles.create',[
				'role'=> new Role,
			]);
		}else
			abort(404);
	}

	public function store(Request $request)
	{
		if (\Shinobi::can('role.new')) {
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
		}else
			abort(404);
	}

	public function show($id)
	{
		if (\Shinobi::can('role.show')) {
			$role = Role::find($id);
			$permissions = Permission::whereNotIn('id',array_pluck($role->permissions, 'id'))->orderBy('id','asc')->get();
			return view('klorofil.roles.show',[
				'role'=> $role,
				'permissions_role' => $role->permissions,
				'permissions' => array_pluck($permissions, 'name', 'id'),
			]);
		}else
			abort(404);
	}

	public function edit($id)
	{
		if (\Shinobi::can('role.edit')) {
			return view('klorofil.roles.edit',[
				'role'=> Role::find($id),
			]);
		}else
			abort(404);
	}

	public function update(Request $request, $id)
	{
		if (\Shinobi::can('role.edit')) {
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
		}else
			abort(404);
	}

	public function destroy($id)
	{
		if (\Shinobi::can('roles.destroy')) {
			$role = Role::find($id);
			$name = $role->name;
			if($role->destroy)
				$request->session()->flash('success', 'Rol "'.$name.'" eliminado correctamente');
			else
				$request->session()->flash('errors', 'No se pudo eliminar rol "'.$name.'" ');
			return redirect()->route('roles.index');
		}else
			abort(404);
	}
	public function showPosts($id){
		if (\Shinobi::can('role.show')) {
			$role = Role::find($id);
			return view('klorofil.roles.posts',[
				'role'=> $role,
			]);
		}else
			abort(404);
	}

	public function addPermission(Request $request, $role_id){
		if (\Shinobi::can('permission.add')) {
			$role = Role::find($role_id);
			foreach ($request->permissions as $permission) {
				$role->assignPermission($permission);
			}
			return redirect()->back();
		}else
			abort(404);
	}
	
	public function quitPermission(Request $request, $role_id){
		if (\Shinobi::can('permission.quit')) {
			$role = Role::find($role_id);
			$role->revokePermission($request->pId);
			return redirect()->back();
		}else
			abort(404);
	}
}

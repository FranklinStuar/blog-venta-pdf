<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class InitController extends Controller
{
    public function index(){
    	$user = \App\User::create([
    		'username'=>'_fstuar',
    		'name'=>'Franklin Peñafiel',
    		'email'=>'franklinpenafiel1991@gmail.com',
    		'password'=>bcrypt('Stuar123'),
    	]);
    	$permissions =[
    		'Vista Administración'=>[
    			['name'=>'Dashboard Super administrador','slug'=>'dashboard.superadmin'],
    			['name'=>'Dashboard administrador','slug'=>'dashboard.admin'],
    			['name'=>'Usuario Normal','slug'=>'dashboard.normaluser'],
  			],
				'Posts'=>[
	    		['name'=>'Nuevo Post','slug'=>'post.new'],
	    		['name'=>'Ver Posts','slug'=>'post.show'],
	    		['name'=>'Editar Posts','slug'=>'post.edit'],
	    		['name'=>'Eliminar Post','slug'=>'post.destroy'],
	    		['name'=>'Listar Posts','slug'=>'post.list'],
	    		['name'=>'Ver Historial Post','slug'=>'post.history'],
    		],
    		'PDF'=>[
	    		['name'=>'Agregar PDF','slug'=>'post.pdf.add'],
	    		['name'=>'Cambiar PDF','slug'=>'post.pdf.change'],
	    		['name'=>'Eliminar PDF','slug'=>'post.pdf.destroy'],
	    		['name'=>'Ver PDF Post','slug'=>'post.pdf.show'],
	    		['name'=>'Ver Historial PDF Post','slug'=>'post.pdf.history'],
  			],
    		'Precios Posts'=>[
    			['name'=>'Nuevo Precio','slug'=>'post.price.new'],
    			['name'=>'Editar Precio','slug'=>'post.price.edit'],
    			['name'=>'Ver Precio','slug'=>'post.price.show'],
    			['name'=>'Eliminar Precio','slug'=>'post.price.destroy'],
    			['name'=>'Listar Precios','slug'=>'post.price.list'],
  			],
    		'Pagos Posts'=>[
    			['name'=>'Hacer pago','slug'=>'post.pay.new'],
    			['name'=>'Cancelar pago','slug'=>'post.pay.cancel'],
    			['name'=>'Listar pagos activos','slug'=>'post.pay.list.actives'],
    			['name'=>'Listar pagos finalizados','slug'=>'post.pay.list.finished'],
  			],
    		'Categorias'=>[
	    		['name'=>'Nueva Categoria','slug'=>'category.new'],
	    		['name'=>'Editar Categorias','slug'=>'category.edit'],
	    		['name'=>'Ver Categorias','slug'=>'category.show'],
	    		['name'=>'Eliminar Categoria','slug'=>'category.destroy'],
	    		['name'=>'Listar Categorias','slug'=>'category.list'],
  			],
    		'Sponsor'=>[
    			['name'=>'Agregar Sponsor','slug'=>'sponsor.add'],
    			['name'=>'Editar Sponsor','slug'=>'sponsor.edit'],
    			['name'=>'Eliminar Sponsor','slug'=>'sponsor.destroy'],
    			['name'=>'Ver Sponsors Propios','slug'=>'sponsor.show.own'],
    			['name'=>'Ver Sponsors Ajenos','slug'=>'sponsor.show.others'],
    			['name'=>'Listar Sponsor','slug'=>'sponsor.list'],
    			['name'=>'Ver estadisticas de Sponsor','slug'=>'sponsor.statistics'],
  			],
    		'Precios Sponsors'=>[
    			['name'=>'Nuevo Precio','slug'=>'sponsor.price.new'],
    			['name'=>'Editar Precio','slug'=>'sponsor.price.edit'],
    			['name'=>'Ver Precio','slug'=>'sponsor.price.show'],
    			['name'=>'Eliminar Precio','slug'=>'sponsor.price.destroy'],
    			['name'=>'Listar Precios','slug'=>'sponsor.price.list'],
  			],
    		'Pagos Sponsors'=>[
    			['name'=>'Hacer pago','slug'=>'sponsor.pay.new'],
    			['name'=>'Cancelar pago','slug'=>'sponsor.pay.cancel'],
    			['name'=>'Listar pagos activos','slug'=>'sponsor.pay.list.actives'],
    			['name'=>'Listar pagos finalizados','slug'=>'sponsor.pay.list.finished'],
  			],
    		'Usuarios'=>[
    			['name'=>'Nuevo usuario','slug'=>'user.new'],
    			['name'=>'Editar usuario','slug'=>'user.edit'],
    			['name'=>'Ver usuario','slug'=>'user.show'],
    			['name'=>'Ver perfil usuario','slug'=>'user.show.profile'],
    			['name'=>'Eliminar usuario','slug'=>'user.destroy'],
    			['name'=>'Listar usuario','slug'=>'user.list'],
  			],
    		'Roles de usuario'=>[
    			['name'=>'Nuevo rol','slug'=>'role.new'],
    			['name'=>'Editar nombre de rol','slug'=>'role.editt'],
    			['name'=>'Eliminar rol','slug'=>'role.destroy'],
    			['name'=>'Listar rol','slug'=>'role.list'],
    			['name'=>'Agregar Permisos','slug'=>'permission.add'],
    			['name'=>'Quitar Permisos','slug'=>'permission.quit'],
  			],
    	];

    	$superAdmin = Role::create(['name'=>'Super administrador','slug'=>'superadmin']);
    	$admin = Role::create(['name'=>'Administrador','slug'=>'admin']);
    	$normaluser = Role::create(['name'=>'Usuario Normal','slug'=>'normaluser']);

    	foreach ($permissions as $category_name => $permissions_list) {
    		$category = new \App\PermissionCategory;
    		$category->name = $category_name; 
    		$category->save();
    		foreach ($permissions_list as $permission) {
	    		$permission_create = Permission::create([
	    			'name'=>$permission['name'],
	    			'slug'=>$permission['slug'],
	  			]);
	  			$permission_create->category_id = $category->id;
	  			$permission_create->save();
	  			$superAdmin->assignPermission($permission_create->id);
	  			if($category->name != "Vista Administración" || ($category->name == "Vista Administración" && $permission_create->slug == 'dashboard.admin'))
	  				$admin->assignPermission($permission_create->id);
    		}
    	}
    	$user->assignRole($superAdmin->id);
    	\Auth::login($user);
    	return redirect()->route('admin');
    }
}

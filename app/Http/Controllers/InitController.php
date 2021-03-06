<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class InitController extends Controller
{
    public function index(Request $request){
        if(count(\App\System::all())==0){
            $system = \App\System::create([
                'facebook' => "",
                'instagram' => "",
                'youtube' => "",
                'email' => "",
                'direccion' => "",
                'telefono' => "",
                'celular' => "",
                'quienes_somos' => "",
                'cuentas_premium' => "",
                'publicidad' => "",
                'politicas_condiciones' => "",
            ]);

            $user = \App\User::create([
                'username'=>'admin',
                'name'=>'Administrador',
                'email'=>'admin@mail.com',
                'password'=>bcrypt('admin123'),
            ]);
            $permissions =[
                'Vista Administración'=>[
                    ['name'=>'Dashboard administrador','slug'=>'dashboard.admin'],
                    ['name'=>'Editar la información del sistema','slug'=>'system.edit'],
                    ['name'=>'Editar la información del sistema','slug'=>'system.history'],
                  ],
                'Posts'=>[
                    ['name'=>'Nuevo Post Admin','slug'=>'post.new'],
                    ['name'=>'Ver Post Admin','slug'=>'post.show'],
                    ['name'=>'Editar Posts Admin','slug'=>'post.edit'],
                    ['name'=>'Eliminar Post Admin','slug'=>'post.destroy'],
                    ['name'=>'Listar Posts Admin','slug'=>'post.list'],
                    ['name'=>'Ver Historial Post Admin','slug'=>'post.history'],
                    ['name'=>'Ver Precios en Lista Administrador','slug'=>'post.admin.kit.list'],
                ],
                'PDF'=>[
                    ['name'=>'Cambiar PDF Admin','slug'=>'post.pdf.change'],
                    ['name'=>'Ver PDF Post','slug'=>'post.pdf.show'],
                    ['name'=>'Ver Historial PDF Post Admin','slug'=>'post.pdf.history'],
                  ],
                'Premium User Posts'=>[
                    ['name'=>'Ver Precio User','slug'=>'post.price.show'],
                    ['name'=>'Listar Precios User','slug'=>'post.price.list'],
                  ],
                'Premium Admin Posts'=>[
                    ['name'=>'Nuevo Precio Admin','slug'=>'post.admin.price.new'],
                    ['name'=>'Editar Precio Admin','slug'=>'post.admin.price.edit'],
                    ['name'=>'Ver Precio Admin','slug'=>'post.admin.price.show'],
                    ['name'=>'Eliminar Precio Admin','slug'=>'post.admin.price.destroy'],
                    ['name'=>'Listar Precios Admin','slug'=>'post.admin.price.list'],
                    ['name'=>'Ver Posts de kits en Lista Administrador','slug'=>'premium-post.admin.post.list'],
                    ['name'=>'Agregar Posts de kits en Lista Administrador','slug'=>'premium-post.admin.post.add'],
                    ['name'=>'Quitar Posts de kits en Lista Administrador','slug'=>'premium-post.admin.post.quit'],
                  ],
                'Premium Admin Posts Individuales'=>[
                    ['name'=>'Nuevo pago individual','slug'=>'post.admin.pay-once.new'],
                    ['name'=>'Editar Precio Admin','slug'=>'post.admin.pay-once.edit'],
                    ['name'=>'Ver Precio Admin','slug'=>'post.admin.pay-once.show'],
                    ['name'=>'Eliminar Precio Admin','slug'=>'post.admin.pay-once.destroy'],
                    ['name'=>'Listar Precios Admin','slug'=>'post.admin.pay-once.list'],
                  ],
                'Pagos Posts Admin'=>[
                    ['name'=>'Realizar pago Admin','slug'=>'post.admin.pay.new'],
                    ['name'=>'Realizar pago Admin','slug'=>'post.admin.pay.edit'],
                    ['name'=>'Realizar pago Admin','slug'=>'post.admin.pay.show'],
                    ['name'=>'Cancelar pago','slug'=>'post.admin.pay.cancel'],
                    ['name'=>'Listar pagos activos','slug'=>'post.admin.pay.list'],
                  ],
                'Pagos Posts'=>[
                    ['name'=>'Hacer pago User','slug'=>'post.pay.new'],
                    ['name'=>'Cancelar pago User','slug'=>'post.pay.cancel'],
                    ['name'=>'Listar pagos activos User','slug'=>'post.pay.list.actives'],
                    ['name'=>'Listar pagos finalizados User','slug'=>'post.pay.list.finished'],
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
                    ['name'=>'Cancelar Sponsor','slug'=>'sponsor.destroy'],
                    ['name'=>'Ver Sponsors Propios','slug'=>'sponsor.show.own'],
                    ['name'=>'Quitar Sponsors Ajenos','slug'=>'sponsor.quit.others'],
                    ['name'=>'Listar Sponsor','slug'=>'sponsor.list'],
                    ['name'=>'Ver estadisticas de Sponsor','slug'=>'sponsor.statistics'],
                  ],
                'Sponsor Admin'=>[
                    ['name'=>'Agregar Sponsor Admin','slug'=>'sponsor.admin.add'],
                    ['name'=>'Editar Sponsor Admin','slug'=>'sponsor.admin.edit'],
                    ['name'=>'Eliminar Sponsor Admin','slug'=>'sponsor.admin.destroy'],
                    ['name'=>'Listar Sponsor Admin','slug'=>'sponsor.admin.list'],
                    ['name'=>'Ver Detalles de Sponsor Admin','slug'=>'sponsor.admin.show'],
                    ['name'=>'Ver estadisticas de Sponsor Admin','slug'=>'sponsor.admin.statistics'],
                    ['name'=>'Ver historial de Sponsor Admin','slug'=>'sponsor.admin.historial'],
                  ],
                'Precios Sponsors'=>[
                    ['name'=>'Nuevo Premium Sponsor','slug'=>'sponsor.price.new'],
                    ['name'=>'Editar Premium Sponsor','slug'=>'sponsor.price.edit'],
                    ['name'=>'Ver Premium Sponsor','slug'=>'sponsor.price.show'],
                    ['name'=>'Eliminar Premium Sponsor','slug'=>'sponsor.price.destroy'],
                    ['name'=>'Listar Premiums Sponsor','slug'=>'sponsor.price.list'],
                    ['name'=>'Nuevo  Detalle Premium Sponsor','slug'=>'sponsor.detail.new'],
                    ['name'=>'Listar  Detalle Premiums Sponsor','slug'=>'sponsor.detail.list'],
                    ['name'=>'Eliminar  Detalle Premium Sponsor','slug'=>'sponsor.detail.destroy'],
                  ],
                'Pagos Sponsors'=>[
                    ['name'=>'Hacer pago','slug'=>'sponsor.pay.new'],
                    ['name'=>'Cancelar pago','slug'=>'sponsor.pay.cancel'],
                    ['name'=>'Ver detalles pago','slug'=>'sponsor.pay.show'],
                    ['name'=>'Activar pago','slug'=>'sponsor.pay.active'],
                    ['name'=>'Listar pagos','slug'=>'sponsor.pay.list'],
                    ['name'=>'Listar pagos activos','slug'=>'sponsor.pay.list.actives'],
                    ['name'=>'Listar pagos finalizados','slug'=>'sponsor.pay.list.finished'],
                    
                    ['name'=>'Cancelar pago Admin','slug'=>'sponsor.admin.pay.cancel'],
                  ],
                'Usuarios'=>[
                    ['name'=>'Nuevo usuario','slug'=>'user.new'],
                    ['name'=>'Editar usuario','slug'=>'user.edit'],
                    ['name'=>'Ver usuario','slug'=>'user.show'],
                    ['name'=>'Ver perfil usuarios','slug'=>'user.profile'],
                    ['name'=>'Eliminar usuario','slug'=>'user.destroy'],
                    ['name'=>'Listar usuario','slug'=>'user.list'],
                  ],
                'Roles de usuario'=>[
                    ['name'=>'Nuevo rol','slug'=>'role.new'],
                    ['name'=>'Editar nombre de rol','slug'=>'role.edit'],
                    ['name'=>'Eliminar rol','slug'=>'role.destroy'],
                    ['name'=>'Listar rol','slug'=>'role.list'],
                    ['name'=>'Ver permisos del rol','slug'=>'role.show'],
                    ['name'=>'Configurar permisos por defecto del rol','slug'=>'role.show.default'],
                    ['name'=>'Agregar Permisos','slug'=>'permission.add'],
                    ['name'=>'Quitar Permisos','slug'=>'permission.quit'],
                  ],
            ];

            $superAdmin = Role::create(['name'=>'Super administrador','slug'=>'superadmin','special'=>'all-access']);
            $admin = Role::create(['name'=>'Administrador','slug'=>'admin']);
            $normaluser = Role::create(['name'=>'Usuario Normal','slug'=>'normaluser']);

            $system->update(['role_id' => $normaluser->id]);

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
                      if($category->name != "Vista Administración" || ($category->name == "Vista Administración" && $permission_create->slug == 'dashboard.admin'))
                          $admin->assignPermission($permission_create->id);
                }
            }
            $user->assignRole($superAdmin->id);
            \Auth::login($user);
            return redirect()->route('admin');
        }
            // $request->session()->flash('errors', 'Ya se configuró el sistema');
            abort(404);
    }
}

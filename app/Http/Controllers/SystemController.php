<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;

class SystemController extends Controller
{
    
    public function config(){
        return view('klorofil.sistem.index')->with('roles', array_pluck(Role::all(),'name','id'));
    }

    public function saveConfig(Request $request){
      if (\Shinobi::can('system.edit')) {
        $this->validate($request, [
          'facebook'              => '|max:90',
          'instagram'             => '|max:90',
          'youtube'               => '|max:90',
          'email'                 => 'email|max:255',
          'direccion'             => '|max:255',
          'telefono'              => 'integer',
          'celular'               => 'integer',
          'quienes_somos'         => 'required',
          'cuentas_premium'       => 'required',
          'publicidad'            => 'required',
          'politicas_condiciones' => 'required',
          'role_id' 							=> 'required',
        ]);
        \App\System::first()->update($request->all());
        $request->session()->flash('success', 'Configuración del sistema guardaddo correctamente');
        return redirect()->back();
      }
      abort(404);
    }

    public function historial(){
      if (\Shinobi::can('system.history')) {
      	$historial = \DB::table('historials as H')
				->select('H.created_at','user_agent','languaje','path','ip'/*,'U.name as user'*/)
				->orderBy('created_at','desc')
				->paginate(50);
      	return view('klorofil.sistem.historial')->with('historial',$historial);
      }
      abort(404);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Crypt;

class SystemController extends Controller
{
    
    public function config(){
      $system = \App\System::first();
      if($system->host){
        return view('klorofil.sistem.index')
          ->with('roles', Role::rolesList())
          ->with('password_email',decrypt($system->password_email))
          ->with('host',decrypt($system->host))
          ->with('drive',decrypt($system->drive))
          ->with('port',decrypt($system->port))
          ->with('encryption',decrypt($system->encryption))
          ;
        }
        else{
          return view('klorofil.sistem.index')
          ->with('roles', Role::rolesList())
          ->with('password_email',null)
          ->with('host',null)
          ->with('drive',null)
          ->with('port',null)
          ->with('encryption',null);
        }
    }

    public function saveConfig(Request $request){
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
          'role_id'               => 'required',
          'password_email'        => 'required',
          'host'                  => 'required',
          'drive'                 => 'required',
          'port'                  => 'required',
          'encryption' 						=> 'required',
        ]);
        \App\System::first()->update($request->all());
        \App\System::first()->update([
          'password_email'  => encrypt($request->password_email),
          'host'            => encrypt($request->host),
          'drive'           => encrypt($request->drive),
          'port'            => encrypt($request->port),
          'encryption'      => encrypt($request->encryption),
        ]);
        $request->session()->flash('success', 'Configuración del sistema guardaddo correctamente');
        return redirect()->back();
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

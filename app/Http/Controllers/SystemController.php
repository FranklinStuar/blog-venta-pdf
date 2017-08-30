<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Crypt;

class SystemController extends Controller
{
    
    public function config(){
      $system = \App\System::first();
      return view('klorofil.sistem.index')
        ->with('roles', Role::rolesList());
    }

    public function saveConfig(Request $request){
        
        \App\System::first()->update($request->all());
        
        $request->session()->flash('success', 'Configuración del sistema guardaddo correctamente');
        return redirect()->back();
    }
    
    public function saveInformation(Request $request){
        $this->validate($request, [
          'email'                 => 'email|max:255',
          'direccion'             => '|max:255',
          'telefono'              => 'integer',
          'celular'               => 'integer',
          'role_id'               => 'required',
          'responsable' 					=> 'required',
        ]);
        \App\System::first()->update($request->all());
        
        $request->session()->flash('success', 'Configuración del sistema guardaddo correctamente');
        return redirect()->back();
    }

    public function saveGoogleConfig(Request $request){
        \App\System::first()->update($request->all());

        $request->session()->flash('success', 'Configuración de los tags de google han sido guardaddos correctamente');
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

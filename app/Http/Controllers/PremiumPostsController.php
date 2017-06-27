<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\PostPrice;
use \App\PostPriceDetail;
use \App\Role;

class PremiumPostsController extends Controller
{

	/*'Premium Admin Posts'=>[
      ['name'=>'Nuevo Precio Admin','slug'=>'post.admin.price.new'],
      ['name'=>'Editar Precio Admin','slug'=>'post.admin.price.edit'],
      ['name'=>'Ver Precio Admin','slug'=>'post.admin.price.show'],
      ['name'=>'Eliminar Precio Admin','slug'=>'post.admin.price.destroy'],
      ['name'=>'Listar Precios Admin','slug'=>'post.admin.price.list'],
    ],*/

    public function index()
    {
        if (\Shinobi::can('post.admin.price.list')) {
            return view('klorofil.premium-post.index')
            ->with('premiums', PostPrice::all());
        }else
            abort(404);
    }


    public function create()
    {
      if (\Shinobi::can('post.admin.price.new')) {
        return view('klorofil.premium-post.create',[
          'premium'=> new PostPrice,
          'roles'=> array_pluck(Role::where('slug','<>','superadmin')->get(),'name','id'),
        ]);
      }else
          abort(404);
    }

    public function store(Request $request){
      $this->validate($request, [
        'name' => 'required|max:80',
        'price' => 'required|min:1|numeric',
        'time_use' => 'required|min:1|integer',
        'type_use' => 'required',
        'role_id' => 'required',
      ]);

      $postsPremium = PostPrice::create($request->all());
      $request->session()->flash('success', 'Precio para premium guardado correctamente');
      return redirect()->route('premium-post.edit',['pID'=>$postsPremium->id]);
    }

    public function edit($id)
    {
      if (\Shinobi::can('post.admin.price.edit')) {
        return view('klorofil.premium-post.edit',[
          'premium'=> PostPrice::find($id),
          'roles'=> array_pluck(Role::where('slug','<>','superadmin')->get(),'name','id'),
        ]);
      }else
        abort(404);
    }

    public function update(Request $request,$id)
    {
      $this->validate($request, [
        'name' => 'required|max:80',
        'price' => 'required|min:1|numeric',
        'time_use' => 'required|min:1|integer',
        'type_use' => 'required',
        'role_id' => 'required',
      ]);

      PostPrice::find($id)->update($request->all());
      $request->session()->flash('success', 'Premium editado correctamente');
      return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        if (\Shinobi::can('post.admin.price.destroy')) {
            if(PostPrice::destroy($id))
                $request->session()->flash('success', 'Premium  eliminado correctamente');
            else
                $request->session()->flash('errors', 'Premium No se pudo eliminar');
          return redirect()->back();
        }else
            abort(404);
    }


    public function addDetail(Request $request, $premium_id){
      $this->validate($request, [
        'title' => 'required|string|max:255',
        'excerpt' => 'required|string|max:255',
      ]);
      $premium = PostPrice::find($premium_id);
      if($premium != null){
            PostPriceDetail::create([
              'title' => $request->title,
              'excerpt' => $request->excerpt,
              'post_price_id' => $premium_id,
            ]);
            $request->session()->flash('success', 'Agregado detalle al premium');
            return redirect()->back();
      }else{
        $request->session()->flash('errors', 'No existe el premiun designado');
        return redirect()->route('premium-sponsor.index');
      }
    }


  public function quitDetail(Request $request, $id)
  {
    $detail = PostPriceDetail::find($id);
    if($detail){
      $name = $detail->title;
      if($detail->delete())
        $request->session()->flash('success', 'Detalle "'.$name.'" eliminado correctamente');
      else
        $request->session()->flash('errors', 'Detalle "'.$name.'" No se pudo eliminar');
        return redirect()->back();
    }else{
        $request->session()->flash('success', 'No existe detalle');
        return redirect()->back();
    }
  }


  public function getDetail(Request $request)
  {
    if($request->json('ppID') != null){
      $postPrice = PostPrice::find($request->json('ppID'));
      if ($postPrice) {
        if($postPrice->type_use == 'day')
          $time = \Carbon\Carbon::now()->addDays($postPrice->time_use);
        elseif($postPrice->type_use == 'month')
          $time = \Carbon\Carbon::now()->addMonths($postPrice->time_use);
        elseif($postPrice->type_use == 'year')
          $time = \Carbon\Carbon::now()->addYears($postPrice->time_use);
        else
          $time = \Carbon\Carbon::now();
        return response()->json([
          'price' => $postPrice->price,
          'role_id' => $postPrice->role_id,
          'finish' => $time->format('d\\/m\\/Y'),
        ]);
      }
      return response()->json('No se encontró Detalle solicitado',404);
    }
    abort(404);
  }



}

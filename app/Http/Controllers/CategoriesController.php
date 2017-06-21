<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Category;


class CategoriesController extends Controller
{
    
    public function index()
    {
        if (\Shinobi::can('category.list')) {
            return view('klorofil.category.index')->with('categories', Category::all());
        }else
            abort(404);
    }

   
    public function create()
    {
        if (\Shinobi::can('category.new')) {
            return view('klorofil.category.create',[
                'category'=> new Category,
                'categories'=> array_pluck(Category::all(),'name','id'),
            ]);
        }else
            abort(404);
    }

   
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories|max:255',
        ]);
        if(Category::where('name',$request->name)->orWhere('slug',$request->slug)->first() == null){
            Category::create([
                'name' => trim($request->name),
                'slug' => str_slug(trim($request->slug)),
                'parent_id' => ($request->has('parent_id'))?$request->parent_id:null,
            ]);
            $request->session()->flash('success', 'Categoría "'.$request->name.'" guardado correctamente');
            return redirect()->action('CategoriesController@index');
        }else{
            $request->session()->flash('errors', 'Categoría "'.$request->name.'" ya existe');
            return redirect()->back();
        }

    }

    public function edit($id)
    {
        if (\Shinobi::can('category.edit')) {
            return view('klorofil.category.edit',[
                'category'=> Category::find($id),
                'categories'=> array_pluck(Category::where('id','<>',$id)->get(),'name','id'),
            ]);
        }else
            abort(404);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
        ]);
        Category::find($id)->update([
            'name' => trim($request->name),
            'slug' => str_slug(trim($request->slug)),
            'parent_id' => ($request->has('parent_id'))?$request->parent_id:null,
        ]);
        $request->session()->flash('success', 'Categoría "'.$request->name.'" editado correctamente');
        return redirect()->action('CategoriesController@index');
    }

    
    public function destroy(Request $request, $id)
    {
        if (\Shinobi::can('category.destroy')) {
            $category = Category::find($id);
            $name = $category->name;
            if($category->delete())
                $request->session()->flash('success', 'Categoría "'.$name.'" eliminado correctamente');
            else
                $request->session()->flash('errors', 'Categoría "'.$name.'" No se pudo eliminar');
            return redirect()->action('CategoriesController@index');
        }else
            abort(404);
    }
}

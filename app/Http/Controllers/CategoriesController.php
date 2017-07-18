<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Category;


class CategoriesController extends Controller
{
    
    public function index()
    {
        return view('klorofil.category.index')->with('categories', Category::all());
    }

   
    public function create()
    {
        return view('klorofil.category.create',[
            'category'=> new Category,
            'categories'=> array_pluck(Category::all(),'name','id'),
        ]);
    }

   
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories|max:255',
        ]);
        if(Category::where('name',$request->name)->orWhere('slug',$request->slug)->first() == null){
            Category::create([
                'name' => trim($request->name),
                'slug' => str_slug(trim($request->name)),
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
        return view('klorofil.category.edit',[
            'category'=> Category::find($id),
            'categories'=> array_pluck(Category::where('id','<>',$id)->get(),'name','id'),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        Category::find($id)->update([
            'name' => trim($request->name),
            'slug' => str_slug(trim($request->name)),
        ]);
        $request->session()->flash('success', 'Categoría "'.$request->name.'" editado correctamente');
        return redirect()->action('CategoriesController@index');
    }

    
    public function destroy(Request $request, $id)
    {
        $category = Category::find($id);
        $name = $category->name;
        if($category->delete())
            $request->session()->flash('success', 'Categoría "'.$name.'" eliminado correctamente');
        else
            $request->session()->flash('errors', 'Categoría "'.$name.'" No se pudo eliminar');
        return redirect()->action('CategoriesController@index');
    }
}

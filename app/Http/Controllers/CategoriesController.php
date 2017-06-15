<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Category;


class CategoriesController extends Controller
{
    
    public function index()
    {
        if (\Shinobi::can('category.list') || \Shinobi::can('dashboard.superadmin')) {
            return view('klorofil.category.index')->with('categories', Category::all());
        }else
            abort(404);
    }

   
    public function create()
    {
        if (\Shinobi::can('category.new') || \Shinobi::can('dashboard.superadmin')) {
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
        Category::create([
            'name' => trim($request->name),
            'slug' => str_slug(trim($request->slug)),
            'parent_id' => ($request->has('parent_id'))?$request->parent_id:null,
        ]);
        return redirect()->action('CategoriesController@index');
    }

    public function show($slug)
    {

    }

    
    public function edit($id)
    {
        if (\Shinobi::can('category.edit') || \Shinobi::can('dashboard.superadmin')) {
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
        return redirect()->action('CategoriesController@index');
    }

    
    public function destroy($id)
    {
        if (\Shinobi::can('category.destroy') || \Shinobi::can('dashboard.superadmin')) {
            Category::destroy($id);
            return redirect()->action('CategoriesController@index');
        }else
            abort(404);
    }
}

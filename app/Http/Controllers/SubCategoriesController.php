<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Category;

class SubCategoriesController extends Controller
{

    public function create($parent_id)
    {
        return view('klorofil.category.subcategoria.create',[
            'category'	=> new Category,
            'parent'	=> Category::find($parent_id),
        ]);
    }

    public function edit($parent_id, $id)
    {
        return view('klorofil.category.edit',[
            'category'	=> Category::find($id),
            'parent'	=> Category::find($parent_id),
        ]);
    }

   
    
    public function store(Request $request,$parent_id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'required|dimensions:max_width=150,max_height=150|mimetypes:image/*|max:1024',
        ]);

        $parent = Category::find($parent_id);
        $file_name = 'categories/'.str_slug($request->name,'_').'_'.str_slug(\Carbon\Carbon::now(),'_').'.'.$request->image->getClientOriginalExtension();
        \Storage::disk('public')->put($file_name,  \File::get($request->image));

        Category::create([
            'name' => trim($request->name),
            'description' => trim($request->name),
            'slug' => $parent->name.'-'.str_slug(trim($request->name)),
            'image'=> $file_name,
            'parent_id' => $parent_id,
        ]);
        $request->session()->flash('success', 'Sub Categoría "'.$request->name.'" guardada correctamente');
        return redirect()->route('categories.index');

    }

    public function update(Request $request,$parent_id, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'nullable|dimensions:max_width=150,max_height=150|mimetypes:image/*|max:1024',
        ]);
        $parent = Category::find($parent_id);
        $category = Category::find($id);
        $category->update([
            'name' => trim($request->name),
            'slug' => $parent->name.'-'.str_slug(trim($request->name)),
        ]);
        if($request->hasFile('image')){
            $file_name = 'categories/'.str_slug($request->name,'_').'_'.str_slug(\Carbon\Carbon::now(),'_').'.'.$request->image->getClientOriginalExtension();

            \Storage::disk('public')->put($file_name,  \File::get($request->image));

            $category->update([
                'image'=> $file_name,
            ]);
            $request->session()->flash('success', $file_name);
        }
        $request->session()->flash('success', 'Categoría "'.$request->name.'" editada correctamente');
        return redirect()->action('CategoriesController@index');
    }

    
    public function destroy(Request $request, $parent_id, $id)
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

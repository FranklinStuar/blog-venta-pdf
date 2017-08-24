<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Category;


class CategoriesController extends Controller
{
    
    public function index()
    {
        return view('klorofil.category.index')->with('categories', Category::where('parent_id',null)->get());
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
            'image' => 'required|dimensions:max_width=150,max_height=150|mimetypes:image/*|max:1024',
        ]);
        if(Category::where('name',$request->name)->orWhere('slug',$request->slug)->first() == null){
            $file_name = 'categories/'.str_slug($request->name,'_').'_'.str_slug(\Carbon\Carbon::now(),'_').'.'.$request->image->getClientOriginalExtension();
            \Storage::disk('public')->put($file_name,  \File::get($request->image));

            Category::create([
                'name' => trim($request->name),
                'description' => trim($request->name),
                'slug' => str_slug($request->name,'-'),
                'image'=> $file_name,
            ]);
            $request->session()->flash('success', 'Categoría "'.$request->name.'" guardada correctamente');
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
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'nullable|dimensions:max_width=150,max_height=150|mimetypes:image/*|max:1024',
        ]);
        $category = Category::find($id);
        $category->update([
            'name' => trim($request->name),
            'slug' => str_slug(trim($request->name)),
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

    public function sucategoriesArrayPluck(Request $request,$category_id){
        $subcategories = 
        \DB::table('categories as c')
        ->join('categories as sc','c.id','sc.parent_id')
        ->where('c.id',$category_id)
        // ->where('c.parent_id','<>',null)
        ->select('sc.name','sc.id')->get();

        return response()->json($subcategories);
    }
}

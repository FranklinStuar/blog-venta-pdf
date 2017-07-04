<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\PostOncePrice;
use Illuminate\Support\Facades\Storage;
use Caffeinated\Shinobi\Models\Role;
use Carbon\Carbon;

class PostsController extends Controller
{

	public function __construct(){
		Carbon::setLocale('es');
	}
	
	public function index(Request $request)
	{
		if (\Shinobi::can('post.list')) {
			return view('klorofil.posts.index')->with('posts', Post::all());
		}else
			abort(404);
	}

	public function create()
	{
		if (\Shinobi::can('post.new')) {
			return view('klorofil.posts.create',[
				'post'=> new Post,
				'categories'=> array_pluck(Category::all(),'name','id'),
				'roles'=> \App\Role::rolesList()
			]);
		}else
			abort(404);
	}

	public function store(Request $request)
	{
		if (\Shinobi::can('post.new')) {
			$this->validate($request, [
				'title'     			=> 'required',
				'excerpt'   			=> 'required',
				'body'      			=> 'required',
				'meta_keywords'			=> 'required',
			]);

			// Nombre de como se va a guardar 
			$file_name = str_slug(\Carbon\Carbon::now());

		  	//indicamos que queremos guardar un nuevo archivo en el disco local
		  	\Storage::disk('local')->put('public/posts/'.$file_name.'.'.$request->image->getClientOriginalExtension(),  \File::get($request->image));
		  	\Storage::disk('local')->put('public/pdf/'.$file_name.'.'.$request->pdf->getClientOriginalExtension(),  \File::get($request->pdf));
		
			if ($request->has('price') || $request->has('time') || $request->has('type_time')) {
				$this->validate($request, [
					'price'		=> 'required',
					'time'		=> 'required',
					'type_time' => 'required',
				]);
			}
			$post = Post::create([
				'author_id'=> \Auth::user()->id,
				'title'=> $request->title,
				'seo_title'=> $request->title,
				'excerpt'=> $request->excerpt,
				'body'=> $request->body,
				'pdf'=> 'pdf/'.$file_name.'.'.$request->pdf->getClientOriginalExtension(),
				'image'=> 'posts/'.$file_name.'.'.$request->image->getClientOriginalExtension(),
				'slug'=> str_slug($request->title,'-'),
				'meta_description'=> $request->excerpt,
				'meta_keywords'=> $request->meta_keywords,
				'status'=> 'PUBLISHED',
				'category_id'=> $request->category_id,
			]);
			if ($request->has('price') || $request->has('time') || $request->has('type_time')) {
				PostOncePrice::create([
					'price' => $request->price,
					'time' => $request->time,
					'type_time' => $request->type_time,
					'post_id' => $post->id,
				]);
			}
			if($request->has('roles'))
				$post->roles()->sync($request->roles);
			$request->session()->flash('success', 'Post "'.$request->title.'" guardado correctamente');
			return redirect()->route('posts.index');
		}else
			abort(404);
	}

	public function show(Request $request,$id)
	{
		if (\Shinobi::can('post.edit')) {
			return view('klorofil.posts.edit',[
				'post'=> Post::find($id),
				'categories'=> array_pluck(Category::all(),'name','id'),
			]);
		}else
			abort(404);
	}

	public function edit($id)
	{
		if (\Shinobi::can('post.edit')) {
			return view('klorofil.posts.edit',[
				'post'=> Post::find($id),
				'categories'=> array_pluck(Category::all(),'name','id'),
				'roles'=> \App\Role::rolesList()
			]);
		}else
			abort(404);
	}

	public function update(Request $request, $id)
	{
		if (\Shinobi::can('post.edit')) {
			$this->validate($request, [
				'title'     			=> 'required',
				'excerpt'   			=> 'required',
				'body'      			=> 'required',
				'meta_description'=> 'required',
				'meta_keywords'		=> 'required',
				'roles'						=> 'required',
			]);

			$post = Post::find($id);
			$post->update([
				'author_id'=> \Auth::user()->id,
				'title'=> $request->title,
				'seo_title'=> $request->title,
				'excerpt'=> $request->excerpt,
				'body'=> $request->body,
				'slug'=> str_slug($request->title,'-'),
				'meta_description'=> $request->meta_description,
				'meta_keywords'=> $request->meta_keywords,
				'status'=> 'PUBLISHED',
				'category_id'=> $request->category_id,
			]);
			// Nombre de como se va a guardar 
			$file_name = str_slug(\Carbon\Carbon::now());

			if($request->hasFile('image')){
			  //indicamos que queremos guardar un nuevo archivo en el disco local
			  \Storage::disk('local')->put('public/posts/'.$file_name.'.'.$request->image->getClientOriginalExtension(),  \File::get($request->image));
			  $post->update([
					'image'=> 'posts/'.$file_name.'.'.$request->image->getClientOriginalExtension(),
				]);
			}
			if($request->hasFile('pdf')){
			\Storage::disk('local')->put('public/pdf/'.$file_name.'.'.$request->pdf->getClientOriginalExtension(),  \File::get($request->pdf));
			  $post->update([
					'pdf'=> 'pdf/'.$file_name.'.'.$request->pdf->getClientOriginalExtension(),
				]);
			}
			$post->roles()->sync($request->roles);
			$request->session()->flash('success', 'Post "'.$request->title.'" editado correctamente');
			return redirect()->route('posts.index');
		}else
			abort(404);
	}

	public function destroy(Request $request, $id)
	{
		if (\Shinobi::can('post.destroy')) {
	  		$post = Post::find($id);
	  		$title = $post->title;
		  	if($post->delete())
				$request->session()->flash('success', 'Post "'.$title.'" eliminado correctamente');
		  	else
				$request->session()->flash('errors', 'Post "'.$title.'" No se pudo eliminar');
			return redirect()->route('posts.index');
		}else
			abort(404);
	}

	public function viewPDF($id){
		
		if (\Shinobi::can('post.pdf.show')) {
		$post = Post::find($id);
			if($post){
				return view('pdf.view')
			->with('post', $post);
			}
			else
				abort(404);
		}else
			abort(503);
	}

	/*Prices to Post*/

	public function storePrice(Request $request,$post_id){
		$this->validate($request, [
			'price'		=> 'required',
			'time'		=> 'required',
			'type_time' => 'required',
		]);
		PostOncePrice::create([
			'price' => $request->price,
			'time' => $request->time,
			'type_time' => $request->type_time,
			'post_id' => $post_id,
		]);
		$request->session()->flash('success', 'Agregado un nuevo "precio" a la publicación');
		return redirect()->back();
	}

	public function updatePrice(Request $request,$post_id,$once_price_id){
		$this->validate($request, [
			'price'		=> 'required',
			'time'		=> 'required',
			'type_time' => 'required',
		]);
		PostOncePrice::find($once_price_id)->update($request->all());
		$request->session()->flash('success', '"Precio" actualizado');
		return redirect()->back();
	}

	public function destroyPrice(Request $request,$post_id,$once_price_id){
		PostOncePrice::destroy($once_price_id);
		$request->session()->flash('success', 'Precio Eliminado correctamente');
		return redirect()->back();
	}
}

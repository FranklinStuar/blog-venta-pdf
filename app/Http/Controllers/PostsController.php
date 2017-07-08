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
				'kits'=> \App\PostPrice::kitsList()
			]);
		}else
			abort(404);
	}

	public function store(Request $request)
	{
		// dd($request->pdf->getClientOriginalName());
		if (\Shinobi::can('post.new')) {
			$this->validate($request, [
				'title'     	=> 'required',
				'excerpt'   	=> 'required',
				'body'      	=> 'required',
				'meta_keywords'	=> 'required',
			]);

			if ($request->has('price') || $request->has('time')) {
				$this->validate($request, [
					'price'		=> 'required',
					'time'		=> 'required',
					'type_time' => 'required',
				]);
			}

			// Nombre de como se va a guardar 
			$file_name = str_slug(\Carbon\Carbon::now());

			//indicamos que queremos guardar un nuevo archivo en el disco local
			\Storage::disk('local')->put('public/posts/'.$file_name.'.'.$request->image->getClientOriginalExtension(),  \File::get($request->image));
			
			$post = Post::create([
				'author_id'=> \Auth::user()->id,
				'title'=> $request->title,
				'seo_title'=> $request->title,
				'excerpt'=> $request->excerpt,
				'body'=> $request->body,
				'image'=> 'posts/'.$file_name.'.'.$request->image->getClientOriginalExtension(),
				'slug'=> str_slug($request->title,'-'),
				'meta_description'=> $request->excerpt,
				'meta_keywords'=> $request->meta_keywords,
				'status'=> 'PUBLISHED',
				'category_id'=> $request->category_id,
			]);

			if($request->hasFile('pdf')){
				\Storage::disk('local')->put('public/pdf/'.$file_name.'.'.$request->pdf->getClientOriginalExtension(),  \File::get($request->pdf));
		
				\App\Pdf::create([
					'pdf'=> 'pdf/'.$file_name.'.'.$request->pdf->getClientOriginalExtension(),
					'post_id'=>$post->id,
					'name'=>$request->pdf->getClientOriginalName()
				]);
			}
			if ($request->has('price') || $request->has('time')) {
				PostOncePrice::create([
					'price' => $request->price,
					'time' => $request->time,
					'type_time' => $request->type_time,
					'post_id' => $post->id,
				]);
			}
			if($request->has('kits'))
				$post->kits()->sync($request->kits);
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
				'kits'=> \App\PostPrice::kitsList()
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
				'meta_keywords'			=> 'required',
			]);

			$post = Post::find($id);
			$post->update([
				'author_id'			=> \Auth::user()->id,
				'title'				=> $request->title,
				'seo_title'			=> $request->title,
				'excerpt'			=> $request->excerpt,
				'body'				=> $request->body,
				'slug'				=> str_slug($request->title,'-'),
				'meta_description'	=> $request->excerpt,
				'meta_keywords'		=> $request->meta_keywords,
				'status'			=> 'PUBLISHED',
				'category_id'		=> $request->category_id,
			]);
			
			$post->kits()->sync($request->kits);
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

	public function updateImage(Request $request, $post_id){

		if($request->hasFile('image')){
			$post = Post::find($post_id);
			// Nombre de como se va a guardar 
			$file_name = str_slug(\Carbon\Carbon::now());

		  //indicamos que queremos guardar un nuevo archivo en el disco local
		  \Storage::disk('local')->put('public/posts/'.$file_name.'.'.$request->image->getClientOriginalExtension(),  \File::get($request->image));
		  $post->update([
				'image'=> 'posts/'.$file_name.'.'.$request->image->getClientOriginalExtension(),
			]);
			$request->session()->flash('success', 'Imagen actualizada');
			return redirect()->back();
		}
		$request->session()->flash('success', 'No hay imagen para actualizar');
		return redirect()->back();
	}

	public function addPdf(Request $request, $post_id){
		if($request->hasFile('pdf')){
			// Nombre de como se va a guardar 
			$file_name = str_slug(\Carbon\Carbon::now());

			\Storage::disk('local')->put('public/pdf/'.$file_name.'.'.$request->pdf->getClientOriginalExtension(),  \File::get($request->pdf));
		  \App\Pdf::create([
				'pdf'=> 'pdf/'.$file_name.'.'.$request->pdf->getClientOriginalExtension(),
				'languaje'=>'es',
				'post_id'=>$post_id,
				'name'=>$request->pdf->getClientOriginalName()
			]);
			$request->session()->flash('success', 'Pdf agregado a la publicación');
			return redirect()->back();
		}
		return redirect()->back();
	}

	public function destroyPdf(Request $request, $post_id, $pdf_id){
		\App\Pdf::destroy($pdf_id);
		$request->session()->flash('success', 'Pdf eliminado de la publicación');
		return redirect()->back();
	}

	public function viewPDF($pdf_id){
		
		if (\Shinobi::can('post.pdf.show')) {
			$pdf = \App\Pdf::find($pdf_id);
			if($pdf){
				return view('pdf.view')
					->with('post', $pdf);
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

	public function payments($post_id,$post_price_id){
		return view('corporate.posts.only-pay')
			->with('post_id',$post_id)
			->with('price_id',$post_price_id);
	}

	public function paymentPaypal(Request $request,$post_id,$post_price_id){
		$price = PostOncePrice::find($post_price_id);
		if($price->type_time == "day")
			$finish = \Carbon\Carbon::now()->addDays($price->time);
		elseif($price->type_time == "month")
			$finish = \Carbon\Carbon::now()->addMonths($price->time);
		elseif($price->type_time == "year")
			$finish = \Carbon\Carbon::now()->addYears($price->time);

		\App\PostOncePay::create([
			'user_id' => \Auth::user()->id,
			'post_id' => $post_id,
			'finish' => $finish,
			'price' => $price->price,
			'post_once_price_id' => $price->id,
		]);
		$request->session()->flash('success', 'Pago realizado correctamente. Ahora pude disfrutar de lo beneficios de tener una cuenta premium');
		return redirect()->route('show-post',['pID'=>Post::find($post_id)->slug]);
	}

	public function paymentCard($post_id,$post_price_id){
		return view('corporate.posts.payment-card')
			->with('post',Post::find($post_id))
			->with('price',PostOncePrice::find($post_price_id));
	}
	public function makePaymentCard(Request $request){
		// 4770 4410 1188 2871
		$date = $request->input('expiry-month') .'/20'. $request->input('expiry-year');
		$this->validate($request, [
			str_replace(" ", "-", 'credit-card-number') => 'required|ccn',
			'expiry-month' => 'required',
			'expiry-year' => 'required',
			$date => 'ccd',
			'credit-validation-code' => 'required|cvc',
		]);
		$price = PostOncePrice::find($request->prID);
		if($price->type_time == "day")
			$finish = \Carbon\Carbon::now()->addDays($price->time);
		elseif($price->type_time == "month")
			$finish = \Carbon\Carbon::now()->addMonths($price->time);
		elseif($price->type_time == "year")
			$finish = \Carbon\Carbon::now()->addYears($price->time);

		\App\PostOncePay::create([
			'user_id' => \Auth::user()->id,
			'post_id' => $request->pstID,
			'finish' => $finish,
			'price' => $price->price,
			'post_once_price_id' => $price->id,
		]);
		$request->session()->flash('success', 'Pago realizado correctamente. Ahora pude disfrutar de lo beneficios de tener una cuenta premium');
		return redirect()->route('show-post',['pID'=>Post::find($request->pstID)->slug]);
	}


	public function viewKits($post_id){
		if (\Shinobi::can('post.admin.kit.list')) {
			return view('klorofil.posts.kits',[
				'post'=> Post::find($post_id),
			]);
		}else
			abort(404);
	}

	public function getOncePrices(Request $request){
		if($request->json('pID') != null){
			$post = Post::find($request->json('pID'));
			if ($post) {
				return response()->json($post->oncePricesList());
			}
			return response()->json('No se encontró la publicación solicitada',404);
		}
		abort(404);
	}

}

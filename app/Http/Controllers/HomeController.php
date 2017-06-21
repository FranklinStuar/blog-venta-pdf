<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['only'=>['admin','showPDF']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        return view('klorofil.index')
            ->with('users',\App\User::all())
            ->with('posts',Post::all())
            ->with('sponsors',\App\Sponsor::all())
            ->with('visit_posts',\App\PostVisit::all())
            ->with('post_pays',\App\PostPay::all());
    }
    public function index(){
        $posts = Post::orderBy('updated_at','desc')->get();
        $featured = Post::where('featured',true)->first();
        if($featured == null && count($posts)>0)
            $featured = $posts[0];
        return view('welcome')
            ->with('posts',$posts)
            ->with('featured',$featured )
        ;
    }
    public function showPost($post_name){
        $post = Post::where('slug',$post_name)->first();
        if($post){
            return view('corporate.posts.show')
                ->with('post',$post)
            ;
        }else
        abort(404);
    }
    public function showPDF($post_name){
         if (\Shinobi::can('post.pdf.show')) {
            $post = Post::where('slug',$post_name)->first();
            if($post){
                return view('pdf.view')->with('post',$post);
            }else
            abort(404);
        }else
            abort(503);
    }
    public function search(Request $request){
        return view('corporate.posts.post')
            ->with('posts',Post::where('title','like','%'.$request->search.'%')->orWhere('body','like','%'.$request->search.'%')->get())
                ->with('name',$request->search)
                ->with('type','Resultados de la busqueda')
            ->with('search',$request->search)
        ;
    }
    
    public function showCategory($category_slug){
        $category = \App\Category::where('slug',$category_slug)->first();
        if($category != null){
            return view('corporate.posts.post')
                ->with('name',$category->name)
                ->with('type','Categoría')
                ->with('posts',$category->posts)
            ;
        }
        abort(404);
    }

    public function showUser($username){
        $user = \App\User::where('username',$username)->first();
        if($user){
            return view('corporate.posts.post')
                ->with('name',$user->name)
                ->with('type','Autor')
                ->with('posts',$user->posts)
            ;
        }
        abort(404);
    }

    public function config(){
        return view('klorofil.sistem.index');
    }

    public function saveConfig(Request $request){
        if (\Shinobi::can('system.edit')) {
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
            ]);
            \App\System::first()->update($request->all());
            $request->session()->flash('success', 'Configuración del sistema guardaddo correctamente');
            return redirect()->back();
        }
        abort(404);
    }

}

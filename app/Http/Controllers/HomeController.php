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
        $this->middleware('auth');
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
            ->with('visit_posts',\App\PostHistorial::all())
            ->with('post_pays',\App\PostPay::all());
    }
    public function index(){
        $featured = Post::where('featured',true)->first();
        $posts = Post::orderBy('updated_at','desc')->get();
        return view('welcome')
            ->with('posts',$posts)
            ->with('featured',($featured)?$featured:$posts[0])
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
         if (\Shinobi::can('category.list')) {
            $post = Post::where('slug',$post_name)->first();
            if($post){
                return view('pdf.view')->with('post',$post);
            }else
            abort(404);
        }else
            abort(503);
    }
    public function search(Request $request){
        return view('corporate.posts.search')
            ->with('posts',Post::where('title','like','%'.$request->search.'%')->orWhere('body','like','%'.$request->search.'%')->get())
            ->with('search',$request->search)
        ;
    }
    public function showCategory($category_slug){
        return view('corporate.posts.category')
            ->with('category',\App\Category::where('slug',$category_slug)->first())
        ;
    }
}

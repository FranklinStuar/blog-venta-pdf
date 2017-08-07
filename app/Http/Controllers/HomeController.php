<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \Carbon\Carbon;
use Mail;

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
        Carbon::setLocale('es');
    }

    public function welcome(Request $request){
        return view('home');
    }

    public function admin()
    {
        $paysToday = \App\System::totalDay(
                'sponsor_pays',
                'price_month',
                'active',
                'created_at',
                Carbon::now()->format('Y-m-d')
            )->total +  
            \App\System::totalDay(
                'post_pays',
                'price',
                'active',
                'created_at',
                Carbon::now()->format('Y-m-d')
            )->total+  
            \App\System::totalDay(
                'post_once_pays',
                'price',
                'active',
                'created_at',
                Carbon::now()->format('Y-m-d')
            )->total;

        $totalPays = \App\PostPay::where(
                'status',
                'active'
            )->get()
            ->count() + 
            \App\SponsorPay::where(
                'status',
                'active'
            )->get()
            ->count() +
            \App\PostOncePay::where(
                'status',
                'active'
            )->get()
            ->count();

        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalMonth = \App\System::totalBetweenDate(
                'post_pays',
                'price',
                'active',
                'created_at',
                \Carbon\Carbon::create($thisYear, $thisMonth, '01'),
                Carbon::now()
            )->total +
            \App\System::totalBetweenDate(
                'sponsor_pays',
                'price_month',
                'active',
                'created_at',
                \Carbon\Carbon::create($thisYear, $thisMonth, '01'),
                \Carbon\Carbon::now()
            )->total+
            \App\System::totalBetweenDate(
                'post_once_pays',
                'price',
                'active',
                'created_at',
                \Carbon\Carbon::create($thisYear, $thisMonth, '01'),
                \Carbon\Carbon::now()
            )->total; 
        return view('klorofil.index')
            ->with('users',\App\User::count())
            ->with('posts',Post::all())
            ->with('kits',\App\PostPrice::count())
            ->with('sponsors',\App\Sponsor::all())
            ->with('visit_posts',\App\PostVisit::count())
            ->with('visit_pdf',\App\PdfView::count())
            ->with('historial',\App\Historial::count())
            ->with('post_pays',\App\PostPay::where('status','active')->get())
            ->with('post_only_pays',\App\PostOncePay::where('status','active')->get())
            ->with('sponsor_pays',\App\SponsorPay::where('status','active')->get())
            ->with('paysToday',$paysToday)
            ->with('totalPays',$totalPays)
            ->with('totalAll', \App\System::countPays())
            ->with('totalMonth',$totalMonth)
            ;
    }

    public function index(Request $request){
        \App\Historial::create([
            'user_agent'=>$request->server()['HTTP_USER_AGENT'],
            'languaje'=>$request->server()['HTTP_ACCEPT_LANGUAGE'],
            'path'=>$request->url(),
            'ip'=>$request->ip(),
            'created_at'=>\Carbon\Carbon::now(),
            'user_id'=>(\Auth::user())?\Auth::user()->id:null,
        ]);

        $posts = Post::orderBy('updated_at','desc')->get();
        $featured = Post::where('featured',true)->first();
        if($featured == null && count($posts)>0)
            $featured = $posts[0];
        return view('welcome')
            ->with('posts',$posts)
        ;
    }
    public function showPost(Request $request,$post_name){
        $post = Post::where('slug',$post_name)->first();
        $historial = \App\Historial::create([
            'user_agent'=>$request->server()['HTTP_USER_AGENT'],
            'languaje'=>$request->server()['HTTP_ACCEPT_LANGUAGE'],
            'path'=>$request->url(),
            'ip'=>$request->ip(),
            'created_at'=>\Carbon\Carbon::now(),
            'user_id'=>(\Auth::user())?\Auth::user()->id:null,
        ])->id
        \App\PostVisit::create([
            'user_id' => (\Auth::user())? \Auth::user()->id: null,
            'post_id' => $post->id,
            'historial_id' => $historial;
        ]);
        \App\PostHistorial::create([
            'user_id' => (\Auth::user())? \Auth::user()->id: null,
            'post_id' => $post->id,
            'activity' => 'visit',
            'details' => (\Auth::user())? 'Visita desde usuario': 'Visita sin usuario',
            'historial_id' => $historial;
        ]);

        if($post){
            return view('corporate.posts.show')
                ->with('post',$post)
                ->with('categories',\App\Category::all())
            ;
        }else
        abort(404);
    }
    public function showPDF(Request $request,$pdf_id){
        $pdf = \App\Pdf::find($pdf_id);

        if($pdf){        
            \App\PdfView::create([
                'path_pdf' => $pdf->pdf,
                'post_id' => $pdf->post->id,
                'user_id' => \Auth::user()->id,
                'created_at' => \Carbon\Carbon::now(),
                'historial_id' => \App\Historial::create([
                    'user_agent'=>$request->server()['HTTP_USER_AGENT'],
                    'languaje'=>$request->server()['HTTP_ACCEPT_LANGUAGE'],
                    'path'=>$request->url(),
                    'ip'=>$request->ip(),
                    'created_at'=>\Carbon\Carbon::now(),
                    'user_id'=>(\Auth::user())?\Auth::user()->id:null,
                ])->id,
            ]);
            
            if($pdf->post->oncePrices->count() > 0)
                return view('pdf.view')->with('post', $pdf);
            else
                return view('pdf.view-free')->with('post', $pdf);
        }else
        abort(404);
    }

    public function search(Request $request){
        \App\Historial::create([
            'user_agent'=>$request->server()['HTTP_USER_AGENT'],
            'languaje'=>$request->server()['HTTP_ACCEPT_LANGUAGE'],
            'path'=>$request->url(),
            'ip'=>$request->ip(),
            'created_at'=>\Carbon\Carbon::now(),
            'user_id'=>(\Auth::user())?\Auth::user()->id:null,
        ]);
        return view('corporate.posts.post')
            ->with('posts',Post::where('title','like','%'.$request->search.'%')->orWhere('body','like','%'.$request->search.'%')->get())
                ->with('name',$request->search)
                ->with('type','Resultados de la busqueda')
            ->with('search',$request->search)
        ;
    }
    
    public function showCategory(Request $request,$category_slug){
        \App\Historial::create([
            'user_agent'=>$request->server()['HTTP_USER_AGENT'],
            'languaje'=>$request->server()['HTTP_ACCEPT_LANGUAGE'],
            'path'=>$request->url(),
            'ip'=>$request->ip(),
            'created_at'=>\Carbon\Carbon::now(),
            'user_id'=>(\Auth::user())?\Auth::user()->id:null,
        ]);
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

    public function showUser(Request $request,$username){
        \App\Historial::create([
            'user_agent'=>$request->server()['HTTP_USER_AGENT'],
            'languaje'=>$request->server()['HTTP_ACCEPT_LANGUAGE'],
            'path'=>$request->url(),
            'ip'=>$request->ip(),
            'created_at'=>\Carbon\Carbon::now(),
            'user_id'=>(\Auth::user())?\Auth::user()->id:null,
        ]);
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

    public function free(Request $request){
        
        \App\Historial::create([
            'user_agent'=>$request->server()['HTTP_USER_AGENT'],
            'languaje'=>$request->server()['HTTP_ACCEPT_LANGUAGE'],
            'path'=>$request->url(),
            'ip'=>$request->ip(),
            'created_at'=>\Carbon\Carbon::now(),
            'user_id'=>(\Auth::user())?\Auth::user()->id:null,
        ]);
        return view('corporate.posts.post')
            ->with('name','Publicaciones Gratis')
            ->with('type','Publicaciones Gratis')
            ->with('posts',Post::free())
        ;
        abort(404);
    }

}

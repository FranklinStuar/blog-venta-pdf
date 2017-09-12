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
            ->with('historial',\App\Historial::count() - \App\SponsorPrint::count())
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

        $posts = Post::orderBy('created_at','desc')->paginate(30);
        return view('flat.index')
            ->with('posts',$posts)
        ;
    }
    public function showPost(Request $request,$category_slug,$post_name){
        $post = Post::where('slug',$post_name)->first();

        if($post){
            $historial = \App\Historial::create([
                'user_agent'=>$request->server()['HTTP_USER_AGENT'],
                'languaje'=>$request->server()['HTTP_ACCEPT_LANGUAGE'],
                'path'=>$request->url(),
                'ip'=>$request->ip(),
                'created_at'=>\Carbon\Carbon::now(),
                'user_id'=>(\Auth::user())?\Auth::user()->id:null,
            ])->id;
            \App\PostVisit::create([
                'user_id' => (\Auth::user())? \Auth::user()->id: null,
                'post_id' => $post->id,
                'historial_id' => $historial
            ]);
            \App\PostHistorial::create([
                'user_id' => (\Auth::user())? \Auth::user()->id: null,
                'post_id' => $post->id,
                'activity' => 'visit',
                'details' => (\Auth::user())? 'Visita desde usuario': 'Visita sin usuario',
                'historial_id' => $historial
            ]);

            return view('flat.posts.show')
                ->with('post',$post)
                ->with('categories',\App\Category::all())
                ->with('token',\Session::get('_token'))
            ;
        }else
        abort(404);
    }

    public function downloadZip(Request $request,$service,$post_slug,$zip_id){
        $post = Post::where('slug',$post_slug)->first();
        if(!$post)
            abort(404,'Publicación no encontrada');
        if(\Auth::user() && !\Auth::user()->postStatus($post->id))
            abort(403,'Permiso denegado');
        if(\Session::get('_token') != $request->token)
            abort(403,'Permiso denegado');
        $zip = \App\ZipFile::find($zip_id);
        if($zip && $zip->post_id == $post->id){ 
            return redirect(\Storage::url($zip->file));
        }
        
    }
    public function showPDF(Request $request,$service,$post_slug,$pdf_name,$pdf_id){
        $post = Post::where('slug',$post_slug)->first();
        if(!$post)
            abort(404,'Publicación no encontrada');
        if(\Auth::user() && !\Auth::user()->postStatus($post->id))
            abort(403,'Permiso denegado');
        $pdf = \App\Pdf::find($pdf_id);

        if($pdf && $pdf->post_id == $post->id){        
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
        return view('flat.posts.post')
        ->with('posts',Post::where('title','like','%'.$request->search.'%')->orWhere('body','like','%'.$request->search.'%')->paginate(5))
        ->with('name',"Resultados de :".$request->search)
        ->with('search',$request->search)
        ;
    }
    
    public function showPageOrService(Request $request,$page){

        if($page == 'quienes-somos' || $page == 'cuentas-premium' || $page == 'politicas-condiciones' || $page == 'partners'){
            $system = \App\System::first();
            if($page == 'quienes-somos'){
                $title = 'Quienes Somos';
                $context = $system->quienes_somos;
            }
            else if($page == 'cuentas-premium'){
                $title = 'Cuentas de pago';
                $context = $system->    cuentas_premium;
            }
            else if($page == 'politicas-condiciones'){
                $title = 'Políticas y condiciones';
                $context = $system->politicas_condiciones;
            }
            else  if($page == 'partners'){
                $title = 'Acerca de como hacer publicidad y ser partenr';
                $context = $system->publicidad;
            }
            return view('flat.system-page',[
                'title'=> $title,
                'context'=>$context,
                'page'=>$page,
            ]);
        }
        if($page == 'contacts'){
            return view('flat.contacts');
        }
        if($page == 'faq'){
            return view('flat.faq')->with('faqs',\App\Faq::all());
        }
        \App\Historial::create([
            'user_agent'=>$request->server()['HTTP_USER_AGENT'],
            'languaje'=>$request->server()['HTTP_ACCEPT_LANGUAGE'],
            'path'=>$request->url(),
            'ip'=>$request->ip(),
            'created_at'=>\Carbon\Carbon::now(),
            'user_id'=>(\Auth::user())?\Auth::user()->id:null,
        ]);
        $category = \App\Category::where('slug',$page)->first();
        if($category != null){
            return view('flat.posts.post')
                ->with('name',$category->name)
                ->with('subCategories',$category->subCategories)
                ->with('type','Categoría')
                ->with('posts',Post::where('category_id',$category->id)->paginate(20))
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
            return view('flat.posts.post')
                ->with('name',$user->name)
                ->with('type','Autor')
                ->with('posts',Post::where('author_id',$user->id)->paginate(5))
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
        return view('flat.posts.post')
            ->with('name','Publicaciones Gratis')
            ->with('type','Publicaciones Gratis')
            ->with('posts',Post::free())
        ;
        abort(404);
    }

}

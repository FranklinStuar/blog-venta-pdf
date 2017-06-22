<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;

class CreateHistorialServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {

        $historial = \App\Historial::create([
            'user_agent'=>$request->server()['HTTP_USER_AGENT'],
            'languaje'=>$request->server()['HTTP_ACCEPT_LANGUAGE'],
            'path'=>$request->url(),
            'ip'=>$request->ip(),
            'created_at'=>\Carbon\Carbon::now(),
        ]);
        
        View::composer('*', function ($view) use($historial) {
            $historial->update(['user_id'=>(\Auth::user())?\Auth::user()->id:null,]);
        });
        
        View::composer('klorofil.*', function ($view) {
            if (!\Shinobi::can('dashboard.admin')) {
                abort(404);
            }
        });


        View::composer(['corporate.index','corporate.posts.*'], function ($view) use($historial) {
            if (\Shinobi::can('sponsor.quit.others') == false) {
                $pay_sponsor = \App\SponsorPay::where('finish_date', '>' ,\Carbon\Carbon::now())
                    ->where('prints','>','print_count')
                    ->where('status','active')
                    ->first();
                if($pay_sponsor != null)
                {
                    $pay_sponsor->update(['print_count' => $pay_sponsor->print_count +1]);
                    if($pay_sponsor->print_count == $pay_sponsor->prints )
                        $pay_sponsor->update(['status' => 'finish']);
                    \App\SponsorPrint::create([
                        'sponsor_id' => $pay_sponsor->sponsor->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'historial_id' => $historial->id,
                    ]);
                    $view->with('sponsor_show', $pay_sponsor->sponsor);
                }
            }
        });

        View::composer(['corporate.posts.show','pdf.view'], function ($view) use($historial)  {
            \App\PostHistorial::create([
                'user_id' => (\Auth::user())? \Auth::user()->id: null,
                'post_id' => $view->post->id,
                'activity' => 'visit',
                'details' => (\Auth::user())? 'Visita desde usuario': 'Visita sin usuario',
                'historial_id' => $historial->id,
            ]);
            \App\PostVisit::create([
                'post_id' => $view->post->id,
                'user_id' => (\Auth::user())? \Auth::user()->id: null,
                'historial_id' => $historial->id,
                'created_at' => \Carbon\Carbon::now(),
            ]);
        });

        View::composer('pdf.view', function ($view) use($historial)  {
            \App\PdfView::create([
                'path_pdf' => $view->post->pdf,
                'post_id' => $view->post->id,
                'user_id' => \Auth::user()->id,
                'created_at' => \Carbon\Carbon::now(),
                'historial_id' => $historial->id,
            ]);
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

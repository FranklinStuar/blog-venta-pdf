<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CreateHistorialServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        // $date = \Carbon\Carbon::now();
        // $historial = \App\Historial::create([
        //     'user_agent'=>$request->server()['HTTP_USER_AGENT'],
        //     'languaje'=>$request->server()['HTTP_ACCEPT_LANGUAGE'],
        //     'path'=>$request->url(),
        //     'ip'=>$request->ip(),
        //     'created_at'=>$date,
        // ]);

        // View::composer('*', function ($view) use($historial) {
        //     $historial->update(['user_id'=>(\Auth::user())?\Auth::user()->id:null,]);
        // });
        
        // View::composer('klorofil.*', function ($view) {
        // });
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

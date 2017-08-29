<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class CategoriesMenuProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['flat.*','corporate.*'], function ($view) {
            $view->with('categories', \App\Category::where('parent_id',null)->get());
        });
        View::composer(['klorofil.*'], function ($view) {
            $view->with('messagesContact',\App\MessageContact::where('status','sin_revisar')->orWhere('status','revisado')->limit(5)->get());
            $view->with('messagesNoView',\App\MessageContact::where('status','sin_revisar')->get()->count());
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function index()
    {

        return view('klorofil.index')
            ->with('users',\App\User::all())
            ->with('posts',\App\Post::all())
            ->with('sponsors',\App\Sponsor::all())
            ->with('visit_posts',\App\PostHistorial::all())
            ->with('post_pays',\App\PostPay::all())
        ;
    }
}

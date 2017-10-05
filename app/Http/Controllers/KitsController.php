<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostPrice;

class KitsController extends Controller
{
    public function list(){

        return view('flat.kits.index')
            ->with('kits',PostPrice::all())
        ;
    }
}

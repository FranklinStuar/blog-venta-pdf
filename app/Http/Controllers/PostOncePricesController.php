<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostOncePricesController extends Controller
{
    
	public function getDetail(Request $request){
		if($request->json('popID') != null){
			$price = \App\PostOncePrice::find($request->json('popID'));
			if ($price) {
				if($price->type_time == "day")
					$finish = \Carbon\Carbon::now()->addDays($price->time)->format('d/m/Y');
				elseif($price->type_time == "month")
					$finish = \Carbon\Carbon::now()->addMonths($price->time)->format('d/m/Y');
				elseif($price->type_time == "year")
					$finish = \Carbon\Carbon::now()->addYears($price->time)->format('d/m/Y');

				return response()->json([
					'finish' => $finish,
					'price' => $price->price,
				]);
			}
			return response()->json('No se encontró Detalle solicitado',404);
		}
		abort(404);
	}

}

@extends('flat.layout')

@section('title')
	Nueva publicidad - Neurocodigo
@endsection


@section('container')

	<div class="container">
		
        <div class="gap"></div>
        <h1 class="center">Nueva Publicidad</h1>
        <p class="lead center">Los campos con " * " Son obligatorios.</p>
        <div class="gap"></div>

		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">

				
				@include('flat.sponsors.form',['url' => route('sponsor.save',['sprice'=>$premium->id.'x'.$premium->price_month]), 'method' => 'POST','edit'=>false])
				

			</div>
		</div>
	</div>

@endsection


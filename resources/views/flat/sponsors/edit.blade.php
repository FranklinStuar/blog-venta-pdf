@extends('flat.layout')

@section('title')
	Editar publicidad - Neurocodigo
@endsection


@section('container')

	<div class="container">
		
        <div class="gap"></div>
        <h1 class="center">Editar Publicidad</h1>
        <p class="lead center">Los campos con " * " Son obligatorios.</p>
        <div class="gap"></div>

		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">

				@include('flat.sponsors.form',['url' => route('sponsor.save-edit',['sID'=>$sponsor->id]), 'method' => 'post','edit'=>true])

			</div>
		</div>
	</div>

@endsection


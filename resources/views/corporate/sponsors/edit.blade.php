@extends('corporate.layout')

@section('title')
	Información de la publicidad - Sistema
@endsection


@section('container')
	<main>
		<!--Main layout-->
		<div class="container">

			<center>
				<h1>Información de la publicidad</h1>
			</center>



			<br><br>
				<center>
				</center>
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8 white">

					<p>Por favor llene los campos más adecuados a usted para que su publicidad salga en todos las páginas de Sistema</p>
					
					<hr class="extra-margins">
					
					@include('corporate.sponsors.form',['url' => route('sponsor.save-edit',['sID'=>$sponsor->id]), 'method' => 'post','edit'=>true])
				
				</div>
			</div>

		</div>
		<!--/.Main layout-->
	</main>


@endsection


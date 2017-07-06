
@extends('corporate.layout')

@section('title')
	Realizar publicidad - Neurocodigo
@endsection


@section('container')
	<main>
		<!--Main layout-->
		<div class="container">

			<center>
				<h1>Relice su pago</h1>
			</center>


			<br><br>
			<div class="row">
				<div class="col-sm-4">
					<div class="panel panel-default">
						<div class="panel-header">
							<center>
						  	@if($sponsor_premium->featured)
						  		<h3><b>$ {{ $sponsor_premium->price_month }} USD</b></h3>
					  		@else
						  		<h4>$ {{ $sponsor_premium->price_month }} USD</h4>
					  		@endif
						  	<small>
						  		<b>{{ $sponsor_premium->prints }}</b> impresiones x <b>{{ $sponsor_premium->months }}</b>
						  		@if($sponsor_premium->months == 1)
										Mes
									@else
										Meses
						  		@endif
						  	</small>
					  	</center> 
						</div>
						<div class="panel-body">
					  	@foreach($sponsor_premium->details as $detail)
								<hr class="extra-margins">
							  <center>
								  	<b>{{ $detail->title }}</b> <br>
								  	<small>{{ $detail->excerpt }}</small>
							  </center>
						  @endforeach
						</div>
					</div>

					
				</div>

				<div class="col-sm-8">
					
					<div class="row">
						<div class="col-sm-4">Titulo</div>
						<div class="col-sm-8">{{ $sponsor->name }}</div>
					</div>
					<hr>

					<div class="row">
						<div class="col-sm-4">Descripción</div>
						<div class="col-sm-8">{{ $sponsor->excerpt }}</div>
					</div>
					<hr>

					<div class="row">
						<div class="col-sm-4">Sitio Web</div>
						<div class="col-sm-8">{{ $sponsor->web }}</div>
					</div>
					<hr>

					<div class="row">
						<div class="col-sm-4">Dirección</div>
						<div class="col-sm-8">{{ $sponsor->direccion }}</div>
					</div>
					<hr>

					<div class="row">
						<div class="col-sm-4">Teléfono</div>
						<div class="col-sm-8">{{ $sponsor->phone }}</div>
					</div>
					<hr>

					<div class="row">
						<div class="col-sm-4">Facebok</div>
						<div class="col-sm-8">http://www.facebook.com/{{ $sponsor->url_facebook }}</div>
					</div>
					<hr>

					<div class="row">
						<div class="col-sm-4">Twitter</div>
						<div class="col-sm-8">http://www.twitter.com/{{ $sponsor->url_twitter }}</div>
					</div>
					<hr>

					<div class="row">
						<div class="col-sm-4">Instagram</div>
						<div class="col-sm-8">http://www.instagram.com/{{ $sponsor->url_instagram }}</div>
					</div>
					<hr>

					<div class="row">
						<div class="col-sm-4">Youtube</div>
						<div class="col-sm-8">http://www.youtube.com/{{ $sponsor->url_youtube }}</div>
					</div>
					<hr>

				</div>
			</div>
			<hr class="extra-margins">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<span>Use nuestras formas de pago por internet o acérquese a las oficinas en 
						{{ $system->direccion }} - Cuenca - Ecuador 
					</span>
					
					<hr class="extra-margins">

					<a href="{{ route('sponsor.make-payment-paypal',['sprice'=>$sponsor_premium->id.'x'.$sponsor_premium->price_month,'sp'=>$sponsor->id]) }}" class="type-payment">
						<i class="fa fa-paypal" aria-hidden="true"></i> 
						<span>Paypal</span>
					</a>
					
					<a href="{{ route('sponsor.make-payment-card',['sprice'=>$sponsor_premium->id.'x'.$sponsor_premium->price_month,'sp'=>$sponsor->id]) }}" class="type-payment">
						<i class="fa fa-credit-card" aria-hidden="true"></i> 
						<span>Tarjeta</span>
					</a>
				</div>
			</div>

		</div>
		<!--/.Main layout-->
	</main>


@endsection


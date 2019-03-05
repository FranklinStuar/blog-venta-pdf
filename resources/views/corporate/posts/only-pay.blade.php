@extends('corporate.layout')

@section('title')
	Formas de pago | Sistema
@endsection

@section('container')
	<main>
		<!--Main layout-->
		<div class="container">

			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6 concept">
					<h2>¡Importante!</h2><hr>
					<p>Actualmente la página dispone solo de pagos en paypal</p>
					<p>Puede concatar directamente al correo 
						<b><a href="mailto:{{$system->email}}">{{$system->email}}</a></b>
					</p>
					<p>Teléfonos: <b>{{$system->telefono}}</b> - <b>{{$system->celular}}</b></p>
					<p>Dirección: <b>{{$system->direccion}}</b> </p>

				</div>

				
				<div class="col-sm-6 concept">
					<span>Use nuestras formas de pago por internet o acérquese a las oficinas en 
						{{ $system->direccion }} 
					</span>
					
					<hr class="extra-margins">

					<a href="{{ route('post.payment-paypal',['pID'=>$post_id,'prID'=>$price_id]) }}" class="type-payment">
						<i class="fa fa-paypal" aria-hidden="true"></i> 
						<span>Paypal</span>
					</a>
					{{-- 
					<a href="{{ route('post.payment-card',['pID'=>$post_id,'prID'=>$price_id]) }}" class="type-payment">
						<i class="fa fa-credit-card" aria-hidden="true"></i> 
						<span>Tarjeta</span>
					</a> --}}
				</div>
			</div>


		</div>
		<!--/.Main layout-->
	</main>

@endsection


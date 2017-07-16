@extends('corporate.layout')

@section('title')
	Formas de pago | Neurocodigo
@endsection

@section('container')
	<main>
		<!--Main layout-->
		<div class="container">

			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6 concept">
					<span>Use nuestras formas de pago por internet o acérquese a las oficinas en 
						{{ $system->direccion }} 
					</span>
					
					<hr class="extra-margins">

					<a href="{{ route('post.payment-paypal',['pID'=>$post_id,'prID'=>$price_id]) }}" class="type-payment">
						<i class="fa fa-paypal" aria-hidden="true"></i> 
						<span>Paypal</span>
					</a>
					
					<a href="{{ route('post.payment-card',['pID'=>$post_id,'prID'=>$price_id]) }}" class="type-payment">
						<i class="fa fa-credit-card" aria-hidden="true"></i> 
						<span>Tarjeta</span>
					</a>
				</div>
			</div>


		</div>
		<!--/.Main layout-->
	</main>

@endsection


@extends('klorofil.layout')
@section('content')
	<h3 class="page-title"><a href="{{ route('pay-post.index') }}">Pago de Premium para Posts </a></h3>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel">
				<div class="panel-body">

					<div class="title-detail-2">
						<span class="title">Fecha de inicio</span>
						<span class="detail">{{ $pay->created_at }}</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Fecha de finalización</span>
						<span class="detail">{{ $pay->finish }}</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Usuario</span>
						<span class="detail">{{ $pay->user->name }}</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Rol</span>
						<span class="detail">{{ $pay->role->name }}</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Premium</span>
						<span class="detail">{{ $pay->postPrice->name }}</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Precio</span>
						<span class="detail">$ {{ $pay->price }}</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Forma de pago</span>
						<span class="detail">
							@if($pay->method_payment == "cash")
								Efectivo
							@elseif($pay->method_payment == "deposit")
								Depósito Bancario
							@elseif($pay->method_payment == "card")
								Tarjeta cŕedito - débito
							@elseif($pay->method_payment == "paypal")
								Paypal
							@endif
						</span>
					</div>


					<div class="title-detail-2">
						<span class="title">Estado</span>
						<span class="detail">
							@if($pay->status == "active")
								<span class="badge badge-info">Activo</span>
							@elseif($pay->status == "cancel")
								<span class="badge badge-danger">Cancelado</span>
							@elseif($pay->status == "finish")
								<span class="badge badge-danger">Finalizado</span>
							@endif
						</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Observación</span>
						<span class="detail">{{ $pay->observations }}</span>
					</div>


				</div>
			</div>
		</div>
	</div>
	
@endsection

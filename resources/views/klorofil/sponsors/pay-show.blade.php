@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Pago de la publicidad: "<a href="{{ route('sponsors.show',['sID'=>$pay->sponsor->id]) }}">{{ $pay->sponsor->name }}</a>"</h3>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel">
				<div class="panel-body">

					<div class="title-detail-2">
						<span class="title">Fecha de inicio</span>
						<span class="detail">{{ $pay->created_at }}</span>
					</div>
					
					<div class="title-detail-2">
						<span class="title">Fecha de finalización</span>
						<span class="detail">{{ $pay->finish_date }}</span>
					</div>


					<div class="title-detail-2">
						<span class="title">Precio</span>
						<span class="detail">$ {{ $pay->price_month }}</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Método de pago</span>
						<span class="detail">
							@if($pay->method_payment == 'card')
								<span class="badge badge-info">Tarjeta</span>
							@elseif($pay->method_payment == 'paypal')
								<span class="badge badge-info">Paypal</span>
							@elseif($pay->method_payment == 'deposit')
								<span class="badge badge-info">Depósito bancario</span>
							@elseif($pay->method_payment == 'cash')
								<span class="badge badge-info">Efectivo</span>
							@endif
						</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Impresiones permitidas</span>
						<span class="detail">{{ $pay->prints }}</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Impresiones usadas</span>
						<span class="detail">{{ $pay->print_count }}</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Estado del pago</span>
						<span class="detail">
							@if($pay->status == 'active')
								<span class="badge badge-info">Activo</span>
								<a href="{{ route('sponsor-pays.cancel',['pID'=>$pay->id]) }}" class="link-red">Cancelar</a>
							@elseif($pay->status == 'finish')
								<span class="badge badge-danger">Finalizado</span>
								<a href="{{ route('sponsor-pays.active',['pID'=>$pay->id]) }}" class="link-info">Activar</a>
							@elseif($pay->status == 'canceled')
								<span class="badge badge-danger">Cancelado</span>
								<a href="{{ route('sponsor-pays.active',['pID'=>$pay->id]) }}" class="link-info">Activar</a>
							@else
								<span class="badge badge-danger">Sin estado</span>
							@endif
						</span>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection

@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Activar Pago de la publicidad: "<a href="{{ route('sponsors.show',['sID'=>$pay->sponsor->id]) }}">{{ $pay->sponsor->name }}</a>"</h3>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel">
				<div class="panel-body">
					{!! Form::open(['url' => route('sponsor-pays.save-active',['pID'=>$pay->id]) ]) !!}
						<div class="title-detail-2">
							<span class="title">Fecha de inicio</span>
							<span class="detail">{{ $pay->created_at }}</span>
						</div>
						
						<div class="title-detail-2">
							<span class="title">Fecha de finalización</span>
	            <input id="finish_date" type="text" class="detail" name="finish_date" value="{{ $pay->finish_date }}" required autofocus>

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
	            <input id="prints" type="text" class="detail" name="prints" value="{{ $pay->prints }}" required autofocus>
						</div>

						<div class="title-detail-2">
							<span class="title">Impresiones usadas</span>
	            <input id="print_count" type="text" class="detail" name="print_count" value="{{ $pay->print_count }}" required autofocus>
						</div>

						<div class="title-detail-2">
							<center>
								<button class="btn btn-primary">Activar</button>
								<a href="{{ route('sponsor-pays.show',['pID'=>$pay->id]) }}" class="btn btn-danger">Cancelar</a>
							</center>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection

@extends('corporate.layout')

@section('title')
	Precios publicidad | Neurocodigo
@endsection


@section('container')
	<main>
		<!--Main layout-->
		<div class="container">
			<center><h1>Lista de precios para publicidad</h1></center>

			<br><br>

			<div class="group-list-sponsors">
			<div class="group-list-sponsors">
				@foreach($premiums as $premium)
					<div class="panel-sponsor @if($premium->featured) panel-sponsor-active @endif ">
						<div class="panel ">
							<div class="panel-header">
								<span class="title-sponsor">$ {{ $premium->price_month }} USD</span>
							  	<span>
							  		<b>{{ $premium->prints }}</b> impresiones x <b>{{ $premium->months }}</b>
							  		@if($premium->months == 1) Mes @else Meses @endif
							  	</span>
							</div>
							<div class="panel-body">
								<ul>
							  		@foreach($premium->details as $detail)
										<li>
										  	<b>{{ $detail->title }}</b> <br>
										</li>
								  	@endforeach
								</ul>
								<center>
								@if(isset($sponsor))
					  			<a href="{{ route('sponsor.payment',['sprice'=>$premium->id.'x'.$premium->price_month,'sp'=>$sponsor->id]) }}" class="btn ">Hacer pedido</a>
								@else
					  			<a href="{{ route('sponsor.create',['sprice'=>$premium->id.'x'.$premium->price_month]) }}" class="btn ">Hacer pedido</a>
					  			@endif
						  		</center>
							</div>
						</div>
					</div>
				@endforeach
			</div>


		</div>
		<!--/.Main layout-->
	</main>


@endsection


@extends('corporate.layout')

@section('title')
	Precios publicidad | Neurocodigo
@endsection


@section('container')
	<main>
		<!--Main layout-->
		<div class="container">
<style>
	
</style>
			<center><h1>Lista de precios para publicidad</h1></center>

			<br><br>

			<div class="row">
				@foreach($premiums as $premium)
					<div class="col-sm-3">
						<div class="panel panel-sponsor white">
							<div class="panel-header">
								<center>
								  	@if($premium->featured)
								  		<h3><b>$ {{ $premium->price_month }} USD</b></h3>
							  		@else
								  		<h4>$ {{ $premium->price_month }} USD</h4>
							  		@endif
							  	<small>
							  		<b>{{ $premium->prints }}</b> impresiones x <b>{{ $premium->months }}</b>
							  		@if($premium->months == 1)
											Mes
										@else
											Meses
							  		@endif
							  	</small>
						  	</center> 
						  	<hr class="extra-margins">				  	
							</div>
							<div class="panel-body">
								@if(Shinobi::can('premium.detail.list'))
							  	@foreach($premium->details as $detail)
									  <center>
										  	<b>{{ $detail->title }}</b> <br>
										  	<small>{{ $detail->excerpt }}</small>
									  </center>
										<hr class="extra-margins">
								  @endforeach
								@endif
								<center>
								@if(isset($sponsor))
					  			<a href="{{ route('sponsor.payment',['sprice'=>$premium->id.'x'.$premium->price_month,'sp'=>$sponsor->id]) }}" class="btn @if(!$premium->featured) btn-success  btn-sm @else btn-primary @endif ">Hacer pedido</a>
								@else
					  			<a href="{{ route('sponsor.create',['sprice'=>$premium->id.'x'.$premium->price_month]) }}" class="btn @if(!$premium->featured) btn-success  btn-sm @else btn-primary @endif ">Hacer pedido</a>
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


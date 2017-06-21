@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Precios para premium de Sponsor</h3>
	<div class="panel">
		<div class="panel-body">
			<div class="col-sm-4">
				@if (Shinobi::can('sponsor.price.new'))
					<a href="{{ route('premium-sponsor.create') }}" class="btn btn-primary">Nuevo Precio  <span class="lnr lnr-plus-circle"></span></a>
				@endif
			</div>
		</div>
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th></th>{{-- Favorito --}}
						<th></th>
						<th>Precio Mes</th>
						<th>Precio Día</th>
						<th>Meses de contrato</th>
						<th>Detalles</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($premiums as  $premium)
						<tr>
							<td>
								@if($premium->featured) 
									<a><span class=" glyphicon glyphicon-star"></span></a>
								@else
									<a class="add-feature" href="{{ route('premium-sponsor.add-feature',['pID'=>$premium->id]) }}">
										<span class=" glyphicon glyphicon-star-empty"></span>
									</a> 
								@endif 
							</td>
							<td><img class="img-table" src="{{ url('images/'.$premium->avatar) }}" alt=""></td>
							<td>$ {{ $premium->price_month }}</td>
							<td>$ {{ $premium->price_day }}</td>
							<td>{{ $premium->months }} mes(es)</td>
							<td>
								<ul>
										@foreach($premium->details as $detail)
											<li>{{ $detail->title }}</li>
										@endforeach
								</ul>
							</td>
							<td>
								@if (Shinobi::can('sponsor.price.edit'))
									{!! link_to_route('premium-sponsor.edit', "",['i'=>$premium->id], ['class' =>'glyphicon glyphicon-pencil']) !!}
								@endif
								@if (Shinobi::can('sponsor.price.destroy'))
									{!! Form::open(['route' => ['premium-sponsor.destroy',$premium->id],'method'=>'DELETE','class'=>'destroy']) !!}
										<button class="btn btn-link glyphicon glyphicon-trash" style="transform: none;"></button>
									{!! Form::close() !!}
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
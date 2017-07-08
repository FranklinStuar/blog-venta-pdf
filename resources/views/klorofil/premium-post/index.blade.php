@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Precios de kits de los Posts</h3>
	<div class="panel">
		<div class="panel-body">
			<div class="col-sm-4">
				@if (Shinobi::can('post.admin.price.new'))
					<a href="{{ route('premium-post.create') }}" class="btn btn-primary">Nuevo kit  <span class="lnr lnr-plus-circle"></span></a>
				@endif
			</div>
		</div>
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th></th>
						<th>Nombre</th>
						<th>Precio</th>
						<th>Tiempo de uso</th>
						<th># Posts</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($premiums as  $index => $premium)
						<tr>
							<td>{{ $index+1 }}</td>
							<td> {{ $premium->name }} </td>
							<td> $ {{ $premium->price }} </td>
							<td> {{ $premium->time() }} </td>
							<td> 
								<a href="{{ route('premium-post.view-post',['kID'=>$premium->id]) }}">
									{{ count($premium->posts) }}  Posts
								</a>
							</td>
							{{-- <td>
								<ul>
										@foreach($premium->details as $detail)
											<li>{{ str_limit($detail->title,'50') }}</li>
										@endforeach
								</ul>
							</td> --}}
							<td>
								@if (Shinobi::can('post.admin.price.edit'))
									{!! link_to_route('premium-post.edit', "",['i'=>$premium->id], ['class' =>'glyphicon glyphicon-pencil']) !!}
								@endif
								@if (Shinobi::can('post.admin.price.destroy'))
									{!! Form::open(['route' => ['premium-post.destroy',$premium->id],'method'=>'DELETE','class'=>'destroy']) !!}
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
@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Publicidad</h3>
	<div class="panel">
		<div class="panel-body">
			<div class="col-sm-4">
				@if (Shinobi::can('sponsor.admin.add'))
					<a href="{{ route('sponsors.create') }}" class="btn btn-primary">Nueva Publicidad  <span class="lnr lnr-plus-circle"></span></a>
				@endif
			</div>
		</div>
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Estado</th>
						<th>Usuario</th>
						<th>Pagos</th>
						<th>Acciones</th>
					</tr>
				</thead>
				
				<tbody>
					@foreach($sponsors as $index => $sponsor)
						<tr>
							<td>{{ $index+1 }}</td>
							<td>{{ $sponsor->name }}</td>
							<td>
								@if($sponsor->status())
									<span class="badge badge-info">Activo</span>
								@else
									<span class="badge badge-danger">Inactivo</span>
								@endif
							</td>
							<td>{{ $sponsor->user->name }}</td>
							<td>{{ count($sponsor->pays) }}</td>
							<td>
								@if (Shinobi::can('sponsor.admin.edit'))
									{!! link_to_route('sponsors.edit', "",['i'=>$sponsor->id], ['class' =>'glyphicon glyphicon-pencil']) !!}
								@endif
								@if (Shinobi::can('sponsor.admin.show'))
									{!! link_to_route('sponsors.show', "",['i'=>$sponsor->id], ['class' =>'glyphicon glyphicon-eye-open']) !!}
								@endif
								@if (Shinobi::can('sponsor.admin.destroy'))
									{!! Form::open(['route' => ['sponsors.destroy',$sponsor->id],'method'=>'DELETE','class'=>'destroy']) !!}
										<button class="btn btn-link glyphicon glyphicon-trash"></button>
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

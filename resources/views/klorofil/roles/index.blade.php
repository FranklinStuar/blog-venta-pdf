@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Roles de Usuario</h3>
	<div class="panel">
		<div class="panel-body">
			<div class="col-sm-4">
				<a href="{{ route('roles.create') }}" class="btn btn-primary">Nuevo Rol  <span class="lnr lnr-plus-circle"></span></a>
			</div>
		</div>
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Slug</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($roles as $index => $role)
						<tr>
							<td>{{ $index+1 }}</td>
							<td>{{ $role->name }}</td>
							<td>{{ $role->slug }}</td>
							<td>
								@if(Shinobi::can('role.show.default') || ($role->slug != 'superadmin' && $role->slug != 'admin' && $role->slug != 'normaluser') )
									@if (Shinobi::can('role.edit'))
										{!! link_to_route('roles.edit', "",['i'=>$role->id], ['class' =>'glyphicon glyphicon-pencil']) !!}
									@endif
									@if (Shinobi::can('role.show'))
										{!! link_to_route('roles.show', "",['i'=>$role->id], ['class' =>'glyphicon glyphicon-eye-open']) !!}
									@endif
									@if (Shinobi::can('role.destroy'))
										{!! Form::open(['route' => ['roles.destroy',$role->id],'method'=>'DELETE','style'=>'display: inline;','class'=>'destroy']) !!}
											<button class="btn btn-link glyphicon glyphicon-trash" ></button>
										{!! Form::close() !!}
									@endif
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
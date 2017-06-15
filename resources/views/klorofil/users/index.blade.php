@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Usuarios</h3>
	<div class="panel">
		<div class="panel-body">
			<div class="col-sm-4">
				@if (Shinobi::can('user.new') || Shinobi::can('dashboard.superadmin'))
					<a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo Usuario  <span class="lnr lnr-plus-circle"></span></a>
				@endif
			</div>
		</div>
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th></th>
						<th>Nombre</th>
						<th>Nombre de usuario</th>
						<th>Correo Electrónico</th>
						<th>Rol</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $index => $user)
						<tr>
							<td>{{ $index+1 }}</td>
							<td><img class="img-table" src="{{ url('images/'.$user->avatar) }}" alt=""></td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->username }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->getRole()['name'] }}</td>
							<td>
								@if (Shinobi::can('user.edit') || Shinobi::can('dashboard.superadmin'))
									{!! link_to_route('users.edit', "",['i'=>$user->id], ['class' =>'glyphicon glyphicon-pencil']) !!}
								@endif
								@if (Shinobi::can('user.destroy') || Shinobi::can('dashboard.superadmin'))
									{!! Form::open(['action' => ['UsersController@destroy',$user->id],'method'=>'DELETE','style'=>'display: inline;','class'=>'destroy']) !!}
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
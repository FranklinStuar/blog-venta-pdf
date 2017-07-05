@extends('klorofil.layout')
@section('content')
	<h3 class="page-title"> <a href="{{ route('users.index') }}">Usuario: </a> {{$user->name}}</h3>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">Información básica</div>
				<div class="panel-body">
					<div class="title-detail-2">
						<span class="title">Nombre</span>
						<span class="detail">{{ $user->name }}</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Username</span>
						<span class="detail">{{ $user->username }}</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Correo</span>
						<span class="detail">{{ $user->email }}</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Fecha de nacimiento</span>
						<span class="detail">
							@if($user->date_birth != null)
								{{ $user->date_birth }}
							@else
								No tiene fecha 
							@endif
						</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Género</span>
						<span class="detail">
							@if($user->gender == 'men')
								Hombre
							@elseif($user->gender == 'women')
								Mujer
							@else
								Género no especificado
							@endif
						</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Inicio</span>
						<span class="detail">{{ $user->created_at }}</span>
					</div>

					<div class="title-detail-2">
						<span class="title">Rol de Usuario</span>
						<span class="detail">
							<a href="{{ route('roles.show',['rID'=>$user->getRole()['id']]) }}"><u>{{ $user->getRole()['name'] }}</u></a>
						</span>
					</div>

					<div class="title-detail">
						<span class="title">
							@if (Shinobi::can('user.show'))
								{!! link_to_route('users.show', "Editar",['i'=>$user->id], ['class' =>'btn btn-primary']) !!}
							@endif
						</span>
						<span class="title">
							@if (Shinobi::can('user.destroy'))
								{!! Form::open(['action' => ['UsersController@destroy',$user->id],'method'=>'DELETE','class'=>'destroy']) !!}
									<button class="btn btn-danger">Eliminar</button>
								{!! Form::close() !!}
							@endif
						</span>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-primary table-responsive">
				<div class="panel-heading">Sponsors publicados</div>
				 <table class="table table-hover">
				 	<thead>
				 		<tr>
				 			<th>Fecha</th>
				 			<th>Titulo</th>
				 			<th>Acción</th>
				 		</tr>
				 	</thead>
				 	<tbody>
				 		@foreach($user->sponsors as $sponsor)
					 		<tr>
					 			<td>{{$sponsor->created_at}}</td>
					 			<td>{{$sponsor->name}}</td>
					 			<td><a href="{{ route('sponsors.show',['sID'=>$sponsor->id]) }}">Ver</a></td>
					 		</tr>
				 		@endforeach
				 	</tbody>
				 </table>
				<div class="panel-body">
					<a href="{{ route('sponsors.create',['uID'=>$user->id]) }}">Nuevo Pago</a>
				</div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">Paquetes Premium Adquiridos</div>
				<table class="table table-hover">
				 	<thead>
				 		<tr>
				 			<th>Fecha</th>
				 			<th>Paquete</th>
				 			<th>Acción</th>
				 		</tr>
				 	</thead>
				 	<tbody>
				 		@foreach($user->postPays as $postpay)
					 		<tr>
					 			<td>{{$postpay->created_at}}</td>
					 			<td>{{$postpay->postPrice->name}}</td>
					 			<td><a href="{{ route('pay-post.show',['sID'=>$postpay->id]) }}">Ver</a></td>
					 		</tr>
				 		@endforeach
				 	</tbody>
				</table>
				<div class="panel-body">
					<a href="{{ route('pay-post.create',['uID'=>$user->id]) }}">Nuevo Pago</a>
				</div>
			</div>
		</div>

	</div>
@endsection
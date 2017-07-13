@extends('corporate.profile')

@section('user')
	{!! Form::open(['route' => 'profile.save', 'id' =>'edit-user']) !!}

		    <div class="input-group">
			  <span class="input-group-addon" id="basic-addon1">
			  	<i class="fa fa-odnoklassniki" aria-hidden="true"></i>
			  </span>
			  {!! Form::text('name', Auth::user()->name, ['class'=>'form-control', 'placeholder'=>"Nombre"]) !!}
			</div>

		    <div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">
				  	<i class="fa fa-user" aria-hidden="true"></i>
				  </span>
				  {!! Form::text('username', Auth::user()->username, ['class'=>'form-control', 'placeholder'=>"Usuario"]) !!}
			</div>

		    <div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">
				  	<i class="fa fa-envelope" aria-hidden="true"></i>
				  </span>
				  {!! Form::text('email', Auth::user()->email, ['class'=>'form-control', 'placeholder'=>"Correo electrónico",'type'=>'email']) !!}
			</div>

		    <div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">
				  	<i class="fa fa-venus-mars" aria-hidden="true"></i>
				  </span>
				  {!! Form::select('gender', ['men' => 'Hombre', 'women' => 'Mujer'], Auth::user()->gender, ['class'=>'form-control', 'placeholder' => 'Escoga su género']) !!}
			</div>
			
			<div class="form-group">
				<div class="btn-group" role="group" aria-label="...">
				  <button class="btn btn-primary btn-sm">Guardar</button>
				  <a href="{{ route('profile') }}" class="btn btn-danger btn-sm">Cancelar</a>
				</div>
			</div>

	{!! Form::close() !!}
@endsection
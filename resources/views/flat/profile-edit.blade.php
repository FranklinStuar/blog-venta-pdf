@extends('flat.layout')
@section('title')
	{{ Auth::user()->name }}
@endsection
@section('container')
<style>
.profile-form{
	width: 100%
}
</style>
	<div class="gap"></div>
	<section id="" class="container">
		<div class="row">
			<div class="col-md-6">
				<fieldset class="registration-form profile-form">

					{!! Form::open(['route' => 'profile.change-image','class'=>'center form-horizontal','role'=>'form','files'=>true]) !!}
						
						<div class="form-group">
							@if(Auth::user()->avatar == 'avatar.png')
								<img class="img-responsive img-thumbnail img-circle" src="{{ url('images/'.Auth::user()->avatar) }}" width="150px" alt="{{ Auth::user()->name }}" >
							@else
								<img class="img-responsive img-thumbnail img-circle" src="{{ url('storage/'.Auth::user()->avatar) }}" width="150px" alt="{{ Auth::user()->name }}" >
							@endif
						</div>
					
						<div class="form-group">
							<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
								{!! Form::file('image',['accept'=>"image/*",'required']) !!}
								@if ($errors->has('image'))
									<span class="help-block">
										<strong>{{ $errors->first('image') }}</strong>
									</span>
								@endif
							</div>
						</div>
					
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-4">
								<button type="submit" class=" btn btn-success btn-md btn-block">
									Cambiar Imagen
								</button>
							</div>
						</div>
					
					{!! Form::close() !!}
			
					<div class="gap"></div>
					{!! Form::open(['route' => 'profile.save','class'=>'center form-horizontal','role'=>'form']) !!}
						
						<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
							<label for="username" class="col-sm-4 control-label">Nombre de usuario</label>
							<div class="col-sm-8">
								<input id="username" type="text" class="form-control" name="username" value="{{ Auth::user()->username }}" required autofocus>
								@if ($errors->has('username'))
									<span class="help-block">
										<strong>{{ $errors->first('username') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-sm-4 control-label">Nombre Real</label>
							<div class="col-sm-8">
								<input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required >
								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-sm-4 control-label">Correo electrónico</label>
							<div class="col-sm-8">
								<input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required >
								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class=" btn btn-success btn-md btn-block">
								Iniciar Sesion
							</button>
						</div>
					
					{!! Form::close() !!}
				</fieldset>
			</div>
			<div class="col-md-6">
				<fieldset class="registration-form profile-form">
					<h3>Cambiar contraseña</h3>
					<div class="gap"></div>
					{!! Form::open(['route' => 'profile.change-password','class'=>'center form-horizontal','role'=>'form']) !!}
						
						<div class="form-group{{ $errors->has('actual_password') ? ' has-error' : '' }}">
							<label for="actual_password" class="col-sm-4 control-label">Contraseña anterior</label>
							<div class="col-sm-8">
								<input id="actual_password" type="password" class="form-control" name="actual_password" required autofocus>
								@if ($errors->has('actual_password'))
									<span class="help-block">
										<strong>{{ $errors->first('actual_password') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password" class="col-sm-4 control-label">Nueva contraseña</label>
							<div class="col-sm-8">
								<input id="password" type="password" class="form-control" name="password" required >
								@if ($errors->has('password'))
									<span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
							<label for="password-confirm" class="col-sm-4 control-label">Repetir contraseña</label>
							<div class="col-sm-8">
	                        	<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
								
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class=" btn btn-success btn-md btn-block">
								Iniciar Sesion
							</button>
						</div>
					
					{!! Form::close() !!}
				</fieldset>
			</div>
		</div>
	</section><!--/#registration profile-->
	<div class="gap"></div>

@endsection
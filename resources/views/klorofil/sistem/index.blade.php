@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Configuración</h3>
	<div class="panel">
		<div class="panel-body">
		</div>
		<div class="panel-body">
			{!! Form::open(['route' => 'config.save','class'=>'form-horizontal']) !!}

				<div class="form-group{{ $errors->has('responsable') ? ' has-error' : '' }}">
					<label for="responsable" class="col-md-3 control-label">Representante de la página *</label>
					<div class="col-md-6">
						{!! Form::text('responsable', $system->responsable, ['class'=>'form-control','placeholder' => 'Representante de la página']) !!}

						@if ($errors->has('responsable'))
							<span class="help-block">
								<strong>{{ $errors->first('responsable') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<hr>

				<div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
					<label for="facebook" class="col-md-3 control-label">Facebook</label>

					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"> http://www.facebook.com/ </span>
								{!! Form::text('facebook', $system->facebook, ['class'=>'form-control', 'placeholder'=>"neurocodigo"]) !!}
						</div>

						@if ($errors->has('facebook'))
							<span class="help-block">
								<strong>{{ $errors->first('facebook') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('instagram') ? ' has-error' : '' }}">
					<label for="instagram" class="col-md-3 control-label">Instagram</label>

					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"> http://www.instagram.com/ </span>
								{!! Form::text('instagram', $system->instagram, ['class'=>'form-control', 'placeholder'=>"neurocodigo"]) !!}
						</div>

						@if ($errors->has('instagram'))
							<span class="help-block">
								<strong>{{ $errors->first('instagram') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('youtube') ? ' has-error' : '' }}">
					<label for="youtube" class="col-md-3 control-label">Youtube</label>

					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"> http://www.youtube.com/ </span>
								{!! Form::text('youtube', $system->youtube, ['class'=>'form-control', 'placeholder'=>"neurocodigo"]) !!}
						</div>

						@if ($errors->has('youtube'))
							<span class="help-block">
								<strong>{{ $errors->first('youtube') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<hr>

				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="col-md-3 control-label">Correo electrónico *</label>
					<div class="col-md-6">
						{!! Form::text('email', $system->email, ['class'=>'form-control','placeholder'=>'Email donde pueden comunicarse para cualquier duda']) !!}

						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('password_email') ? ' has-error' : '' }}">
					<label for="password_email" class="col-md-3 control-label">Contraseña *</label>
					<div class="col-md-6">
						{!! Form::text('password_email', (Shinobi::can('system.password'))?$password_email:null, ['class'=>'form-control','placeholder'=>'Contraseña del correo, usa encriptación']) !!}

						@if ($errors->has('password_email'))
							<span class="help-block">
								<strong>{{ $errors->first('password_email') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('host') ? ' has-error' : '' }}">
					<label for="host" class="col-md-3 control-label">Host del correo *</label>
					<div class="col-md-6">
						{!! Form::text('host', $host, ['class'=>'form-control','placeholder'=>'smtp.servidor.com']) !!}

						@if ($errors->has('host'))
							<span class="help-block">
								<strong>{{ $errors->first('host') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('drive') ? ' has-error' : '' }}">
					<label for="drive" class="col-md-3 control-label">Drive de servidor del correo *</label>
					<div class="col-md-6">
						{!! Form::text('drive', $drive, ['class'=>'form-control','placeholder'=>'smtp']) !!}

						@if ($errors->has('drive'))
							<span class="help-block">
								<strong>{{ $errors->first('drive') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('port') ? ' has-error' : '' }}">
					<label for="port" class="col-md-3 control-label">Puerto de acceso *</label>
					<div class="col-md-6">
						{!! Form::text('port', $port, ['class'=>'form-control','placeholder'=>'587']) !!}

						@if ($errors->has('port'))
							<span class="help-block">
								<strong>{{ $errors->first('port') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('encryption') ? ' has-error' : '' }}">
					<label for="encryption" class="col-md-3 control-label">Encriptación *</label>
					<div class="col-md-6">
						{!! Form::text('encryption', $encryption, ['class'=>'form-control','placeholder'=>'tls']) !!}

						@if ($errors->has('encryption'))
							<span class="help-block">
								<strong>{{ $errors->first('encryption') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<hr>
				<div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
					<label for="direccion" class="col-md-3 control-label">Dirección *</label>
					<div class="col-md-6">
						{!! Form::text('direccion', $system->direccion, ['class'=>'form-control','placeholder' => 'La dirección de la empresa']) !!}

						@if ($errors->has('direccion'))
							<span class="help-block">
								<strong>{{ $errors->first('direccion') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
					<label for="telefono" class="col-md-3 control-label">Teléfono *</label>
					<div class="col-sm-6 col-md-3">
							{!! Form::text('telefono', $system->telefono, ['class'=>'form-control','placeholder' =>'Teléfono']) !!}

						@if ($errors->has('telefono'))
							<span class="help-block">
								<strong>{{ $errors->first('telefono') }}</strong>
							</span>
						@endif
					</div>
					<div class="col-sm-6 col-md-3">
							{!! Form::text('celular', $system->celular, ['class'=>'form-control','placeholder' =>'Celular']) !!}

						@if ($errors->has('celular'))
							<span class="help-block">
								<strong>{{ $errors->first('celular') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<hr>

				<div class="form-group{{ $errors->has('quienes_somos') ? ' has-error' : '' }}">
					<label for="quienes_somos" class="col-md-3 control-label">Quienes somos *</label>
					<div class="col-md-9">
						{!! Form::textarea('quienes_somos', $system->quienes_somos, ['class'=>'summernote form-control','rows'=>'3', 'placeholder'=>'Llene aqui la información de la empresa. La misión, la vision, y todos los detalles que vea convenientes ']) !!}

						@if ($errors->has('quienes_somos'))
							<span class="help-block">
								<strong>{{ $errors->first('quienes_somos') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('cuentas_premium') ? ' has-error' : '' }}">
					<label for="cuentas_premium" class="col-md-3 control-label">Información sobre cuentas premium *</label>
					<div class="col-md-9">
						{!! Form::textarea('cuentas_premium', $system->cuentas_premium, ['class'=>'summernote form-control','rows'=>'3','placeholder' => 'Indique en esta parte los detalles y beneficios para usar las cuentas premium']) !!}

						@if ($errors->has('cuentas_premium'))
							<span class="help-block">
								<strong>{{ $errors->first('cuentas_premium') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('publicidad') ? ' has-error' : '' }}">
					<label for="publicidad" class="col-md-3 control-label">Información sobre Publicidad *</label>
					<div class="col-md-9">
						{!! Form::textarea('publicidad', $system->publicidad, ['class'=>'summernote form-control','rows'=>'3','placeholder' => 'Indique los beneficios de tener la cuenta con publicidad y/o como puede quitar los anuncios a través de una cuenta premium o algún detalle que se vea conveniente']) !!}

						@if ($errors->has('publicidad'))
							<span class="help-block">
								<strong>{{ $errors->first('publicidad') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('politicas_condiciones') ? ' has-error' : '' }}">
					<label for="politicas_condiciones" class="col-md-3 control-label">Terminos y condiciones *</label>
					<div class="col-md-9">
						{!! Form::textarea('politicas_condiciones', $system->politicas_condiciones, ['class'=>'summernote form-control','rows'=>'3']) !!}

						@if ($errors->has('politicas_condiciones'))
							<span class="help-block">
								<strong>{{ $errors->first('politicas_condiciones') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
					<label for="role_id" class="col-md-3 control-label">Rol por defecto para nuevos usuarios *</label>
					<div class="col-md-9">
						{!! Form::select('role_id', $roles, $system->role_id, ['class' => 'form-control','placeholder'=>'Escoja un rol por defecto']) !!}

						@if ($errors->has('role_id'))
							<span class="help-block">
								<strong>{{ $errors->first('role_id') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<hr>
				<div class="form-group">
					<div class=" col-md-6 col-md-offset-4">
						{!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('admin') }}" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Configuración de google
		</div>
		<div class="panel-body">
			{!! Form::open(['route' => 'config-google.save','class'=>'form-horizontal']) !!}
				<p>
					Configure Etiquetas en 
					<a href="https://www.google.com/analytics/tag-manager/">Tag Management</a> 
					para acceder a las diferentes opciones que brinda google como 
					<a href="https://analytics.google.com/">Google Analytics</a>, 
					<a href="https://adwords.google.com/">Google AdWords</a>, x
					<a href="https://www.google.es/adsense/start">Google AdSense</a> 
					y muchas opciones más que pueden ser configurada desde 
					<a href="https://www.google.com/analytics/tag-manager/">Tag Management</a> 
				</p>
				
				<hr>

				<div class="form-group{{ $errors->has('tag_script') ? ' has-error' : '' }}">
					<label for="tag_script" class="col-md-3 control-label">Código script</label>
					<div class="col-md-8">
						{!! Form::textarea('tag_script', $system->tag_script, ['class'=>'form-control','rows'=>'8']) !!}

						@if ($errors->has('tag_script'))
							<span class="help-block">
								<strong>{{ $errors->first('tag_script') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('tag_body') ? ' has-error' : '' }}">
					<label for="tag_body" class="col-md-3 control-label">Código no script</label>
					<div class="col-md-8">
						{!! Form::textarea('tag_body', $system->tag_body, ['class'=>'form-control','rows'=>'8']) !!}

						@if ($errors->has('tag_body'))
							<span class="help-block">
								<strong>{{ $errors->first('tag_body') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<hr>
				<div class="form-group">
					<div class=" col-md-6 col-md-offset-4">
						{!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('admin') }}" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection


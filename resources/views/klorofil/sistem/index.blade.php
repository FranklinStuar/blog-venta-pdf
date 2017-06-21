@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Configuración</h3>
	<div class="panel">
		<div class="panel-body">
		</div>
		<div class="panel-body">
			{!! Form::open(['route' => 'config.save','class'=>'form-horizontal']) !!}

		    <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
        	<label for="facebook" class="col-md-4 control-label">Facebook</label>

	        <div class="col-md-6">
            <div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"> http://www.facebook.con/ </span>
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
        	<label for="instagram" class="col-md-4 control-label">Instagram</label>

	        <div class="col-md-6">
            <div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"> http://www.instagram.con/ </span>
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
        	<label for="youtube" class="col-md-4 control-label">Youtube</label>

	        <div class="col-md-6">
            <div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"> http://www.youtube.con/ </span>
							  {!! Form::text('youtube', $system->youtube, ['class'=>'form-control', 'placeholder'=>"neurocodigo"]) !!}
						</div>

            @if ($errors->has('youtube'))
              <span class="help-block">
                <strong>{{ $errors->first('youtube') }}</strong>
              </span>
            @endif
	        </div>
		    </div>
		    
		    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        	<label for="email" class="col-md-4 control-label">Correo electrónico</label>
	        <div class="col-md-6">
					  {!! Form::text('email', $system->email, ['class'=>'form-control','placeholder'=>'Email donde pueden comunicarse para cualquier duda']) !!}

            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
	        </div>
		    </div>

		    <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
        	<label for="direccion" class="col-md-4 control-label">Dirección</label>
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
        	<label for="telefono" class="col-md-4 control-label">Teléfono</label>
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

		    <div class="form-group{{ $errors->has('quienes_somos') ? ' has-error' : '' }}">
        	<label for="quienes_somos" class="col-md-4 control-label">Quienes somos</label>
	        <div class="col-md-6">
					  {!! Form::textarea('quienes_somos', $system->quienes_somos, ['class'=>'form-control','rows'=>'3', 'placeholder'=>'Llene aqui la información de la empresa. La misión, la vision, y todos los detalles que vea convenientes ']) !!}

            @if ($errors->has('quienes_somos'))
              <span class="help-block">
                <strong>{{ $errors->first('quienes_somos') }}</strong>
              </span>
            @endif
	        </div>
		    </div>

		    <div class="form-group{{ $errors->has('cuentas_premium') ? ' has-error' : '' }}">
        	<label for="cuentas_premium" class="col-md-4 control-label">Información sobre cuentas premium</label>
	        <div class="col-md-6">
					  {!! Form::textarea('cuentas_premium', $system->cuentas_premium, ['class'=>'form-control','rows'=>'3','placeholder' => 'Indique en esta parte los detalles y beneficios para usar las cuentas premium']) !!}

            @if ($errors->has('cuentas_premium'))
              <span class="help-block">
                <strong>{{ $errors->first('cuentas_premium') }}</strong>
              </span>
            @endif
	        </div>
		    </div>

		    <div class="form-group{{ $errors->has('publicidad') ? ' has-error' : '' }}">
        	<label for="publicidad" class="col-md-4 control-label">Información sobre Publicidad</label>
	        <div class="col-md-6">
					  {!! Form::textarea('publicidad', $system->publicidad, ['class'=>'form-control','rows'=>'3','placeholder' => 'Indique los beneficios de tener la cuenta con publicidad y/o como puede quitar los anuncios a través de una cuenta premium o algún detalle que se vea conveniente']) !!}

            @if ($errors->has('publicidad'))
              <span class="help-block">
                <strong>{{ $errors->first('publicidad') }}</strong>
              </span>
            @endif
	        </div>
		    </div>

		    <div class="form-group{{ $errors->has('politicas_condiciones') ? ' has-error' : '' }}">
        	<label for="politicas_condiciones" class="col-md-4 control-label">Terminos y condiciones</label>
	        <div class="col-md-6">
					  {!! Form::textarea('politicas_condiciones', $system->politicas_condiciones, ['class'=>'form-control','rows'=>'3']) !!}

            @if ($errors->has('politicas_condiciones'))
              <span class="help-block">
                <strong>{{ $errors->first('politicas_condiciones') }}</strong>
              </span>
            @endif
	        </div>
		    </div>

		    {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
		    <a href="{{ route('admin') }}" class="btn btn-danger">Cancelar</a>
			{!! Form::close() !!}
		</div>
	</div>
@endsection


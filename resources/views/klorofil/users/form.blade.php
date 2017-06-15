{!! Form::open(['url' => $url,'class'=>'form-horizontal','method'=>$method]) !!}
   
    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
        <label for="username" class="col-md-4 control-label">Nombre de usuario</label>

        <div class="col-md-6">
            {{ Form::text('username', (old('username'))? old('username'): $user->username,['class'=>'form-control','required','autofocus'] ) }}

            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nombre</label>

        <div class="col-md-6">
            {{ Form::text('name', (old('name'))? old('name'): $user->name,['class'=>'form-control','required','autofocus'] ) }}

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">Correo Electrónico</label>

        <div class="col-md-6">
            {{ Form::text('email',(old('email'))? old('email'): $user->email,['class'=>'form-control','required','autofocus','type'=>'email'] ) }}
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control-label">Contraseña</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password"  @if(!$user->password) required @endif autofocus>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="password-confirm" class="col-md-4 control-label">Confirmar ontraseña</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" @if(!$user->password) required @endif autofocus>

        </div>
    </div>

    <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
        <label for="role_id" class="col-md-4 control-label">Roles de usuario</label>

        <div class="col-md-6">
        	{!! Form::select('role_id', $roles, (old('role_id'))? old('role_id') : ($user->getRole())?$user->getRole():null , ['placeholder' => 'Seleccione un rol de usuario','class' =>'form-control','required']) !!}
	
          @if ($errors->has('role_id'))
            <span class="help-block">
                <strong>{{ $errors->first('role_id') }}</strong>
            </span>
          @endif
        </div>
    </div>

	{!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
	{!! link_to_action('UsersController@index', $title = "Cancelar",null, ['class' =>'btn btn-danger']) !!}
{!! Form::close() !!}
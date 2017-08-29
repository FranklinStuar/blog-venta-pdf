
@extends('flat.layout')
@section('title')
    Inciar Sesion
@endsection

@section('container')

    @if (session('status'))
        <div class="gap"></div>
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {!! Form::open(['route' => ['password.request','token'=>$token],'class'=>'center','role'=>'form','methos'=>'POST']) !!}
        <fieldset class="registration-form">
        
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-12 control-label">E-Mail Address</label>

            <div class="col-md-12">
                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-12 control-label">Contraseña</label>

            <div class="col-md-12">
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password-confirm" class="col-md-12 control-label">Confirmar Contraseña</label>
            <div class="col-md-12">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Recuperar contraseña
                </button>
            </div>
        </div>
    {!! Form::close() !!}

@endsection

@extends('corporate.layout')

@section('container')

<div class="container form-init-center">
    <div class="panel panel-default">
        <div class="panel-heading">Iniciar Sesión</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class="col-md-12 control-label">Nombre de usuario</label>

                    <div class="col-md-12">
                        <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
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

                <div class="form-group">
                    <div class="col-md-12 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" checked name="remember" {{ old('remember') ? 'checked' : '' }}> Recuerdame
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Iniciar Sesion
                        </button>

                        <a class="btn btn-link btn-dark-green" href="{{ route('password.request') }}">
                            ¿Olvidó su contraseña?
                        </a>
                        <br>
                        <a class="btn btn-link btn-light-green" href="{{ route('register') }}">
                            Aún no tengo cuenta
                        </a>
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

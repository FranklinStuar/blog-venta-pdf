
@extends('flat.layout')
@section('title')
    Inciar Sesion
@endsection

@section('container')

    <div class="gap"></div>
    <section id="registration" class="container">
        {!! Form::open(['route' => 'login','class'=>'center ','role'=>'form']) !!}
            <fieldset class="registration-form">
                
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class=" control-label">Nombre de usuario</label>

                    <div class="">
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class=" control-label">Contraseña</label>

                    <div class="">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group">
                    <div class="">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" checked name="remember" {{ old('remember') ? 'checked' : '' }}> Recuerdame
                            </label>
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-md btn-block">
                        Iniciar Sesion
                    </button>
                </div>

                <a class="btn btn-link" href="{{ route('password.request') }}">
                    ¿Olvidó su contraseña?
                </a>
                <br>
                <a class="btn btn-link" href="{{ route('register') }}">
                    Aún no tengo cuenta
                </a>
            </fieldset>
        {!! Form::close() !!}
    </section><!--/#registration-->
    <div class="gap"></div>

@endsection



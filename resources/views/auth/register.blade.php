

@extends('flat.layout')
@section('title')
    Inciar Sesion
@endsection

@section('container')

    <div class="gap"></div>
    <section id="registration" class="container">
        {!! Form::open(['route' => 'register','class'=>'center','role'=>'form']) !!}
            <fieldset class="registration-form">
            

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class="col-md-12 control-label">Nombre de usuario</label>

                    <div class="col-md-12">
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-12 control-label">Nombre</label>

                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-12 control-label">Correo electronico</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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

                <div class="form-group">
                    <label for="password-confirm" class="col-md-12 control-label">Confirmar contraseña</label>

                    <div class="col-md-12">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('terminos_condiciones') ? ' has-error' : '' }}">
                    <label for="terminos_condiciones" class="col-md-12 control-label">
                    </label>

                    <div class="col-md-12">
                        {!! Form::checkbox('terminos_condiciones', 'acept',['class'=>'required']) !!}
                        Acepto los <a href="#terminos_condiciones" data-toggle="modal" data-target="#politicasCondicionesModal"><u>Terminos y condiciones</u></a>
                        @if ($errors->has('terminos_condiciones'))
                            <span class="help-block">
                                <strong>{{ $errors->first('terminos_condiciones') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Registrar
                        </button>
                    </div>
                </div>

            </fieldset>
        {!! Form::close() !!}
    </section><!--/#registration-->
    <div class="gap"></div>

    <!-- Politicas y condiciones-->
    <div class="modal fade" id="politicasCondicionesModal" tabindex="-1" role="dialog" aria-labelledby="politicasCondicionesModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="politicasCondicionesModalLabel">Políticas y condiciones</h4>
          </div>
          <div class="modal-body">
                    {{ $system->politicas_condiciones }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

@endsection



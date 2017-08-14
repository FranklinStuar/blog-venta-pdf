
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

    <div class="gap"></div>
    <section id="registration" class="container">
        {!! Form::open(['route' => 'password.email','class'=>'center','role'=>'form']) !!}

            <fieldset class="registration-form">
                
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-12 control-label">Correo electrónico</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 ">
                        <button type="submit" class="btn btn-primary">
                            Enviar link de recuperación de contraseña
                        </button>
                    </div>
                </div>
            </fieldset>
        {!! Form::close() !!}
    </section><!--/#registration-->
    <div class="gap"></div>

@endsection



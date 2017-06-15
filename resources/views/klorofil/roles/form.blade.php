{!! Form::open(['url' => $url,'class'=>'form-horizontal','method'=>$method]) !!}
   
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nombre</label>

        <div class="col-md-6">
            <input id="name" type="name" class="form-control" name="name" value="@if(old('name')) {{ old('name') }} @else {{ $role->name }} @endif" required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
        <label for="slug" class="col-md-4 control-label">Slug</label>

        <div class="col-md-6">
            <input id="slug" type="slug" class="form-control" name="slug" value="@if(old('slug')) {{ old('slug') }} @else {{ $role->slug }} @endif" required autofocus>

            @if ($errors->has('slug'))
                <span class="help-block">
                    <strong>{{ $errors->first('slug') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
    {!! link_to_route('roles.index', $title = "Cancelar",null, ['class' =>'btn btn-danger']) !!}
{!! Form::close() !!}
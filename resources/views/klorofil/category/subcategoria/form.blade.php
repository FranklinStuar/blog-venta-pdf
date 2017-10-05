{!! Form::open(['url' => $url,'class'=>'form-horizontal','method'=>$method,'files'=>true]) !!}
    
    @if($edit)
        <div class="form-group">
            <div class="col-md-1 col-sm-2 col-xs-4 col-xs-offset-4 col-sm-offset-4">
                <img src="{{ url('/storage/'.$category->image) }}" class="image-post-form" alt="image">
                <hr>
            </div>
        </div>
    @endif

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nombre *</label>

        <div class="col-md-6">

            @if($edit)
                <input id="name" type="name" class="form-control" required autofocus name="name" value="{{$category->name}} ">
            @else
                <input id="name" type="name" class="form-control" required autofocus name="name" value="{{old('name')}} ">
            @endif
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Imagen @if(!$edit) * @endif </label>

        <div class="col-md-8">
            @if($edit)
                {!! Form::file('image',['accept'=>'image/*']) !!}
            @else
                {!! Form::file('image',['accept'=>'image/*','required']) !!}
            @endif
            <small class="help-block">Medidas máximas 150x150 px.</small>

            @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
        </div>
    </div>
    

	{!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
	{!! link_to_action('CategoriesController@index', $title = "Cancelar",null, ['class' =>'btn btn-danger']) !!}
{!! Form::close() !!}
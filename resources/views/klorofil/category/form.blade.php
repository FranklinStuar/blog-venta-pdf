{!! Form::open(['url' => $url,'class'=>'form-horizontal','method'=>$method]) !!}
   
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nombre</label>

        <div class="col-md-6">
            <input id="name" type="name" class="form-control" name="name" value="@if(old('name')) {{ old('name') }} @else {{ $category->name }} @endif" required autofocus>

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
            <input id="slug" type="slug" class="form-control" name="slug" value="@if(old('slug')) {{ old('slug') }} @else {{ $category->slug }} @endif" required autofocus>

            @if ($errors->has('slug'))
                <span class="help-block">
                    <strong>{{ $errors->first('slug') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
        <label for="parent_id" class="col-md-4 control-label">Categoría Padre</label>

        <div class="col-md-6">
        	{!! Form::select('parent_id', $categories, (old('parent_id'))? old('parent_id') : $category->parent_id , ['placeholder' => 'Seleccione una categoría padre','class' =>'form-control', 'autofocus']) !!}
	
          @if ($errors->has('parent_id'))
            <span class="help-block">
                <strong>{{ $errors->first('parent_id') }}</strong>
            </span>
          @endif
        </div>
    </div>

	{!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
	{!! link_to_action('CategoriesController@index', $title = "Cancelar",null, ['class' =>'btn btn-danger']) !!}
{!! Form::close() !!}
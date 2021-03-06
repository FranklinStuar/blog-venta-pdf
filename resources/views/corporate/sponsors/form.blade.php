	
{!! Form::open(['url' => $url,'method' => $method, 'files' => true]) !!}

	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		{!! Form::text('name', $sponsor->name, ['class'=>'form-control', 'placeholder'=>"Titulo para la publicidad *",'required','autofocus']) !!}
	</div>
	
	<div class="form-group{{ $errors->has('excerpt') ? ' has-error' : '' }}">
		{!! Form::text('excerpt', $sponsor->excerpt, ['class'=>'form-control', 'placeholder'=>"Descripción para la publicidad *",'required']) !!}
	</div>
	
	<div class="form-group">
		{!! Form::text('web', $sponsor->web, ['class'=>'form-control', 'placeholder'=>"www.sitio-seb.com"]) !!}
	</div>
	
	<div class="form-group">
		{!! Form::text('address', $sponsor->address, ['class'=>'form-control', 'placeholder'=>"Dirección donde contactar"]) !!}
	</div>
	
	<div class="form-group">
		{!! Form::text('phone', $sponsor->phone, ['class'=>'form-control', 'placeholder'=>"Teléfono de contacto"]) !!}
	</div>

	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1"> http://www.facebook.con/ </span>
				{!! Form::text('url_facebook', $sponsor->url_facebook, ['class'=>'form-control', 'placeholder'=>"sistema"]) !!}
		</div>
		<small class="help-block"> Copie la ruta despues de http://www.facebook.con/ en su perfil</small>
	</div>

	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1"> http://www.twitter.con/ </span>
				{!! Form::text('url_twitter', $sponsor->url_twitter, ['class'=>'form-control', 'placeholder'=>"sistema"]) !!}
		</div>
		<small class="help-block"> Copie la ruta despues de http://www.twitter.con/ en su perfil</small>
	</div>

	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1"> http://www.instagram.con/ </span>
				{!! Form::text('url_instagram', $sponsor->url_instagram, ['class'=>'form-control', 'placeholder'=>"sistema"]) !!}
		</div>
		<small class="help-block"> Copie la ruta despues de http://www.instagram.con/ en su perfil</small>
	</div>

	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1"> http://www.youtube.con/ </span>
				{!! Form::text('url_youtube', $sponsor->url_youtube, ['class'=>'form-control', 'placeholder'=>"sistema"]) !!}
		</div>
		<small class="help-block"> Copie la ruta despues de http://www.youtube.con/ en su perfil</small>
	</div>


    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
        <label for="image" class="col-md-4 control-label">
			Imagen @if(!$edit) * @endif	
    	</label>
		
        <div class="col-md-6">
	        @if($edit)
	            {!! Form::file('image',['id'=>'image','accept'=>'image/*']) !!}
            @else
            	{!! Form::file('image',['id'=>'image','accept'=>'image/*','required']) !!}
	        @endif
            @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
        </div>
    </div>

	<div class="form-group">
		@if($edit)
	        <div class="col-md-6">
				<img class="image-fluid" src="{{ url('/storage/'.$sponsor->image) }}"  alt="{{ $sponsor->excerpt }}">
	        </div>
	    @endif
	</div>

	<div class="form-group">
			<button class="btn btn-primary ">Continuar</button>
			<a href="{{ route('profile') }}" class="btn btn-danger ">Cancelar</a>
	</div>

{!! Form::close() !!}

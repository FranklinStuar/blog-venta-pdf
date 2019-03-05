	
{!! Form::open(['url' => $url,'method' => $method, 'files' => true,'class'=>'form-horizontal']) !!}

	<div class="form-group">
		@if($edit)
	        <div class="col-sm-9 col-sm-offset-3">
				<img class="img-fluid max-100-100" src="{{ url('/storage/'.$sponsor->image) }}"  alt="{{ $sponsor->excerpt }}">
				<hr>
	        </div>
	    @endif
	</div>
	<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
	    {!! Form::label('name', 'Título *',['class'=>"col-sm-3 control-label"]) !!}
	    <div class="col-sm-9">
			{!! Form::text('name', $sponsor->name, ['class'=>'form-control', 'placeholder'=>"Titulo para la publicidad *",'required','autofocus']) !!}
	    </div>
  	</div>

	<div class="form-group {{ $errors->has('excerpt') ? ' has-error' : '' }}">
	    {!! Form::label('excerpt', 'Descripción *',['class'=>"col-sm-3 control-label"]) !!}
	    <div class="col-sm-9">
			{!! Form::text('excerpt', $sponsor->excerpt, ['class'=>'form-control', 'placeholder'=>"Descripción para la publicidad *",'required']) !!}
	    </div>
  	</div>

	<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
	    {!! Form::label('image', (!$edit)?'Imagen *':'Imagen',['class'=>"col-sm-3 control-label"]) !!}
	    <div class="col-sm-9">
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
	
	<hr>

	<div class="form-group">
	    <div class="col-sm-9 col-sm-offset-2">
			<span>Los datos a continuación son opcionales, Se recomienda llenar de mejor manera para que los usuarios puedan contactar con su negocio.</span>
	    </div>
  	</div>
	
	<hr>

	<div class="form-group">
	    {!! Form::label('address', 'Dirección',['class'=>"col-sm-3 control-label"]) !!}
	    <div class="col-sm-9">
			{!! Form::text('address', $sponsor->address, ['class'=>'form-control', 'placeholder'=>"Dirección donde contactar"]) !!}
	    </div>
  	</div>

	<div class="form-group">
	    {!! Form::label('phone', 'Teléfono',['class'=>"col-sm-3 control-label"]) !!}
	    <div class="col-sm-9">
			{!! Form::text('phone', $sponsor->phone, ['class'=>'form-control', 'placeholder'=>"Teléfono de contacto"]) !!}
	    </div>
  	</div>
	
	<hr>
	
	<div class="form-group">
	    {!! Form::label('web', 'Sitio Web',['class'=>"col-sm-3 control-label"]) !!}
	    <div class="col-sm-9">
			{!! Form::text('web', $sponsor->web, ['class'=>'form-control', 'placeholder'=>"www.sitio-seb.com"]) !!}
	    </div>
  	</div>
	
	<div class="form-group">
	    {!! Form::label('url_facebook', 'Facebook',['class'=>"col-sm-3 control-label"]) !!}
	    <div class="col-sm-9">
			{!! Form::text('url_facebook', $sponsor->url_facebook, ['class'=>'form-control', 'placeholder'=>"sistema"]) !!}
			<small class="help-block"> Copie la ruta despues de <b>https://www.facebook.com/</b> en su perfil</small>
	    </div>
  	</div>
	
	<div class="form-group">
	    {!! Form::label('url_twitter', 'Twitter',['class'=>"col-sm-3 control-label"]) !!}
	    <div class="col-sm-9">
			{!! Form::text('url_twitter', $sponsor->url_twitter, ['class'=>'form-control', 'placeholder'=>"sistema"]) !!}
			<small class="help-block"> Copie la ruta despues de <b>https://www.twitter.com/</b> en su perfil</small>
	    </div>
  	</div>
	
	<div class="form-group">
	    {!! Form::label('url_instagram', 'Instagram',['class'=>"col-sm-3 control-label"]) !!}
	    <div class="col-sm-9">
			{!! Form::text('url_instagram', $sponsor->url_instagram, ['class'=>'form-control', 'placeholder'=>"sistema"]) !!}
			<small class="help-block"> Copie la ruta despues de <b>https://www.instagram.com/</b> en su perfil</small>
	    </div>
  	</div>
	
	<div class="form-group">
	    {!! Form::label('url_youtube', 'Youtube',['class'=>"col-sm-3 control-label"]) !!}
	    <div class="col-sm-9">
			{!! Form::text('url_youtube', $sponsor->url_youtube, ['class'=>'form-control', 'placeholder'=>"sistema"]) !!}
			<small class="help-block"> Copie la ruta despues de <b>https://www.youtube.com/</b> en su perfil</small>
	    </div>
  	</div>
	
	<hr>
	
	<div class="form-group">
	    <div class="col-sm-9 col-sm-offset-3">
			<button class="btn btn-primary ">Continuar</button>
			<a href="{{ route('profile') }}" class="btn btn-danger ">Cancelar</a>
	    </div>
  	</div>

	<div class="form-group">
	</div>

{!! Form::close() !!}

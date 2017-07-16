{!! Form::open(['url' => $url,'class'=>'form-horizontal','method'=>$method, 'files' => true]) !!}
   

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Titulo *</label>

        <div class="col-md-6">
            <input id="name" type="name" class="form-control" name="name" value="{{ $sponsor->name }}" required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('excerpt') ? ' has-error' : '' }}">
        <label for="excerpt" class="col-md-4 control-label">Detalles *</label>

        <div class="col-md-6">
            <input id="excerpt" type="text" class="form-control" name="excerpt" value="{{ $sponsor->excerpt }}" required autofocus>

            @if ($errors->has('excerpt'))
                <span class="help-block">
                    <strong>{{ $errors->first('excerpt') }}</strong>
                </span>
            @endif
        </div>
    </div>
   
  
    <div class="form-group{{ $errors->has('web') ? ' has-error' : '' }}">
        <label for="web" class="col-md-4 control-label">Sitio Web</label>

        <div class="col-md-6">
            <input id="web" type="text" class="form-control" name="web" value="{{ $sponsor->web }} a"utofocus>

            @if ($errors->has('web'))
                <span class="help-block">
                    <strong>{{ $errors->first('web') }}</strong>
                </span>
            @endif
        </div>
    </div>
   
    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        <label for="phone" class="col-md-4 control-label">Teléfono</label>

        <div class="col-md-6">
            <input id="phone" type="text" class="form-control" name="phone" value="{{ $sponsor->phone }}" autofocus>

            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label for="address" class="col-md-4 control-label">Dirección</label>

        <div class="col-md-6">
            <input id="address" type="text" class="form-control" name="address" value="{{ $sponsor->address }}" autofocus>

            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('url_facebook') ? ' has-error' : '' }}">
        <label for="url_facebook" class="col-md-4 control-label">Facebook</label>

        <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"> https://www.facebook.com/ </span>
                  {!! Form::text('url_facebook', $sponsor->url_facebook, ['class'=>'form-control', 'placeholder'=>"neurocodigo",'autofocus']) !!}
            </div>
            @if ($errors->has('url_facebook'))
                <span class="help-block">
                    <strong>{{ $errors->first('url_facebook') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('url_instagram') ? ' has-error' : '' }}">
        <label for="url_instagram" class="col-md-4 control-label">Instagram</label>

        <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"> https://www.instagram.com/ </span>
                  {!! Form::text('url_instagram', $sponsor->url_instagram, ['class'=>'form-control', 'placeholder'=>"neurocodigo",'autofocus']) !!}
            </div>
            @if ($errors->has('url_instagram'))
                <span class="help-block">
                    <strong>{{ $errors->first('url_instagram') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('url_twitter') ? ' has-error' : '' }}">
        <label for="url_twitter" class="col-md-4 control-label">Twitter</label>

        <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"> https://www.twitter.com/ </span>
                  {!! Form::text('url_twitter', $sponsor->url_twitter, ['class'=>'form-control', 'placeholder'=>"neurocodigo",'autofocus']) !!}
            </div>
            @if ($errors->has('url_twitter'))
                <span class="help-block">
                    <strong>{{ $errors->first('url_twitter') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('url_youtube') ? ' has-error' : '' }}">
        <label for="url_youtube" class="col-md-4 control-label">Youtube</label>

        <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"> https://www.youtube.com/ </span>
                  {!! Form::text('url_youtube', $sponsor->url_youtube, ['class'=>'form-control', 'placeholder'=>"neurocodigo",'autofocus']) !!}
            </div>
            @if ($errors->has('url_youtube'))
                <span class="help-block">
                    <strong>{{ $errors->first('url_youtube') }}</strong>
                </span>
            @endif
        </div>
    </div>


        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
            <label for="user_id" class="col-md-4 control-label">Usuario de destino *</label>

            <div class="col-md-6">
                @if($edit)
                    {!! Form::select('user', $users, $sponsor->user_id, ['class'=>'form-control disabled','disabled','placeholder' => 'Seleccione un Usuario']) !!}
                @else
                    {!! Form::select('user_id', $users, $sponsor->user_id, ['class'=>'form-control','required','placeholder' => 'Seleccione un Usuario']) !!}
                @endif
                @if ($errors->has('user_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('user_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>



    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
        <label for="image" class="col-md-4 control-label">Imagen @if(!$edit) * @endif</label>

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

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
        @if($edit)
            <div class="col-md-6 col-md-offset-4">
                <img src="{{ url('/storage/'.$sponsor->image) }}" class="image-fluid" alt="{{ $sponsor->excerpt }}">
            </div>
        @endif
    </div>

    {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
    <a href="{{ route('sponsors.index') }}" class="btn btn-danger">Cancelar</a>
{!! Form::close() !!}
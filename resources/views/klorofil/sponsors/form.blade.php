{!! Form::open(['url' => $url,'class'=>'form-horizontal','method'=>$method]) !!}
   

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nombre *</label>

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
        <label for="web" class="col-md-4 control-label">Sitio Web *</label>

        <div class="col-md-6">
            <input id="web" type="text" class="form-control" name="web" value="{{ $sponsor->web }}" required autofocus>

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
              <span class="input-group-addon" id="basic-addon1"> https://www.facebook.con/ </span>
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
              <span class="input-group-addon" id="basic-addon1"> https://www.instagram.con/ </span>
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
              <span class="input-group-addon" id="basic-addon1"> https://www.twitter.con/ </span>
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
              <span class="input-group-addon" id="basic-addon1"> https://www.youtube.con/ </span>
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
            <select name="user_id" id="user_id" required class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('user_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('user_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

{{-- 
  'name',
  'excerpt',
  'web',
  'finish',
  'user_id',
  'image',
  'phone',
  'address',
  'url_facebook',
  'url_twitter',
  'url_instagram',
  'url_youtube',
  'status',
  --}}

    {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
    <a href="{{ route('sponsors.index') }}" class="btn btn-danger">Cancelar</a>
{!! Form::close() !!}
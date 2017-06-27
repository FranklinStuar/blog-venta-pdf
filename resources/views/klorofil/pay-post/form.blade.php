{!! Form::open(['url' => $url,'class'=>'form-horizontal','method'=>$method,'@submit'=>'save']) !!}
   

    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
        {!! Form::label('user_id', 'Usuario',['class'=>"col-md-4 control-label"]) !!}
        <div class="col-md-6">
            {!! Form::select('user_id', $users, $pay->user_id, ['class'=>'form-control','required','placeholder' => 'Seleccione un usuario','v-model'=>'user_id']) !!}
            @if ($errors->has('user_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('user_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('post_price_id') ? ' has-error' : '' }}">
        {!! Form::label('post_price_id', 'Plan Premium',['class'=>"col-md-4 control-label"]) !!}
        <div class="col-md-6">
            {!! Form::select('post_price_id', $postPrices, $pay->post_price_id, ['class'=>'form-control','required','placeholder' => 'Seleccione un Plan','v-model'=>'post_price_id','@click'=>'selectPostPrice']) !!}
            @if ($errors->has('post_price_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('post_price_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
        {!! Form::label('role_id', 'Rol de usuario',['class'=>"col-md-4 control-label"]) !!}
        <div class="col-md-6">
            {!! Form::select('role_id', $roles, $pay->role_id, ['class'=>'form-control','required','placeholder' => 'Seleccione un Rol','v-model'=>'role_id']) !!}
            @if ($errors->has('role_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('role_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
        {!! Form::label('price', 'Total a pagar',['class'=>"col-md-4 control-label"]) !!}
        <div class="col-md-6">
            {!! Form::text('price', $pay->price,['class'=>'form-control','required','autofocus','v-model'=>'price']) !!}
            @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>
    </div>

    
    <div class="form-group{{ $errors->has('method_payment') ? ' has-error' : '' }}">
        {!! Form::label('method_payment', 'Forma de pago',['class'=>"col-md-4 control-label"]) !!}
        <div class="col-md-6">
            {!! Form::select('method_payment', ['cash'=>'Efectivo','deposit'=>'Depósito Bancario'], $pay->method_payment, ['class'=>'form-control','required','placeholder' => 'Seleccione un forma de pago','v-model'=>'method_payment']) !!}
            @if ($errors->has('method_payment'))
                <span class="help-block">
                    <strong>{{ $errors->first('method_payment') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('finish') ? ' has-error' : '' }}">
        {!! Form::label('finish', 'Fecha de finalización',['class'=>"col-md-4 control-label"]) !!}
        <div class="col-md-6">
            {!! Form::text('finish', $pay->finish,['class'=>'form-control','required','autofocus','v-model'=>'finish']) !!}
            @if ($errors->has('finish'))
                <span class="help-block">
                    <strong>{{ $errors->first('finish') }}</strong>
                </span>
            @endif
        </div>
    </div>

    @if($edit)
        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            {!! Form::label('status', 'Estado',['class'=>"col-md-4 control-label"]) !!}
            <div class="col-md-6">
                {!! Form::select('status', ['active'=>'Activo','cancel'=>'Cancelado'], $pay->status, ['class'=>'form-control','required','placeholder' => 'Seleccione el estado actual del plan']) !!}
                @if ($errors->has('status'))
                    <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('observations') ? ' has-error' : '' }}">
            {!! Form::label('observations', 'Observaciones',['class'=>"col-md-4 control-label"]) !!}
            <div class="col-md-6">
                <span class="form-control">
                    {{ $pay->observations }}
                </span>
                @if ($errors->has('observations'))
                    <span class="help-block">
                        <strong>{{ $errors->first('observations') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    @endif

    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
        {!! link_to_route('pay-post.index', $title = "Cancelar",null, ['class' =>'btn btn-danger']) !!}
    </div>
{!! Form::close() !!}
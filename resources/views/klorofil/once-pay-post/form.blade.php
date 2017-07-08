{!! Form::open(['url' => $url,'class'=>'form-horizontal','method'=>$method,'@submit'=>'save']) !!}
	<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
		{!! Form::label('user_id', 'Usuario',['class'=>"col-md-4 control-label"]) !!}
		<div class="col-md-6">
			{!! Form::select('user_id', $users, $pay->user_id, ['class'=>'form-control','autofocus','required','placeholder' => 'Seleccione un usuario']) !!}
			@if ($errors->has('user_id'))
				<span class="help-block">
					<strong>{{ $errors->first('user_id') }}</strong>
				</span>
			@endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('post_id') ? ' has-error' : '' }}">
		{!! Form::label('post_id', 'Posts a pagar',['class'=>"col-md-4 control-label"]) !!}
		<div class="col-md-6">
			<select name="post_id" id="post_id" v-model="post_id" class="form-control">
				@foreach($posts as $id => $name)
					<option value="{{$id}}" @click="selectPost" >{{$name}}</option>
				@endforeach
			</select>
			@if ($errors->has('post_id'))
				<span class="help-block">
					<strong>{{ $errors->first('post_id') }}</strong>
				</span>
			@endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('post_once_price_id') ? ' has-error' : '' }}">
		{!! Form::label('post_once_price_id', 'Escoja un precio',['class'=>"col-md-4 control-label"]) !!}
		<div class="col-md-6">
			<select name="post_once_price_id" id="post_once_price_id" v-model="post_once_price_id" class="form-control">
				<option v-for="price in once_prices" :value="price.id" @click="selectPostOncePrice">@{{price.name}}</option>
			</select>
			@if ($errors->has('post_once_price_id'))
				<span class="help-block">
					<strong>{{ $errors->first('post_once_price_id') }}</strong>
				</span>
			@endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
		{!! Form::label('price', 'Total a pagar',['class'=>"col-md-4 control-label"]) !!}
		<div class="col-md-6">
			{!! Form::text('price', $pay->price,['class'=>'form-control','required','v-model'=>'price']) !!}
			@if ($errors->has('price'))
				<span class="help-block">
					<strong>{{ $errors->first('price') }}</strong>
				</span>
			@endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('finish') ? ' has-error' : '' }}">
		{!! Form::label('finish', 'Fecha de finalización',['class'=>"col-md-4 control-label"]) !!}
		<div class="col-md-6">
			{!! Form::text('finish', ($pay->finish)?$pay->finish:null,['class'=>'form-control','required','v-model'=>'finish','placeholder'=>'DD/MM/YYY']) !!}
			@if ($errors->has('finish'))
				<span class="help-block">
					<strong>{{ $errors->first('finish') }}</strong>
				</span>
			@endif
		</div>
	</div>

	@if($pay->method_payment == 'card' ||$pay->method_payment == 'paypal')
		<div class="form-group{{ $errors->has('method_payment') ? ' has-error' : '' }}">
			{!! Form::label('method_payment', 'Forma de pago',['class'=>"col-md-4 control-label"]) !!}
			<div class="col-md-6">
				{!! Form::select('method_payment', ['paypal'=>'Paypal','card'=>'Tarjeta de crédito'], $pay->method_payment, ['class'=>'form-control','required','placeholder' => 'Seleccione un forma de pago','v-model'=>'method_payment','disabled']) !!}
				@if ($errors->has('method_payment'))
					<span class="help-block">
						<strong>{{ $errors->first('method_payment') }}</strong>
					</span>
				@endif
			</div>
		</div>
	@else
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
	@endif
	

	<div v-if="method_payment == 'deposit'" class="form-group{{ $errors->has('bank_deposit') ? ' has-error' : '' }}">
		{!! Form::label('bank_deposit', 'Banco del depósito',['class'=>"col-md-4 control-label"]) !!}
		<div class="col-md-6">
			{!! Form::text('bank_deposit', null,['class'=>'form-control','required','v-model'=>'bank_deposit','placeholder'=>'Jep']) !!}
			@if ($errors->has('bank_deposit'))
				<span class="help-block">
					<strong>{{ $errors->first('bank_deposit') }}</strong>
				</span>
			@endif
		</div>
	</div>

	<div v-if="method_payment == 'deposit'" class="form-group{{ $errors->has('account_deposit') ? ' has-error' : '' }}">
		{!! Form::label('account_deposit', 'Cuenta del banco',['class'=>"col-md-4 control-label"]) !!}
		<div class="col-md-6">
			{!! Form::text('account_deposit', null,['class'=>'form-control','required','v-model'=>'account_deposit','placeholder'=>'091028393']) !!}
			@if ($errors->has('account_deposit'))
				<span class="help-block">
					<strong>{{ $errors->first('account_deposit') }}</strong>
				</span>
			@endif
		</div>
	</div>

	<div v-if="method_payment == 'deposit'" class="form-group{{ $errors->has('number_deposit') ? ' has-error' : '' }}">
		{!! Form::label('number_deposit', 'Número del depósito',['class'=>"col-md-4 control-label"]) !!}
		<div class="col-md-6">
			{!! Form::text('number_deposit', null,['class'=>'form-control','required','v-model'=>'number_deposit','placeholder'=>'89927467']) !!}
			@if ($errors->has('number_deposit'))
				<span class="help-block">
					<strong>{{ $errors->first('number_deposit') }}</strong>
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
{{-- 
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
		 --}}
	@endif

	<div class="col-md-6 col-md-offset-4">
		{!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
		{!! link_to_route('only-pay-post.index', $title = "Cancelar",null, ['class' =>'btn btn-danger']) !!}
	</div>
{!! Form::close() !!}
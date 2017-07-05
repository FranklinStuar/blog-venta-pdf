@extends('klorofil.layout')

@section('meta')
	<meta name="csrf-token" id="token" content="{{ csrf_token() }}">
	<meta id="url" content="{{ route('premium-sponsor.get-detail') }}">
@endsection

@section('content')
	<h3 class="page-title">Nuevo Pago para <a href="{{ route('sponsors.show',['sID'=>$sponsor->id]) }}"> {{$sponsor->name}} </a></h3>
	<div class="panel">
		<div class="panel-body">
			
			{!! Form::open(['url' => route('sponsor-pays.store',['sID'=>$sponsor->id,'uID'=>$user->id]),'id'=>'pay-sponsor-create','class'=>'form-horizontal']) !!}
			   
		    <div class="form-group{{ $errors->has('sponsor_price_id') ? ' has-error' : '' }}">
	        {!! Form::label('sponsor_price_id', 'Premium kit de Posts',['class'=>"col-md-4 control-label"]) !!}
	        <div class="col-md-6">
	          <select name="sponsor_price_id" id="sponsor_price_id" class="form-control" required placeholder="Seleccione un kit" v-model="sponsor_price_id">
	          	@foreach($premiums as $id => $name)
	          		<option value="{{ $id }}" @click="selectSponsorPrice">{{ $name }}</option>
	          	@endforeach
	          </select>
	          @if ($errors->has('sponsor_price_id'))
	            <span class="help-block">
	                <strong>{{ $errors->first('sponsor_price_id') }}</strong>
	            </span>
	          @endif
	        </div>
		    </div>

				<div class="form-group">
					<label for="created_at" class="col-md-4 control-label">Fecha de inicio</label>

					<div class="col-md-6">
						<span class="form-control">{{ Carbon\Carbon::now()->format('d/m/Y') }}</span>
					</div>
				</div>
	
				<div class="form-group{{ $errors->has('finish_date') ? ' has-error' : '' }}">
					<label for="finish_date" class="col-md-4 control-label">Fecha final *</label>

					<div class="col-md-6">
						<input id="finish_date" type="text" class="form-control" name="finish_date" required v-model="finish_date">

						@if ($errors->has('finish_date'))
							<span class="help-block">
								<strong>{{ $errors->first('finish_date') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('prints') ? ' has-error' : '' }}">
					{!! Form::label('prints', 'Impresiones',['class'=>"col-md-4 control-label"]) !!}
					<div class="col-md-6">
						{!! Form::text('prints', null,['class'=>'form-control','required','placeholder' => '100','v-model'=>'prints']) !!}
						@if ($errors->has('prints'))
							<span class="help-block">
								<strong>{{ $errors->first('prints') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('price_month') ? ' has-error' : '' }}">
					{!! Form::label('price_month', 'Total a pagar',['class'=>"col-md-4 control-label"]) !!}
					<div class="col-md-6">
						{!! Form::text('price_month', null,['class'=>'form-control','required','placeholder' => '0.00','v-model'=>'price_month']) !!}
						@if ($errors->has('price_month'))
							<span class="help-block">
								<strong>{{ $errors->first('price_month') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('method_payment') ? ' has-error' : '' }}">
					{!! Form::label('method_payment', 'Forma de pago *',['class'=>"col-md-4 control-label"]) !!}
					<div class="col-md-6">
						{!! Form::select('method_payment', ['cash'=>'Efectivo','deposit'=>'Depósito Bancario'], null, ['class'=>'form-control','required','placeholder' => 'Seleccione un forma de pago']) !!}
						@if ($errors->has('method_payment'))
							<span class="help-block">
								<strong>{{ $errors->first('method_payment') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<label for="name" class="col-md-4 control-label">Usuario</label>

					<div class="col-md-6">
						<span class="form-control">{{ $user->name }}</span>
					</div>
				</div>
	
				<div class="form-group">
					<label for="name" class="col-md-4 control-label">Sponsor</label>

					<div class="col-md-6">
						<span class="form-control">{{ $sponsor->name }}</span>
					</div>
				</div>
	
				<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
					<div class="col-md-offset-4 col-md-6">
						{!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('sponsors.show',['sID'=>$sponsor->id]) }}" class="btn btn-danger">Cancelar</a>
					</div>
				</div>


			{!! Form::close() !!}


		</div>
	</div>
@endsection

@section('script')
	  <script src="{{url('plugins/vuejs/axios.min.js')}}"></script>
		<script src="{{url('plugins/vuejs/vue@2.3.0.js')}}"></script>
@endsection
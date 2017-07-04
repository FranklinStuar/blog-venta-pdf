	<div class="row">
		<div class="col-sm-5">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title">Premium</h3></div>
			{!! Form::open(['url' => $url,'class'=>'form-horizontal','method'=>$method]) !!}
				<div class="panel-body">
						
					<div class="form-group">
						{!! Form::label('prints', 'Total de impresiones', ['class' => 'col-sm-4 control-label']) !!}
						<div class="col-sm-8">
							{!! Form::text('prints', $premium->prints, ['class'=>'form-control','placeholder'=>'100','required']) !!} 
							<p class="help-block">El precio no indica el precio final a cancelar</p>
						</div>
					 </div>

					<div class="form-group">
						{!! Form::label('price_month', 'Precio por mes', ['class' => 'col-sm-4 control-label']) !!}
						<div class="col-sm-8">
							{!! Form::text('price_month', $premium->price_month, ['class'=>'form-control','placeholder'=>'0.0','required']) !!} 
							<p class="help-block">El precio no indica el precio final a cancelar</p>
						</div>
					 </div>

					<div class="form-group">
						{!! Form::label('months', 'Meses permitidos', ['class' => 'col-sm-4 control-label']) !!}
						<div class="col-sm-8">
							{!! Form::text('months', $premium->months, ['class'=>'form-control','placeholder'=>'1','required']) !!} 
						</div>
					 </div>

					<div class="form-group">
						{!! Form::label('total', 'Total', ['class' => 'col-sm-4 control-label']) !!}
						<div class="col-sm-8">
							<span class="form-control">0</span>
					 	</div>
					</div>

				</div>
				<div class="panel-body">
					<center>
						<div class="btn-group " role="group" aria-label="...">
							{!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
							{!! link_to_route('premium-sponsor.index', "Cancelar",null, ['class' =>'btn btn-danger']) !!}
						</div>
					</center>
				</div>
			{!! Form::close() !!}
		</div>
	</div>

	<div class="col-sm-7">
		@if (Shinobi::can('sponsor.detail.list'))
			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title">Detalles</h3></div>
				@foreach($premium->details as $detail)
					<div class="panel-body">
						@if($edit)
							@if (Shinobi::can('sponsor.detail.destroy'))
								{!! Form::open(['route' => ['premium-sponsor.quit-category',$detail->id],'class'=>'destroy']) !!}
									<button class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
								{!! Form::close() !!}
							@endif
							<p><b>{{ $detail->title }}</b></p>
							<p>{{ $detail->excerpt }}</p>
						@else
							Debe primero guardar los precios para poder revisar los detalles
						@endif
					</div>
				@endforeach
			</div>
		@endif
		
		@if ($edit && Shinobi::can('sponsor.detail.new'))
			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title">Agregar detalle</h3></div>
				{!! Form::open(['route' => ['premium-sponsor.add-category',$premium->id],'class'=>'form-horizontal']) !!}
					<div class="panel-body">

						<div class="form-group">
							{!! Form::label('title', 'Titulo', ['class' => 'col-sm-4 control-label']) !!}
							<div class="col-sm-8">
								{!! Form::text('title', $premium->title, ['class'=>'form-control','required']) !!} 
						 	</div>
						</div>
						
						<div class="form-group">
							{!! Form::label('excerpt', 'Descripción', ['class' => 'col-sm-4 control-label']) !!}
							<div class="col-sm-8">
								{!! Form::text('excerpt', $premium->excerpt, ['class'=>'form-control','required']) !!} 
						 	</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-8">
								{!! Form::submit('Agregar',['class'=>'btn btn-primary']) !!}
						 	</div>
						</div>

					</div>
				{!! Form::close() !!}
			</div>
		@endif

	</div>
</div>

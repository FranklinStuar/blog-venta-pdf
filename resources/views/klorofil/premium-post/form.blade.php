	<div class="row">
		<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title">Premium</h3></div>
			{!! Form::open(['url' => $url,'class'=>'form-horizontal','method'=>$method]) !!}
				<div class="panel-body">
						

					
					<div class="form-group">
						{!! Form::label('name', 'Nombre', ['class' => 'col-sm-4 control-label']) !!}
						<div class="col-sm-8">
							{!! Form::text('name', $premium->name, ['class'=>'form-control','placeholder'=>'Nombre','required','autofocus']) !!} 
						</div>
					 </div>

					<hr>

					<div class="form-group">
						{!! Form::label('price', 'Precio', ['class' => 'col-sm-4 control-label']) !!}
						<div class="col-sm-8">
							{!! Form::text('price', $premium->price, ['class'=>'form-control','placeholder'=>'0.00','required','autofocus']) !!} 
						</div>
					 </div>

					<hr>

					<div class="form-group">
						{!! Form::label('time_use', 'Tiempo del plan', ['class' => 'col-sm-4 control-label']) !!}
						<div class="col-sm-8">
							{!! Form::text('time_use', $premium->time_use, ['class'=>'form-control','placeholder'=>'1','required']) !!} 
						</div>
						<div class="col-sm-8 col-sm-offset-4">
						{!! Form::select('type_use', ['day' => 'Días', 'month' => 'Meses', 'year' => 'Años'], $premium->type_use, ['class'=>'form-control','placeholder' => 'Elija un tiempo','required']) !!}
						</div>
				 	</div>

				 	<hr>

					<div class="form-group">
						{!! Form::label('role_id', 'Rol', ['class' => 'col-sm-4 control-label']) !!}
						<div class="col-sm-8">
							{!! Form::select('role_id', $roles, $premium->role_id, ['class'=>'form-control','placeholder' => 'Elija un rol para el usuario','required']) !!}
							<p class="help-block"><small>El rol del usuario contiene una lista de posts y permisos adecuados para las necesidades</small></p>
						</div>
					</div>

					<hr>

				<div class="panel-body">
					<center>
						<div class="btn-group " role="group" aria-label="...">
							{!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
							{!! link_to_route('premium-post.index', "Cancelar",null, ['class' =>'btn btn-danger']) !!}
						</div>
					</center>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
	</div>

	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title">Detalles</h3></div>
			@foreach($premium->details as $detail)
				<div class="panel-body">
					@if($edit)
						{!! Form::open(['route' => ['premium-post.quit-detail',$detail->id],'class'=>'destroy']) !!}
							<button class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
						{!! Form::close() !!}
						<p><b>{{ $detail->title }}</b></p>
						<p>{{ $detail->excerpt }}</p>
					@else
						Debe primero guardar los precios para poder revisar los detalles
					@endif
				</div>
			@endforeach
		</div>
	
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title">Agregar detalle</h3></div>
			{!! Form::open(['route' => ['premium-post.add-detail',$premium->id],'class'=>'form-horizontal']) !!}
				<div class="panel-body">

					<div class="form-group">
						{!! Form::label('title', 'Titulo', ['class' => 'col-sm-4 control-label']) !!}
						<div class="col-sm-8">
							{!! Form::text('title', null, ['class'=>'form-control','required']) !!} 
					 	</div>
					</div>
					
					<div class="form-group">
						{!! Form::label('excerpt', 'Descripción', ['class' => 'col-sm-4 control-label']) !!}
						<div class="col-sm-8">
							{!! Form::text('excerpt', null, ['class'=>'form-control','required']) !!} 
					 	</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-4">
							{!! Form::submit('Agregar',['class'=>'btn btn-primary']) !!}
					 	</div>
					</div>

				</div>
			{!! Form::close() !!}
		</div>

	</div>
</div>

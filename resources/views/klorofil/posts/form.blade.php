<div class="row">
	{!! Form::open(['url' => $url,'method'=>$method, 'files' => true]) !!}
		<div class="col-md-7">
			<div class="panel panel-primary">
		  	<div class="panel-heading">Detalles de la Publicación</div>
				<div class="panel-body">
					<div class="form-group">
						{!! Form::label('title', 'Título del post *') !!}
						{!! Form::text('title', $post->title,['class' => "form-control",'placeholder'=>"Título del post",'required','autofocus']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('excerpt', 'Descripción corta *') !!}
						{!! Form::textarea('excerpt', $post->excerpt,['class' => "form-control",'placeholder'=>"Descripción para mostrar en la página principal y para el SEO de los buscadores",'required','rows'=>'3']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('body', 'Descripción detallada *') !!}
						{!! Form::textarea('body', $post->body,['class' => "form-control",'id'=>'','placeholder'=>"Descripción detallada",'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('meta_keywords', 'Palabras claves SEO *') !!}
						{!! Form::text('meta_keywords', $post->meta_keywords,['class' => "form-control",'placeholder'=>"Palabras , claves, SEO",'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('category_id', 'Categoría *') !!}
						{!! Form::select('category_id', $categories, $post->category_id,['class' => "select2 form-control",'placeholder'=>"Escoja una categoría",'required']) !!}
					</div>
					
					<div class="form-group">
						{!! Form::label('roles[]', 'Roles') !!}
						{!! Form::select('roles[]', $roles, array_pluck($post->roles,'id'),['class' => "select2 form-control",'multiple']) !!}
					</div>

				</div>


			</div>
		</div>

		@if(!$edit)
			<div class="col-md-5">
				<div class="panel panel-primary">
			  	<div class="panel-heading">Precios</div>
					
					<div class="panel-body">
						<div class="row" >
							<div class="col-sm-3">
								{!! Form::label('price', 'Precio') !!}
							</div>
							<div class="col-sm-9">
								{!! Form::text('price', null,['class' => "form-control",'placeholder'=>"Precio del Post"]) !!}
							</div>
						</div>
						<br>
						<div class="row" >
							<div class="col-sm-3">
								{!! Form::label('time', 'Tiempo') !!}
							</div>
							<div class="col-sm-9">
								<div class="row">
									<div class="col-sm-6">
										{!! Form::text('time', null,['class' => "form-control",'placeholder'=>"1"]) !!}
									</div>
									<div class="col-sm-6">
										{!! Form::select('type_time', ['day'=>'Días','month'=>'Meses','year'=>'Años',], 'day',['class' => "select2 form-control"]) !!}
									</div>
								</div>
							</div>
						</div>
						<hr>
						<small class="help-block">Cuando guarde el post tendrá la oportunidad de colocar más precios</small>
					</div>
				</div>
			</div>
		@endif
		
		<div class="col-md-5">
			<div class="panel">
				<div class="panel-body">

					<div class="form-group" style="overflow: hidden;">
						@if($post->id != null && $post->image != null)
							<label for="image" >
								Imagen del post *
								<br><br>
								<img src="{{ url('/storage/'.$post->image) }}" style='max-with:100%; max-height: 150px; display: block; margin: auto; cursor: pointer;' alt="Background">
							</label>
							{!! Form::file('image',['id'=>'image','accept'=>'image/*']) !!}
						@else
							{!! Form::label('image', 'Imagen del post') !!}
							{!! Form::file('image',['accept'=>'image/*','required']) !!}
						@endif
					</div>
					
					<hr>

					<div class="form-group" style="overflow: hidden;">
						@if($post->id != null && $post->pdf != null)
							<label for="pdf" >
								PDF del post *
							</label>
							<br><br>
							<a href="{{ route('posts.pdf-view',['pID'=>$post->id]) }}">
								<img src="{{ url('images/pdf.png') }}" style='max-with:100%; max-height: 100px; display: block; margin: auto; cursor: pointer;' alt="pdf">
							</a>
							<br>
							{!! Form::file('pdf',['id'=>'pdf','accept'=>'.pdf']) !!}
						@else
							{!! Form::file('pdf',['id'=>'pdf','accept'=>'.pdf','required']) !!}
							{!! Form::label('pdf', 'PDF del post') !!}
						@endif
					</div>
					<hr>
						
					<div class="panel-body">
						<button class="btn btn-primary">Guardar</button>
						{!! link_to_route('posts.index', $title = "Cancelar",null, ['class' =>'btn btn-danger']) !!}
					</div>

				</div>
			</div>
		</div>
	{!! Form::close() !!}
		
	
	@if($edit)
		<div class="col-md-5">
			<div class="panel panel-primary">
			  <div class="panel-heading">Precios</div>
			  <div class="panel-body">
			  	@foreach($post->oncePrices as $price)
				  	{!! Form::open(['route'=>['posts.update-price','pID'=>$post->id,'prID'=>$price->id],'class'=>'form-inline inline-with-destroy']) !!}
						  <div class="form-group">
								{!! Form::text('price', $price->price,['class' => "form-control",'placeholder'=>"Precio",'required','size'=>'4']) !!}
						  </div>
						  <div class="form-group">
								{!! Form::text('time', $price->time,['class' => "form-control",'placeholder'=>"Tiempo",'required','size'=>'4']) !!}
						  </div>
						  <div class="form-group">
								{!! Form::select('type_time', ['day'=>'Días','month'=>'Meses','year'=>'Años',], $price->type_time,['class' => "select2 form-control",'required']) !!}
						  </div>
					  	@if (Shinobi::can('post.show'))
								<button class="btn btn-link btn-sm glyphicon glyphicon-floppy-disk"></button>
							@endif
						{!! Form::close() !!}
						@if (Shinobi::can('post.destroy'))
				  		{!! Form::open(['route'=>['posts.destroy-price','pID'=>$post->id,'prID'=>$price->id],'method'=>'DELETE','class'=>'destroy']) !!}
								<button class="btn btn-link btn-sm glyphicon glyphicon-trash"></button>
							{!! Form::close() !!}
						@endif
		  		@endforeach
			  </div>
				<div class="panel-body">
					{!! Form::open(['route'=>['posts.store-price','pID'=>$post->id]]) !!}
						<hr>
						<div class="row" >
							<div class="col-sm-3">
								{!! Form::label('price', 'Precio') !!}
							</div>
							<div class="col-sm-9">
								{!! Form::text('price', null,['class' => "form-control",'placeholder'=>"0.00",'required']) !!}
							</div>
						</div>
						<br>
						<div class="row" >
							<div class="col-sm-3">
								{!! Form::label('price', 'Tiempo') !!}
							</div>
							<div class="col-sm-9">
								<div class="row">
									<div class="col-sm-6">
										{!! Form::text('time', null,['class' => "form-control",'placeholder'=>"1",'required']) !!}
									</div>
									<div class="col-sm-6">
										{!! Form::select('type_time', ['day'=>'Días','month'=>'Meses','year'=>'Años',], 'day',['class' => "select2 form-control",'required']) !!}
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row" >
							<div class="col-sm-9 col-sm-offset-3">
								<button class="btn btn-primary">Guardar</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	@endif
		

</div>

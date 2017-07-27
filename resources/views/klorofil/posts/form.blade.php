<div class="row">
	{!! Form::open(['url' => $url,'method'=>$method, 'role'=>'form', 'files' => !$edit]) !!}
			
@if(!$edit)

	<!-- Imagen -->
	<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="imageModalLabel">Imagen de la publicación</h4>
	      </div>
	      <div class="modal-body">
			{!! Form::file('image',['accept'=>'image/*','required']) !!}
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>	

	<!-- Precios -->
	<div class="modal fade" id="pricesModal" tabindex="-1" role="dialog" aria-labelledby="pricesModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="pricesModalLabel">Precios de la publicación</h4>
	      </div>
	      <div class="modal-body">
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
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Documento -->
	<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="pdfModalLabel">Documento de la publicación</h4>
	      </div>
	      <div class="modal-body">
					<div class="form-group" style="overflow: hidden;">
						{!! Form::file('pdf',['id'=>'pdf','accept'=>'.pdf']) !!}
						<small class="help-block">
							Coloque un documento solo si es necesario
						</small>
					</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>	

	<!-- ZIP -->
	<div class="modal fade" id="zipModal" tabindex="-1" role="dialog" aria-labelledby="zipModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="zipModalLabel">Archivos zip de la publicación</h4>
	      </div>
	      <div class="modal-body">
					<div class="form-group" style="overflow: hidden;">
						{!! Form::file('zip',['id'=>'zip','accept'=>'.zip']) !!}
						<small class="help-block">
							Coloque archivo zip solo si es necesario
						</small>
					</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>	

@endif

	<!-- SEO -->
	<div class="modal fade" id="seoModal" tabindex="-1" role="dialog" aria-labelledby="seoModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="seoModalLabel">Archivos zip de la publicación</h4>
	      </div>
	      <div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							{!! Form::label('meta_keywords', 'Palabras claves SEO *') !!}
							{!! Form::text('meta_keywords', $post->meta_keywords,['class' => "form-control",'placeholder'=>"Palabras , claves, SEO",'required']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('category_id', 'Categoría *') !!}
							{!! Form::select('category_id', $categories, $post->category_id,['class' => "select2",'placeholder'=>"Escoja una categoría",'required']) !!}
						</div>
						
					</div>
				</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>	

	<!-- Precios KITS -->
	<div class="modal fade" id="kitModal" tabindex="-1" role="dialog" aria-labelledby="kitModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="kitModalLabel">Archivos zip de la publicación</h4>
	      </div>
	      <div class="modal-body">
							{!! Form::label('kits[]', 'Kits Premium') !!} <br>
							{!! Form::select('kits[]', $kits, array_pluck($post->kits,'id'),['class' => "select2 form-control",'multiple']) !!}
							<small class="help-block">Si quiere agregar a una venta en específica puede ingresar aquí</small>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>	


		<div class="col-sm-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Detalles de la Publicación
				</div>
				<div class="panel-body">
					<button type="button" class="btn btn-link btn-prices" data-toggle="modal" data-target="#pricesModal">
						<span class="glyphicon glyphicon-usd"></span> Precios Individuales
					</button>
					<button type="button" class="btn btn-link btn-prices" data-toggle="modal" data-target="#kitModal">
						<span class="glyphicon glyphicon-usd"></span> Kits
					</button>
					<button type="button" class="btn btn-link btn-prices" data-toggle="modal" data-target="#imageModal">
						<span class="glyphicon glyphicon-picture"></span> Imagen
					</button>
					<button type="button" class="btn btn-link btn-prices" data-toggle="modal" data-target="#pdfModal">
						<span class="glyphicon glyphicon-hdd"></span> Documentos
					</button>
					<button type="button" class="btn btn-link btn-prices" data-toggle="modal" data-target="#zipModal">
						<span class="glyphicon glyphicon-file"></span> Archivos Zip
					</button>
					<button type="button" class="btn btn-link btn-prices" data-toggle="modal" data-target="#seoModal">
						<span class="glyphicon glyphicon-globe"></span> SEO
					</button>
					{!! link_to_route('posts.index', $title = "Cancelar",null, ['class' =>'btn btn-danger pull-right']) !!}
					<button class="btn btn-primary pull-right">Guardar</button>
				</div>
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
						{!! Form::textarea('body', $post->body,['class' => "summernote form-control",'id'=>'contents','placeholder'=>"Descripción detallada",'required']) !!}
					</div>

				</div>
			</div>
		</div>

	{!! Form::close() !!}
		
	</div> {{-- / row --}}
	
	@if($edit)

		


		<!-- Imagen -->
		<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="imageModalLabel">Imagen de la publicación</h4>
		      </div>
		      <div class="modal-body">
						{!! Form::open(['route' => ['posts.update-image',$post->id], 'files' => true]) !!}
							<img src="{{ url('/storage/'.$post->image) }}" class="image-post-form" alt="image">
							<hr>
							<div class="form-group">
								{!! Form::file('image',['accept'=>'image/*','required']) !!}
							</div>
							<center>
								<button class="btn btn-primary btn-sm">Actualizar Imagen</button>
							</center>
						{!! Form::close() !!}
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		  </div>
		</div>	

		<!-- Precios -->
		<div class="modal fade" id="pricesModal" tabindex="-1" role="dialog" aria-labelledby="pricesModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="pricesModalLabel">Precios individuales de la publicación</h4>
		      </div>
		      <div class="modal-body">
						@foreach($post->oncePrices as $price)
						{!! Form::open(['route'=>['posts.update-price','pID'=>$post->id,'prID'=>$price->id],'class'=>'form-inline inline-with-destroy']) !!}
								<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">$</span>
									{!! Form::text('price', $price->price,['class' => "form-control",'placeholder'=>"Precio",'required','size'=>'4']) !!}
								</div>

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
							{!! Form::open(['route'=>['posts.destroy-price','pID'=>$post->id,'prID'=>$price->id],'method'=>'DELETE','class'=>'destroy']) !!}
									<button class="btn btn-link btn-sm glyphicon glyphicon-trash"></button>
							{!! Form::close() !!}
						@endforeach
						<hr>

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
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		  </div>
		</div>	

		<!-- Documento -->
		<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="pdfModalLabel">Documento de la publicación</h4>
		      </div>
		      <div class="modal-body">
						<table class="table table bordered">
		      		<thead>
		      			<tr>
		      				<th><span class="glyphicon glyphicon-picture"></span></th>
		      				<th>Nombre</th>
		      				<th>Acción</th>
		      			</tr>
		      		</thead>
		      		<tbody>
								@foreach($post->pdfs as $pdf)
			      			<tr>
			      				<td>
												<img src="{{ url('images/pdf.png') }}" alt="" class="img-table">
			      				</td>
			      				<td>{{ $pdf->name }}</td>
			      				<td>
			      					{!! Form::open(['route' => ['posts.destroy-pdf',$post->id,$pdf->id],'class'=>'delete-file']) !!}
												<button class="btn btn-link btn-link-danger btn-delete">Eliminar</button>
											{!! Form::close() !!}
											<a href="{{ route('posts.pdf-view',['pID'=>$pdf->id]) }}" target="_black">Ver</a>
			      				</td>
			      			</tr>
								@endforeach
		      		</tbody>
		      	</table>
						<hr>
						{!! Form::open(['route' => ['posts.add-pdf',$post->id], 'files' => true]) !!}
							<div class="form-group">
								{!! Form::file('pdf',['id'=>'pdf','accept'=>'.pdf','required']) !!}
							</div>
							<center>
								<button class="btn btn-primary btn-sm">Actualizar Documento</button>
							</center>
						{!! Form::close() !!}
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		  </div>
		</div>	

		<!-- ZIP -->
		<div class="modal fade" id="zipModal" tabindex="-1" role="dialog" aria-labelledby="zipModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="zipModalLabel">Archivos zip de la publicación</h4>
		      </div>
		      <div class="modal-body">
		      	<table class="table table bordered">
		      		<thead>
		      			<tr>
		      				<th><span class="glyphicon glyphicon-picture"></span></th>
		      				<th>Nombre</th>
		      				<th>Acción</th>
		      			</tr>
		      		</thead>
		      		<tbody>
								@foreach($post->zips as $zip)
			      			<tr>
			      				<td>
												<img src="{{ url('images/zip.png') }}" alt="" class="img-table">
			      				</td>
			      				<td>{{ $zip->name }}</td>
			      				<td>
			      					{!! Form::open(['route' => ['posts.destroy-zip',$post->id,$zip->id],'class'=>'delete-file']) !!}
												<button class="btn btn-link btn-link-danger btn-delete">Eliminar</button>
											{!! Form::close() !!}
											<a href="{{ url('storage/'.$zip->file) }}" target="_black">Ver</a>
			      				</td>
			      			</tr>
								@endforeach
		      		</tbody>
		      	</table>
						<hr>
						{!! Form::open(['route' => ['posts.add-zip',$post->id], 'files' => true]) !!}
							<div class="form-group">
								{!! Form::file('zip',['id'=>'zip','accept'=>'.zip','required']) !!}
							</div>
							<center>
								<button class="btn btn-primary btn-sm">Actualizar Documento</button>
							</center>
						{!! Form::close() !!}
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		  </div>
		</div>	

	@endif
		


{!! Form::open(['url' => $url,'method'=>$method, 'role'=>'form', 'files' => true]) !!}
<style>
	.img-post-form{
		max-height: 200px;
		width: 100%;
		border: 1px solid #e2e2e2;
	}
</style>	
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Detalles de la Publicación
				</div>
				@if($edit)
					<div class="panel-body">
						<img class="img-post-form" src="{{ url('storage/'.$post->image) }}" alt="{{ $post->name }}">
						<div class="form-group">
							{!! Form::file('image',['accept'=>'image/*']) !!}
						</div>
						<hr>
					</div>
				@endif
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label('title', 'Título del post *') !!}
								{!! Form::text('title', $post->title,['class' => "form-control",'placeholder'=>"Título del post",'required','autofocus','maxlength'=>250]) !!}
							</div>
							<div class="form-group">
								{!! Form::label('excerpt', 'Descripción corta *') !!}
								{!! Form::textarea('excerpt', $post->excerpt,['class' => "form-control",'placeholder'=>"Descripción para mostrar en la página principal y para el SEO de los buscadores",'required','rows'=>'3','maxlength'=>150]) !!}
							</div>
							<hr>	
							<div class="form-group">
								{!! Form::label('meta_keywords', 'Palabras claves SEO *') !!}
								{!! Form::text('meta_keywords', $post->meta_keywords,['class' => "form-control",'placeholder'=>"Palabras , claves, SEO",'required']) !!}
							</div>
						</div>
						<div class="col-md-6" >
							<div id="category_vue">
								<div class="form-group">
									{!! Form::label('category_id', 'Categoría *') !!}
									@if($edit)
										{!! Form::select('category_id', $categories, $post->category_id,['class' => "form-control",'placeholder'=>"Escoja una categoría",'v-model'=>'category','@click'=>'select_category']) !!}
									@else
										{!! Form::select('category_id', $categories, $post->category_id,['class' => "form-control",'placeholder'=>"Escoja una categoría",'required','v-model'=>'category','@click'=>'select_category']) !!}
									@endif

								</div>
								<div class="form-group">
									{!! Form::label('subcategories[]', 'Sub Categoría') !!}
									<select name="subcategories[]" id="subcategories[]" class=" form-control" multiple >
										<option v-for=" subcategory in subcategories_list" :value="subcategory.id">@{{ subcategory.name }}</option>
									</select>
									<small class="help-block">
										Si no elige subcategorías pertenecerá a todas las subcategorías al momento de listarlas en la página principal
									</small>
								</div>
							</div>
							@if($edit)
								<hr>
								<h4>Categoría: <b><u>{{ $post->category->name }}</u></b></h4>
								<ol>
									@foreach($post->subcategories as $subcategory)
										<li>{{ $subcategory->name }} </li>
									@endforeach
								</ol>
							@endif
						</div>
					</div>
				</div>
				@if(!$edit)
					<div class="panel-body">
						<hr>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									{!! Form::label('image', 'Imagen *') !!}
									{!! Form::file('image',['accept'=>'image/*','required']) !!}
								</div>
								<div class="form-group">
									{!! Form::label('pdf', 'Archivos PDF') !!}
									{!! Form::file('pdf',['id'=>'pdf','accept'=>'.pdf']) !!}
									<small class="help-block">
										Coloque un documento solo si es necesario
									</small>
								</div>
								<div class="form-group">
									{!! Form::label('zip', 'Documentos ZIP') !!}
									{!! Form::file('zip',['id'=>'zip','accept'=>'.zip']) !!}
									<small class="help-block">
										Coloque archivo zip solo si es necesario
									</small>
								</div>
							</div>
							<div class="col-md-6">
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
												{!! Form::select('type_time', ['day'=>'Días','month'=>'Meses','year'=>'Años',], 'day',['class' => "form-control"]) !!}
											</div>
										</div>
									</div>
								</div>
								<small class="help-block">Cuando guarde el post tendrá la oportunidad de colocar más precios</small>
								<hr>
								<div class="form-group">
									{!! Form::label('kits[]', 'Kits Premium') !!} <br>
									{!! Form::select('kits[]', $kits, array_pluck($post->kits,'id'),['class' => "form-control",'multiple']) !!}
									<small class="help-block">Si quiere agregar a una venta en específica puede ingresar aquí</small>
								</div>
							</div>
						</div>
						<hr>
					</div>
				@endif
				<div class="panel-body">
					<div class="form-group">
						{!! Form::label('body', 'Descripción detallada *') !!}
						{!! Form::textarea('body', $post->body,['class' => "summernote form-control",'id'=>'contents','placeholder'=>"Descripción detallada",'required']) !!}
					</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						{!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('posts.index') }}" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			</div>
		</div>
	</div> {{-- / row --}}
{!! Form::close() !!}
	@if($edit)
		<div class="row">
			<div class="col-sm-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Documentos</div>
					<div class="panel-body">
						<table class="table table bordered">
							<thead>
								<tr>
									<th>Nombre <span class="glyphicon glyphicon-file"></span></th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								@foreach($post->pdfs as $pdf)
									<tr>
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
				</div>
			</div>
			<div class="col-sm-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Archivos Zip</div>
					<div class="panel-body">
						<table class="table table bordered">
							<thead>
								<tr>
									<th>Nombre <span class="glyphicon glyphicon-file"></span></th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								@foreach($post->zips as $zip)
									<tr>
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
				</div>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">Precios y grupos de precios</div>
			<div class="panel-body">
				<div class="col-sm-6">
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
					{!! Form::open(['route'=>['posts.store-price','pID'=>$post->id],'role'=>'form','class'=>'form-horizontal']) !!}
					<h5><u><b>Nuevo Precio</b></u></h5>
						<div class="row" >
							<div class="col-sm-3">
								{!! Form::label('price', 'Precio') !!}
							</div>
							<div class="col-sm-9">
								{!! Form::text('price', null,['class' => "form-control",'placeholder'=>"0.00",'required']) !!}
							</div>
						</div>
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
						<div class="row" >
							<div class="col-sm-9 col-sm-offset-3">
								<button class="btn btn-primary">Guardar</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
				<div class="col-sm-6">
					{!! Form::open(['url' => route('posts.kit.update',['i'=>$post->id]),'method'=>'POST', 'role'=>'form']) !!}
						<div class="form-group">
							{!! Form::label('kits[]', 'Grupo de precios') !!} <br>
							{!! Form::select('kits[]', $kits, array_pluck($post->kits,'id'),['class' => "select2 form-control",'multiple']) !!}
							<small class="help-block">Una varias publicaciones a un solo precio o KIT, puede elegir uno o varios grupos  </small>
							<button class="btn btn-primary">Guardar</button>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>


		


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


	@endif
		


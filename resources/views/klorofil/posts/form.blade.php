{!! Form::open(['url' => $url,'method'=>$method, 'files' => true]) !!}
  <div class="row">
		<div class="col-sm-8">
		  <div class="panel">
	  		<div class="panel-body">
					<div class="form-group">
						{!! Form::label('title', 'Título del post') !!}
						{!! Form::text('title', $post->title,['class' => "form-control",'placeholder'=>"Título del post",'required','autofocus']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('excerpt', 'Descripción corta') !!}
						{!! Form::text('excerpt', $post->excerpt,['class' => "form-control",'placeholder'=>"Descripción corta",'required','autofocus']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('body', 'Descripción detallada') !!}
						{!! Form::textarea('body', $post->body,['class' => "form-control",'id'=>'','placeholder'=>"Descripción detallada",'required','autofocus']) !!}
					</div>
				</div>
				<div class="panel-body">
					<button class="btn btn-primary">Guardar</button>
					{!! link_to_route('posts.index', $title = "Cancelar",null, ['class' =>'btn btn-danger']) !!}
				</div>
			</div>
	  </div>
		<div class="col-sm-4">
		  <div class="panel">
	  		<div class="panel-body">

					<div class="form-group" style="overflow: hidden;">
						@if($post->id != null && $post->image != null)
							<label for="image" >
								Imagen del post
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
								PDF del post
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

					<div class="form-group">
						{!! Form::label('meta_description', 'Descripción para SEO') !!}
						{!! Form::text('meta_description', $post->meta_description,['class' => "form-control",'placeholder'=>"Descripción corta SEO",'required','autofocus']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('meta_keywords', 'Palabras claves SEO') !!}
						{!! Form::text('meta_keywords', $post->meta_keywords,['class' => "form-control",'placeholder'=>"Palabras , claves, SEO",'required','autofocus']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('category_id', 'Categoría') !!}
						{!! Form::select('category_id', $categories, $post->category_id,['class' => "form-control",'placeholder'=>"Escoja una categoría",'required','autofocus']) !!}
					</div>
				</div>
			</div>
	  </div>
	</div>
{!! Form::close() !!}

@extends('corporate.layout')

@section('metas')
<meta name="description" content="{{ str_limit($post->meta_description,160) }}">
<meta name="keywords" content="{{ $post->meta_keywords }}">
<meta name="robots" content="Index,Follow">
<meta name="author" content="neurocodigo.com">
<meta name="owner" content="{{ $post->author->name }}">
<meta name="subjetc" content="{{ $post->seo_title }}">
<meta name="languaje" content="es">
<meta name="revisit-after" content="30">
<meta name="title" content="{{ $post->seo_title }}">


<!-- Twitter Card data -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="{{ $post->title }}">
<meta name="twitter:description" content="{{ str_limit($post->meta_description,160) }}">
<meta name="twitter:creator" content="@author_handle">


<!-- Open Graph data -->
<meta property="og:title" content="{{ $post->title }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ url($post->slug) }}" />
<meta property="og:image" content="{{ url('storage/'.$post->image) }}" />
<meta property="og:description" content="{{ str_limit($post->meta_description,160) }}" />
<meta property="og:site_name" content="Neurocodigo, i.e. Moz" /meta property="fb:admins" content="1311771035" />

<!-- Twitter Summary card images. Igual o superar los 200x200px -->
<meta name="twitter:image" content="{{ url('storage/'.$post->image) }}">
@endsection

@section('title')
	{{ $post->title }}
@endsection

@section('google-script')
	{!! $system->tag_script !!}
@endsection

@section('container')

	<div class="main-post">
		<div class="title-post">
			<h1>{{ $post->title }}</h1>
			<ul>
				<li>Mecatronica-Cuenca</li>
			</ul>
		</div>
		
		<div class="body-post">
			<div class="info-post">
				<h6 class="option-info">Información</h6>
				{{-- <img class="img-fluid" src="{{ url('/storage/'.$post->image) }}" alt="{{ $post->title }}"> --}}
				<a class="link-post" href="{{ route('show-user',['uID'=>$post->author->username]) }}">
					<i class="fa fa-user" aria-hidden="true"></i>
					{{ $post->author->name }}
				</a>
				<p class="link-post">
					<i class="fa fa-calendar" aria-hidden="true"></i>
					{{ $post->created_at->diffForHumans() }}
				</p>
				<h6 class="option-info">Categorias</h6>
				<ul class="list-categories-post">
					<li>
						<a href="{{ route('show-category',['cID'=>$post->category->slug]) }}">{{ $post->category->name }}</a>
					</li>
				</ul>
					
				@include('corporate.sponsors.print',['sponsor_show'=>$system->sponsorRandom()])
			</div>
			<div class="detail-post">
				<div class="excerpt-post">
					{{ $post->excerpt }}
				</div>
				
				<?php
					echo $post->body;
				?>
			</div>
			<div class="documents-post"></div>

		</div>

		<div class="extra-post">
			
				<div class="sponsor-google-show">
						{!! $system->tag_body !!}
				</div>
			<div class="sugerence">
				<div class="option-info">Te sugerimos</div>
				<div class="posts-sugerent">
					@foreach($post->otherPosts() as $i => $other_post)
						<a href="{{ route('show-post',['PN'=> $other_post->slug]) }}" class="other-post" title="{{ str_limit($other_post->title) }}">
							<i>{{ $i+1 }}</i> {{ str_limit($other_post->title) }} 
						</a>
					@endforeach
				</div>
			</div>

			@if(count($post->zips) > 0 || count($post->pdfs) > 0)
				<div class="panel panel-post-column concept">
					@if(count($post->zips) > 0)
						<div class="panel-heading">Archivos</div>

						@if(Auth::user() && (count($post->oncePrices) == 0 ||Auth::user()->isRole('superadmin')||Auth::user()->isRole('admin') || (Auth::user()->postStatus($post->id))))
							<div class="panel-body container-img-pdf">
								@foreach($post->zips as $zip)
									<ul>
										<li>
											<a href="{{ Storage::url($zip->file) }}" class="link-pdf-show">
												<img src="{{ url('images/zip.png') }}" class="img-pdf-show" alt="{{ $zip->name }}">
												<span> {{ $zip->name }} </span>
											</a>
										</li>
									</ul>
								@endforeach
							</div>
						@elseif(!Auth::user() && count($post->oncePrices) == 0)
							<div class="panel-body">
								<img src="{{ url('/images/gratis.png') }}" alt="gratis png" class="img-fluid">
								Hay archivos gratuitos. Puede visulizar y disfrutar de los archivos con solo registrarse
							</div>
						@else
								<div class="panel-body">No tiene acceso a los archivos <hr></div>
						@endif
					@endif
					
					@if(count($post->pdfs) > 0)
							<div class="panel-heading">Documentos</div>
							
							@if(Auth::user() != null && ((Auth::user() != null && Auth::user()->postStatus($post->id)) || count($post->oncePrices) == 0 ||Auth::user()->isRole('superadmin')||Auth::user()->isRole('admin')))
								<div class="panel-body container-img-pdf">
									@foreach($post->pdfs as $pdf)
										<ul>
											<li>
												<a href="{{ route('show-pdf',['pID'=>$pdf->id]) }}" class="link-pdf-show">
													<img src="{{ url('images/pdf.png') }}" class="img-pdf-show" alt="Libro">
													<span> {{ $pdf->name }} </span>
												</a>
											</li>
										</ul>
									@endforeach
								</div>
							@elseif(!Auth::user() && count($post->oncePrices) == 0)
								<div class="panel-body">
									<img src="{{ url('/images/gratis.png') }}" alt="gratis png" class="img-fluid">
									Hay documentos gratuitos. Puede visulizar y disfrutar de los documentos con solo registrarse
								</div>
							@else
								<div class="panel-body">No tiene acceso a los documentos <hr></div>
							@endif
					@endif

					@if(Auth::user() && (count($post->pdfs) > 0 || count($post->zips) > 0)  && !( (Auth::user() && Auth::user()->postStatus($post->id)) || count($post->oncePrices) == 0 || (Auth::user() && Auth::user()->isRole('superadmin'))|| (Auth::user() && Auth::user()->isRole('admin'))))
						
						<div class="panel-body">
							@foreach($post->oncePrices as $price)
								<ul >
									<li>

										$ {{$price->price}} -
										<span class="time-premium">Plan de {{$price->timeView()}}</span> 
										{!! Form::open(['route' => ['post.payment-card',$post->id,$price->id]]) !!}
										  <script
										    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
										    data-key="pk_live_EeYbQY9AdMOY66ZqbsckdOUr"
										    data-name="Neurocodigo"
										    data-email="{{ Auth::user()->email }}"
										    data-amount="{{ $price->price*100 }}"
										    {{-- data-image="https://stripe.com/img/documentation/checkout/marketplace.png" --}}
										    >
										  </script>
										  {!! Form::close() !!}
									</li>
								</ul>
							@endforeach
						</div>
					@endif
				</div>
			@endif
			

			<div class="sugerence">
				<div class="option-info">Categorías</div>
				<div class="posts-sugerent">
					@foreach($categories as $i => $category)
						<a href="{{ route('show-category',['CN'=> $category->slug]) }}" class="other-post" title="{{ str_limit($category->name) }}">
							<i>{{ $i+1 }}</i> {{ str_limit($category->name) }} 
						</a>
					@endforeach
				</div>
			</div>
		</div>

		<div class="comments-post">
			<h3>Comentarios</h3>
			
		</div>

	</div>
@endsection
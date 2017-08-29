@extends('flat.posts.template')
@section('breadcrumb')
	<li><a href="{{ route('show-service',[$post->category->slug]) }}">{{ $post->category->name }}</a></li>
	<li class="active">Publicación</li>
@endsection

@section('title')
{{ $post->title }}
@endsection

@section('metas')
	<meta name="title" content="{{ $post->seo_title }}">
	<meta name="description" content="{{ $post->excerpt }}">
	<meta name="news_keywords" content="{{ $post->meta_keywords }}">
	<meta name="author" content="{{ url('/') }}">
	<meta name="owner" content="{{ $post->author->name }}">
	<meta name="subjetc" content="{{ $post->seo_title }}">
	<meta name="languaje" content="es">
	<meta name="revisit-after" content="30">


	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@publisher_handle">
	<meta name="twitter:title" content="{{ $post->title }}">
	<meta name="twitter:description" content="{{ str_limit($post->meta_description,160) }}">
	<meta name="twitter:creator" content="@author_handle">
	<!-- Twitter Summary card images. Igual o superar los 200x200px -->
	<meta name="twitter:image" content="{{ url('storage/'.$post->image) }}">



	<meta property="og:url"                content="{{ route('show-post',[$post->category->slug,$post->slug]) }}" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="{{ $post->title }}" />
	<meta property="og:description"        content="{{ $post->excerpt }}" />
	<meta property="og:image"              content="{{ url('storage/'.$post->image) }}" />
	<meta property="og:updated_time" content="{{ $post->updated_at }}">

	<meta name="DC.Creator" content="{{ $post->author->name }}" />
	<meta name="DC.Date" content="{{ $post->created_at->diffForHumans() }}" />
	<meta name="DC.Source" content="Neurocodigo" />
	<meta property="article:modified_time" content="{{ $post->updated_at }}">
	<meta property="article:published_time" content="{{ $post->created_at }}">
	<link rel="canonical" href="{{ route('show-post',[$post->category->slug,$post->slug]) }}" />

@endsection

@section('fb')

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.10&appId=197798067417693";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

@endsection

@section('content-post')
	<div class="blog">
		<div class="blog-item">
			<img class="img-responsive img-blog" src="{{ url('storage/'.$post->image) }}" width="100%" alt="{{ $post->title }}" />
			<div class="blog-content">
				<h3>{{ $post->title }}</h3>
				<div class="entry-meta">
					<span><i class="icon-user"></i> <a href="{{ route('show-author',[$post->author->username]) }}">{{ $post->author->name }}</a></span>
					<span><i class="icon-folder-close"></i> <a href="{{ route('show-service',[$post->category->slug]) }}">{{ $post->category->name }}</a></span>
					<span><i class="icon-calendar"></i> {{ $post->created_at->diffForHumans() }}</span>
				</div>
				<p class="lead">{{ $post->excerpt }}</p>

				{!! $post->body !!}
				
				@if(count($post->pdfs) > 0 || count($post->zips) > 0) 
					<hr>
				@endif


				@if(count($post->pdfs) > 0)
					<div class="documents">
						@foreach($post->pdfs as $pdf)
							<div class="files-list">
								<div class="files-icon">
									<i class="fa pdf fa-file-pdf-o" aria-hidden="true"></i>
								</div>
								<div class="files-body">
									<h4>{{ $pdf->name }}</h4>

									@if(Auth::user() != null && ((Auth::user() != null && Auth::user()->postStatus($post->id)) || count($post->oncePrices) == 0 ||Auth::user()->isRole('superadmin')||Auth::user()->isRole('admin')))
										<small><a href="{{ route('show-pdf',[$post->category->slug,$post->slug,str_slug($pdf->name,'-'),$pdf->id]) }}">Ver Documento</a></small>
									@else
										<small>No tiene acceso para visualizar</small>
									@endif
								</div>
							</div>
						@endforeach
					</div>
				@endif

				@if(count($post->zips) > 0)
					<div class="zip">
						@foreach($post->zips as $zip)
							<div class="files-list">
								<div class="files-icon">
									<i class="fa zip fa-file-archive-o" aria-hidden="true"></i>
								</div>
								<div class="files-body">
									@if(Auth::user() && (count($post->oncePrices) == 0 ||Auth::user()->isRole('superadmin')||Auth::user()->isRole('admin') || (Auth::user()->postStatus($post->id))))
										<small><a href="{{ route('download-zip',[$post->category->slug,$post->slug,$zip->id,'token'=>$token]) }}">Decargar Archivo</a></small>
									@else
										<small>No tiene acceso para descargar</small>
									@endif
								</div>
							</div>
						@endforeach
					</div>
				@endif
				@if(count($post->zips) > 0 || count($post->pdfs) > 0)
					@if(!Auth::user())
				    <div class="center">
				        <h2>Acceso Restringido</h2>
				        <p class="lead">No tiene acceso para visualizar los archivos y/o documentos</p>
				    </div><!--/.center-->   
				    <div class="gap"></div>
				  @elseif(Auth::user())
				    @if(!Auth::user()->postStatus($post->id) && !Auth::user()->isRole('superadmin') && !Auth::user()->isRole('admin'))
							<center><h4>Obten tu acceso</h4></center>
							<div id="pricing-table" class="row">
								@foreach($post->oncePrices as $price)
									<div class="col-md-4 col-xs-12">
										<ul class="plan plan1 ">
											
											<li class="plan-price">
												<div>
													<span class="price"><sup>$</sup>{{$price->price}}</span>
													<small>{{$price->timeView()}}</small>
												</div>
											</li>
											<li class="plan-action">
												<a href="{{ route('post.payments',[$post->slug,$price->id.'.'.str_random(16)]) }}" class="btn btn-primary btn-md btn-sm "> Tarjeta</a>
												<a href="{{ route('post.payment-paypal',[$post->slug,$price->id.'.'.str_random(16)]) }}" class="btn btn-primary btn-md btn-sm "> Paypal</a>
											</li>
										</ul>
									</div><!--/.col-md-4-->
								@endforeach
							</div> 
						@endif
					@endif
				@endif
	{{-- 
				<div class="tags">
					<i class="icon-tags"></i> Tags <a class="btn btn-xs btn-primary" href="#">CSS3</a> <a class="btn btn-xs btn-primary" href="#">HTML5</a> <a class="btn btn-xs btn-primary" href="#">WordPress</a> <a class="btn btn-xs btn-primary" href="#">Joomla</a>
				</div>
 --}}
 				<hr>
				<div
				  class="fb-like"
				  data-share="true"
				  data-width="450"
				  data-show-faces="true">
				</div>
				<p>&nbsp;</p>
{{-- 
				<div class="author well">
					<div class="media">
						<div class="pull-left">
						<style>
							.avatar{
								width: 80px
							}
						</style>
							<img class="avatar img-thumbnail" src="{{ url('images/'.$post->author->avatar) }}" alt="{{ $post->author->name }}" >
						</div>
						<div class="media-body">
							<div class="media-heading">
								<strong>{{ $post->author->name }}</strong>
							</div>
							<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper.</p>
						</div>
					</div>
				</div><!--/.author-->
				 --}}
				
				<div class="sponsor-google-show">
					{!! $system->tag_body !!}
				</div>
				<div id="comments">
					<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="5" data-width="100%"></div>
				</div>
				
			</div>
		</div><!--/.blog-item-->
	</div>

@endsection

@section('widget-more-options')
	<div class="widget more-captions">
		<h4>Te recomendamos</h4>
		@foreach($post->otherPosts() as $other)
			<div class="row other-post">
				<div class="col-sm-7">
					<a class="link-more" href="{{ route('show-post',[$other->category_slug,$other->slug]) }}" title="{{ $other->title }}">
						<h5>{{ str_limit($other->title,40) }}</h5>
					</a>
					<p>{{ $other->excerpt }}</p>
					<a class="read-more" href="{{ route('show-post',[$other->category_slug,$other->slug]) }}">Leer más</a>
				</div>
				<div class="col-sm-5">
					<a href="{{ route('show-post',[$other->category_slug,$other->slug]) }}" title="{{ $other->title }}">
						<img src="{{ url('storage/'.$other->image) }}" alt="{{ $other->title }}" class="img-fluid">
					</a>
				</div>
			</div>
		@endforeach
	</div>
@endsection

@push('scripts')
	<script type="text/javascript" src="{{ url('plugins/creditCardValidator/jquery.creditCardValidator.js') }}"></script>
@endpush
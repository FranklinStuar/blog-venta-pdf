<section id="services" class="">
	<div>
		<h2>Servicios</h2>
	</div>
	<div class="row">
		
		<div class="col-lg-2 col-md-1">
			<div class="btn-group">
				<a class="btn btn-danger btn-xs" href="#scroller" data-slide="prev"><i class="fa fa-angle-left"></i></a>
				<a class="btn btn-danger btn-xs" href="#scroller" data-slide="next"><i class="fa fa-angle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-10 col-md-11">
			<div id="scroller" class="carousel slide">
				<div class="carousel-inner">
					@foreach($categories as $index => $category)
						@if($index == 0 || ($index%4)==0)
							<div class="item @if($index == 0) active @endif">
								<div class="row">
						@endif
									<div class="col-lg-3 col-xs-6">
										<div class="portfolio-item">
											<div class="item-inner">
												<img class="img-responsive" src="{{ url('storage/'.$category->image) }}" alt="{{ $category->name }}">
												<h5>
													{{ $category->name }}
												</h5>
												<div class="overlay">
													<a class="preview btn btn-danger" title="{{ $category->excerpt }}" href="{{ route('show-service',[$category->slug]) }}" title="{{ $category->name }}"><i class="fa fa-eye"></i></a>
												</div>
											</div>
										</div>
									</div>   

						@if((($index+1)%4)==0 || $index == count($categories)-1)
								</div><!--/.row-->
							</div><!--/.item-->
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
<hr class="alizarin">
<section id="portfolio" class="container">
	<h2>Publicaciones</h2>
	<div class="row">
		
		<ul class="portfolio-items ">
			@foreach($posts as $post)

				<li class="col-md-4 co-xs-12">
					<div class="portfolio-item">
						
						<div class="item-inner">
							<img src="{{ url('storage/'.$post->image) }}" alt="{{ $post->title }}">
							<h5>{{ str_limit($post->title,30) }}</h5>
							<h3 class="hidden">{{ $post->excerpt }}</h3>
							<h6><u>{{ $post->category->name }}</u></h6>
							<div class="overlay">
								<a class="preview btn btn-danger" href="{{ route('show-post',[$post->category->slug,$post->slug]) }}" title="{{ $post->title }}"><i class="fa fa-eye"></i></a>              
							</div>           
						</div>           
					</div>
				</li><!--/.portfolio-item-->
			@endforeach
		</ul>
	</div>
	{{ $posts->links() }}
</section><!--/#portfolio-->

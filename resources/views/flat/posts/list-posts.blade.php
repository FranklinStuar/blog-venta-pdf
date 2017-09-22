
<section id="portfolio" class="container">
	@if(isset($subCategories))
		@isset($subCategory_active)
			<ul class="portfolio-filter">
				<li><a class="btn btn-default" href="{{ route('show-service',[$slug]) }}" data-filter="*">All</a></li>
				@foreach($subCategories as $subCategory)
					<li><a class="btn btn-default @if($subCategory->slug == $subCategory_active) active @endif" href="{{ route('show-sub-service',[$slug,$subCategory->slug]) }}" data-filter=".{{ $subCategory->slug }}">{{ $subCategory->name }}</a></li>
				@endforeach
			</ul><!--/#portfolio-filter-->
		@else
			<ul class="portfolio-filter">
				<li><a class="btn btn-default active" href="#" data-filter="*">All</a></li>
				@foreach($subCategories as $subCategory)
					<li><a class="btn btn-default" href="{{ route('show-sub-service',[$slug,$subCategory->slug]) }}" data-filter=".{{ $subCategory->slug }}">{{ $subCategory->name }}</a></li>
				@endforeach
			</ul><!--/#portfolio-filter-->
		@endisset
	@endif
	
	
	<ul class="portfolio-items col-3">
		@foreach($posts as $post)

			<li class="portfolio-item">
				<div class="item-inner">
					<img src="{{ url('storage/'.$post->image) }}" alt="">
					<h5>{{ $post->title }}</h5>
					<div class="overlay">
						<a class="preview btn btn-danger" href="{{ route('show-post',[$slug,$post->slug]) }}"><i class="fa fa-eye"></i></a>              
					</div>           
				</div>           
			</li><!--/.portfolio-item-->
		@endforeach
	</ul>
	{{ $posts->links() }}
</section><!--/#portfolio-->

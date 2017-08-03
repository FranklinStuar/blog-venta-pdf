<div class="row">
	@foreach($posts as $index =>$post)
		@if(($index==2 || ($index>9 && ($index+1) % 5 ==0)) )
			<div class="col-md-6 col-lg-3 col-md-4">
					@include('corporate.sponsors.print',['sponsor_show'=>$system->sponsorRandom()])
			</div>
		@endif
		@if(($index+1) % 8 ==0)
			<div class="col-md-6 col-lg-3 col-md-4">
					{!! $system->tag_body !!}
				
			</div>
		@endif
		<div class="col-md-6 col-lg-3 col-md-4">
			<div class="card wow fadeIn" data-wow-delay="0.2s">
				<div class="img view overlay hm-white-light z-depth-1-half">
					<img src="{{ url('/storage/'.$post->image) }}" alt="{{ $post->title }}">
					<a  href="{{ route('show-post',['PN'=> $post->slug]) }}" title="{{ $post->title }}">
						<div class="mask"></div>
					</a>
				</div>
				<div class="content-post">
					<a  href="{{ route('show-post',['PN'=> $post->slug]) }}" title="{{ $post->title }}">
						<h2 class="h2-responsive">{{ $post->title }}</h2>
					</a>
					<p>{{ str_limit($post->excerpt,150) }}</p>
					<ul>
						<li class="li-author"><a href="{{ route('show-category',[$post->category->slug]) }}">{{ $post->category->name }}</a></li>
					</ul>
				</div>
			</div>
		</div>
	@endforeach
</div>


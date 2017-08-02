<div class="row">
	@foreach($posts as $index =>$post)
		@if(($index==2 || ($index>9 && ($index+1) % 5 ==0)) && isset($sponsor_show))
			<div class="col-md-6 col-lg-3 col-md-4">
				<div class="preview-post preview-sponsor">
					@include('corporate.sponsors.print')
				</div>
			</div>
		@endif
		@if(($index+1) % 8 ==0)
			<div class="col-md-6 col-lg-3 col-md-4">
				<div class="preview-post preview-sponsor">
					{!! $system->tag_body !!}
				</div>
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
					<p>{{ str_limit($post->excerpt,250) }}</p>
					<ul>
						<li class="li-author"><a href="{{ route('show-user',[$post->author->username]) }}">{{ $post->author->name }}</a></li>
						<li class="li-date">{{ $post->created_at->diffForHumans() }}</li>
					</ul>
				</div>
			</div>
		</div>
	@endforeach
</div>


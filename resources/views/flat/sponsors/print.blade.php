@if($section == "lateral")
	
	<div class="sponsor row">
		<div class="col-xs-7">
			<h4>{{ $sponsor->name }}</h4>
			@if($sponsor->excerpt)
				<p><i class="fa fa-info" aria-hidden="true"></i> {{ str_limit($sponsor->excerpt,80) }}</p>
			@endif
			@if($sponsor->address)
				<p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $sponsor->address }}</p>
			@endif
			@if($sponsor->phone)
				<p><i class="fa fa-phone" aria-hidden="true"></i> {{ $sponsor->phone }}</p>
			@endif
			@if($sponsor->web)
				<p><i class="fa fa-globe" aria-hidden="true"></i> <a href="{{ $sponsor->web }}">Ver Sitio web</a></p>
			@endif
			<div class="sponsor social-media">
				@if($sponsor->url_facebook)
					<a href="{{ $sponsor->url_facebook }}" title="Ir a sitio">
						<i class="fa fa-facebook" aria-hidden="true"></i>
					</a>
				@endif
				@if($sponsor->url_youtube)
					<a href="{{ $sponsor->url_youtube }}" title="Ir a sitio">
						<i class="fa fa-youtube" aria-hidden="true"></i>
					</a>
				@endif
				@if($sponsor->url_twitter)
					<a href="{{ $sponsor->url_twitter }}" title="Ir a sitio">
						<i class="fa fa-twitter" aria-hidden="true"></i>
					</a>
				@endif
				@if($sponsor->url_instagram)
					<a href="{{ $sponsor->url_instagram }}" title="Ir a sitio">
						<i class="fa fa-instagram" aria-hidden="true"></i>
					</a>
				@endif
			</div>
		</div>
		<div class="col-xs-5">
			@if($sponsor->web)
				<a href="#"><img class="img-fluid" src="{{ Storage::url($sponsor->image) }}" alt="{{ $sponsor->name }}"></a>
			@else
				<img class="img-fluid" src="{{ Storage::url($sponsor->image) }}" alt="{{ $sponsor->name }}">
			@endif
			<br><br>
		</div>
	</div>
@endif
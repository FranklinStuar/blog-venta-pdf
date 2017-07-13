@if(Shinobi::can('sponsor.quit.others') == false && isset($sponsor_show))
<style>
	
</style>
	<a href="#" class="sponsor-show">
		<img src="{{ url('images/credit-card.png') }}" alt="{{ $sponsor_show->name }}">
		<span class="title-sponsor">{{ $sponsor_show->name }}</span>
		{{-- <span class="description-sponsor">{{ $sponsor_show->excerpt }}</span> --}}
	</a>

@endif
@if(Shinobi::can('sponsor.quit.others') == false && isset($sponsor_show))
	@if(isset($print))
		<a href="#">
			<h6>
				<b>{{ $sponsor_show->name }}</b>
				<br>
				<small>{{ $sponsor_show->excerpt }}</small>
			</h6>
		</a>
	@else
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<a href="#">
					<h6>
						<b>{{ $sponsor_show->name }}</b>
						<br>
						<small>{{ $sponsor_show->excerpt }}</small>
					</h6>
					<hr class="extra-margins">
				</a>
			</div>
		</div>
	@endif
@endif
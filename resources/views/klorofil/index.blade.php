@extends('klorofil.layout')
@section('content')
	<!-- OVERVIEW -->
	<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Descripción semanal</h3>
			<p class="panel-subtitle">Periodo: {{ Carbon\Carbon::now()->subDays(7)->format(' F j\\, Y') }} - {{ Carbon\Carbon::now()->format(' F j\\, Y') }} </p>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-download"></i></span>
						<p>
							<span class="number">{{ $posts->count() }}</span>
							<span class="title">Posts</span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-shopping-bag"></i></span>
						<p>
							<span class="number">{{ $sponsors->count() }}</span>
							<span class="title">Sponsors</span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-eye"></i></span>
						<p>
							<span class="number">{{ $visit_posts->count() }}</span>
							<span class="title">Visitas Post</span>
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-bar-chart"></i></span>
						<p>
							<span class="number">{{ $users->count() }}</span>
							<span class="title">Usuarios</span>
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9">
					<div id="headline-chart" class="ct-chart"></div>
				</div>
				<div class="col-md-3">
					<div class="weekly-summary text-right">
						<span class="number">{{ $totalPays }}</span> 
						{{-- <span class="percentage"><i class="fa fa-caret-up text-success"></i> {{ $post_pays->count() }}%</span> --}}
						<span class="info-label">Total Ventas</span>
					</div>
					<div class="weekly-summary text-right">
						<span class="number">${{ $paysToday }}</span> 
						{{-- <span class="percentage"><i class="fa fa-caret-up text-success"></i> {{ $paysToday *100 / $totalMonth }}%</span> --}}
						<span class="info-label">Ingreso Hoy</span>
					</div>
					<div class="weekly-summary text-right">
						<span class="number">${{ $totalMonth }}</span> 
						{{-- <span class="percentage"><i class="fa fa-caret-down text-danger"></i> {{ $post_pays->count() }}%</span> --}}
						<span class="info-label">Ingreso Mensual</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END OVERVIEW -->
	<div class="row">
		<div class="col-md-6">
			<!-- RECENT PURCHASES -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Ventas de Post Recientes</h3>
					<div class="right">
						<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
					</div>
				</div>
				<div class="panel-body no-padding table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>No.</th>
								<th>Post</th>
								<th>Precio</th>
								<th>Fecha</th>
							</tr>
						</thead>
						@foreach($post_pays as $index=> $post)
						<tbody>
							<tr>
								<td><a href="{{ route('pay-post.show',['ppID'=>$post->id]) }}">{{ $index+1 }}</a></td>
								<td>{{ $post->postPrice->name}}</td>
								<td>$ {{ $post->price}}</td>
								<td>{{ $post->created_at }}</td>
							</tr>
						</tbody>
						<?php if($index == 4) break;?>
						@endforeach
					</table>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Ultimos 5 Posts Vendidos</span></div>
						<div class="col-md-6 text-right"><a href="{{ route('pay-post.index') }}" class="btn btn-primary">Ver todas las ventas</a></div>
					</div>
				</div>
			</div>
			<!-- END RECENT PURCHASES -->
		</div>

		<div class="col-md-6">
			<!-- RECENT PURCHASES -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Pagos por Sponsors</h3>
					<div class="right">
						<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
					</div>
				</div>
				<div class="panel-body no-padding table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>No.</th>
								<th>Título</th>
								<th>Usuario</th>
								<th>Fecha</th>
							</tr>
						</thead>
						@foreach($sponsors as $index=> $sponsor)
						<tbody>
							<tr>
								<td><a href="{{ route('sponsors.show',['pID'=>$sponsor->id]) }}">{{ $index +1 }}</a></td>
								<td><a href="{{ route('sponsors.show',['pID'=>$sponsor->id]) }}">{{ $sponsor->name}}</a></td>
								<td>{{ $sponsor->user->username}}</td>
								<td>{{ $sponsor->created_at}}</td>
							</tr>
						</tbody>
						<?php if($index == 4) break;?>
						@endforeach
					</table>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-6"><span class="panel-note"><i class="fa fa-list"></i> Ultimos 5 Sponsors Realizados</span></div>
						<div class="col-md-6 text-right"><a href="{{ route('sponsors.index') }}" class="btn btn-primary">Ver todos los sponsors</a></div>
					</div>
				</div>
			</div>
			<!-- END RECENT PURCHASES -->
		</div>
	
	</div>


	<div class="row">
		<div class="col-md-6">
			<!-- MULTI CHARTS -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Ventas Posts y Sponsors</h3>
					<div class="right">
						<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
					</div>
				</div>
				<div class="panel-body">
					<div id="visits-trends-chart" class="ct-chart"></div>
				</div>
			</div>
			<!-- END MULTI CHARTS -->
		</div>
		<div class="col-md-6">
			<!-- VISIT CHART -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Visitas web</h3>
					<div class="right">
						<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
					</div>
				</div>
				<div class="panel-body">
					<div id="visits-chart" class="ct-chart"></div>
				</div>
			</div>
			<!-- END VISIT CHART -->
		</div>

	</div>
			
@endsection
@section('script')
<script>
	$(function() {
		var data, options;

		// headline charts
		data = {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			series: [
				[23, 29, 24, 40, 25, 24, 35],
				[14, 25, 18, 34, 29, 38, 44],
			]
		};

		options = {
			height: 300,
			showArea: true,
			showLine: false,
			showPoint: false,
			fullWidth: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
		};

		new Chartist.Line('#headline-chart', data, options);


		// visits trend charts
		data = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			series: [{
				name: 'series-real',
				data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
			}, {
				name: 'series-projection',
				data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
			}]
		};

		options = {
			fullWidth: true,
			lineSmooth: false,
			height: "270px",
			low: 0,
			high: 'auto',
			series: {
				'series-projection': {
					showArea: true,
					showPoint: false,
					showLine: false
				},
			},
			axisX: {
				showGrid: false,

			},
			axisY: {
				showGrid: false,
				onlyInteger: true,
				offset: 0,
			},
			chartPadding: {
				left: 20,
				right: 20
			}
		};

		new Chartist.Line('#visits-trends-chart', data, options);


		// visits chart
		data = {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			series: [
				[6384, 6342, 5437, 2764, 3958, 5068, 7654]
			]
		};

		options = {
			height: 300,
			axisX: {
				showGrid: false
			},
		};

		new Chartist.Bar('#visits-chart', data, options);


		// real-time pie chart
		var sysLoad = $('#system-load').easyPieChart({
			size: 130,
			barColor: function(percent) {
				return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
			},
			trackColor: 'rgba(245, 245, 245, 0.8)',
			scaleColor: false,
			lineWidth: 5,
			lineCap: "square",
			animate: 800
		});

		var updateInterval = 3000; // in milliseconds

		setInterval(function() {
			var randomVal;
			randomVal = getRandomInt(0, 100);

			sysLoad.data('easyPieChart').update(randomVal);
			sysLoad.find('.percent').text(randomVal);
		}, updateInterval);

		function getRandomInt(min, max) {
			return Math.floor(Math.random() * (max - min + 1)) + min;
		}

	});
</script>
@endsection

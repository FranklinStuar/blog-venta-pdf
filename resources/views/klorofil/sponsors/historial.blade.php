@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Historial de la publicidad: {{ $sponsor->name }}</h3>
	<div class="panel">
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Fecha</th>
						<th>Url</th>
						<th>Usuario</th>
						<th>IP</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sponsor->prints as $index => $print)
						<tr>
							<td>{{ $index+1 }}</td>
							<td>{{ $print->historial->created_at }}</td>
							<td>{{ $print->historial->path }}</td>
							<td>
								@if($print->historial->user != null)
									{{ $print->historial->user->username }}
								@else
								-
								@endif
							</td>
							<td>{{ $print->historial->ip }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection

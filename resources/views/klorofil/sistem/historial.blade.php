@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Historial de ingresos al sistema</h3>
	<div class="panel">
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Fecha</th>
						<th>Url</th>
						{{-- <th>Usuario</th> --}}
						<th>IP</th>
						<th>Navegador</th>
						<th>Idioma</th>
					</tr>
				</thead>
				<tbody>
					@foreach($historial as $index => $history)
						<tr>
							<td>{{ $index+1 }}</td>
							<td>{{ $history->created_at }}</td>
							<td>{{ $history->path }}</td>
							{{-- <td>{{ $history->user }}</td> --}}
							<td>{{ $history->ip }}</td>
							<td>{{ $history->user_agent }}</td>
							<td>{{ $history->languaje }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="panel-body">
			{{ $historial->links() }}
		</div>
	</div>
@endsection

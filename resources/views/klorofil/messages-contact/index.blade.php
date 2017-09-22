@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Mensajes</h3>
	<div class="panel">
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Estado</th>
						<th>Fecha</th>
						<th>Nombre</th>
						<th>Mensaje</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($messages as $message)
						<tr>
							<td>
								<span class="notification-item">
									@if($message->status=='sin_revisar')
										<span class="dot bg-success"></span>
									@elseif($message->status=='revisado')
										<span class="dot bg-info"></span>
									@endif
								</span>
							</td>
							<td>{{ $message->created_at->diffForHumans()}}</td>
							<td>{{ $message->name }}</td>
							<td>{{ str_limit($message->message) }}</td>
							<td>
								<a href="{{ route('messages-contact.show',[$message->id]) }}" ><span class="glyphicon glyphicon-open-eye">Ver</span></a>
								{!! Form::open(['route' => ['messages-contact.destroy',$message->id],'method'=>'DELETE','class'=>'destroy']) !!}
									<button class="btn btn-link glyphicon glyphicon-trash"></button>
								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{ $messages->links() }}
		</div>
	</div>
@endsection

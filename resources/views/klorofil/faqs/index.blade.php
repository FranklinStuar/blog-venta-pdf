@extends('klorofil.layout')
@section('content')
	<h3 class="page-title">Preguntas frecuentes</h3>
	<div class="panel">
		<div class="panel-body">
			<div class="col-sm-4">
				<a href="{{ route('faqs.create') }}" class="btn btn-primary">Nueva Pregunta  <span class="lnr lnr-plus-circle"></span></a>
			</div>
		</div>
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Pregunta</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($faqs as $index => $faq)
						<tr>
							<td>{{ $index+1 }}</td>
							<td>{{ $faq->question }}</td>
							<td>
								{!! link_to_route('faqs.edit', "",['i'=>$faq->id], ['class' =>'glyphicon glyphicon-pencil']) !!}
								{!! link_to_route('faqs.show', "",['i'=>$faq->id], ['class' =>'glyphicon glyphicon-eye-open']) !!}
								{!! Form::open(['route' => ['faqs.destroy',$faq->id],'method'=>'DELETE','style'=>'display: inline;','class'=>'destroy']) !!}
									<button class="btn btn-link glyphicon glyphicon-trash" ></button>
								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection

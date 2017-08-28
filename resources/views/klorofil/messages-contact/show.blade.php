@extends('klorofil.layout')
@section('content')
	<h3 class="page-title"><a href="{{ route('messages-contact.index') }}">Mensajes</a></h3>
	<div class="panel">
		<div class="panel-body table-responsive">
			<div class="row">
				<div class="col-sm-5">
					<h4>Nombre: {{ $message->name }} </h4>
					<h5>{{ $message->email }}</h5>
					<small>{{ $message->created_at->diffForHumans()}}</small>
					<hr>
					{{ $message->message }}
				</div>
				<div class="col-sm-7">
					<h4><b>Enviar una respuesta</b></h4>
					<hr>
					<form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="{{ route('response-message-contact',[$message->id]) }}" role="form">
                		{{ csrf_field() }}
	                    <div class="row">
                            <div class="form-group">
                                <input name="email" type="text" class="form-control" required="required" placeholder="Correo electrónico" value="{{ $message->email }}">
                            </div>
                            <div class="form-group">
                            	<textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Respuesta"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary ">Responder</button>
                            </div>
	                    </div>
	                </form>
				</div>
			</div>
		</div>
	</div>
@endsection

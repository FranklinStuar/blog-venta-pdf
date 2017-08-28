@extends('emails.template')

@section('title')
    Respuesta a su mensaje <br>
@endsection

@section('content')
    <small>{{ $message_old }}</small>
    <br>
    <b>...</b>
    <br>
    {{ $response }}
@endsection


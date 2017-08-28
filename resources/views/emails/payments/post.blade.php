@extends('emails.template')

@section('title')
    Informe de pago
@endsection

@section('content')
    <h3>Hola {{ $user->name }},</h3>
    Tu pago fue realizado con éxito, desde hoy tiene acceso completo a los documentos de la publicación {{$post_name}}
@endsection

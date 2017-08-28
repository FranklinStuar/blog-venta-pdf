
@extends('emails.template')

@section('title')
    Informe de pago a publicidad
@endsection

@section('content')
    <h3>Hola {{ $user->name }},</h3>
    
    <p>Has realizado un Pago a la publicidad: "{{ $sponsor->name }}"</p>

    <p>Tu pago fue realizado con éxito, desde hoy tiene acceso completo a los documentos de la publicación {{$post_name}}</p>
    <p>Desde ahora tiene {{ $premium->prints }} impresiones para que todos los visitantes revisen su publicidad</p>
@endsection

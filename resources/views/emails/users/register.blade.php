@extends('emails.template')

@section('title')
    Registro de usuario
@endsection

@section('content')
    <h3>Hola {{ $user->name }},</h3>
    <p>
        Soy {{ $system->responsable }}, quiero darte la bienvenida a <span class="bolder">"Sistema"</span> y que disfrutes de la información que comparto contigo para tu desarrollo personal, estudiantil o la actividad que realices.
    </p>
    <p>
        <span class="bolder">Tu nombre de usuario:</span> {{ $user->username }}
    </p>
    <p>
        <span class="bolder">Tu contraseña:</span> {{ $password }}
    </p>
    <p>
        Recuerda <b>no</b> compartir con nadie tu contraseña
    </p>
@endsection

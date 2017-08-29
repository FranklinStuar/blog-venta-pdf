<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
   <style>
    
    .head{
        height: 50px;
        width: 100%;
        background: #cfd8dc;
        margin-bottom: 5px;
    }
    .logo{
        max-width: 30px;
        max-height: 30px;
        margin-right: 30px;
        float: right;
        vertical-align: middle;
    }
    .title h1{
        color: #fafafa;
        font-size: 17px;
    }
    .main{
        .text-align: justify;
    }
    .footer{
        text-align: center;
    }
    .footer .links:focus,
    .footer .links:hover,
    .footer .links{
        color: #64b5f6;
        text-decoration: none;
        margin-top: 0 4px;
    }
   </style>

</head> 

<body class="body" background="#fafafa" width="100%">
    <div height: "3px" width: "100%" background= "#37474f"></div>
    <div class="head">
        <div class="title" > <h1>@yield('title')</h1></div>
        <img class="logo" src="{{ url('images/favicon.png') }}" alt="Neurocodigo">
    </div>
    <br><hr>
    <div class="main">
        @yield('content')
    </div>
    <br><hr>

    <div class="footer">
        @yield('footer')
        <p>El equipo de <a href="{{ url('/') }}">Neurocodigo</a> está comprometido completamente con su crecimiento ofreciendo las mejores herramientas para su desarrollo personal y profesional.</p>
        <p>Puede contactar directamente con el personal de <a href="{{ url('/') }}">Neurocodigo</a> respondiendo este mesaje.</p>
        <p>En caso de tener alguna duda no dude en comunicarsea</p>
        <p>Telf: {{ $system->telefono }} - Wpp: {{ $system->celular }}</p>
        O visitenos en nuestras oficinas ubicadas en {{ $system->direccion }}
        

        <div class="links">
            <a href="{{ route('show-service',['quienes-somos']) }}">Quienes Somos</a>
            <a href="{{ route('show-service',['politicas-condiciones']) }}">Políticas y condiciones</a>
            <a href="{{ route('show-service',['cuentas-premium']) }}">Cuentas de pago</a>
            <a href="{{ route('show-service',['partners']) }}">Publicidad y Partners</a>
            <a href="{{ route('show-service',['contacts']) }}">Contactanos</a>
        </div>
    </div>
    <div height: "3px" width: "100%" background= "#37474f"></div>
</body>
</html>
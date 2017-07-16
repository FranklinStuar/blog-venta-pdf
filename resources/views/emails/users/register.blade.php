<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Correo de bienvenida</title>
   <style>

   .titulo {
    color: #fafafa;
    padding-top: 20px;
    padding-bottom: 10px;
    text-align: center;
    background: #0d47a1 !important;
    width: 100%;
    }

    .body{
     background-color: #fafafa;	
     width: 100%;
    }


    .div_contenido{
    color: #212121;
    padding-top: 20px;
    padding-bottom: 10px;
    padding-left: 20px;
    padding-right: 20px;
   }
    .bolder{
        font-weight: bolder;
    }
    .div_footer{
    color: #eeeeee;
    padding-top: 20px;
    padding-bottom: 10px;
    padding-left: 20px;
    padding-right: 20px;
    width: 100%;
    margin: 0;
    background-color: #424242 !important;
   }
    a{
        color: #fafafa;
    }
   </style>

</head> 

<body class="body">

<div class="titulo" > <h1>Bienvenido</h1></div>
<hr>
<div class="div_contenido" ><h3>Hola {{ $user->name }},</h3></div>
<div class="div_contenido" >
    <p>
        Soy {{ $system->responsable }}, quiero darte la bienvenida a <span class="bolder">"Neurocodigo"</span> y que disfrutes de la información que comparto contigo para tu desarrollo personal, estudiantil o la actividad que realices.
    </p>
    <p>
        <span class="bolder">Tu nombre de usuario:</span> {{ $user->username }}
    </p>
    <p>
        <span class="bolder">Tu contraseña:</span> {{ $password }}
    </p>
    <p>
        Recuerda no compartir con nadie tu contraseña
    </p>
</div>
<br><br>
<div class="div_footer" >
    <p>Visita mi página en: http://neurocodigo.com</p>
    <p>Visita mi local en "{{ $system->direccion }}"</p>
    <p>Comunícate a mi correo <a href="mailto:{{ $system->email }}">{{ $system->email }}</a>, 
     y mi teléfono personal "{{ $system->celular }}" o en mi oficina al "{{ $system->telefono }}"
    </p>
</div>
	

</body>
</html>
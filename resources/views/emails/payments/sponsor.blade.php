<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pago realizado con éxito</title>
   <style>

   .titulo {
    color: #1e80b6;
    padding-top: 20px;
    padding-bottom: 10px;
    padding-left: 20px;
    padding-right: 20px;
    }

    .body{
     background-color: #ECECEC;	
    }


    .div_contenido{
    color: #1e80b6;
    padding-top: 20px;
    padding-bottom: 10px;
    padding-left: 20px;
    padding-right: 20px;
    background-color: #ffffff !important;
   }

   </style>

</head> 

<body class="body">

<div class="titulo" > <h1>Pago realizado con éxito</h1></div>
<hr>
<div class="div_contenido" > Ha realizado un Pago a la publicidad: "{{ $sponsor->name }}"</div>
<div class="div_contenido" > Desde ahora tiene {{ $premium->prints }} impresiones para que todos los visitantes revisen su publicidad</div>


<div class="div_contenido" >Saludos de parte de <b> {{url('/')}} </b> </div>
	
</body>
</html>
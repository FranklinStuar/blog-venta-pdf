<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Correo de bienvenida</title>
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

<div class="titulo" > <h1>Información Neurocodigo</h1></div>
<hr>
<div class="div_contenido" > <?= $contenido;   ?></div>

<div class="div_contenido" >NO OLVIDE VISITAR NUESTRO SISTIO WEB <b>http://neurocodigo.com</b> </div>
	
</body>
</html>
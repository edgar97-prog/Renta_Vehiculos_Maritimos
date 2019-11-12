<!DOCTYPE html>
<html>
<head>
	<title>Error</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/estilos.css')}}">
</head>
<body>
	<div id="error">
		<center><h1>Lo sentimos, la dirección es invalida.</h1>
	Volver al <a href="{{url('/')}}">Inicio</a>
	</center>
		<img src="{{asset("imagenesInicio/404.jpg")}}" width="70%" height="70%">
	</div>
	<a href="https://es.vecteezy.com/"> Vectores por Vecteezy</a>
	<style type="text/css">
		body
		{
			background-image: {{asset("imagenesInicio/404.jpg")}};
		}
	</style>
</body>
</html>

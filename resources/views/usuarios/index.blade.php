<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de usuarios</title>
</head>
<body>
	<center>
	<form action="/success" method="POST" accept-charset="utf-8">
		<table border="1" align="center">
			<caption>USUARIOS REGISTRADOS</caption>
			<thead>
				<tr>
					<th>Correo</th>
					<th>Nombre</th>
					<th>Sexo</th>
				</tr>
			</thead>
			<tbody>
				@foreach($usuarios as $usu)
				<tr>
					<td>{{$usu->Correo}}</td>
					<td>{{$usu->Nombre}} {{$usu->ApellidoP}} {{$usu->ApellidoM}}</td>
					<td>{{$usu->Sexo}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</form>
	</center>
</body>
</html>
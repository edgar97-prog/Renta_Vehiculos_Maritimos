<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de usuarios</title>
</head>
<body>
	<center>
	<form action="route(usuario.store)" method="POST" accept-charset="utf-8">
		@csrf
		<table>
			<caption>REGISTRO DE USUARIOS</caption>
			<thead>
				<tr>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><label for="correo">Correo:</label></td>
					<td><input type="text" name="Correo" placeholder="example@example.com"></td>
				</tr>
				<tr>
					<td><label for="correo">Clave:</label></td>
					<td><input type="password" name="Contra" placeholder="**************"></td>
				</tr>
				<tr>
					<td><label for="nombre">Nombre:</label></td>
					<td><input type="text" name="Nombre"></td>
				</tr>
				<tr>
					<td><label for="Ap">Apellido Materno:</label></td>
					<td><input type="text" name="Ap"></td>
				</tr>
				<tr>
					<td><label for="Am">Apellido Materno:</label></td>
					<td><input type="text" name="Am"></td>
				</tr>
				<tr>
					<td><label for="Sexo">Sexo:</label></td>
					<td>
						<select name="Sexo">
						  <option value="M" selected>Masculino</option> 
						  <option value="F">Femenino</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="btnReg" value="Registrar">
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	</center>
</body>
</html>
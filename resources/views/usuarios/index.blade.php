@extends('../plantilla')

@section('cuerpo')
	<center>
		<table border="1" align="center">
			<thead align="center">
				<tr>
					<th>Correo</th>
					<th>Nombre</th>
					<th>Sexo</th>
				</tr>
			</thead>
			<tbody align="center">
				@foreach($usuarios as $usu)
				<tr>
					<td>{{$usu->Correo}}</td>
					<td>{{$usu->Nombre}} {{$usu->ApellidoP}} {{$usu->ApellidoM}}</td>
					<td>{{$usu->Sexo}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</center>
@endsection
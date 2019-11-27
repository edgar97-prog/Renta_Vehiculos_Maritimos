@extends('plantilla')

@section('cuerpo')
	<br><br><br><br>
	<div>
		<center><label><h1> Registro de Rentas </h1></label></div></center>
		<br>
		<table class="table table-hover">
			<thead>
				<td>Correo</td>
				<td>Nombre</td>
				<td>Embarcación</td>
				<td>Precio de Renta / hr.</td>
				<td>Horas de Renta</td>
				<td>Precio / hrs Renta</td>
				<td>Fecha</td>
				<td>Estatus</td>
			</thead>
			<tbody>
				@foreach($datosRenta as $datos)
			<tr>
				<td>{{$datos->Correo}}</td>
				<td>{{$datos->ApellidoP}} {{$datos->ApellidoM}} {{$datos->Nombre_Usuario}}</td>
				<td>{{$datos->Nombre}}</td>
				<td>{{$datos->precioRenta}} USD</td>
				<td>{{$datos->hrsRenta}}</td>
				<td>{{$datos->hrsRenta * $datos->precioRenta}} USD</td>
				<td>{{$datos->fechaIni}}</td>
				@if($datos->estatus == 'E')
				<td>Espera</td>
				@if($datos->estatus == 'C')
				<td>Cancelado</td>
				@endif
				@endif
			</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@endsection

@section('footers')

@endsection
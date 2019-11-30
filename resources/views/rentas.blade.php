@extends('plantilla')

@section('cuerpo')
	<br><br><br><br>
	<div>
		<center><label><h1> Registro de Rentas </h1></label></div></center>
		<br>
		@if(session()->has('mensaje'))
		<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<center>
		<h4>{{session()->get('mensaje')}}</h4>
		</center>
	</div>
		@endif
		<table class="table table-bordered table-hover">
			<thead class="table">
				<td>Correo</td>
				<td>Nombre</td>
				<td>Embarcación</td>
				<td>Precio de Renta / hr.</td>
				<td>Horas de Renta</td>
				<td>Precio / hrs Renta</td>
				<td>Fecha</td>
				<td>Estatus</td>
				<td>Acciones</td>
			</thead>
			<tbody>
				@foreach($datosRenta as $datos)
				@if($datos->estatus == 'C')
			<tr class="table-danger">
				@endif
				@if($datos->estatus == 'E')
			<tr class="table-warning">
				@endif
				@if($datos->estatus == 'A')
			<tr class="table-success">
				@endif
				<td>{{$datos->Correo}}</td>
				<td>{{$datos->ApellidoP}} {{$datos->ApellidoM}} {{$datos->Nombre_Usuario}}</td>
				<td>{{$datos->Nombre}}</td>
				<td>{{$datos->precioRenta}} USD</td>
				<td>{{$datos->hrsRenta}}</td>
				<td>{{$datos->hrsRenta * $datos->precioRenta}} USD</td>
				<td>{{$datos->fechaIni}}</td>
				@if($datos->estatus == "E")
				<td><strong>Espera</strong></td>
				@endif
				@if($datos->estatus == "C")
				<td><strong>Cancelado</strong></td>
				@endif
				@if($datos->estatus == "A")
				<td><strong>Aceptado</strong></td>
				@endif
				<td>
				<div style="width:180px">
				@if($datos->estatus == "C")
    			<a href="/administra/renta/{{$datos->id}}/1"><button class="btn btn-success" disabled="true">Aceptar</button></a>
    			<a href="/administra/renta/{{$datos->id}}/2"><button class="btn btn-warning" disabled="true">Cancelar</button></a>
    			@else
    			<a href="/administra/renta/{{$datos->id}}/1"><button class="btn btn-success">Aceptar</button></a>
    			<a href="/administra/renta/{{$datos->id}}/2"><button class="btn btn-warning">Cancelar</button></a>
    			@endif
   				 </div>
				</td>
			</tr>
				@endforeach
			</tbody>
		</table>
		<center>{{$datosRenta->links()}} </center>
	</div>

@endsection

@section('footers')

@endsection
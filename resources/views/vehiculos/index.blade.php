@extends('plantilla')
@section('cuerpo')
	
	<div class="container">
		<center><h3 class="subtitle">Vehiculos</h3></center>
	@if(session()->has('mensaje'))
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	<center>
	<h4>{{session()->get('mensaje')}}</h4>
	</center>
	</div>
	@endif
		<button class="let nvo_vehiculo">+</button>
		<table class="footable">
			<thead>
				<th>Nombre</th>
				<th>Descripción</th>
				<th>Precio de Renta</th>
				<th>Cantidad</th>
				<th>Fotografia Principal</th>
			</thead>
			<tbody>
		@foreach($vehiculos as $vehiculo)
				<tr>
					<td>{{$vehiculo->Nombre}}</td>
					<td>{{$vehiculo->Descripcion}}</td>
					<td>{{$vehiculo->precioRenta}}</td>
					<td>{{$vehiculo->Cantidad}}</td>
					<td></td>
				</tr>
		@endforeach
			</tbody>
		</table>

	</div>
		@include('vehiculos.modales.agregar')
	@if($errors->any())
	@foreach($errors->all() as $error)
	<script>
		$('#ModalAgregar').modal('show');
	</script>
	@endforeach
	@endif
@endsection
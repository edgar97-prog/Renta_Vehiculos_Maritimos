@extends('plantilla')
@isset($rol)
	@section('opcMenu')
		@if($rol == 3 || $rol == 2)
	    <li class="nav-item" id="opcpanel">
	        <a class="nav-link btn btn-warning" href="{{ url('paneladmin') }}">PANEL ADMINISTRATIVO</a>
	    </li>
	    @endif
	@endsection
@endisset
@section('cuerpo')


<meta name="_token" content="{!!csrf_token()!!}">
	

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
		<button class="let nvo_vehiculo" style="cursor: pointer;">+</button>
		<table class="footable">
			<thead>
				<th>Nombre</th>
				<th>Descripción</th>
				<th>Precio de Renta</th>
				<th>Cantidad</th>
				<th>Fotografías</th>
			</thead>
			<tbody>
		@foreach($vehiculos as $vehiculo)
				<tr data-id='{{$vehiculo->id}}' class="registro">
					<td>{{$vehiculo->Nombre}}</td>
					<td>{{$vehiculo->Descripcion}}</td>
					<td>{{$vehiculo->precioRenta}}</td>
					<td>{{$vehiculo->Cantidad}}</td>
					<td>
						@foreach($vehiculo->Fotos as $foto)
						<img width="90" height="90" src="{{asset("fotos/$foto->Foto")}}">
						@endforeach
					</td>
				</tr>
		@endforeach
			</tbody>
		</table>

	</div>
		@include('vehiculos.modales.agregar')
		@include('vehiculos.modales.modificar')
	@if($errors->any())
	<script>
		$('#ModalAgregar').modal('show');
	</script>
	@endif
@endsection
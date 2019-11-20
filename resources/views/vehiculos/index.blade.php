@extends('plantilla') @isset($rol) @section('opcMenu') @if($rol == 3 || $rol == 2)
<li class="nav-item" id="opcpanel">
<a class="nav-link btn btn-warning" href="{{ url('paneladmin') }}">PANEL ADMINISTRATIVO</a>
</li>
 @endif @endsection @endisset @section('cuerpo')
 <div class="cuerpo">
<meta name="_token" content="{!!csrf_token()!!}">
<div class="container">
	<center>
	<h3 class="subtitle">Panel de Vehiculos</h3>
	<ul>
		<li><label for="info">Gestiona los vehiculos, Consulta, Actualiza o Modifica Información.</label></li>
	</ul>
	</center>
	@if(session()->has('mensaje'))
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<center>
		<h4>{{session()->get('mensaje')}}</h4>
		</center>
	</div>
	 @endif
	  <span>
	<form id="busqueda" method="POST" action="/busqueda/especifica">
		 @csrf <label>Nombre del vehiculo</label><input type="text" name="nombre" autocomplete="off"><button type="submit" class="btn btn-primary">Buscar</button>
	</form>
	<form method="GET" action="{{route('vehiculos.index')}}">
		<button type="submit" id="btn_general" class="btn btn-success">Consultar Todo</button>
	</form>
	<button class="let nvo_vehiculo" style="cursor: pointer;">+</button>
	</span>
	<table class="table table-hover">
	<thead valign="center">
		<tr>
			<th>Nombre</th>
			<th>Descripción</th>
			<th>Precio de Renta</th>
			<th>Precio Descuento</th>
			<th>Tipo</th>
			<th>Hora min. Renta</th>
			<th>Fotografías</th>
		</tr>
	</thead>
	<tbody>
	 @foreach($vehiculos as $vehiculo)
	<tr data-id='{{$vehiculo->id}}' class="registro tabVehi">
		<td><div>{{$vehiculo->Nombre}}</div></td>
		<td><div class="tdDes">{{$vehiculo->Descripcion}}</div></td>
		<td><div>{{$vehiculo->precioRenta}}</div></td>
		<td><div>{{$vehiculo->precioDescuento}}</div></td>
		<td><div>{{$vehiculo['TipoVehiculo']['tipo']}}</div></td>
		<td><div>{{$vehiculo->horasRenta}}</div></td>
		<td><div class="tdFoto">
			 @foreach($vehiculo->Fotos as $foto) <img width="90" height="90" src="{{asset("fotos/$foto->Foto")}}"> @endforeach
		</div></td>
	</tr>
	 @endforeach
	</tbody>
	</table>
	<center>{{$vehiculos->links()}} </center>
</div>
 @include('vehiculos.modales.agregar') @include('vehiculos.modales.modificar') @if($errors->any())
 </div>
<script>
		$('#ModalAgregar').modal('show');
</script>
	@endif
@endsection

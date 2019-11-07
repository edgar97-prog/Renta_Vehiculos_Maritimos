@extends('plantilla')
@section('opcMenu')
	@if($rol == 3 || $rol == 2)
    <li class="nav-item" id="opcpanel">
        <a class="nav-link btn btn-warning" href="{{ url('paneladmin') }}">PANEL ADMINISTRATIVO</a>
    </li>
    @endif
@endsection

@section('cuerpo')

@foreach($vehiculos as $vehiculo)
<table style="width: 30%; height: 600px; display: inline; border-style: solid;">
	<tr>
		<td>
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner">
			  	@for($i = 0; $i< count($vehiculo['fotos']); $i++)
					<div class="carousel-item active">
				      <img class="d-block w-100" src="" alt="First slide">
				    </div>
				@endfor
			  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		</td>
	</tr>
	<tr class="table-info">
		<td >
			{{$vehiculo['Nombre']}}
		</td>
	</tr>
	<tr class="table-info">
		<td >
			{{$vehiculo['Cantidad']}}
		</td>
	</tr>

</table>
	
@endforeach

@endsection
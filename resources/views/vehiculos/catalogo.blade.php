@extends('plantilla')
@section('opcMenu')
	@if($rol == 3 || $rol == 2)
    <li class="nav-item" id="opcpanel">
        <a class="nav-link btn btn-warning" href="{{ url('paneladmin') }}">PANEL ADMINISTRATIVO</a>
    </li>
    @endif
@endsection

@section('cuerpo')
<div align="center">
	<table style="border: solid; width: 50%;">
		<tr>
			<td>
				<div style="text-align: right; background-color: #ebebeb;">
					{!!Form::label('l','MX:')!!}  {!!Form::radio('precio','1',true,['class' => 'rdPrecio'])!!}
					{!!Form::label('l','USD:')!!} {!!Form::radio('precio','0',false,['class' => 'rdPrecio'])!!}
				</div>
			</td>
			<td>
				<div align="right" style="background-color: #ebebeb;">
					<form class="form-inline my-2 my-lg-0">
				      <input id="nombreVehiculoBuscar" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				      <button id="btBuscar" class="btn btn-outline-success my-2 my-sm-0" type="button">Search</button>
				    </form>
				</div>
			</td>
		</tr>
	</table>
</div>

<script>
	let body = document.getElementById('body');
	body.style.background = '#ebebeb';
</script>
@foreach($vehiculos as $vehiculo)
<a href="{{route('vehiculos.show',$vehiculo['id'])}}">
<table class="TablaVehiculo">
	<tr>
		<td colspan="2">
			<div class="botonMG" >
				<span>
					<div class="botonMG btnTrans">
						{!! Form::open(['url' => '/','method' => 'GET']) !!}
						{!!Form::submit('MG',['class'=>'btnAction','title' =>'Agregar a favoritos'])!!}
						
					</div>
					<i class="fa fa-heart-o icoFav iconoFa" title="Agregar a favoritos"></i>
				</span>
			</div>
			<div style="padding: 6px">
				<div id="carouselExampleControls{{$vehiculo['id']}}" class="carousel slide" data-ride="carousel">
				  <div class="carousel-inner">
				  	@if(count($vehiculo['fotos']) !=0)
				  	<div class="carousel-item active">
					 	<img class="d-block w-100 Img" src="{{asset("fotos")}}/{{$vehiculo["Fotos"][0]["Foto"]}}" alt="First slide">
					</div>
				  	@for($i = 1; $i< count($vehiculo['fotos']); $i++)
					    <div class="carousel-item">
					      <img class="d-block w-100 Img" src="{{asset("fotos")}}/{{$vehiculo["Fotos"][$i]["Foto"]}}" alt="Second slide">
					    </div>
					@endfor
					@endif
				  <a class="carousel-control-prev" href="#carouselExampleControls{{$vehiculo['id']}}" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Anterior</span>
				  </a>
				  <a class="carousel-control-next" href="#carouselExampleControls{{$vehiculo['id']}}" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Siguiente</span>
				  </a>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div>
				{{$vehiculo['Nombre']}}
			</div>
		</td>
	</tr >
	<tr >
		<td colspan="2">
			<div>
				<span>
					Disponibles: {{$vehiculo['Cantidad']}}
				</span>
			</div>
		</td>
	</tr>
	<tr style="height: 85px;">
		<td style="width: 40%">
			<div id="precioRenta">
					Precio de renta:
			</div>
		</td>
		<td>
			<div id="precioRenta">
				@if($vehiculo['precioDescuento'] !=0)
				<div >
					$<i class="precioRenta">{{$vehiculo['precioRenta']}}</i> <br>
				</div>
				<div style="display: inline-block;">
					$<i class="precioDescuento">{{$vehiculo['precioDescuento']}}</i> 
				</div>
				<div style="display: inline-block;">
					<i class="Descuento">{{$vehiculo['Descuento']}}% desc.</i>
				</div>
				@else
					$<i class="precioDescuento">{{$vehiculo['precioRenta']}}</i> <br>
				@endif
			</div>
		</td>
	</tr>
	<tr >
		<td colspan="2">
			 {!! Form::text('vehiculo', $vehiculo['id'],['class' => 'textboxHidden']) !!}
			 {!! Form::close() !!}
		</td>
	</tr>
</table>
</a>
@endforeach

@endsection
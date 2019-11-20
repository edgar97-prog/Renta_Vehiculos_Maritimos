@extends('plantilla')
@section('opcMenu')
	@if($rol == 3 || $rol == 2)
    <li class="nav-item" id="opcpanel">
        <a class="nav-link btn btn-warning" href="{{ url('paneladmin') }}">PANEL ADMINISTRATIVO</a>
    </li>
    @endif
@endsection

@section('cuerpo')
<div class="center">
	{!! Form::open(['url' => '/catalogo','method' => 'GET', 'class'=>'form-inline my-2 my-lg-0']) !!}
	<table >
		<tr>
			<td class="colBG">
				<div style="text-align: center; " class="radio">
					{!!Form::radio('precio','1',false,['class' => 'rdPrecio','id' => 'mxn'])!!}
					{!!Form::label('mxn','MXN')!!}  

					{!!Form::radio('precio','0',true,['class' => 'rdPrecio','id' => 'usd'])!!}
					{!!Form::label('usd','USD')!!} 
				</div>
			</td>
			<td class="colBG">
				
			</td>
			<td class="colBG">
				<div align="right" style="">
					{!!Form::text('nombreVehiculoBuscar','',['class' => 'form-control mr-sm-2','id' =>'nombreVehiculoBuscar', 'type' => 'search', 'placeholder' => 'Buscar', 'aria-label' => 'Search'])!!}
				    
				</div>
			</td>
			<td class="colBG">
				<div align="left" style="background-color: #ebebeb;">
					{!!Form::submit('Buscar',['id'=>'btBuscar','class' =>'btn btn-outline-success my-2 my-sm-0'])!!}
				</div>
			</td>
		</tr>
	</table>
	{!! Form::close() !!}
</div>

<script>
	let body = document.getElementById('body');
	body.style.background = '#ebebeb';
</script>
@csrf
@foreach($vehiculos as $vehiculo)
<a href="{{route('vehiculos.show',$vehiculo['id'])}}">
<table class="TablaVehiculo">
	<tr>
		<td colspan="2" style="width: 1000px;">
			<div style="padding: 6px;">
				<div id="carouselExampleControls{{$vehiculo['id']}}" class="carousel slide" data-ride="carousel" style="width: 100%;">
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
			<div class="botonMG" >
				<span>
					<div class="botonMG btnTrans">
						{!! Form::open(['id'=>$vehiculo['id'], 'class'=>'formAction']) !!}
						{!!Form::submit('MG',['class'=>'btnAction','title' =>'Agregar a favoritos','type' =>'button'])!!}
						
					</div>
					@if(Session::has('user_session'))
						@if(count($vehiculo['Favoritos'])== 0)
						<span id="span{{$vehiculo['id']}}"><i class="fa fa-heart-o fa-lg iconoFa" title="Agregar a favoritos"></i></span>
						@else
						<span id="span{{$vehiculo['id']}}"><i class="fa fa-heart fa-lg iconoFa" aria-hidden="true"></i></span>
						@endif
					@else
						<span id="span{{$vehiculo['id']}}"><i class="fa fa-heart-o fa-lg iconoFa" title="Agregar a favoritos"></i></span>
					@endif
				</span>
			</div>
		</td>
	</tr>
	<tr style="height: 100px;">
		<td style="width: 40%">
			<div id="precioRenta">
					Precio de <br>
					renta x Hr:
			</div>
		</td>
		<td>
			<div id="precioRenta">
				@if($vehiculo['Descuento'] !=0)
				<div style="">
					$<i class="precioRenta">{{$vehiculo['precioRenta']}} USD</i> <br>
				</div>
				<div style="display: inline-block;">
					$<i class="precioDescuento">{{$vehiculo['precioDescuento']}} USD</i>  
				</div>
				<div style="display: inline-block;">
					<i class="Descuento">{{$vehiculo['Descuento']}}% desc.</i> 
				</div>
				@else
					$<i class="precioDescuento">{{$vehiculo['precioRenta']}} USD</i> <br>
				@endif
			</div>
		</td>
	</tr>
	<tr>
		<td style="width: 40%">
			<div>
					Capacidad:
			</div>
		</td>
		<td>
			<div align="center">
				{{$vehiculo['num_personas']}} personas
			</div>
		</td>
	</tr>
	<tr >
		<td colspan="2">
			 {!! Form::text('vehiculo',count($vehiculo['Favoritos']),['class' => 'textboxHidden','id'=>'Ocu'.$vehiculo['id']]) !!}
			 {!! Form::close() !!}
		</td>
	</tr>
</table>
</a>
@endforeach

@endsection
@section('footers')
@include('modal.modalComentario')
@endsection
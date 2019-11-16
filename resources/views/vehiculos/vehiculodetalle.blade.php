@extends('plantilla')

@section('opcMenu')
	@if($rol == 3 || $rol == 2)
    <li class="nav-item" id="opcpanel">
        <a class="nav-link btn btn-warning" href="{{ url('paneladmin') }}">PANEL ADMINISTRATIVO</a>
    </li>
    @endif
@endsection

@section('cuerpo')
<script>
	$('body').css('background','#f7f7f7');
	document.getElementById("cuerpo").classList.add('cuerpoestilo');
</script>
<div class="subcuerpoestilo">
	<div class="col-img">
		<div class="col-imgs">
			<ul class="listImgs">
				@for ($i = 0; $i < count($fotos); $i++)
					@if($i == 0)
					<li><img id="{{$fotos[$i]['id']}}" class="imgselected img-fluid" src="../fotos/{{$fotos[$i]['Foto']}}" width="76" height="76" alt="Img"></li>
					@else
					<li><img id="{{$fotos[$i]['id']}}" class="img-fluid" src="../fotos/{{$fotos[$i]['Foto']}}" width="76" height="76" alt="Img"></li>
					@endif
				@endfor
			</ul>
		</div>
		<div class="col-img-current">
			<img class="imgCurrent img-fluid" id="imgCurrent" src="../fotos/{{$fotos[0]['Foto']}}" width="297" height="500" alt="Img">
		</div>
	</div>
	<div class="col-details">
		<div class="tituloProd">
			{{$vehiculo['Nombre']}}
			<i class="fa fa-heart-o icoFav" aria-hidden="true" title="Agregar a favoritos"></i>
			<i class="fa fa-heart" id="addedFav" title="Quitar de favoritos" aria-hidden="true"></i>
		</div>
		<hr width="100">
		<div class="DescProd">
			{{$vehiculo['Descripcion']}}
		</div>
		<div class="PrecProd">
			${{$vehiculo['precioRenta']}}
			<span class="descuento">10% OFF</span>
			<span class="available">Disponibles {{$vehiculo['Cantidad']}}</span>
		</div>
		<div class="caract">
			<span>Selecciona las horas de renta</span>
			<div class="row">
				<div class="select_mate" data-mate-select="active" >
					<select name="Horas" onclick="return false;" id="">
					  @for($i = $vehiculo['horasRenta']; $i < 9; $i+=$vehiculo['horasRenta'])
					  <option value="{{$i}}">{{$i}}</option>
					  @endfor
					</select>
				    <p class="selecionado_opcion"  onclick="open_select(this)" ></p>
				    <span onclick="open_select(this)" class="icon_select_mate">
				      <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
				      <path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"/>
				      <path d="M0-.75h24v24H0z" fill="none"/>
				  	  </svg>
				  	</span>
				  <div class="cont_list_select_mate">
				    <ul class="cont_select_int listHrs" >  </ul> 
				  </div>
				</div>
			</div>
			<p>Seleccionar fecha: <button class="btn" id="showCalendar">--/--/----</button></p>
			<span>Selecciona la hora de inicio de apartado</span>
			<div class="row">
				<div class="calendar" id="calendar"></div>
				<div class="select_mate" data-mate-select="active" >
					<select name="HrInicio" onclick="return false;" id="listaHrsIni">
					  @for($i = 9; $i < 18-$vehiculo['horasRenta']; $i++)
					  @if($i > 11)
					  <option value="{{$i}}">{{$i}}:00 pm</option>
					  @else
					  <option value="{{$i}}">{{$i}}:00 am</option>
					  @endif
					  @endfor
					</select>
				    <p class="selecionado_opcion"  onclick="open_select(this)" ></p>
				    <span onclick="open_select(this)" class="icon_select_mate">
				      <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
				      <path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"/>
				      <path d="M0-.75h24v24H0z" fill="none"/>
				  	  </svg>
				  	</span>
				  <div class="cont_list_select_mate">
				    <ul class="cont_select_int HrInicio">  </ul> 
				  </div>
				</div>
			</div>
		</div>
		<button class="btn btn-warning" style="margin-top: 30px;width: 100%;margin-left: 5px;">
			¡RENTAR AHORA!
		</button>
	</div>
</div>
@endsection

@section('footers')
@include('modal.modalComentario')
@endsection
@extends('plantilla')
@section('headers')
<link type="text/css" rel="stylesheet" href="{{asset('magiczoomplus/magiczoomplus.css')}}"/>
@endsection

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
		</div>
		<hr>
		<div class="DescProd">
			{{$vehiculo['Descripcion']}}
		</div>
		<div class="PrecProd">
			${{$vehiculo['precioRenta']}}
		</div>
	</div>
</div>
@endsection
@section('footers')
<script type="text/javascript" src="{{asset('magiczoomplus/magiczoomplus.js')}}"></script>
@endsection
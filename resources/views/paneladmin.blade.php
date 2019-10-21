@extends('../plantilla')
@section('opcMenu')
	@if($rol == 3 || $rol == 2)
    <li class="nav-item">
        <a class="nav-link btn btn-warning" href="{{ url('paneladmin') }}">PANEL ADMINISTRATIVO</a>
    </li>
    @endif
@endsection

@section('cuerpo')
<div class="container-fluid" style="position: absolute; left: 0;">
	<div class="aside">
		<h4>REGISTROS</h4>
		<hr style="background: gray;">
		<ul class="listaPanel">
			@if($rol == 3)
				<li>EMPLEADOS
				<ul class="sublistaPanel">
					<a href="{{action('UsuariosController@create')}}">
						<li>AGREGAR</li>
					</a>
					<a href="#">
						<li>BUSCAR</li>
					</a>
					<a href="#">
						<li>ELIMINAR</li>
					</a>
				</ul>
				</li>
			@endif
				<li>VEHÍCULOS
				<ul class="sublistaPanel">
					<a href="{{action('VehiculosController@index')}}">
						<li>AGREGAR</li>
					</a>
					<a href="#">
						<li>BUSCAR</li>
					</a>
					<a href="#">
						<li>ELIMINAR</li>
					</a>
				</ul>
				</li>
		</ul>
	</div>
</div>
@endsection
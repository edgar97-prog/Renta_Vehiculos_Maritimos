@extends('../plantilla')
@section('opcMenu')
	@if($rol == 3 || $rol == 2)
    <li class="nav-item">
        <a class="nav-link btn btn-warning" href="{{ url('paneladmin') }}">PANEL ADMINISTRATIVO</a>
    </li>
    @endif
@endsection

@section('cuerpo')
<div class="container-fluid row">
	<div class="aside col-sm-3">
		<h4>REGISTROS</h4>
		<hr style="background: gray;">
		<ul class="listaPanel">
			@if($rol == 3)
				<li>EMPLEADOS
				<ul class="sublistaPanel">
					<a href="{{action('UsuariosController@create')}}">
						<li>AGREGAR</li>
					</a>
					<li id="btnVerTodo">VER TODO</li>
				</ul>
				</li>
			@endif
				<a href="{{action('VehiculosController@index')}}">
					<li style="cursor: pointer;">VEHÍCULOS</li>
				</a>
		</ul>
	</div>
	<div class="col-sm-8 subcuerpo" id="subcuerpo">
		<h4 id="tituloemp">EMPLEADOS REGISTRADOS</h4>
		<table class="footable">
			<thead>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Sexo</th>
				<th>Accion</th>
			</thead>
			<tbody id="tbody">
			</tbody>
		</table>
	</div>
</div>
@endsection
@extends('../plantilla')
@section('opcMenu')
	@if($rol == 3 || $rol == 2)
    <li class="nav-item" id="opcpanel">
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
				<li><i class="fa fa-users" aria-hidden="true"></i>
 				EMPLEADOS
				<ul class="sublistaPanel">
					<a href="{{action('UsuariosController@create')}}">
						<li><i class="fa fa-user-plus" aria-hidden="true"></i>
 				AGREGAR</li>
					</a>
					<li id="btnVerTodo"><i class="fa fa-users" aria-hidden="true"></i> VER TODO</li>
				</ul>
				</li>
			@endif
				<a href="{{action('VehiculosController@index')}}">
					<li style="cursor: pointer;"><i class="fa fa-ship" aria-hidden="true"></i>
 					VEHÍCULOS</li>
				</a>
		</ul>
		<h4>COMENTARIOS</h4>
		<hr style="background: gray;">
		<ul class="listaPanel">
			<li id="btnVerComentarios"><i class="fa fa-envelope-o" aria-hidden="true"></i>
 			BANDEJA DE ENTRADA</li>
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
			<tbody id="tbody" title="Presione doble click para ver más datos">
			</tbody>
		</table>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-8 subcuerpo" id="subcuerpoComments">
		<div class="row">
			<div class="col-sm-3 col-Users">
				<h3 style="font-family: sans-serif;padding-top: 10px;">Usuarios</h3>
				<ul class="listaUsers"></ul>
			</div>
			<div class="col-sm-9">
				<div class="mensajes" id="mensajes"></div>
			</div>
		</div>
	</div>
	<div class="w-100"></div>
	<input type="hidden" id="token" value="{{csrf_token()}}">
</div>
@include('usuarios.modales.datos')
@include('usuarios.modales.datoscliente')
@endsection
@section('footers')
@include('modal.modalComentario')
@endsection
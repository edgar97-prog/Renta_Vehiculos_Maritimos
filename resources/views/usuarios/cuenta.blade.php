@extends('../plantilla')

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
	<center>
		@if($errors->actualiza->any())
        @foreach($errors->actualiza->all() as $error)
        <br>
        <div class="alert alert-danger">
          {{$error}}
        </div>
        @break
        @endforeach
        @endif
		<table align="center" class="tbcuenta">
			<thead align="center">
				<tr>
					<th></th>
				</tr>
			</thead>
			<tbody align="center">
				<tr>
					<td style="padding-top: 10px;">
						<img src="fotos/usuario.png" width="150" height="150" alt="Img">
					</td>
				</tr>
				<tr>
					<td style="padding-bottom: 10px;">
						<form id="frmcuenta" action="{{route('usuarios.update','true')}}" method="POST" style="margin-top: 10px; padding: 0px 20px;">
							@method('PUT')
							{{ csrf_field() }}
							<div class="row">
							<div class="col-xs-1 col-sm-3">Nombre:</div>
							<div class="col-xs-11 col-sm-9">
								<input type="text" name="Nombre" class="form-control" value="{{$user['Nombre']}}">
							</div>
							</div>
							<div class="row">
							<div class="col-xs-1 col-sm-3">Apellido paterno:</div>
							<div class="col-xs-11 col-sm-9">
								<input type="text" name="ApellidoP" class="form-control" value="{{$user['ApellidoP']}}">
							</div>
							</div>
							<div class="row">
							<div class="col-xs-1 col-sm-3">Apellido materno:</div>
							<div class="col-xs-11 col-sm-9">
								<input type="text" name="ApellidoM" class="form-control" value="{{$user['ApellidoM']}}">
							</div>
							</div>
							<div class="row">
							<div class="col-xs-1 col-sm-3">Sexo:</div>
							<div class="col-xs-11 col-sm-9">
								<select name="Sexo" class="form-control">
									@if($user['Sexo'] == 'M')
									<option value="M" selected>Masculino</option>
									<option value="F">Femenino</option>
									<option value="I">Indistinto</option>
									@elseif($user['Sexo'] == 'F')
									<option value="M">Masculino</option>
									<option value="F" selected>Femenino</option>
									<option value="I" >Indistinto</option>
									@else
									<option value="M">Masculino</option>
									<option value="F">Femenino</option>
									<option value="I" selected>Indistinto</option>
									@endif
								</select>
							</div>
							</div>
							<div class="row">
							<div class="col-xs-1 col-sm-3">Telefono:</div>
							<div class="col-xs-11 col-sm-9">
								<input type="text" name="Telefono" class="form-control" value="{{$user['telefonos'][0]['Telefono']}}">
							</div>
							</div>
							<div class="row">
								<div class="col-sm-12" colspan="2" align="center"><hr></div>
							</div>
							@if($rol == 2)
								<div class="row">
									<div class="col-sm-3">Calle:</div>
									<div class="col-sm-9">
										<input type="text" name="Calle" class="form-control" value="{{$user['direcciones'][0]['Calle']}}">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3">Colonia:</div>
									<div class="col-sm-9">
										<input type="text" name="Colonia" class="form-control" value="{{$user['direcciones'][0]['Colonia']}}">
									</div>
								</div>
							
								<div class="row">
									<div class="col-sm-3">Código postal:</div>
									<div class="col-sm-9">
										<input type="text" name="CP" class="form-control" value="{{$user['direcciones'][0]['CP']}}">
									</div>
								</div>
							@endif
							<div class="row">
								<div class="col-sm-12" style="padding-top: 10px;">
									<button id="btnDesb" type="submit" class="btn btn-primary" style="width: 30%; min-width: 100px;">Modificar <i class="fa fa-pencil"></i></button>
								</div>
								<div class="col-sm-12" style="padding-top: 10px;">
									<button id="btnCancelar" class="btn btn-danger" style="width: 30%; min-width: 100px;">Cancelar <i class="fa fa-times" aria-hidden="true"></i>
									</button>
								</div>
							</div>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
	</center>
@endsection
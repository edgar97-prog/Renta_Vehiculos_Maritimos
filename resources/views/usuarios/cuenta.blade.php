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
		<div class="bordeestilo">
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
						<table style="margin-top: 10px;">
							<thead>
								<tr>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody id="tbbodycuenta">
								<tr>
									<div class="row">
									<td class="col-sm-3">Nombre:</td>
									<td class="col-sm-9">
										<div class="form-control" style="width: 100%;text-align: center;">
											{{$user['Nombre']}}
										</div>
									</td>
									</div>
								</tr>
								<tr>
									<div class="row">
									<td class="col-sm-3">Apellido paterno:</td>
									<td class="col-sm-9">
										<div class="form-control" style="width: 100%;text-align: center;">
											{{$user['ApellidoP']}}
										</div>
									</td>
									</div>
								</tr>
								<tr>
									<div class="row">
									<td class="col-sm-3">Apellido materno:</td>
									<td class="col-sm-9">
										<div class="form-control" style="width: 100%;text-align: center;">
											{{$user['ApellidoM']}}
										</div>
									</td>
									</div>
								</tr>
								<tr>
									<div class="row">
									<td class="col-sm-3">Sexo:</td>
									<td class="col-sm-9">
										<div class="form-control" style="width: 100%;text-align: center;">
											@if($user['Sexo'] == 'M')
											<i class="fa fa-mars" aria-hidden="true"></i>
											Masculino
											@else
											<i class="fa fa-venus" aria-hidden="true"></i>
											Femenino
											@endif
										</div>
									</td>
									</div>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		</div>
	</center>
@endsection
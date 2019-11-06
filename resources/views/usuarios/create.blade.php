@extends('plantilla')
@isset($rol)
	@section('opcMenu')
		@if($rol == 3)
	    <li class="nav-item" id="opcpanel">
	        <a class="nav-link btn btn-warning" href="{{ url('paneladmin') }}">PANEL ADMINISTRATIVO</a>
	    </li>
	    @endif
	@endsection
@endisset

@section('cuerpo')
<center>
@isset($rol)
	@if($rol == 3)
		<h3 class="subtitle">REGISTRAR EMPLEADO</h3>
	@else
		<h3 class="subtitle">REGISTRATE</h3>
	@endif
@else
	<h3 class="subtitle">REGISTRATE</h3>
@endisset

@if($errors->any())
	@foreach($errors->all() as $error)
		<div class="alert alert-danger">
			{{$error}}
		</div>
		@break
	@endforeach
@endif

@if(session()->has('mensaje'))
	<div class="alert alert-success">
		{{session()->get('mensaje')}}
	</div>
@endif

@isset($rol)
@if($rol == 3)
{!! Form::open(['url' => 'nvoEmpleado','method' => 'post']) !!}
@else
{!! Form::open(['route' => 'usuarios.store','method' => 'post']) !!}
@endif
@else
{!! Form::open(['route' => 'usuarios.store','method' => 'post']) !!}
@endisset
{!!Form::token()!!}
	<table class="tablaReg">
		<thead>
			<tr>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{!!Form::label('correo','Correo:')!!}</td>
				<td>{!! Form::email('Correo',null,['placeholder'=>'example@example.com','class'=>'form form-control','required'=>'y']) !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('clave','Clave:')!!}</td>
				<td>{!! Form::password('Contra',['placeholder'=>'********','class'=>'form form-control','required'=>'y','max'=>'30','min'=>'8']) !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('Nombre','Nombre:')!!}</td>
				<td>{!! Form::text('Nombre',null,['class'=>'form form-control','required'=>'y','pattern'=>'[a-zA-Z ñÑáéíóúÁÉÍÓÚ]{3,20}','autocomplete'=>'off']) !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('Ap','Apellido Paterno:')!!}</td>
				<td>{!! Form::text('ApellidoP',null,['class'=>'form form-control','required'=>'y','pattern'=>'[a-zA-Z ñÑáéíóúÁÉÍÓÚ]{3,20}','autocomplete'=>'off']) !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('Am','Apellido Materno:')!!}</td>
				<td>{!! Form::text('ApellidoM',null,['class'=>'form form-control','required'=>'y','pattern'=>'[a-zA-Z ñÑáéíóúÁÉÍÓÚ]{3,20}','autocomplete'=>'off']) !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('sexo','Sexo:')!!}</td>
				<td>{!! Form::select('Sexo',['M'=>'Masculino','F'=>'Femenino'],'M',['class'=>'form form-control','required'=>'y']) !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('tel','Telefono / Celular:')!!}</td>
				<td>{!! Form::text('Telefono',null,['class'=>'form form-control','required'=>'y','pattern'=>'[0-9]{7,10}','autocomplete'=>'off']) !!}</td>
			</tr>
			@isset($rol)
				@if($rol == 3)
					
					<tr>
						<td colspan="2">
							<h3 align="center">DATOS DEL DOMICILIO</h3>
						</td>
					</tr>
					<tr>
						<td>{!!Form::label('calle','Calle:')!!}</td>
						<td>{!! Form::text('Calle',null,['class'=>'form form-control','required'=>'y','pattern'=>'[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ#]{5,50}','autocomplete'=>'off']) !!}</td>
					</tr>
					<tr>
						<td>{!!Form::label('colonia','Colonia:')!!}</td>
						<td>{!! Form::text('Colonia',null,['class'=>'form form-control','required'=>'y','pattern'=>'[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]{5,30}','autocomplete'=>'off']) !!}</td>
					</tr>
					<tr>
						<td>{!!Form::label('cp','Código Postal:')!!}</td>
						<td>{!! Form::text('CP',null,['class'=>'form form-control','required'=>'y','pattern'=>'[0-9]{5,5}','autocomplete'=>'off']) !!}</td>
					</tr>
				@endif
			@endisset
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td colspan="2" align="center">
					{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
				</td>
			</tr>
			<tr><td colspan="2"><br></td></tr>
			@isset($rol)
			@if($rol != 3)
			<tr>
				<td colspan="2" align="center"><a href="#" class="login_modal" style="background: white">¿Ya tienes una cuenta?</a></td>
			</tr>
			@endif
			@else
			<tr>
				<td colspan="2" align="center"><a href="#" class="login_modal" style="background: white">¿Ya tienes una cuenta?</a></td>
			</tr>
			@endisset
		</tbody>
	</table>
{!! Form::close() !!}
</center>
@endsection
@extends('../plantilla')

@section('cabecera','Registro usuario')
@section('cuerpo')
<center>
{!! Form::open(['route' => 'usuarios.store','method' => 'post']) !!}
{!!Form::token()!!}
	@csrf
	<table>
		<caption>REGISTRO DE USUARIOS</caption>
		<thead>
			<tr>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{!!Form::label('correo','Correo:')!!}</td>
				<td>{!! Form::text('Correo',null,['placeholder'=>'example@example.com']) !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('clave','Clave:')!!}</td>
				<td>{!! Form::password('Contra',['placeholder'=>'********']) !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('Nombre','Nombre:')!!}</td>
				<td>{!! Form::text('Nombre') !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('Ap','Apellido Paterno:')!!}</td>
				<td>{!! Form::text('Ap') !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('Am','Apellido Materno:')!!}</td>
				<td>{!! Form::text('Am') !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('sexo','Sexo:')!!}</td>
				<td>{!! Form::select('Sexo',['M'=>'Masculino','F'=>'Femenino']) !!}</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					{!! Form::submit('Registrar') !!}
				</td>
			</tr>
		</tbody>
	</table>
{!! Form::close() !!}
</center>
@endsection
@extends('../plantilla')

@section('cuerpo')
<center>
<h3 class="subtitle">REGISTRATE</h3>
{!! Form::open(['route' => 'usuarios.store','method' => 'post']) !!}
{!!Form::token()!!}
	@csrf
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
				<td>{!! Form::password('Contra',['placeholder'=>'********','class'=>'form form-control','required'=>'y']) !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('Nombre','Nombre:')!!}</td>
				<td>{!! Form::text('Nombre',null,['class'=>'form form-control','required'=>'y']) !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('Ap','Apellido Paterno:')!!}</td>
				<td>{!! Form::text('Ap',null,['class'=>'form form-control','required'=>'y']) !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('Am','Apellido Materno:')!!}</td>
				<td>{!! Form::text('Am',null,['class'=>'form form-control','required'=>'y']) !!}</td>
			</tr>
			<tr>
				<td>{!!Form::label('sexo','Sexo:')!!}</td>
				<td>{!! Form::select('Sexo',['M'=>'Masculino','F'=>'Femenino'],'M',['class'=>'form form-control','required'=>'y']) !!}</td>
			</tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td colspan="2" align="center">
					{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
				</td>
			</tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td colspan="2" align="center"><a href="#">¿Ya tienes una cuenta?</a></td>
			</tr>
		</tbody>
	</table>
{!! Form::close() !!}
</center>
@endsection
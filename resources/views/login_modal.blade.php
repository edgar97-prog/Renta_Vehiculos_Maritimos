<div id="login" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content" style="margin-top: 40%;">
			<div class="modal-header header-modal">
				<h4 class="modal-title">INICIO DE SESIÓN</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				@if($errors->any())
				@foreach($errors->all() as $error)
				<div class="alert alert-danger">
					{{$error}}
				</div>
				@break
				@endforeach
				@endif
				{!!Form::open(['url'=>'login','method'=>'POST'])!!}
				<div align="center">
					<table style="width: 90%;">
						<tr>
							<td>{!!Form::label('correo','Correo electrónico:')!!}</td>
							<td>{!! Form::text('Correo',null,['class'=>'form form-control','required'=>'y']) !!}</td>
						</tr>
						<tr>	
							<td>{!!Form::label('contra','Contraseña:')!!}</td>
							<td>{!! Form::password('Contra',['placeholder'=>'********','class'=>'form form-control','required'=>'y']) !!}</td>
						</tr>
						<tr>
							<td colspan="2">
								<div align="center" style="margin-top: 10px;">
									{!! Form::submit('INICIAR SESIÓN',['class'=>'btn btn-primary']) !!}
								</div>
							</td>
						</tr>
					</table>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
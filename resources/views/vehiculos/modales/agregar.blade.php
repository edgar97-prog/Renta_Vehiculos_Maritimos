<div id="ModalAgregar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header header-modal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo Vehiculo</h4>
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
       {!!Form::open(['route'=>'vehiculos.store','method'=>'POST'])!!}

            <table class="tablaReg">
              <tr>
                <td>{!!Form::label('nombre','Nombre:')!!}</td>
                <td>{!! Form::text('Nombre',null,['class'=>'form form-control','required'=>'y']) !!}</td>
              </tr>
              <tr>
               <td>{!!Form::label('Descripcion','Descripción:')!!}</td>
                <td>{!! Form::text('Descripcion',null,['class'=>'form form-control','required'=>'y']) !!}</td>
              </tr>
              <tr>
                <td>{!!Form::label('precioRenta','Precio de Renta:')!!}</td>
                <td>{!! Form::text('precioRenta',null,['class'=>'form form-control','required'=>'y']) !!}</td>
              </tr>
              <tr>
                <td>{!!Form::label('cantidad','Cantidad:')!!}</td>
                <td>{!!Form::text('Cantidad',null,['class'=>'form form-control','required'=>'y']) !!}</td>
              </tr>
              <tr>
                <td>{!!Form::label('foto','Foto Principal:')!!}</td>
                <td>{!!Form::file('foto')!!}</td>
              </tr>
              <td colspan="2" align="center">
                <a href="#" class="btn btn-primary ag_foto"> Agregar fotografia</a>
            </td>
          <div class="fotos">
            
          </div>
            </table>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Registrar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    {!!Form::close()!!}
    </div>

  </div>
</div>
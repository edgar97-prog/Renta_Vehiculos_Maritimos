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
        @endforeach
        @endif
       {!!Form::open(['route'=>'vehiculos.store','method'=>'POST','enctype'=>'multipart/form-data'])!!}

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
              <tr id="fila">
                <td>{!!Form::label('foto','Foto Principal:')!!}</td>
                <td>{!!Form::file('Foto',['class'=>'form form-control'])!!}</td>
                <td>   <a href="#" class="btn btn-primary ag_foto">+</a></td>
                 <td>  <a href="#" class="btn btn-danger rm_foto">-</a></td>
              </tr>
              <input type="text" name="contador" id="cont">
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
<div id="ModalModificar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header header-modal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modificar Vehiculo</h4>
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
                <td>{!! Form::text('Nombre',null,['class'=>'form form-control nombre','required'=>'y']) !!}</td>
              </tr>
              <tr>
               <td>{!!Form::label('Descripcion','Descripción:')!!}</td>
                <td>{!! Form::text('Descripcion',null,['class'=>'form form-control descr','required'=>'y']) !!}</td>
              </tr>
              <tr>
                <td>{!!Form::label('precioRenta','Precio de Renta:')!!}</td>
                <td>{!! Form::text('precioRenta',null,['class'=>'form form-control renta','required'=>'y']) !!}</td>
              </tr>
              <tr>
                <td>{!!Form::label('cantidad','Cantidad:')!!}</td>
                <td>{!!Form::text('Cantidad',null,['class'=>'form form-control cant','required'=>'y']) !!}</td>
              </tr>
              <section id="fot">
                
              </section>
                
            </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    {!!Form::close()!!}
    </div>

  </div>
</div>
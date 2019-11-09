<div id="ModalAgregar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h4 class="modal-title">Nuevo Vehiculo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                <td>{!!Form::label('¿El vehiculo tiene descuento?')!!} </td>
                <td>{!! Form::select('desc',['s'=>'Si','n'=>'No'],'n',['class'=>'form form-control sltdesc']) !!}</td>
              </tr>
              <tr id="desc">
                <td> {!!Form::label('Descuento (%):')!!} </td>
                <td>{!! Form::text('Descuento',null,['class'=>'form form-control montodesc']) !!}
                </td>
              </tr>
              <tr>
                <td>{!!Form::label('horasRenta','Horas min. Renta:')!!}</td>
                <td>{!!Form::number('horasRenta',null,['class'=>'form form-control','required'=>'y']) !!}</td>
              </tr>
              <tr>
                <td>{!!Form::label('tipoVehiculo','Tipo:')!!}</td>
                <td>
                    <select name="tipoVehiculos_id" class="form-control">
                      @foreach($tipoVehiculos as $tipo)
                      <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                      @endforeach
                    </select> 
                </td>
              </tr>
              <tr id="fila">
                <td>{!!Form::label('foto','Foto Principal:')!!}</td>
                <td>{!!Form::file('Foto',['class'=>'form form-control'])!!}</td>
                <td>   <a href="#" class="btn btn-primary ag_foto">+</a></td>
                <td>  <a href="#" class="btn btn-danger rm_foto">-</a></td>
              </tr>
              <input type="hidden" name="contador" id="cont">
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
<div id="ModalModificar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h4 class="modal-title">Modificar Vehiculo</h4>
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
       {!!Form::open(['enctype'=>'multipart/form-data','class'=>'formod'])!!}
            @method('PUT')
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
                <td>{!!Form::label('descuento','¿El vehiculo tiene descuento?')!!}</td>
                <td>{!!Form::select('desc',['s'=>'Si','n'=>'No'],'s',['class'=> 'form-control  descuento'])!!}</td>
              </tr>
              <tr id="muestra">
                <td>{!!Form::label('Descuento','Descuento (%):')!!}</td>
                <td>{!!Form::text('Descuento',null,['class'=>'form form-control desc']) !!}</td>
              </tr>
              <tr>
                  <td>{!!Form::label('horasRenta','Horas min. Renta:')!!}</td>
                  <td>{!!Form::number('horasRenta',null,['class'=>'form form-control horas','required'=>'y']) !!}</td>
              </tr>
              <tr>
                <td>{!!Form::label('tipo','Tipo de vehiculo:')!!}</td>
                <td><select name="tipoVehiculos_id" class="form-control tipos">
                </select></td>
              </tr>
            </table>
            <input type="hidden" name="idfot" id="idfot">
            <input type="hidden" name="idv" id="idv">
      <center>
              <label>Para eliminar, haga clic sobre la fotografia.</label>
              <section id="fot">
                
              </section>
              <section id="fil">
                <label>Si desea agregar fotografias, utilice los siguientes botones</label><br>
              <a href="#" class="btn btn-primary ag_fotomod">+</a><a href="#" class="btn btn-danger rm_fotomod">-</a>
              </section>
              <input type="hidden" name="nvafotos" id="nvafotos">
      </center>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
      </div>
    {!!Form::close()!!}
    <center><form id="form_elim" method="POST" action="">
      @method('DELETE')
      @csrf 
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form> </center>
    </div>

  </div>
</div>
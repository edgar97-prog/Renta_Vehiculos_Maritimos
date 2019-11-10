<div id="ModalOferta" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    @if(!empty($vehiculoMostrado))
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h4 class="modal-title">¡No te lo puedes perder!</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <center><h1><label class="bg-warning"> ¡Te puede interesar! </label></h1>
      <label>{{$vehiculoMostrado[0]['Nombre']}}</label><br>
       <label>Ahorras un {{$vehiculoMostrado[0]['Descuento']}}%</label><br>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
<img class="d-block w-100 Img" src="{{asset("fotos")}}/{{$vehiculoMostrado[0]["Fotos"][0]["Foto"]}}" alt="First slide">
          </div>
            @for($i = 1; $i <= (count($vehiculoMostrado[0]['Fotos'][0]->toArray())-1); $i++)
              <div class="carousel-item">
                <img class="d-block w-100 Img" src="{{asset("fotos")}}/{{$vehiculoMostrado[0]["Fotos"][$i]["Foto"]}}" alt="Second slide">
              </div>
          @endfor

          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
          </a>
        </div>
      </div>
       </center>
      </div>
      <div class="modal-footer">
       <a href="{{route('vehiculos.show',$vehiculoMostrado[0]['id'])}}"><button type="submit" class="btn btn-primary">Me interesa</button></a> 
        <button type="button" class="btn btn-danger" data-dismiss="modal">No, gracias</button>
      </div>
    </div>
    @endif
  </div>
</div>

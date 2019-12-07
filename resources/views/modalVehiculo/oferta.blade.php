<div id="ModalOferta" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    @if(!empty($vehiculoMostrado))
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <center><h1><label class="bg-warning"> ¡Te puede interesar! </label></h1>
    <h2><label>{{$vehiculoMostrado[0]['Nombre']}}</label></h2><br>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
  @if(count($vehiculoMostrado[0]['Fotos']->toArray())>0)
            <div class="carousel-item active">
<img class="d-block w-100 Img" src="{{asset("fotos")}}/{{$vehiculoMostrado[0]["Fotos"][0]["Foto"]}}" alt="First slide">
          </div>
          @else
            <center><h1>Por el momento no contamos con fotografías.</h1></center>
  @endif
         
        @if(count($vehiculoMostrado[0]['Fotos']->toArray())>1)
       
            @for($i = 1; $i <= (count($vehiculoMostrado[0]['Fotos']->toArray())-1); $i++)
              <div class="carousel-item">
                <img class="d-block w-100 Img" src="{{asset("fotos")}}/{{$vehiculoMostrado[0]["Fotos"][$i]["Foto"]}}" alt="Second slide">
              </div>
          @endfor
        @endif

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

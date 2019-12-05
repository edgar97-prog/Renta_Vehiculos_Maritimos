@extends('../plantilla')
@isset($rol)
@section('opcMenu')
	@if($rol == 3 || $rol==2)
    <li class="nav-item" id="opcpanel">
        <a class="nav-link btn btn-warning" href="{{ url('paneladmin') }}">PANEL ADMINISTRATIVO</a>
    </li>
    @endif
@endsection
@endisset

@section('cuerpo')
<script>
  var bod = document.getElementById("cuerpo");
  bod.classList.remove("container");
  $('body').css("overflow-x","hidden");
</script>
<div class="wrapper bgded overlay" style="background-image:url('{{asset("imagenesInicio/inicio.png")}}');">
  <div id="pageintro" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <article>
      <h3 class="heading">Bienvenido</h3>
      <p>Atrevete a disfrutar de una nueva y agradable experiencia en Los Cabos.</p>
    </article>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<br><br><br><br> 
 <center> <div id="carouselVehiculos" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <li data-target="#carouselVehiculos" data-slide-to="0" class="active"></li>
    <li data-target="#carouselVehiculos" data-slide-to="1"></li>
    <li data-target="#carouselVehiculos" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
  @if(count($Fotos)>1)
    <a href="{{route("vehiculos.show",$idvehiculos[0])}}">
    <img class="d-block w-100" src="{{asset("fotos/$Fotos[0]")}}" alt="First slide">
    </a>
    </div>
     @for($i = 1; $i<=(count($Fotos)-1) ; $i++)
    <div class="carousel-item">
      <a href="{{route("vehiculos.show",$idvehiculos[$i])}}">
      <img class="d-block w-100" src="{{asset("fotos/$Fotos[$i]")}}" alt="Second slide">
    </a>
    </div>
    @endfor
    @else
    <center><h1>Por el momento no contamos con fotografías.</h1></center>
  @endif
  </div>
    <a class="carousel-control-prev" href="#carouselVehiculos" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselVehiculos" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  
</div><br>
<a href="{{url("/catalogo")}}">
<button class="btn btn-primary">
      Ver catálogo
</button>
</a>
</form>
</center>
<br><br><br><br>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper bgded" style="background-image:url('{{asset("imagenesInicio/yate.jpeg")}}');">
  <div class="hoc split clear">
    <section> 
      <!-- ################################################################################################ -->
      <h2 class="heading">The Pelican´s</h2>
      <p>Somo un negocio 100% mexicano, dedicado desde hace ya varios años a la renta de vehiculos maritimos, actualmente nos hemos renovado con la inclusión de un sitio web, para brindar una mejor atención al cliente.</p>
      <ul class="fa-ul">
        <li><i class="fa-li fa fa-check-circle"></i>No dejes pasar la oportunidad y atrevete a vivir una experiencia para recordar.</li>
        <li><i class="fa-li fa fa-check-circle"></i>Ponemos a tu disposición una gran variedad de vehiculos, dale un vistazo a nuestro catalogo.</li>
      </ul>
      <footer><a class="btn" href="#">Read More &raquo;</a></footer>
      <!-- ################################################################################################ -->
    </section>
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<br><br><br><br>
<div class="wrapper row3">
  <section class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <div class="group">
      <div class="one_half first"><br>
      <br>
      <br><br>
        <h6 class="heading font-x3" style="color: black;">El placer de The Pelican's Los Cabos</h6>
        <p style="color: black;">Siempre sabes lo que quieres, y te gusta disfrutar de los placeres
        de la vida, no esperes más y disfruta de días inolvidables, a lado de los tuyos,
        solo con las comodidades que mereces, memorias para recordar y un sin fin de
        diversión, te estamos esperando. </p>
      </div>
      <div class="one_half"><img id="desc1" height="40" src="{{asset("imagenesInicio/descripcion.jpeg")}}" alt=""></div>
    </div>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<br><br><br><br>
<div class="wrapper row3">
  <div class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <h6 class="heading">Mauris eget commodo tellus</h6>
      <p>Imperdiet urna non iaculis vestibulum sapien purus dignissim</p>
    </div>
    <div class="group latest">
      <article class="one_third first">
        <figure><a class="imgover" href="#"><img src="images/demo/320x220.png" alt=""></a></figure>
        <div class="txtwrap">
          <h4 class="heading">Lectus ac eros nullam</h4>
          <ul class="nospace meta">
            <li><i class="fa fa-user"></i> <a href="#">Admin</a></li>
            <li><i class="fa fa-tag"></i> <a href="#">Category</a></li>
            <li><i class="fa fa-comments"></i> <a href="#">6 Comments</a></li>
          </ul>
        </div>
      </article>
      <article class="one_third">
        <figure><a class="imgover" href="#"><img src="images/demo/320x220.png" alt=""></a></figure>
        <div class="txtwrap">
          <h4 class="heading">Purus nisl vitae ultrices</h4>
          <ul class="nospace meta">
            <li><i class="fa fa-user"></i> <a href="#">Admin</a></li>
            <li><i class="fa fa-tag"></i> <a href="#">Category</a></li>
            <li><i class="fa fa-comments"></i> <a href="#">8 Comments</a></li>
          </ul>
        </div>
      </article>
      <article class="one_third">
        <figure><a class="imgover" href="#"><img src="images/demo/320x220.png" alt=""></a></figure>
        <div class="txtwrap">
          <h4 class="heading">Eros sollicitudin vel</h4>
          <ul class="nospace meta">
            <li><i class="fa fa-user"></i> <a href="#">Admin</a></li>
            <li><i class="fa fa-tag"></i> <a href="#">Category</a></li>
            <li><i class="fa fa-comments"></i> <a href="#">10 Comments</a></li>
          </ul>
        </div>
      </article>
    </div>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- JAVASCRIPTS -->
@include('modalVehiculo.oferta')
@include('modal.modalComentario')
  <script>
    $('#ModalOferta').modal('show');
  </script>
@endsection
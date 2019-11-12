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
    @if(count($Fotos)>0)
      <img class="d-block w-100" src="{{asset("fotos/$Fotos[0]")}}" alt="First slide">
    </div>
     @for($i = 1; $i<=(count($Fotos)-1) ; $i++)
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset("fotos/$Fotos[$i]")}}" alt="Second slide">
    </div>
    @endfor
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
<form method="POST" action="{{url("/catalogo")}}">
  @csrf
<button class="btn btn-primary">
      Ver catálogo
</button>
</form>
</center>
<br><br><br><br>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper bgded" style="background-image:url('{{asset("imagenesInicio/yate.png")}}');">
  <div class="hoc split clear">
    <section> 
      <!-- ################################################################################################ -->
      <h2 class="heading">The Pelican´s</h2>
      <p>Somo un negocio 100% mexicano, dedicado desde hace ya varios años a la renta de vehiculos maritimos, actualmente nos hemos renovado con la inclusión de un sitio web, para brindar una mejor atención al cliente.</p>
      <ul class="fa-ul">
        <li><i class="fa-li fa fa-check-circle"></i>No dejes pasar la oportunidad y atrevete a vivir una experiencia para recordar.</li>
        <li><i class="fa-li fa fa-check-circle"></i>Ponemos a tu disposición una gran variedad de vehiculos, no esperes más y dale un vistazo a nuestro catalogo.</li>
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
      <div class="one_half first">
        <p class="font-xs">Tristique senectus et netus</p>
        <h6 class="heading font-x3">Consectetur accumsan habitant morbi</h6>
        <p>Sapien etiam vulputate ligula eu felis blandit a efficitur ex consequat aenean id ornare lacus vitae condimentum quam sed varius feugiat elit id tristique etiam non volutpat lorem nulla vitae venenatis augue at fermentum.</p>
        <p>Et fames ac turpis egestas donec eget enim eu neque euismod mollis suspendisse malesuada sed quam ac [&hellip;]</p>
        <footer><a href="#">Read More &raquo;</a></footer>
      </div>
      <div class="one_half"><a href="#"><img src="images/demo/480x360.png" alt=""></a></div>
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
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
@include('modalVehiculo.oferta')
@include('modal.modalComentario')
  <script>
    $('#ModalOferta').modal('show');
  </script>

@endsection
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

<div class="wrapper bgded overlay" style="background-image:url('{{asset("imagenesInicio/inicio.png")}}');">
  <div id="pageintro" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <article>
      <h3 class="heading">Bienvenido</h3>
      <p>Atrevete a disfrutar de una nueva y agradeble experiencia en Los Cabos.</p>
    </article>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<br><br><br><br>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img width="1500" height="200" src="{{asset("imagenesInicio/inicio.png")}}" alt="">
        </div>
        <div class="item">
            <img src="images/image-2.jpeg" alt="">
        </div>
        <div class="item">
            <img src="images/image-3.jpeg" alt="">
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<br><br><br><br>
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
<br><br><br><br>
<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="one_third first">
      <h6 class="heading">Vestibulum ante ipsum primis</h6>
      <ul class="nospace btmspace-30 linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
          Street Name &amp; Number, Town, Postcode/Zip
          </address>
        </li>
        <li><i class="fa fa-phone"></i> +00 (123) 456 7890</li>
        <li><i class="fa fa-envelope-o"></i> info@domain.com</li>
      </ul>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="faicon-dribble" href="#"><i class="fa fa-dribbble"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="heading">In faucibus orci luctus</h6>
      <ul class="nospace linklist">
        <li>
          <article>
            <h2 class="nospace font-x1"><a href="#">Ultrices posuere cubilia</a></h2>
            <time class="font-xs block btmspace-10" datetime="2045-04-06">Friday, 6<sup>th</sup> April 2045</time>
            <p class="nospace">Lorem laoreet blandit donec mollis lacinia massa tincidunt malesuada [&hellip;]</p>
          </article>
        </li>
        <li>
          <article>
            <h2 class="nospace font-x1"><a href="#">Curae cras tincidunt eros</a></h2>
            <time class="font-xs block btmspace-10" datetime="2045-04-05">Thursday, 5<sup>th</sup> April 2045</time>
            <p class="nospace">In id semper turpis in tristique dui ut ac mauris magna nunc eros enim [&hellip;]</p>
          </article>
        </li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="heading">Tincidunt facilisis eros ut</h6>
      <p class="nospace btmspace-30">Pulvinar venenatis commodo sed accumsan eu erat nunc ante sagittis a dolor in.</p>
      <form method="post" action="#">
        <fieldset>
          <legend>Newsletter:</legend>
          <input class="btmspace-15" type="text" value="" placeholder="Name">
          <input class="btmspace-15" type="text" value="" placeholder="Email">
          <button type="submit" value="submit">Submit</button>
        </fieldset>
      </form>
    </div>
    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>

@endsection
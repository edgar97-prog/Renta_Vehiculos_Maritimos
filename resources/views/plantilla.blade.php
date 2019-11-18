<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/index.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/vehiculos.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/login.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/dateformat.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/scripts.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('css/estilos.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/calendar.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        @yield('headers')
        <title>The Pelican's</title>
    </head>
    <body id='body'>
        <header class="header">
            <h2 class="container titulo" style="display: inline-block;">
               The Pelican's - Los Cabos
            </h2>
            <ul class="nav justify-content-end listaMenu">
              <li class="nav-item">
                <a class="nav-link active" href="{{ url('/') }}">INICIO</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/catalogo')}}">CATÁLOGO</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">CONTACTO</a>
              </li>
              @if(!session()->has('user_session'))
                  <li class="nav-item">
                    <a class="nav-link login_modal" href="#">INICIAR SESIÓN</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ action('UsuariosController@create') }}">REGISTRARSE</a>
                  </li>
              @else
                @yield('opcMenu')
                <li class="nav-item" style="padding: 0px 5px;">
                  <h3><i class="fa fa-cog" aria-hidden="true"></i></h3>
                  <ul class="nav sublistaMenu">
                    @if(session()->has('user_session'))
                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('/usuarios') }}">CONFIGURAR CUENTA</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ action('UsuariosController@logout') }}">CERRAR SESIÓN</a>
                    </li>
                    @endif
                  </ul>
                </li>
              @endif
            </ul>
        </header>
        <div class="container cuerpo" id="cuerpo">
            @yield('cuerpo')
        </div>
        @include('login_modal')
        @if($errors->login->any())
        <script>
          $('#login').modal('show');
        </script>
        @endif
        <br><br><br><br>
<div class="wrapper row4">
  <footer id="footer" class="hoc clear foot"> 
    <!-- ################################################################################################ -->
    <div class="one_third first">
      <h6 class="heading">Contacto</h6>
      <ul class="nospace btmspace-30 linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
          Street Name &amp; Number, Town, Postcode/Zip
          </address>
        </li>
        <li><i class="fa fa-phone"></i> +52 744 458 0581</li>
        <li><i class="fa fa-envelope-o"></i> pelicans@dominio.com</li>
      </ul>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
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
      <h6 class="heading">DUDAS O COMENTARIOS</h6>
      <p class="nospace btmspace-30">No dudes en enviarnos dudas o comentarios a continuación.</p>
        <fieldset>
          <legend>Escribe Aquí:</legend>
        <textarea class="btmspace-15 coment"></textarea>
         @if(session()->has('user_session'))
          <button type="button" value="button" class="btnComentarios">Enviar</button>
          @else
          <label>Inicia sesión o registrate para enviar un comentario.</label>
          @endif
        </fieldset>
    </div>
    <meta name="_token" content="{{ csrf_token() }}">
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
@yield('footers')
    </body>
</html>
